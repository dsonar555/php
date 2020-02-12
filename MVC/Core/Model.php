<?php 

namespace Core;

use PDO;

abstract class Model {
    protected static function connectDB() {
        static $connection = null;
        
        if($connection === null) {
            $host = "localhost";
            $dbName = "test";
            $userName = "root";
            $password = "";

            try {
                $connection = new PDO("mysql:host=$host;dbname=$dbName", $userName, $password);
                return $connection;
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    }
}

?>