<?php 
session_start();
require_once 'get_set_categories.php';
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
		<form method="POST" enctype="multipart/form-data">
		<fieldset>
			<legend>Categories</legend>
			<div>
				<label>Title</label><br>
				<input type="text" name="category[title]" required>
			</div>
			<div>
				<label>Content:</label><br>
				<textarea name="category[content]" rows="5" cols="50"></textarea>
			</div>
			<div>
				<label>URL:</label><br>
				<input type="text" name="category[url]" required>
			</div>
			<div>
				<label>Meta Title:</label><br>
				<input type="text" name="category[meta_title]">
			</div>
			<div>
				<label>Parent Category:</label><br>
				<select name="category[parent_category]">
					
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
		</form>
	</div>
</body>
</html>