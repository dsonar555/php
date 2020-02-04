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

function fetchAll($tableName,$searchOn=" '' ", $searchOnValue="''",$fields='*')
{   
    global $connection;
    if($connection) {
        $condition='';
        if($searchOn != " " && $searchOnValue!= null)
            $condition = "WHERE $searchOn = $searchOnValue";
        $query = "SELECT $fields FROM $tableName $condition";
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

function delete($tableName,$deleteOnName,$deleteOnValue)
{
    global $connection;
    if($connection)
    {
        $query = "DELETE FROM $tableName WHERE $deleteOnName = $deleteOnValue";
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
    echo $query = "UPDATE $tableName SET $updateData WHERE $updateOnField = $updateOnValue $condition";
    mysqli_query($connection,$query);
    return mysqli_affected_rows($connection);
}

function fetchCategoryOf($post_id)
{
    global $connection;
    if($connection)
    {
        $category = [];
        $query = "SELECT C.title FROM category AS C LEFT JOIN category_post AS CP ON C.category_id = CP.category_id WHERE CP.post_id = $post_id";
        $result = mysqli_query($connection,$query);$category = [];
        while($row = mysqli_fetch_assoc($result))
        {
            array_push($category,$row['title']);
        }
        return $category;
    }
}

?>