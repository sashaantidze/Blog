<?php

if(isset($_GET['p_id'])){
	$get_post_id = $_GET['p_id'];
}

$query = "SELECT * FROM posts WHERE post_id = $get_post_id";
$select_posts_by_id = mysqli_query($connection, $query);

while($row = mysqli_fetch_assoc($select_posts_by_id)){
	$post_id = $row['post_id'];
	$post_author = $row['post_author'];
	$post_title = $row['post_title'];
	$post_category_id = $row['post_category_id'];
	$post_status = $row['post_status'];
	$post_image = $row['post_image'];
	$post_tags = $row['post_tags'];
	$post_comments = $row['post_comment_count'];
	$post_date = $row['post_date'];
	$post_content = $row['post_content'];
}


if(isset($_POST['update_post'])){
	
	$post_author = $_POST['post_author'];
	$post_title = $_POST['post_title'];
	$post_category = $_POST['post_category'];
	$post_status = $_POST['post_status'];
	$post_image = $_FILES['post_image']['name'];
	$post_image_temp = $_FILES['post_image']['tmp_name'];
	$post_content = $_POST['post_content'];
	$post_tags = $_POST['post_tags'];
	
	move_uploaded_file($post_image_temp, "../images/$post_image");
	
	
	
	if(empty($post_image)){
		$query = "SELECT * FROM posts WHERE post_id = $get_post_id ";
		$select_image = mysqli_query($connection, $query);
		
		while($rows = mysqli_fetch_array($select_image)){
			$post_image = $rows['post_image'];
		}
	}
	
	$query = "UPDATE posts SET ";
	$query .="post_title = '{$post_title}', ";
	$query .="post_category_id = '{$post_category}', ";
	$query .="post_date = now(), ";
	$query .="post_title = '{$post_title}', ";
	$query .="post_status = '{$post_status}', ";
	$query .="post_tags = '{$post_tags}', ";
	$query .="post_content = '{$post_content}', ";
	$query .="post_image = '{$post_image}' ";
	$query .="WHERE post_id = {$get_post_id}";
	
	$update_post = mysqli_query($connection, $query);
	
	confirm_query($update_post);
	
	echo "<h2 class='bg-success'>Post Updated. <a href='../post.php?p_id={$get_post_id}'>View Post</a></h2> or <a href='posts.php'>View Other Posts</a>";
	
}

?>




<form action="" method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label for="title">Post Title</label>
		<input type="text" class="form-control" name="post_title" value="<?php echo $post_title; ?>">
	</div>
	
	<div class="form-group">
	<label for="title">Category</label>
		<select name="post_category" id="" class="form-control">
			
			<?php
			
			$query = "SELECT * FROM categories";
				$select_categories = mysqli_query($connection, $query);
			
				confirm_query($select_categories);

				while($row = mysqli_fetch_assoc($select_categories)){
					$cat_id = $row['cat_id'];
					$cat_title = $row['cat_title'];	
					
					echo "<option value={$cat_id}>{$cat_title}</option>";
				}
							
			?>
			
			
		</select>
	</div>
	
	<div class="form-group">
		<label for="author">Post Author</label>
		<input type="text" class="form-control" name="post_author" value="<?php echo $post_author; ?>">
	</div>
	
	<label for="author">Post Status</label>
	<div class="form-group">
		<select name="post_status" id="" class="form-control">
			<option value='<?php echo $post_status; ?>'><?php echo $post_status; ?></option>
			
			<?php
			
			if($post_status == 'published'){
				echo "<option value='draft'>Draft</option>";
			}
			else{
				echo "<option value='published'>Publish</option>";
			}
			
			?>
		</select>
	</div>
	
	
	
	
	<div class="form-group">
	<img src="../images/<?php echo $post_image; ?>" width="200" alt="">
	<br>
	<input type="file" name="post_image">
	</div>
	
	<div class="form-group">
		<label for="tags">Post Tags</label>
		<input type="text" class="form-control" name="post_tags" value="<?php echo $post_tags; ?>">
	</div>
	
	<div class="form-group">
		<label for="content">Post Content</label>
		<textarea name="post_content" id="" cols="30" rows="10" class="form-control">
			<?php echo $post_content; ?>
		</textarea>
	</div>
	
	<div class="form-group">
		<input type="submit" class="btn btn-primary" name="update_post" value="Publish Post">
	</div>
</form>