<?php

namespace App\Controllers\Admin;
use \Core\View;
use App\Config;
use App\Models\Category;

class Categories extends \Core\Controller {
    
    public function indexAction() {
        $data = Category::getAllUsingJoin();
        View::templateRender('Categories/adminCategories.html',['data' => $data]);
    }
        
    public function addAction() {
        if(isset($_POST['submit'])) {
            // echo $_FILES['image']['name'];
            // die();
            if($this->uploadFile($_FILES['image']))
            {
                $data = $_POST['category'];
                $data['url_key'] = $this->generateUrl($data['name']);
                if($this->validate($data)) {
                    $data = $this->makeArray($data);
                    $data ['image'] = "'".$_FILES['image']['name']."'";
                    if(Category::insert($data))
                    {
                        header('Location: '.Config::BASE_URL.'/admin/categories/index');
                    }
                } else {
                    $category_names = Category::getAll('category_id,name');
                    View::templateRender('Categories/addCategoryForm.html',['data'=> $_POST['category'],'error' => $this->error,'category_names' => $category_names]);
                }
            } else {
                $category_names = Category::getAll('category_id,name');
                View::templateRender('Categories/addCategoryForm.html',['data'=> $_POST['category'],'error' => $this->error,'category_names' => $category_names]);
            }
        } else {
            $category_names = Category::getAll('category_id,name');
            View::templateRender('Categories/addCategoryForm.html',['category_names' => $category_names]);
        }
    }

    public function editAction($id = '') {
        if(isset($_POST['edit'])) {
            $data = $_POST['category'];
            echo $data['url_key'] = $this->generateUrl($data['name']);
            
            if($this->validate($data)) {
                $data = $this->makeArray($data);
                if(!empty($_FILES['image']['name'])) {
                    if($this->uploadFile($_FILES['image']))
                    {
                        $data ['image'] = "'".$_FILES['image']['name']."'";
                    } else {
                        View::templateRender('Categories/addCategoryForm.html',['data'=> $_POST['category'],'error' => $this->error]);
                    }
                }
                if(Category::update($data,$_POST['id']))
                {
                    header('Location: '.Config::BASE_URL.'/admin/categories/index');
                }
            } else {
                View::templateRender('Categories/addCategoryForm.html',['data'=> $_POST['category'],'error' => $this->error]);
            }
        } else {
            $data = Category::getRow($id);
            $category_names = Category::getAll('category_id,name');
            View::templateRender('Categories/addCategoryForm.html',['category_names' => $category_names,'data'=> $data]);
        }
    }

    public function deleteAction($id) {
        if(Category::delete($id)) {
            header('Location: '.Config::BASE_URL.'/admin/categories/index');
        } else {
            View::templateRender("500.html");
        }
    }

    public function validate($data) {
        $this->error = []; 
        foreach($data as $key => $value) {
            //if(!empty($value)) {
                
                switch($key) {
                    // case 'name':
                    //     if(!preg_match("/^[a-zA-Z 0-9]*$/", $value)) {
                    //         $this->error [ $key] = 'Enter valid '.$key;
                    //     } 
                    // break;
                    case 'url_key':
                        $id = (isset($_POST['id'])? $_POST['id'] : '');
                        if(!Category::isUniqueUrl($value,$id)) {
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

    public function makeArray($rowData) {

        foreach($rowData as $key => $value) {
        
           switch($key) {
                case 'name':
                    $data['name'] = "'$value'";
                    $url_key = $value;
                    break;
                case 'status': 
                    $data['status'] = "'$value'";
                    break;
                case 'description': 
                    $data['description'] = "'$value'";
                    break;
                case 'parent_category_id':
                    if($value == '0')
                        $data['parent_category_id'] = "NULL";
                    else
                        $data['parent_category_id'] = "$value";  
                    break;
                case 'url_key':
                    $data['url_key'] = "'$value'";
                    break;
           }
       }
       return $data;
    }

    public function uploadFile($file)
    {
        if(isset($file)) {
            $fileName = $file['name'];    
            $tmp_name = $file['tmp_name'];
            if(!empty($file)) {
                $type = $file['type'].'<br>';
                $location = Config::UPLOAD_PATH.'/uploads/Categories/';
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

}

?>