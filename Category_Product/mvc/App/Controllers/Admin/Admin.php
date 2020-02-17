<?php

namespace App\Controllers\Admin;
use \Core\View;
use App\Config;

class Admin extends \Core\Controller {
    
    public function indexAction() {
        echo "Admin";
    }
    
    public function login() {
        View::templateRender('Admin/login.html');
    }

    public function checkUserAction() {
        if($this->validate($_POST)) {
            if($_POST['email']=='ds@ds.com' && $_POST['password']=='Ds123') {
                $this->showAlert("logged in");
                session_start();
                $_SESSION['admin'] = $_POST['email'];
                header('Location: '.Config::BASE_URL.'/admin/admin/dashboard');
            }
        } else {
            View::templateRender('Admin/login.html',['data'=> $_POST,'error' => $this->error]);
        }
    }
    public function dashboard() {
        // if($this->isLoggedIn())
            View::templateRender('Admin/dashboard.html');

    }
    public function showAlert($msg) {
        echo '<script>alert("'.$msg.'")</script>';
    }

    public function validate($data) {
        $this->error = [];
        foreach($data as $key => $value) {
            if(!empty($value)) {
                switch($key) {
                    case 'email':
                        if(!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $value)) {
                            $this->error = [ $key => 'Enter valid '.$key];
                        }
                    break;
                }
            } else {
                $this->error[ $key] = $key.' is required.';
            }
        }
        if(empty($this->error)) {
            return true;
        } else {
            return false;
        }
    }

    public function logout() {
        session_start();
        $_SESSION['admin'];
        session_destroy();
        header('Location: '.Config::BASE_URL.'/admin/admin/login');
    }
    public function isLoggedIn() {
        // session_destroy();
        // session_start();
        $_SESSION['admin'];
        if(isset($_SESSION['admin'])) {
            return TRUE;
        } else {
            header('Location: '.Config::BASE_URL.'/admin/admin/login');
            return FALSE;
        }
    }

}

?>