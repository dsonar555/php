<?php

session_start();
if(empty($_SESSION['user_id']))
{
    header('location: login.php');
    $result = '';
}
require_once 'databaseConnection.php';
if(isset($_GET['post_id']))
{
    $post_id = $_GET['post_id'];
    $result = fetchRow('blog_post','post_id',$post_id);
}
else if(isset($_GET['category_id']))
{
    $category_id = $_GET['category_id'];
    $result = fetchRow('category','category_id',$category_id);
}
if(mysqli_num_rows($result)>0)
{
    $result = mysqli_fetch_assoc($result);
    foreach($result as $key => $value)
    {   
        if($key == 'image')
            echo '<img src="'.$value.'" height="200px" width ="200px"><br>';
        else
            echo "<strong>$key</strong> : $value<br>";
    }
}

?>