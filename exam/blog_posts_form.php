<?php 
session_start();
if(empty($_SESSION['user_id']))
{
    header('location: login.php');
    $result = '';
}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<div>
		<fieldset>
			<legend>Blog Post</legend>
			<div>
				<label>Title</label><br>
				<input type="text" name="title" required>
			</div>
			<div>
				<label>Content:</label><br>
				<textarea name="content" rows="5" cols="50"></textarea>
			</div>
			<div>
				<label>URL:</label><br>
				<input type="text" name="url" required>
			</div>
			<div>
				<label>Published At:</label><br>
				<input type="date" name="published_at">
			</div>
			<div>
				<label>Category:</label><br>
				<select name="category">
					
				</select>
			</div>
			<div>
				<label>Image</label><br>
				<input type="file" name="image">
			</div>
			<div>
				<input type="submit" name="addBlogPost" value="Add Blog Post">
			</div>
		</fieldset>
	</div>
</body>
</html>