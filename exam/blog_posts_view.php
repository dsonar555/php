<?php
session_start();
if(empty($_SESSION['user_id']))
{
    header('location: login.php');
    $result = '';
}
require_once 'header.php';
require_once 'databaseConnection.php';
if(isset($_GET['blog_post_id']))
{
	$rows = delete('blog_post','post_id',$_GET['blog_post_id']);
	if($rows)
		header('location: blog_posts_view.php');
}
$result = fetchAll('blog_post','user_id',$_SESSION['user_id']);
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
			<table border="1">
				<tr>
					<th>Post Id</th>
					<th>Category Name</th>
					<th>Title</th>
					<th>Published date</th>
					<th colspan="2">actions</th>
				</tr>
				<?php while($row = mysqli_fetch_assoc($result)) :
				$selectedCategory = fetchCategoryOf($row['post_id']);
				?>
				<tr>
					<td><a href="viewData.php?post_id=<?=$row['post_id']?>"><?=$row['post_id']?></a></td>
					<td><?=implode(',',$selectedCategory);?></td>
					<td><?=$row['title']?></td>
					<td><?=$row['published_at']?></td>
					<td><a href="blog_posts_form.php?blog_post_id=<?=$row['post_id']?>">edit</a></td>
					<td><a href="blog_posts_view.php?blog_post_id=<?=$row['post_id']?>">delete</a></td>
				</tr>
				<?php endwhile; ?>
			</table>
		</div>
	</div>
</body>
</html>
