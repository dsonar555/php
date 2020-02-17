<?php

namespace App\Controllers\Admin\cms;

use \Core\View;
use App\Config;
use App\Models\Page;

class Pages extends \Core\Controller {
    public function indexAction() {
        $data = Page::getAll();
        View::templateRender('CMS/adminCMS.html',['data' => $data]);
    }
    public function add() {
        if(isset($_POST['submit'])) {
            $data = $_POST['cms'];
            $data['url_key'] = $this->generateUrl($data['page_title']);
            if($this->validate($data)) {
                $data = $this->makeArray($data);
                // print_r($data);
                // die();
                if(Page::insert($data))
                {
                    header('Location: '.Config::BASE_URL.'/admin/cms/pages/index');
                }
            } else {
                View::templateRender('CMS/addNewCMS.html',['data'=> $_POST['cms'],'error' => $this->error]);
            }
        } else {
            View::templateRender('CMS/addNewCMS.html');
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
                        if(!Page::isUniqueUrl($value,$id)) {
                            $this->error[ 'page_title'] = 'Already Exists.';
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

    public function editAction($id = '') {
        if(isset($_POST['edit'])) {
            $data = $_POST['cms'];
            $data['url_key'] = $this->generateUrl($data['page_title']);
            if($this->validate($data)) {
                $data = $this->makeArray($data);
                // print_r($data);
                // die();
                if(Page::update($data,$_POST['id']))
                {
                    header('Location: '.Config::BASE_URL.'/admin/cms/pages/index');
                }
            } else {
                View::templateRender('CMS/addNewCMS.html',['data'=> $_POST['cms'],'error' => $this->error]);
            }
        } else {
            $data = Page::getRow($id);
            View::templateRender('CMS/addNewCMS.html',['data' => $data]);
        }
    }
    public function deleteAction($id) {
        if(Page::delete($id)) {
            header('Location: '.Config::BASE_URL.'/admin/cms/pages/index');
        } else {
            View::templateRender("500.html");
        }
    }

    public function makeArray($rowData) {
    
        foreach($rowData as $key => $value) {
        
            switch($key) {
                case 'page_title':
                    $data['page_title'] = "'$value'";
                    $url_key = $value;
                    break;
                case 'status': 
                    $data['status'] = "'$value'";
                    break;
                case 'content': 
                    $data['content'] = "'$value'";
                    break;
                case 'url_key':
                    $data['url_key'] = "'$value'";
                    break;
            }
        }
        return $data;
    }

    public function generateUrl($name) {
        return strtolower(str_replace(['& ',' '], ['','-'],($name)));
    } 
    
}



?>