<?php

namespace App\Controllers\Admin;
use \Core\View;
use App\Config;
use App\Models\Category;
use App\Models\Product;

class Products extends \Core\Controller {
    public function indexAction() {
        $data = Product::getAll();
        View::templateRender('Products/adminProducts.html',['data'=>$data]);
    }
    public function addAction() {
        if(isset($_POST['submit'])) {
            // echo $_FILES['image']['name'];
            // die();
            if($this->uploadFile($_FILES['image']))
            {
                $data = $_POST['product'];
                $data['url_key'] = $this->generateUrl($data['name']);
                if($this->validate($data)) {
                    $data = $this->makeArray($data);
                    $data ['image'] = "'".$_FILES['image']['name']."'";
                    print_r($data);
                    $product_id = Product::insert($data,'products');
                    if($product_id)
                    {
                        foreach($_POST['product']['category_id'] as $category_id) {
                            $data = ['product_id'=>$product_id,
                            'category_id' => $category_id ];
                            $id = Product::insert($data,'products_categories');
                        }
                        if($id)
                        header('Location: '.Config::BASE_URL.'/admin/products/index');
                    }
                } else {
                    $category_names = Category::getAll('category_id,name');
                    View::templateRender('Products/addProductForm.html',['data'=> $_POST['product'],'error' => $this->error,'category_names' => $category_names]);
                }
            } else {
                $category_names = Category::getAll('category_id,name');
                View::templateRender('Products/addProductForm.html',['data'=> $_POST['product'],'error' => $this->error,'category_names' => $category_names]);
            }
        } else {
            $category_names = Category::getAll('category_id,name');
            View::templateRender('Products/addProductForm.html',['category_names' => $category_names]);
        }
    }
    public function validate($data) {
        $this->error = []; 
        foreach($data as $key => $value) {
            //if(!empty($value)) {
                
                switch($key) {
                    // case 'name':
                    //     if(!preg_match("/^[a-zA-Z0-9 ]*$/", $value)) {
                    //         $this->error [ $key] = 'Enter valid '.$key;
                    //     } 
                    // break;
                    case 'url_key':
                        $id = (isset($_POST['id'])? $_POST['id'] : '');
                        if(!Product::isUniqueUrl($value,$id)) {
                            $this->error[ 'name'] = 'Already Exists.';
                        }
                    break;
                }
            // //} else {
            //     $this->error[ $key] = $key.' is required.';
            // }
        }
        if(empty($this->error)) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteAction($id) {
        if(Product::delete($id,'products')) {

            header('Location: '.Config::BASE_URL.'/admin/products/index');
        } else {
            View::templateRender("500.html");
        }
    }

    public function editAction($id = '') {
        if(isset($_POST['edit'])) {
            $data = $_POST['product'];
            echo $data['url_key'] = $this->generateUrl($data['name']);
            
            if($this->validate($data)) {
                $data = $this->makeArray($data);
                if(!empty($_FILES['image']['name'])) {
                    if($this->uploadFile($_FILES['image']))
                    {
                        $data ['image'] = "'".$_FILES['image']['name']."'";
                    } else {
                        $category_names = Category::getAll('category_id,name');
                    View::templateRender('Products/addProductForm.html',['data'=> $_POST['product'],'error' => $this->error,'category_names' => $category_names]);
                    }
                }
                $product_id = $_POST['id'];
                if(Product::update($data,$product_id))
                {
                    if(Product::delete($product_id,'products_categories')) {
                        foreach($_POST['product']['category_id'] as $category_id) {
                            $data = ['product_id'=>$product_id,
                            'category_id' => $category_id ];
                            $id = Product::insert($data,'products_categories');
                        }
                        if($id)
                        header('Location: '.Config::BASE_URL.'/admin/products/index');
                    } else {
                        View::templateRender("500.html");
                    }
                } else {
                    View::templateRender("500.html");
                }
            } else {
                $category_names = Category::getAll('category_id,name');
                    View::templateRender('Products/addProductForm.html',['data'=> $_POST['product'],'error' => $this->error,'category_names' => $category_names]);
            }
        } else {
            $data = Product::getRow('product_id', $id);
            $category_names = Category::getAll('category_id,name');
            View::templateRender('Products/addProductForm.html',['category_names' => $category_names,'data'=> $data]);
        }
    }

    public function makeArray($rowData) {
        print_r($rowData);
        foreach($rowData as $key => $value) {
        
            switch($key) {
                 case 'name':
                     $data['name'] = "'$value'";
                     break;
                case 'url_key':
                    $data['url_key'] = "'$value'";
                    break;
                 case 'status': 
                     $data['status'] = "'$value'";
                     break;
                 case 'description': 
                     $data['description'] = "'$value'";
                    break;
                case 'short_desc': 
                    $data['short_description'] = "'$value'";
                    break;
                case 'SKU': 
                    $data['sku'] = "'$value'";
                    break;
                case 'price': 
                    $data['price'] = "'$value'";
                    break;
                case 'stock': 
                    $data['stock'] = "'$value'";
                    break;
            }
        }
        return $data;
    }
    public function isLoggedIn()
    {
        // session_destroy();
        session_start();
        if(isset($_SESSION['admin'])) {
            return TRUE;
        } else {
            header('Location: '.Config::BASE_URL.'/public/admin/admin/login');
            return FALSE;
        }
    }
    public function uploadFile($file)
    {
        if(isset($file)) {
            //$file = $_FILES['image'];
            $fileName = $file['name'];    
            $tmp_name = $file['tmp_name'];
            if(!empty($file)) {
                $type = $file['type'].'<br>';
                $location = Config::UPLOAD_PATH.'/uploads/Products/';
                if( $type = 'image/jpeg') {
                    if(move_uploaded_file($tmp_name, $location.$fileName)) {
                        return 1;
                    } else {
                        $this->error['image'] = "Error in uploading";
                        return 0;
                    }
                } else {
                    $this->error['image'] = "only images are accepted";
                    return 0;
                }
            } else {
                $this->error['image'] = "Please choose a file";
                return 0;
            }
        }
    }

    public function generateUrl($name) {
        return strtolower(str_replace(['& ',' '], ['','-'],($name)));
    } 

    protected function before() {
        
        if(isset($_SESSION['admin'])) {
            return TRUE;
        } else {
            header('Location: '.Config::BASE_URL.'/admin/admin/login');
            return FALSE;
        }
    }
} 

?>