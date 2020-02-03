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
			<a href="blog_posts_form.php"><button>Add new blog post</button></a>
		</div><br><br>
		
		<div>

		</div>
	</div>
</body>
</html>
