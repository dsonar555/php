<?php

namespace App\Models;

use PDO;

class Product extends \Core\Model{
    public static function getAll() {

        try {
            $connect = static::connectDB();
            $query = "SELECT * FROM products ORDER BY created_at";
            $result = $connect->query($query);
            $result = $result->fetchALL(PDO::FETCH_ASSOC);
            return $result; 
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }
    public static function insert($data,$tableName) {
        try {
            $connect = static::connectDB();
            $keys = implode(',',array_keys($data));
            $values = implode(',',array_values($data));
            echo $query = "INSERT INTO $tableName ($keys) values ($values)";
            $result = $connect->query($query);
            echo $result = $connect->lastInsertId();
            return $result;
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }
    public static function delete($id,$tableName) {
        try {
            $connect = static::connectDB();
            echo $query = "DELETE FROM $tableName WHERE product_id = $id";
            $result = $connect->prepare($query);
            $result->execute();
            $result = $result->rowCount();
            return $result;
            // return 1;
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }
    public static function getRow($id) {
        try {
            $connect = static::connectDB();
            $query = "SELECT * FROM products WHERE product_id = $id LIMIT 1";
            $result = $connect->query($query);
            $result = $result->fetchALL(PDO::FETCH_ASSOC);
            $query = "SELECT C.category_id FROM products_categories PC LEFT JOIN categories C ON PC.category_id = C.category_id WHERE PC.product_id = $id";
            $result1 = $connect->query($query);
            $result1 = $result1->fetchALL(PDO::FETCH_ASSOC);
            $data = [];
            foreach ($result1 as $row) {
                array_push($data,$row['category_id']);
            }
            $result[0]['category_id'] = $data;
            // print_r($result[0]);
            return $result[0]; 
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function update($data, $id) {
        try {
            $connect = static::connectDB();
            $updateData = '';
            foreach($data as $key =>$value )
            {
                $updateData .= "$key = $value, ";
            }
            $updateData = rtrim($updateData, ', ');
            echo $query = "UPDATE products SET $updateData WHERE product_id= $id";
            $result = $connect->prepare($query);
            $result->execute();
            return $result = $result->rowCount();
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function getAllUsingJoin() {

        try {
            $connect = static::connectDB();
            $query = "";
            $result = $connect->query($query);
            $result = $result->fetchALL(PDO::FETCH_ASSOC);
            return $result; 
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }
    public static function isUniqueUrl($url_key,$id='') {
        try {
            $connect = static::connectDB();
            $query = "SELECT * FROM products WHERE url_key = '$url_key'";
            if(!empty($id)) {
                $query .= " AND product_id != $id";
            }
            $result = $connect->query($query);
            if($result->rowCount()==0) {
                return true;
            }
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }
}

?>