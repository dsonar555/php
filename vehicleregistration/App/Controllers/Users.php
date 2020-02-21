<?php

namespace App\Controllers;
use \Core\View;
use App\Models\User;
use App\Config;

class Users extends \Core\Controller {
    public function login() {
        if(isset($_POST['login'])) {
            // print_r($_POST);
            if($this->validate($_POST))
            {
                // echo "ok";
                $user_id = User::isValidUser($_POST['email'],$_POST['password']);
                if($user_id !==0 ) {
                    $_SESSION['user_id'] = $user_id;
                    header('Location: '.Config::BASE_URL.'vehicle-service/dashboard');
                } else {
                    View::templateRender('User\login.html',['msg'=>"Check your Credentials"]);
                }
            } else {
                View::templateRender('User\login.html',['error'=>$this->error]);
            }
        } else {
            View::templateRender('User\login.html');
        }
    }
    public function register() {
        if(isset($_POST['register'])) {
            if($this->validate($_POST['user'],"registration") && $this->validate($_POST['address'])) {
                // echo "ok";
                $user_id = User::insert($_POST['user'],'users');
                if($user_id) {
                    $data = $_POST['address'];
                    $data['user_id'] = $user_id;
                    if($id = User::insert($data,'user_address'))
                    {
                        header('Location: '.Config::BASE_URL.'users/login');
                    }
                }
            } else {
                View::templateRender('User\register.html',['error'=>$this->error]);
            }
        } else {
            View::templateRender('User\register.html');
        }
    }
    public function validate($data,$operation='') {
        $this->error = [];
        foreach($data as $key => $value) {
            if(!empty($value)) {
                switch($key) {
                    case 'first_name':
                    case 'last_name':
                    case 'city':
                    case 'state':
                    case 'country':
                        if(!preg_match("/^[a-zA-Z ]*$/", $value)) {
                            $this->error[ $key] = 'Enter valid '.$key;
                        }
                    break;
                    case 'mobile_number':
                        if(!preg_match("/^[0-9]{10,10}$/",$value)) {
                            $this->error[ $key] = 'Enter valid '.$key;
                        }
                    break;
                    case 'email':
                        if(!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix",$value))
                        {
                            $this->error[ $key] = 'Enter valid '.$key;
                        }
                    break;
                    case 'password':
                        if($operation == "registration") {
                            if($value != $_POST['user']['confirmPassword'])
                            {
                                $this->error[$key] =  "Password and Confirm password should be same";
                            }
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
        if(isset($_SESSION['user_id'])) {
            session_destroy();
            header('Location: '.Config::BASE_URL.'users/login');
        } else {
            header('Location: '.Config::BASE_URL.'users/login');
        }
    }

}

?>