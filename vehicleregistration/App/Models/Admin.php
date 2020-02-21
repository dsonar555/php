<?php

namespace App\Models;
use PDO;

class Admin extends \Core\Model {

    public static function getAll() {

        try {
            $connect = static::connectDB();
            $query = "SELECT first_name,last_name,title,vehicle_number,license_number,date,timeslots,issue,center,status FROM service_registrations SR LEFT JOIN users U ON SR.user_id = U.user_id ORDER BY SR.created_at";
            $result = $connect->query($query);
            $result = $result->fetchALL(PDO::FETCH_ASSOC);
            return $result; 
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }
}
?>