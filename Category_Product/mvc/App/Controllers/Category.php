<?php

namespace App\Controllers;
use App\Models\Category as CategoryModel;
use App\Models\Product as ProductModel;
use App\Models\MainModel;
use \Core\View;

class Category extends \Core\Controller {

    public function __construct() {
        $url = MainModel::getAll('url_key,page_title');
        View::templateRender("header.html",['url'=>$url]);
    }

    public function view($url_key) {
        $categories = CategoryModel::getParentChild();
        $productsData = MainModel::getProducts($url_key);
        View::templateRender('frontEnd\pages.html',['productsData'=>$productsData,'categories'=>$categories]);
    }
}

?>