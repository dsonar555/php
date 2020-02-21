<?php

namespace App\Models;
use PDO;

class Admin extends \Core\Model {

    public static function getAll() {

        try {
            $connect = static::connectDB();
            $query = "SELECT service_id,first_name,last_name,title,vehicle_number,license_number,date,timeslots,issue,center,status FROM service_registrations SR LEFT JOIN users U ON SR.user_id = U.user_id ORDER BY SR.created_at";
            $result = $connect->query($query);
            $result = $result->fetchALL(PDO::FETCH_ASSOC);
            return $result; 
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }


    public static function updateStatus($id) {
        try {
            $connect = static::connectDB();
            if(self::getStatus($id) == 0) {
                $status = 1;
            } else {
                $status = 0;
            }
            $query = "UPDATE service_registrations SET status = $status WHERE service_id= $id";
            $result = $connect->prepare($query);
            $result->execute();
            return $result = $result->rowCount();
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }
    public static function getStatus($id) {

        try {
            $connect = static::connectDB();
            $query = "SELECT status FROM service_registrations WHERE service_id = $id";
            $result = $connect->query($query);
            $result = $result->fetchALL(PDO::FETCH_ASSOC);
            return $result[0]['status']; 
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function getRow($id,$tableName) {
        try {
                $connect = static::connectDB();
                $query = "SELECT * FROM $tableName WHERE service_id = '$id' LIMIT 1";
                $result = $connect->query($query);
                $result = $result->fetchALL(PDO::FETCH_ASSOC);
                return $result[0];
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }
}
?>