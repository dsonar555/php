<?php

$hostName = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$databaseName = 'customer_portal';

function connectToDb($hostName, $dbUsername, $dbPassword, $databaseName)
{
    $connection = @mysqli_connect($hostName, $dbUsername, $dbPassword, $databaseName);
    return $connection;
}
$connection = connectToDb($hostName, $dbUsername, $dbPassword, $databaseName);

function fetchAll($tableName, $serchOn=" '' ", $serchOnValue="''")
{   
    global $connection;
    if($connection) {
        $query = "SELECT * FROM $tableName WHERE $serchOn = $serchOnValue";
        echo $query;
        $result = mysqli_query($connection, $query);
        return $result;
    }
}

function insert($tableName,$data)
{
    $fields = implode(',',array_keys($data));
    $values = implode(',',array_values($data)); 
    global $connection;
    if($connection) {
        $query = "INSERT INTO $tableName ($fields) VALUES ($values)";
        mysqli_query($connection, $query); 
        return mysqli_insert_id($connection);
    } 
}
function fetchRow($tableName,$searchOn,$searchOnValue)
{
    global $connection;
    if($connection)
    {
        $query = "SELECT * FROM $tableName WHERE $searchOn = $searchOnValue LIMIT 1";
        $result = mysqli_query($connection, $query);
        return mysqli_fetch_assoc($result);
    }
}

?>