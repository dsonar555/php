<?php
require 'databaseConnection.php';
function getAllValues($sectionName)
{
    $result;
    switch($sectionName)
    {
        case 'account':
            $result = fetchAll('customers');
            break;
        case 'address':
            $result = fetchAll('customer_address');
            break;
        case 'other':
            $result = fetchAll('customer_additonal_info');
            break;
    }
    return $result;
}
function setValues($sectionName,$customer_id="")
{
    if(isset($sectionName))
    {
        global $error_array;
        foreach($_POST[$sectionName] as $fieldName => $fieldValue)
        {
            if(!empty($fieldValue))
            {
                if(!validate($fieldName,$fieldValue))
                {
                    $error_array[$fieldName] = ($fieldName == 'password')? 'Password and Confirm Password should be same.' : "Enter valid $fieldName.";
                    print_r($error_array);
                }
            }
        }
        if(empty($error_array))
        {   
            switch($sectionName)
            {
                case 'account':
                    if(insertCustomers($_POST[$sectionName]))
                    return true;
                case 'address':
                    if(insertCustomerAddress($_POST[$sectionName],$customer_id))
                    return true;
                case 'other':
                    if(insertCustomerAdditionalInfo($_POST[$sectionName],$customer_id))
                    return true;
            }
        }
    }
    return false;
}

function validate($fieldName,$fieldValue)
    {
        switch($fieldName)
        {
            case 'firstName':
            case 'lastName':
            case 'city':
            case 'state':
                    return(!preg_match("/^[a-zA-Z]*$/", $fieldValue))? 0 :1 ;
                    break;
            case 'mobileNo':
                    return(!preg_match("/^[0-9]{10,10}$/",$fieldValue))? 0 :1;
                    break;
            case 'email':
                    return(!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix",$fieldValue))? 0 :1;
                    break;
            case 'password':
                    return($fieldValue == $_POST['account']['confirmPassword'])? 1 :0;
                    break;
            case 'postalCode':
                    return(!preg_match("/^[0-9]{6,8}$/",$fieldValue))? 0 :1;
                    break;
            default :
                    return 1;
        }
    }

if(isset($_POST['submit']))
    {       
        // print_r( $_POST );
        if(setValues('account')){
            $customer_id = mysqli_fetch_assoc(getLastAddedCustomerId());
            $customer_id = $customer_id['customer_id'];
            if(setValues('address',$customer_id) && setValues('other',$customer_id))
            echo "data Inserted";
        }
    }


?>