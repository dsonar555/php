<?php 
session_start();
if(empty($_SESSION['user_id']))
{
    header('location: login.php');
    $result = '';
}
require_once "get_set_blog_posts.php";
$categories = fetchAll('category','','','category_id,title');
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<form method="POST" enctype="multipart/form-data">
		<div>
			<fieldset>
				<legend>Blog Post</legend>
				<div>
					<label>Title</label><br>
					<input type="text" name="blog_post[title]" value="<?=getValues('blog_post','title')?>" required>
				</div>
				<div>
					<label>Content:</label><br>
					<textarea name="blog_post[content]" rows="5" cols="50"><?=getValues('blog_post','content')?></textarea>
				</div>
				<div>
					<label>URL:</label><br>
					<input type="text" name="blog_post[url]" value="<?=getValues('blog_post','url')?>" required>
				</div>
				<div>
					<label>Published At:</label><br>
					<input type="date" name="blog_post[published_at]" value="<?=getValues('blog_post','published_at')?>">
				</div>
				<div>
					<label>Category:</label><br>
					<select name="blog_post[category_id][]" multiple>
					<?php 
						$selectedCategory = getValues('blog_post','category_id',[]);
						while($category = mysqli_fetch_assoc($categories) ): 
							$selected = (in_array($category['title'],$selectedCategory))?'selected':'';
							?>
						<option value=<?="$category[category_id]"?> <?=$selected?>><?=$category['title']?></option>
						<?php endwhile; ?>	
					</select>
				</div>
				<div>
					<label>Image</label><br>
					<input type="file" name="image">
				</div>
				<?php 
						if(!isset($_GET['blog_post_id'])) :
					?>
					<div>
						<br><input type="submit" value="AddBlogPost" name="AddBlogPost">
					</div>
					<?php 
						endif;
					?>
					<?php
					if(isset($_GET['blog_post_id'])) :
						?>
						<div><input type="submit" value="Edit" name="editBlogPost"></div>
						<?php
					endif; 
					?>
			</fieldset>
		</div>
	</form>
</body>
</html>