<?php
//session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<div>
		<a href="category_view.php"><button>Manage Category</button></a>&nbsp
		<a href="registration.php?user_id=<?=$_SESSION['user_id']?>"><button>My Profile</button></a>&nbsp
		<a href="logout.php"><button>Logout</button></a>
	</div>
</body>
</html>