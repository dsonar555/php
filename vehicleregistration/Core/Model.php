<?php 

namespace Core;

use PDO;
use App\Config;

/**
 * Base Model
 */

abstract class Model {

    /**
     * Get the PDO database connection
     * @return mixed
     */
    protected static function connectDB() {
        static $connection = null;
        
        if($connection === null) {
        
                // $connection = new PDO("mysql:host=$host;dbname=$dbName", $userName, $password);
                $dsn = 'mysql:host=' . Config::DB_HOST . ';dbname=' . Config::DB_NAME;
                $connection = new PDO($dsn, Config::DB_USER, Config::DB_PASSWORD); 
               
                // Throw an exception when an error occurs
                $connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

                return $connection;
        }
        return $connection;
    }
}

?>