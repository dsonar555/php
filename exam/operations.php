<?php
require_once "databaseConnection.php";

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

function validate($fieldName,$fieldValue,$sectionName='',$operation='')
{
    global $error_array;
    $error_array=[];
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
                    if($sectionName != 'login')
                    {
                        if(isUnique('user','email',"'$fieldValue'"))
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
        case 'url':
            if($operation != 'update'){
                $urlUnique;
                if($sectionName == 'category')
                    $tableName = "category";
                else if($sectionName == 'blog_post')
                    $tableName = 'blog_post';
                if(!isUnique($tableName,'url',"'$fieldValue'"))
                {
                    $error_array["$fieldName"] = "URL is already exist.";
                    return 0;
                }
                else 
                    return 1;
            }
            return 1;
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
                if(!validate($fieldName,$fieldValue,$sectionName,$operation) ){
                    return false;
                }
            }
        }
        if(empty($error_array))
        {
                $id;
                switch($sectionName)
                {
                    case 'user':
                        $user = userData($_POST[$sectionName]);
                        if($operation == 'insert') {
                            $id = insert('user',$user);
                        }
                        else if($operation == 'update') {
                            $user['updated_at'] = '\''.date('Y-m-d H:i:s').'\'';
                            $id = update('user',$user,'user_id',$user_id);
                        }    
                        return $id;
                    case 'category':
                            $file = $_FILES['image'];
                            $fileName = $file['name'];
                            $data = category($_POST[$sectionName]);
                            $data['image']="'uploads/$fileName'";
                        if($operation == 'insert') {
                            // print_r($data);
                            $id = insert('category',$data);
                        }
                        else if($operation == 'update') {
                            $data['updated_at'] = '\''.date('Y-m-d H:i:s').'\'';
                            $id = update('category',$data,'category_id',$user_id);
                        }    
                        return $id;
                        case 'blog_post':
                            $file = $_FILES['image'];
                            $fileName = $file['name'];
                            $post_category=$_POST[$sectionName]['category_id'];
                            $data = blogPostData($_POST[$sectionName]);
                            $data['image']="'uploads/$fileName'";
                        if($operation == 'insert') {
                            // print_r($data);
                            $id = insert('blog_post',$data);
                            if($id)
                            {
                                $post_category_data ['post_id'] = $id;
                                foreach ($post_category as $category_id)
                                {
                                    $post_category_data['category_id'] = $category_id;
                                    //print_r($post_category_data);
                                    $pc_id = insert('category_post',$post_category_data);
                                }
                            }
                        }
                        else if($operation == 'update') {
                            $data['updated_at'] = '\''.date('Y-m-d H:i:s').'\'';
                            $id = update('blog_post',$data,'post_id',$user_id);
                            if($id)
                            {
                                $post_category_data ['post_id'] = $user_id;
                                delete('category_post','post_id',$user_id);
                                foreach ($post_category as $category_id)
                                {
                                    $post_category_data['category_id'] = $category_id;
                                    $pc_id = insert('category_post',$post_category_data);
                                }
                            }
                        }    
                        return $id;
                }       
        }
    }
}

function getValues($sectionName, $fieldName,$returnType="")
    {
        global $data;
        if(isset($data[$sectionName][$fieldName]))
        {
            if($fieldName == 'password') 
            $data[$sectionName][$fieldName] = password_needs_rehash($data[$sectionName][$fieldName],PASSWORD_DEFAULT);
            return $data[$sectionName][$fieldName]; 
        } 
            else 
                return $returnType;
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
    function category($sectionName)
    {
        $user=[];
        foreach ($sectionName as $key => $value)
        {
            switch($key)
            {
                case 'title':
                    $user['title'] = "'$value'";
                    break;
                case 'url': 
                    $user['url'] = "'$value'";
                    break;
                case 'meta_title': 
                    $user['meta_title'] = "'$value'";
                    break;
                case 'image': 
                    $user['image'] = "'$value'";
                    break;
                case 'content':
                    $user['content'] = "'$value'";
                    break;       
                case 'parent_category':
                    $user['parent_category_id'] = $value;                
            }
        }
        return $user;
    }

    function uploadFile($file)
    {
        if(isset($file)) {
            //$file = $_FILES['image'];
            $fileName = $file['name'];    
            $tmp_name = $file['tmp_name'];
            if(!empty($file)) {
                $type = $file['type'].'<br>';
                $location = 'uploads/';
                if( $type = 'image/jpeg') {
                    if(move_uploaded_file($tmp_name, $location.$fileName)) {
                        return 1;
                    } else {
                        echo "Error in uploading";
                        return 0;
                    }
                } else {
                    echo "only images are accepted";
                    return 0;
                }
            } else {
                echo "Please choose a file";
                return 0;
            }
        }
    }

    function blogPostData($sectionName)
    {
        $user=[];
        $user['user_id'] = $_SESSION['user_id'];
        foreach ($sectionName as $key => $value)
        {
            switch($key)
            {
                case 'title':
                    $user['title'] = "'$value'";
                    break;
                case 'url': 
                    $user['url'] = "'$value'";
                    break;
                case 'image': 
                    $user['image'] = "'$value'";
                    break;
                case 'content':
                    $user['content'] = "'$value'";
                    break;       
                case 'published_at':
                    $user['published_at'] = "'$value'";               
            }
        }
        return $user;
    }

?>