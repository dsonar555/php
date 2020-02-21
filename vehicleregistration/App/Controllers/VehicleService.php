<?php

namespace App\Controllers;
use \Core\View;
use App\Models\VehicleModel;
use App\Config;

class VehicleService extends \Core\Controller {
    public function dashboard() {
        $serviceData = VehicleModel::getAll($_SESSION['user_id']);
        View::templateRender('User\dashboard.html',['serviceData'=>$serviceData]);
    }
    protected function before() {
        
        if(isset($_SESSION['user_id'])) {
            return TRUE;
        } else {
            header('Location: '.Config::BASE_URL.'users/login');
            return FALSE;
        }
    }
    public function newService() {
        if(isset($_POST['registerService'])) {
            print_r($_POST);
            if($this->validate($_POST)) {
                // echo "ok";
                if(VehicleModel::insert($_POST)) {
                    header('Location: '.Config::BASE_URL.'vehicle-service/dashboard');
                }
            } else {
                View::templateRender('vehicleService/vehicleServiceRegistration.html',['error'=>$this->error,'data'=>$_POST]);
            }
        } else {
            View::templateRender('vehicleService/vehicleServiceRegistration.html');
        }
    }

    public function validate($data,$operation='') {
        $this->error = [];
        foreach($data as $key => $value) {
            if(!empty($value)) {
                switch($key) {
                    case 'title':
                        if(!preg_match("/^[a-zA-Z ]*$/", $value)) {
                            $this->error[ $key] = 'Enter valid '.$key;
                        }
                    break;
                    case 'vehicle_number':
                        if(!VehicleModel::isUnique('vehicle_number',$value,$_SESSION['user_id'])) {
                            $this->error[ $key] = 'Already exists.';
                        }
                    break;
                    case 'license_number':
                        if(!VehicleModel::isUnique('license_number',$value,$_SESSION['user_id'])) {
                            $this->error[ $key] = 'Already exists.';
                        }
                    break;
                    case 'date':
                        if(!$this->isFutureDate($value)) {
                           $this->error[$key] =  "you can select only future dates.";
                        }
                    break;
                    case 'timeslots':
                        if(!VehicleModel::checkTimeslots($value,$_POST['date'])) {
                           $this->error[$key] =  "this slot allocated to someone else.";
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
    public function isFutureDate($date) {
        // echo $date;
        $opening_date = new \DateTime($date);
        $current_date = new \DateTime();
        // var_dump($opening_date);
        if ($opening_date > $current_date) {
            return true;
        }
        else {
            return false;
        }
    }

}

?>