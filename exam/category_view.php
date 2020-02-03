<?php 
session_start();
if(empty($_SESSION['user_id']))
{
    header('location: login.php');
    $result = '';
}
require_once 'header.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<div>
	<br><br><div>
			<a href="category_form.php"><button>Add new category</button></a>
		</div><br><br>
		
		<div>

		</div>
	</div>
</body>
</html>