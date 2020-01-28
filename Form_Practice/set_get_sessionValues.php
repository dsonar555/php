<?php
session_start();
    if(isset($_POST['submit']))
    {       
        // print_r( $_POST );
        setSessionValues('account');
        setSessionValues('address');
        setSessionValues('other');
    } 
    print_r( $_SESSION );

    function setSessionValues($sectionName)
    {
        if(isset($sectionName))
        {
            $error_array = [];
            foreach($_POST[$sectionName] as $fieldName => $fieldValue)
            {
                if(!empty($fieldValue))
                {
                    if(!validate($fieldName,$fieldValue))
                    {
                        $error_array[$key] = ($fieldName == 'password')? 'Password and Confirm Password should be same.' : "Enter valid $fieldName.";
                    }
                }
            }
            if(empty($error_array))
            {
                $_SESSION[$sectionName] = $_POST[$sectionName];
            }
        }
        else
        {
            $_SESSION[$sectionName] = [];
        }
    }
    function getSessionValues($sectionName, $fieldName,$returnType="")
    {
        return (isset($_SESSION[$sectionName][$fieldName])) ? $_SESSION[$sectionName][$fieldName] : $returnType;
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

?>