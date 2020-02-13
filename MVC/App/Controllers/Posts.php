<?php 


namespace App\Controllers;
use \Core\View;
use \App\Models\Post;

class Posts extends \Core\Controller {
    public $error = [];
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
        // echo 'in addNew method '.get_class($this).' controller';
        View::templateRender('Posts/postsForm.html',['base_url'=> dirname($_SERVER['SCRIPT_NAME'])]);
    }
    public function editAction() {
        echo '<br>in edit method from '.get_class($this).' controller';
        echo '<p>Query String parameters : <pre>'.
        htmlentities(print_r($this->route_params,true)).
        '</pre></p>';
    }
    public function addToDatabase() {
        if($this->validate($_POST)) {
            $data = [
                'title' => $_POST['title'],
                'content' => $_POST['content']
            ];
            if(Post::insert($data)) {
                $data = Post::getAll();
                View::templateRender('Posts/index.html',['data'=>$data,
                'base_url'=> dirname($_SERVER['SCRIPT_NAME'])]);
            }
        } else {
            View::templateRender('Posts/postsForm.html',['base_url'=> dirname($_SERVER['SCRIPT_NAME']),'data'=> $_POST,'error' => $this->error]);
        }
    }
    public function validate($data) {
        $this->error = [];
        foreach($data as $key => $value) {
            if(!empty($value)) {
                switch($key) {
                    case 'title':
                        if(!preg_match("/^[a-zA-Z ]*$/", $value)) {
                            $this->error = [ $key => 'Enter valid '.$key];
                        }
                    break;
                }
            } else {
                $this->error[ $key] = $key.' is required.';
            }
        }
        if(empty($this->error)) {
            return 1;
        } else {
            return 0;
        }
    }
}

?>