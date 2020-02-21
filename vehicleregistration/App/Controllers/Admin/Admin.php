<?php

namespace App\Controllers\Admin;
use App\Models\Admin as AdminModel;
use \Core\View;
use App\Config;

class Admin extends \Core\Controller {
    public function dashboard() {
        $services = AdminModel::getAll();
        View::templateRender('Admin\dashboard.html',['serviceData'=>$services]);
    }
    public function updateStatus($id) {
        // echo $id;
        if(AdminModel::updateStatus($id)) {
            header('Location: '.Config::BASE_URL.'admin/admin/dashboard');
        } else {
            header('Location: '.Config::BASE_URL.'admin/admin/dashboard');
        }
    }
    public function updateService($id) {
        if(isset($_POST['edit'])) {
            if($this->validate($_POST)) {
                // echo "ok";
                if(AdminModel::update($_POST)) {
                    header('Location: '.Config::BASE_URL.'admin/admin/dashboard');
                }
            } else {
                View::templateRender('vehicleService/vehicleServiceRegistration.html',['error'=>$this->error,'data'=>$_POST]);
            }
        } else {
            $data = AdminModel::getRow($id,'service_registrations');
            // print_r($data);
            View::templateRender('vehicleService/vehicleServiceRegistration.html',['data'=>$data]);
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
}

?>