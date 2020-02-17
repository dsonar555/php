<?php

namespace App\Models;

use PDO;

class Category extends \Core\Model{
    public static function getAll($fields = '*') {

        try {
            $connect = static::connectDB();
            $query = "SELECT $fields FROM categories ORDER BY created_at";
            $result = $connect->query($query);
            $result = $result->fetchALL(PDO::FETCH_ASSOC);
            return $result; 
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function getAllUsingJoin() {

        try {
            $connect = static::connectDB();
            $query = "SELECT\n"
            . "    CC.category_id,\n"
            . "    CC.name,\n"
            . "    CC.url_key,\n"
            . "    CC.image,\n"
            . "    CC.status,\n"
            . "    CC.description,\n"
            . "    PC.name parent\n"
            . "FROM\n"
            . "    `categories` CC\n"
            . "LEFT JOIN categories PC ON\n"
            . "    PC.category_id = CC.parent_category_id ORDER BY CC.created_at";
            $result = $connect->query($query);
            $result = $result->fetchALL(PDO::FETCH_ASSOC);
            return $result; 
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function insert($data) {
        try {
            $connect = static::connectDB();
            $keys = implode(',',array_keys($data));
            $values = implode(',',array_values($data));
            echo $query = "INSERT INTO categories ($keys) values ($values)";
            $result = $connect->query($query);
            return $result = $connect->lastInsertId();
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }
    public static function delete($id) {
        try {
            $connect = static::connectDB();
            $query = "DELETE FROM categories WHERE category_id = $id";
            $result = $connect->prepare($query);
            $result->execute();
            $result = $result->rowCount();
            return $result;
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }
    public static function getRow($id) {
        try {
            $connect = static::connectDB();
            $query = "SELECT * FROM categories WHERE category_id = $id LIMIT 1";
            $result = $connect->query($query);
            $result = $result->fetchALL(PDO::FETCH_ASSOC);
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
            echo $query = "UPDATE categories SET $updateData WHERE category_id= $id";
            $result = $connect->prepare($query);
            $result->execute();
            return $result = $result->rowCount();
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }
    public static function isUniqueUrl($url_key,$id='') {
        try {
            $connect = static::connectDB();
            $query = "SELECT * FROM categories WHERE url_key = '$url_key'";
            if(!empty($id)) {
                $query .= " AND category_id != $id";
            }
            $result = $connect->query($query);
            if($result->rowCount()==0) {
                return true;
            }
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }
    public static function getParentChild() {
        try {
            $connect = static::connectDB();
            $query = "SELECT category_id, url_key,name FROM categories WHERE parent_category_id is null";
            $result = $connect->query($query);
            $result = $result->fetchALL(PDO::FETCH_ASSOC);
            $data = [];
            foreach($result as $row) {
                $query = "SELECT category_id, url_key,name FROM categories WHERE parent_category_id = $row[category_id]";
                $child = $connect->query($query);
                $child = $child->fetchALL(PDO::FETCH_ASSOC);
                $row['child'] = $child;
                array_push($data,$row);
            }
            // echo "<pre>";
            // print_r($data);
            // echo "";
            return $data;   
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

}

?>