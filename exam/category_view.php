<?php 
session_start();
if(empty($_SESSION['user_id']))
{
    header('location: login.php');
    $result = '';
}
if(isset($_GET['category_id']))
{
	$rows = delete('category','category_id',$_GET['category_id']);
	if($rows)
		header('location: category_view.php');
}
require "databaseConnection.php";
$result = fetchAll('category');
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
			<table border="1">
				<tr>
					<th>category Id</th>
					<th>category Image</th>
					<th>Name</th>
					<th>created date</th>
					<th colspan="2">actions</th>
				</tr>
				<?php while($row = mysqli_fetch_assoc($result)) :?>
				<tr>
					<td><?=$row['category_id']?></td>
					<td><img src="<?=$row['image']?>" width="100px" height="100px"></td>
					<td><?=$row['title']?></td>
					<td><?=$row['created_at']?></td>
					<td><a href="">edit</a></td>
					<td><a href="category_view.php?category_id=<?=$row['category_id']?>">delete</a></td>
				</tr>
				<?php endwhile; ?>
			</table>
		</div>
	</div>
</body>
</html>