<?php
require "databaseConnection.php";

$error_array = [];
$data = [];
if(isset($_POST['register']))
{
    if(setValues('user','insert'))
    // echo "register";
    header('location: login.php');
}
else if(isset($_POST['login']))
{
    
    if(validate('email',$_POST['email'],'login'))
    {   
        $email = $_POST['email'];
        if($user_id = checkCredentials($email,$_POST['password']))
        {
            session_start();
            $_SESSION['user_id']= $user_id;
            $_SESSION['email'] = $email;
            header('location: blog_posts_view.php');
        }
        else
        {
            echo "Check Email and Password";
        }

    }
}
else if(isset($_POST['edit']))
{
    if(setValues('user','update',$_GET['user_id']))
    // echo "register";
    header('location: blog_posts_view.php');
}
else if(isset($_GET['user_id']))
{
    $user_id = $_GET['user_id'];
    $result = fetchRow('user','user_id',$user_id);
    $data['user'] = mysqli_fetch_assoc($result);
    //print_r($data);
}

function validate($fieldName,$fieldValue,$operation='')
{
    global $error_array;
    switch($fieldName)
    {
        case 'firstName':
        case 'lastName':
                if(!preg_match("/^[a-zA-Z]*$/", $fieldValue))
                {
                    $error_array["$fieldName"] = "enter valid $fieldName";
                    return 0;
                }
                else 
                    return 1;
                break;
        case 'mobileNo':
                if(!preg_match("/^[0-9]{10,10}$/",$fieldValue))
                {
                    $error_array["$fieldName"] = "enter valid $fieldName";
                    return 0;
                }
                else 
                    return 1;
                break;
        case 'email':
                if(!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix",$fieldValue))
                {
                    $error_array["$fieldName"] = "enter valid $fieldName";
                    return 0;
                }
                else 
                {
                    if($operation != 'login')
                    {
                        if(isUnique('user','email',$fieldValue))
                        return 1;
                        else
                        {
                            $error_array["$fieldName"] = "Email should be unique";
                            return 0;
                        }
                    }
                    return 1;
                }
                    
                break;
        case 'password':
                if($fieldValue == $_POST['user']['confirmPassword'])
                {
                    return 1;
                }
                else 
                {
                    $error_array["$fieldName"] = "Password and Confirm password should be same";
                    return 0;
                }
                break;
        default :
                return 1;
    }
}

function setValues($sectionName,$operation,$user_id='')
{
    if(isset($sectionName))
    {
        global $error_array;
        foreach($_POST[$sectionName] as $fieldName => $fieldValue)
        {
            if(!empty($fieldValue))
            {
                if(validate($fieldName,$fieldValue) && empty($error_array))
                $id;
                switch($sectionName)
                {
                    case 'user':
                        $user = userData($_POST[$sectionName]);
                        if($operation == 'insert') {
                            $id = insert('user',$user);
                        }
                        else if($operation == 'update') {
                            $user['updated_at'] = date("d-m-y @h:i:sa");
                            $id = update('user',$user,'user_id',$user_id);
                        }    
                        return $id;
                    case 'category':
                        if($operation == 'insert') {
                            $id = insert('category',$_POST['$sectionName']);
                        }
                        else if($operation == 'update') {
                            $id = update('category',$category,'category_id',$user_id);
                        }    
                        return $id;
                }       
            }
        }
    }
}

function getValues($sectionName, $fieldName,$returnType="")
    {
        global $data;
        if($fieldName == 'password') 
        $data[$sectionName][$fieldName] =  password_needs_rehash($data[$sectionName][$fieldName],PASSWORD_DEFAULT);
        return (isset($data[$sectionName][$fieldName])) ? $data[$sectionName][$fieldName] : $returnType;
    }

    function isUnique($tableName,$fieldName,$fieldValue)
    {
        $result = fetchRow($tableName,$fieldName,$fieldValue);
        if( mysqli_num_rows($result)>0 )
        {
            return 0;
        }
        else
        {
            return 1;
        }
    }

    function userData($sectionName)
    {
        $user=[];
        foreach ($sectionName as $key => $value)
        {
            switch($key)
            {
                case 'prefix':
                    $user['prefix'] = "'$value'";
                    break;
                case 'first_name': 
                    $user['first_name'] = "'$value'";
                    break;
                case 'last_name': 
                    $user['last_name'] = "'$value'";
                    break;
                case 'mobile_no': 
                    $user['mobile_no'] = $value;
                    break;
                case 'email':
                    $user['email'] = "'$value'";
                    break;                        
                case 'password':
                    $value = password_hash($value,PASSWORD_DEFAULT);
                    $user['password'] = "'$value'";
                    break;
                case 'information':
                    $user['information'] = "'$value'";
            }
        }
        return $user;
    }

    function checkCredentials($email,$password)
    {
        $result = fetchRow('user','email',"'$email'",'user_id,email,password');
        if(mysqli_num_rows($result)>0)
        {
            $result = mysqli_fetch_assoc($result);
            if(password_verify($password, $result['password']) )
            {
                return $result['user_id'];
            }
            else 
            {
                return 0;
            }
        }
        else 
        return 0;
    }
?>