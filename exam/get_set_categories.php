<?php 

//require "databaseConnection.php";
require_once 'operations.php';

if(isset($_POST['AddCategory']))
{	//echo "add";
	if(uploadFile($_FILES['image']))
	{
		if(setValues('category','insert'))
        header('location: category_view.php');
            // echo "set";        
	}
}
else if(isset($_POST['editCategory']))
{
    if(uploadFile($_FILES['image']))
	{
        $category_id = $_GET['category_id'];
		if(setValues('category','update',$category_id))
            header('location: category_view.php');
            // echo "set";        
	}
}
else if(isset($_GET['category_id']))
{
	$category_id = $_GET['category_id'];
    $result = fetchRow('category','category_id',$category_id);
    $data['category'] = mysqli_fetch_assoc($result);
}


?>