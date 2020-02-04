<?php

require_once 'operations.php';
if(isset($_POST['AddBlogPost']))
{
    if(uploadFile($_FILES['image']))
	{
		if(setValues('blog_post','insert'))
        header('location: blog_posts_view.php');
            // echo "set";        
	}
}
else if(isset($_POST['editBlogPost']))
{
    if(uploadFile($_FILES['image']))
	{
        $post_id = $_GET['blog_post_id'];
		if(setValues('blog_post','update',$post_id))
        header('location: blog_posts_view.php');
            // echo "set";        
	}
}
else if(isset($_GET['blog_post_id']))
{
    $post_id = $_GET['blog_post_id'];
    $result = fetchRow('blog_post','post_id',$post_id);
    $data['blog_post'] = mysqli_fetch_assoc($result);
    $data['blog_post']['category_id'] = fetchCategoryOf($post_id);
}

?>