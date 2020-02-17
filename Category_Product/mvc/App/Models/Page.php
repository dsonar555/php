<?php

namespace App\Models;

use PDO;

class Page extends \Core\Model{
    public static function getAll($fields = '*') {

        try {
            $connect = static::connectDB();
            $query = "SELECT $fields FROM cms_pages ORDER BY created_at";
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
            echo $query = "INSERT INTO cms_pages ($keys) values ($values)";
            $result = $connect->query($query);
            return $result = $connect->lastInsertId();
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }
    public static function delete($id) {
        try {
            $connect = static::connectDB();
            $query = "DELETE FROM cms_pages WHERE cms_id = $id";
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
            $query = "SELECT * FROM cms_pages WHERE cms_id = $id LIMIT 1";
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
            echo $query = "UPDATE cms_pages SET $updateData WHERE cms_id= $id";
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
            $query = "SELECT * FROM cms_pages WHERE url_key = '$url_key'";
            if(!empty($id)) {
                $query .= " AND cms_id != $id";
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