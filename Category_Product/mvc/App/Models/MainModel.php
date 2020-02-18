<?php
namespace App\Models;

use PDO;

class MainModel extends \Core\Model{
    public static function getAll($fields = '*') {

        try {
            $connect = static::connectDB();
            $query = "SELECT $fields FROM cms_pages";
            $result = $connect->query($query);
            $result = $result->fetchALL(PDO::FETCH_ASSOC);
            return $result; 
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }
    public static function getRow($id) {
        try {
            $connect = static::connectDB();
            $query = "SELECT * FROM cms_pages WHERE url_key = '$id' LIMIT 1";
            $result = $connect->query($query);
            $result = $result->fetchALL(PDO::FETCH_ASSOC);
            return $result[0]; 
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }
    public static function getProducts($url_key) {
        try {
            $connect = static::connectDB();
            $query = "SELECT
            P.product_id,
            P.url_key,
            P.name,
            P.image,
            P.price
        FROM
            categories C
        LEFT JOIN products_categories PC ON
            C.category_id = PC.category_id
        LEFT JOIN products P ON
            PC.product_id = P.product_id
        WHERE
            C.url_key = '$url_key' AND P.status = 1";
            $result = $connect->query($query);
            $result = $result->fetchALL(PDO::FETCH_ASSOC);
            return $result; 
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }
}
?>