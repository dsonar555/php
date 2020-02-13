<?php

namespace App\Models;

use PDO;

class Post extends \Core\Model{
    public static function getAll() {

        try {
            $connect = static::connectDB();
            $query = "SELECT * FROM post ORDER BY created_at";
            $result = $connect->query($query);
            $result = $result->fetchALL(PDO::FETCH_ASSOC);
            return $result; 
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }
    public static function insert($data) {
        print_r($data);
        $connect = static::connectDB();
        $query = "INSERT INTO post (title,content) values (?,?)";
        $result = $connect->prepare($query);
        $result->execute(array_values($data));
        return $result= $result->rowCount();
    }
}

?>