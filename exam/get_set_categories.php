<?php 

//require "databaseConnection.php";
require_once 'operations.php';

if(isset($_POST['addBlogPost']))
{	echo "add";
	if(isset($_FILES['image'])) {
	    $file = $_FILES['image'];
	    $fileName = $file['name'];    
	    $tmp_name = $file['tmp_name'];
	    if(!empty($file)) {
	        $type = $file['type'].'<br>';
	        $location = 'uploads/';
	        if( $type = 'image/jpeg') {
	            if(move_uploaded_file($tmp_name, $location.$fileName)) {
	                
	                if(setValues('category','insert'));
    				header('location: category_view.php');
	            
	            } else {
	                echo "Error in uploading";
	            }
	        } else {
	            echo "File Size must be less than $maxSize";
	        }
	    } else {
	        echo "Please choose a file";
	    }
	}
}

?>