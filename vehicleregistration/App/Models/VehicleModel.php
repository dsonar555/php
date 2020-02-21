<?php

namespace App\Models;
use PDO;

class VehicleModel extends \Core\Model {

    public static function getAll($user_id) {

        try {
            $connect = static::connectDB();
            $query = "SELECT * FROM service_registrations WHERE user_id = $user_id ORDER BY created_at";
            $result = $connect->query($query);
            $result = $result->fetchALL(PDO::FETCH_ASSOC);
            return $result; 
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function isUnique($field,$value,$id='') {
        try {
            $connect = static::connectDB();
            $query = "SELECT * FROM service_registrations WHERE $field = '$value'";
            if(!empty($id)) {
                $query .= " AND user_id != $id";
            }
            $result = $connect->query($query);
            if($result->rowCount()==0) {
                return true;
            } else {
                return false;
            }
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function checkTimeslots($slot,$date) {
        try {
            $connect = static::connectDB();
            $query = "SELECT * FROM service_registrations WHERE timeslots = '$slot' AND date = '$date'";
            $result = $connect->query($query);
            if($result->rowCount()<3) {
                return true;
            } else {
                return false;
            }
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function insert($data) {
        try {
            $connect = static::connectDB();
            $data = self::vehicleData($data);
            $keys = implode(',',array_keys($data));
            $values = implode(',',array_values($data));
            echo $query = "INSERT INTO service_registrations ($keys) values ($values)";
            $result = $connect->query($query);
            $result = $connect->lastInsertId();
            return $result;
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }
    public static function vehicleData($rawData) {
        foreach($rawData as $key => $value) {
            if( $key != 'registerService') {
                $data[$key] = "'$value'";
            }
        }
        $data['user_id'] = $_SESSION['user_id'];
        return $data;
    }

    public static function update($data,$id) {
        try {
            $connect = static::connectDB();
            $updateData = '';
            foreach($data as $key =>$value )
            {
                $updateData .= "$key = $value, ";
            }
            $updateData = rtrim($updateData, ', ');
            echo $query = "UPDATE service_registrations SET $updateData WHERE service_id= $id";
            $result = $connect->prepare($query);
            $result->execute();
            return $result = $result->rowCount();
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

}

?>