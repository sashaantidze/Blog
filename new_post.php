<?php include 'includes/db.php'; ?> 
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Blog Home - Start Bootstrap Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/blog-home.css" rel="stylesheet">
    
    <link href="css/styles.css" rel="stylesheet">
    <script src="http://cloud.tinymce.com/stable/tinymce.min.js"></script>
    
    
    

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    <style>
		body{
			background: url(images/bg-texture.jpg);
		}
		
		.new{
			width: auto;
			float: left;
			font-weight: bold;
		}
		
		.poster{
			width: auto;
			float: right;
			padding-top: 25px;
		}
	</style>

</head>

<body>
<?php include 'includes/navigation.php'; ?>

<?php 

if(!isset($_SESSION['user_role'])){
	header ("Location: index.php");
}

?>



<?php

$post_messege = '';

if(isset($_POST['add_new_post'])){
	
	
	$new_post_author = $_SESSION['username'];
	$new_post_title = $_POST['new_post_title'];
	$new_post_image = $_FILES['new_post_image']['name'];
	$new_post_image_temp = $_FILES['new_post_image']['tmp_name'];
	$new_post_tags = $_POST['new_post_tags'];
	$new_post_content = mysqli_real_escape_string($connection, $_POST['new_post_content']);
	$post_category_id = $_POST['post_category_id'];
	
	move_uploaded_file($new_post_image_temp, "images/$new_post_image");
	
	
	if(!empty($new_post_title) && !empty($new_post_tags) && !empty($new_post_content)){
		
		$ins_query = "INSERT INTO posts (post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status) ";
		$ins_query .= "VALUES ({$post_category_id}, '{$new_post_title}', '{$new_post_author}', now(), '{$new_post_image}', '{$new_post_content}', '{$new_post_tags}', 'draft') ";
		
		$new_post_query = mysqli_query($connection, $ins_query);
		$get_new_post_id = mysqli_insert_id($connection);
		
		if(!$new_post_query){
			die("QUERY FAILED! " . mysqli_error($connection));
		}
		else{
			$post_messege = "<div class='panel panel-success'>
								  <div class='panel-heading'><h3>Post Has Been Added</h3></div>
								  <div class='panel-body'><h4>And Waiting To Be Approved</h4></div>
								</div>";
		}
	}
	else{
		$post_messege =  "<div class='panel panel-danger'>
							 
							  <div class='panel-heading'><h3>Don't Leave Those Fields Empty</h3></div>
							</div>";
	}
	
	
}


?>






<!-- Page Content -->
   <script>tinymce.init({ selector:'textarea' });</script>
    <div class="container">
		
        <div class="row">
        
       	<div class="col-lg-6">
       		<h1 class="new">New Post</h1>
       		<h4 class="poster">Posting As <?php echo $_SESSION['username']; ?></h4>
       		<div class="clearfix"></div>
       		<?php print $post_messege; ?>
      	<form action="" method="post" enctype="multipart/form-data">
      		<div class="form-group">
      			<input type="text" name="new_post_title" class="form-control" placeholder="Post Title">
      		</div>
      		
      		<div class="form-group">
      			<select name="post_category_id" id="" class="form-control">
					<option value="" selected>Select Category</option>

					<?php

					$query = "SELECT * FROM categories";
						$select_categories = mysqli_query($connection, $query);

						//confirm_query($select_categories);
					
						if(!$select_categories){
							die(mysqli_error($connection));
						}

						while($row = mysqli_fetch_assoc($select_categories)){
							$cat_id = $row['cat_id'];
							$cat_title = $row['cat_title'];	

							echo "<option value={$cat_id}>{$cat_title}</option>";
						}

					?>


				</select>
      		</div>
      		
      		<div class="form-group">
      			<input type="file" name="new_post_image" class="form-control btn btn-warning">
      		</div>
      		
      		<div class="form-group">
      			<input type="text" name="new_post_tags" class="form-control" placeholder="Post Tags">
      		</div>
      		
      		<div class="form-group">
      			<textarea name="new_post_content" class="form-control" id="" cols="30" rows="10"></textarea>
      		</div>
      		
      		<div class="form-group">
      			<input type="submit" value="Add New Post" name="add_new_post" class="btn btn-warning">
      		</div>
      	</form>
       	</div>
 
	</div>
 
 <!-- Footer -->
        <footer>
           
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
