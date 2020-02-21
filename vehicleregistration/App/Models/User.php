<?php

namespace App\Models;

use PDO;

class User extends \Core\Model {

    public static function insert($data,$tableName) {
        try {
            $connect = static::connectDB();
            $data = self::userData($data);
            $keys = implode(',',array_keys($data));
            $values = implode(',',array_values($data));
            $query = "INSERT INTO $tableName ($keys) values ($values)";
            $result = $connect->query($query);
            $result = $connect->lastInsertId();
            return $result;
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }
    public static function userData($rawData) {
        foreach($rawData as $key => $value) {
            if( ($key != 'confirmPassword') && ($key != 'register')) {
                $data[$key] = "'$value'";
            }
        }
        return $data;
    }
    public static function isValidUser($email,$password) {
        try {
            $connect = static::connectDB();
            $query = "SELECT user_id FROM users WHERE email = '$email' AND password = '$password'";
            $result = $connect->query($query);

            if($result->rowCount() == 1) {
                $result = $result->fetchALL(PDO::FETCH_ASSOC);
                return $result[0]['user_id'];
                // echo $result->rowCount();
            } else {
                return 0;
            }
             
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

}

?>