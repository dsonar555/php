<?php

namespace App\Controllers;
use App\Models\Product as ProductModel;
use \Core\View;
use App\Models\MainModel;
use App\Models\Category as CategoryModel;

class Product extends \Core\Controller {

    public function __construct() {
        $url = MainModel::getAll('url_key,page_title');
        View::templateRender("header.html",['url'=>$url]);
    }

    public function view($url_key) {
        // echo $url_key;
        $categories = CategoryModel::getParentChild();
        $product = ProductModel::getProduct('url_key',$url_key);
        View::templateRender('frontEnd/pages.html',['product'=>$product,'categories'=>$categories]);
    }
}

?>