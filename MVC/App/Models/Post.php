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
}

?>