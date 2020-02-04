<?php 
session_start();
if(empty($_SESSION['user_id']))
{
    header('location: login.php');
    $result = '';
}
require_once 'get_set_categories.php';
$categories = fetchAll('category','','','category_id,title');
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
				<input type="text" name="category[title]" value="<?=getValues('category','title')?>" required>
			</div>
			<div>
				<label>Content:</label><br>
				<textarea name="category[content]" rows="5" cols="50"><?=getValues('category','content')?></textarea>
			</div>
			<div>
				<label>URL:</label><br>
				<input type="text" name="category[url]" value="<?=getValues('category','url')?>" required>
				<?php if(!empty($error_array['url'])) 
					echo $error_array['url'];
				?>
			</div>
			<div>
				<label>Meta Title:</label><br>
				<input type="text" name="category[meta_title]" value="<?=getValues('category','meta_title')?>">
			</div>
			<div>
				<label>Parent Category:</label><br>
				<select name="category[parent_category]">
					<option value="0">No any parent</option>
					<?php 
					$selectedParent = getValues('category','parent_category_id');
					while($category = mysqli_fetch_assoc($categories) ): 
						$selected = ($selectedParent == $category['category_id'])?'selected':'';
						?>
					<option value=<?="$category[category_id]"?> <?=$selected?>><?=$category['title']?></option>
					<?php endwhile; ?>
				</select>
			</div>
			<div>
				<label>Image</label><br>
				<input type="file" name="image" require>
			</div> 
			<div>
			<?php 
                    if(!isset($_GET['category_id'])) :
                ?>
                <div>
                    <br><input type="submit" value="AddCategory" name="AddCategory">
                </div>
                <?php 
                    endif;
                ?>
                <?php
                if(isset($_GET['category_id'])) :
                    ?>
                    <div><input type="submit" value="Edit" name="editCategory"></div>
                    <?php
                endif; 
                ?>
			</div>
		</fieldset>
		</form>
	</div>
</body>
</html>