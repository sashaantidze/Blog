<?php include 'includes/db.php'; ?> 
<?php include 'includes/header.php'; ?>
<?php include 'includes/navigation.php'; ?>   

<?php
if(isset($_GET['category'])){
	$post_category = $_GET['category'];
	$get_cat_title = "SELECT cat_title FROM categories WHERE cat_id = $post_category";
	$get_cat_title_sql = mysqli_query($connection, $get_cat_title);
	$cat_name = mysqli_fetch_assoc($get_cat_title_sql);
}
?>
 
    

    <div class="container-fluid text-center" id="searchPagebg">
    <?php
		
		
		
		?>
    	<h1 id="intro"><?php echo $cat_name['cat_title']; ?></h1>
 
    </div>

    <!-- Page Content -->
    <div class="container">
		
        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-7 col-md-offset-2">
          

	<?php
	
	$query = "SELECT * FROM posts WHERE post_category_id = $post_category AND post_status = 'published'";
	$select_all_posts_query = mysqli_query($connection, $query);
	
	if(empty(mysqli_num_rows($select_all_posts_query))){
		echo '<h1>No posts are available under this category</h1>';
	}

	else{

		while($row = mysqli_fetch_assoc($select_all_posts_query)){

		$post_title = $row['post_title'];
		$post_id = $row['post_id'];
		$post_author = $row['post_author'];
		$post_date = $row['post_date'];
		$post_image = $row['post_image'];
		$post_content = substr($row['post_content'], 0, 150);
							
	?>

	<h2 class="post_title text-center">
	<a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title ?></a>
	</h2>
	<p class="lead post-info-date">
	by <a href="author_posts.php?author=<?php echo $post_author; ?>&p_id=<?php echo $post_id; ?>"><?php echo $post_author ?></a>
	</p>
	<p class="post-info-date">Posted On: <?php echo $post_date ?></p>
	<hr>
	<a href="post.php?p_id=<?php echo $post_id; ?>"><img class="img-responsive" src="images/<?php echo $post_image ?>" alt=""></a>
	<hr>
	<div id="postContent"><?php echo $post_content ?></div>
	<a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
	<hr>
	<?php  }  }?>
						
			
            </div>

            

        </div>
        <!-- /.row -->

        <hr>

        <?php include 'includes/footer.php'; ?>
