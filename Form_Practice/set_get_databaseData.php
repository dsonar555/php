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
function setValues($sectionName,$customer_id='')
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
                    $account = accountData($_POST[$sectionName]);
                    $id = insert('customers',$account);
                    return $id;
                case 'address':
                    $address = addressData($_POST[$sectionName],$customer_id);
                    $id = insert('customer_address',$address);
                    return $id;
                case 'other':
                    $other = otherInfo($_POST[$sectionName],$customer_id);
                    print_r($other);
                    foreach($other as $row)
                    {
                        $id = insert('customer_additional_info',$row);
                    }
                    return $id;
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

    function getValues($sectionName, $fieldName,$returnType="")
    {
        global $data;
        return (isset($data[$sectionName][$fieldName])) ? $data[$sectionName][$fieldName] : $returnType;
    }
    function getDataFromDatabase($customer_id)
    {
        $data['account'] = fetchRow('customers','customer_id',$customer_id);
        $data['address'] = fetchRow('customer_address','customer_id',$customer_id);
        $result = fetchAll('customer_additional_info','customer_id',$customer_id);
        while($row = mysqli_fetch_assoc($result))
        {
            if($row['field_key'] != 'aboutYourself')
            $data['other'][$row['field_key']] = explode(',',$row['value']);
            else 
            $data['other'][$row['field_key']] = $row['value'];
        }
        // $data['other'] = fetchAll('customer_additional_info','customer_id',$customer_id);
        print_r($data);
        return $data;
    }

    $data;
    if(isset($_POST['submit']))
    {       
        $customer_id = setValues('account');
        if(isset($customer_id))
        {
            $add_id = setValues('address',$customer_id);
            $other_id = setValues('other',$customer_id);
            if(isset($add_id) && isset($other_id))
            echo "data Inserted";
        }
    }
    else if(isset($_GET['customer_id']))
    {
        global $data;
        $customer_id = $_GET['customer_id'];
        $data = getDataFromDatabase($customer_id);
    }
        
    function accountData($sectionName)
    {
        $account=[];
        foreach ($sectionName as $key => $value)
        {
            switch($key)
            {
                case 'prefix':
                    $account['prefix'] = "'$value'";
                    break;
                case 'firstName': 
                    $account['firstName'] = "'$value'";
                    break;
                case 'lastName': 
                    $account['lastName'] = "'$value'";
                    break;
                case 'birthDate': 
                    $account['birthDate'] = "'$value'";
                    break;
                case 'mobileNo': 
                    $account['mobileNo'] = $value;
                    break;
                case 'email':
                    $account['email'] = "'$value'";
                    break;                        
                case 'password':
                    $account['password'] = "'$value'";
                    break;
            }
        }
        return $account;
    }
    function addressData($sectionName, $customer_id)
    {
        $address = [];
        $address['customer_id'] = $customer_id;
        foreach ($sectionName as $key => $value)
        {
            switch($key)
            {
                case 'addressLine1':
                    $address['address_line1'] = "'$value'";
                    break;
                case 'addressLine2': 
                    $address['address_line2'] = "'$value'";
                    break;
                case 'company': 
                    $address['company'] = "'$value'";
                    break;
                case 'city': 
                    $address['city'] = "'$value'";
                    break;
                case 'state': 
                    $address['state'] = "'$value'";
                    break;
                case 'country':
                    $address['country'] = "'$value'";
                    break;                        
                case 'postalCode':
                    $address['postal_code'] = $value;
                    break;
            }
        }
        return $address;
    }
    function otherInfo($sectionName, $customer_id)
    {   
        $additionalInfo = [];
        $row['customer_id'] = $customer_id;
        foreach( $sectionName as $key => $value)
        {
            if(is_array($value))
            {
                $value = implode(',',$value);
            }
            $row ['field_key'] = "'$key'";
            $row ['value'] = "'$value'";
            array_push($additionalInfo,$row);
        }
        return $additionalInfo;
    }
?>