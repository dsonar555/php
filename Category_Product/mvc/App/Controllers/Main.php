<?php

namespace App\Controllers;
use App\Models\MainModel;
use App\Models\Category;
use Core\View;

class Main extends \Core\Controller {
    
    public function __construct() {
        $url = MainModel::getAll('url_key,page_title');
        View::templateRender("header.html",['url'=>$url]);
    }

    public function viewAction($url_key) {
        if($url_key == 'home') {
            $data = MainModel::getRow($url_key);
            $categories = Category::getParentChild();
            View::templateRender("frontEnd\pages.html",['categories'=>$categories,'data'=>$data]);
        } else {
            $data = MainModel::getRow($url_key);
            View::templateRender("frontEnd\pages.html",['data'=>$data]);
        }
    }
}

?>