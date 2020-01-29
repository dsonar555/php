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

function fetchAll($tableName)
{   
    global $connection;
    if($connection) {
        $query = "SELECT * FROM $tableName";
        $result = mysqli_query($connection, $query);
        return $result;
    }
}

function insertCustomers($data)
{
    global $connection;
    if($connection) {
        $query = "INSERT INTO `customers`(`prefix`, `firstName`, `lastName`, `birthDate`, `mobileNo`, `email`, `password`) VALUES ('$data[prefix]','$data[firstName]','$data[lastName]','$data[birthDate]','$data[mobileNo]','$data[email]','$data[password]')";
        echo $query;
        if(mysqli_query($connection, $query)) {
            return true;
        } else {
            return false;
        }
    } 
}

function insertCustomerAddress($data,$customer_id)
{
    global $connection;
    if($connection) {
        $query = "INSERT INTO `customer_address`( `customer_id`, `address_line1`, `address_line2`, `company`, `city`, `state`, `country`, `postal_code`) VALUES ($customer_id,'$data[addressLine1]','$data[addressLine2]','$data[company]','$data[city]','$data[state]','$data[country]','$data[postalCode]')";
        echo '<br>'.$query;
        if(mysqli_query($connection, $query)) {
            return true;
        } else {
            return false;
        }
    } 
}

function insertCustomerAdditionalInfo($data,$customer_id)
{
    global $connection;
    if($connection) {
        $flag = 0;
        foreach ($data as $key => $value) {
            if(is_array($value))
            {
                $value = implode(',',$value);
            }
            $query = "INSERT INTO `customer_additional_info`(`customer_id`, `field_key`, `value`) VALUES ($customer_id,'$key','$value')"; 
            //echo '<br>'.$query;
            if(mysqli_query($connection, $query))
                $flag = 1;
            else
                $flag = 0;
        }
        return $flag;
    } 
}

function getLastAddedCustomerId()
{
    global $connection;
    if($connection) {
        $query = "SELECT customer_id FROM customers ORDER BY customer_id DESC LIMIT 1";
        $result = mysqli_query($connection, $query);
        return $result;
    }
}

function fetchRow($tableName,$searchOn,$searchOnValue)
{
    global $connection;
    if($connection)
    {
        $query = "SELECT * FROM $tableName WHERE $searchOn = $searchOnValue";
    }
}



?>