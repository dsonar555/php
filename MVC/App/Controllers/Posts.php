<?php 


namespace App\Controllers;
use \Core\View;
use \App\Models\Post;

class Posts extends \Core\Controller {
    public function indexAction() {
        //echo '<br>in index method from '.get_class($this).' controller';
        // echo '<p>Query String parameters : <pre>'.
        // htmlentities(print_r($_GET,true)).
        // '</pre>';
        // $data = ['base_url'=> dirname($_SERVER['SCRIPT_NAME']) ];
        $data = Post::getAll();
        View::templateRender('Posts/index.html',['data'=>$data,
        'base_url'=> dirname($_SERVER['SCRIPT_NAME'])]);
    }
    public function addNewAction() {
        echo 'in addNew method '.get_class($this).' controller';
    }
    public function editAction() {
        echo '<br>in edit method from '.get_class($this).' controller';
        echo '<p>Query String parameters : <pre>'.
        htmlentities(print_r($this->route_params,true)).
        '</pre></p>';
    }
}

?>