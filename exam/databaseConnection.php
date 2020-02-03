<?php

$hostName = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$databaseName = 'blog_portal';

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
function fetchRow($tableName,$searchOn,$searchOnValue,$fields='*')
{
    global $connection;
    if($connection)
    {
        $query = "SELECT $fields FROM $tableName WHERE $searchOn = $searchOnValue LIMIT 1";
        $result = mysqli_query($connection, $query);
        return $result;
    }
}

function fetchAllUsingJoin()
{
    global $connection;
    if($connection) 
    {
        $query = "SELECT C.customer_id, C.prefix, C.firstName, C.lastName, CA.city, CO.value AS aboutYourself, HOB.value AS hobbies FROM customers AS C LEFT JOIN customer_address AS CA on C.customer_id=CA.customer_id LEFT JOIN customer_additional_info AS CO on CO.customer_id = C.customer_id AND CO.field_key = 'aboutYourself' LEFT JOIN customer_additional_info AS HOB on HOB.customer_id = C.customer_id AND HOB.field_key='hobbies'";
        $result = mysqli_query($connection, $query);
        return $result;
    }
}
function delete($tableName,$deleteOnName,$deleteOnValue)
{
    global $connection;
    if($connection)
    {
        $query = "DELETE FROM $tableName WHERE $deleteOnName = $deleteOnValue";
        // echo $query;
        mysqli_query($connection,$query);
        return mysqli_affected_rows($connection);
    }
}
function update($tableName,$data,$updateOnField,$updateOnValue,$condition='')
{
    global $connection;
    $updateData = '';
    foreach($data as $key =>$value )
    {
        $updateData .= "$key = $value, ";
    }
    $updateData = rtrim($updateData, ', ');
    $query = "UPDATE $tableName SET $updateData WHERE $updateOnField = $updateOnValue $condition";
    mysqli_query($connection,$query);
    return mysqli_affected_rows($connection);
}
?>