<?php include 'includes/db.php'; ?> 
<?php include 'includes/header.php'; ?>
<?php include 'includes/navigation.php'; ?>   
<?php include 'admin/functions.php'; ?> 
<div class="container-fluid text-center" id="authorPosts">
    <?php
		$the_post_author = $_GET['author'];
		
		?>
    	<h1 id="intro">all posts by <?php echo $the_post_author; ?></h1>
 
    </div>

    <!-- Page Content -->
    <div class="container">
		
        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-12 author_posts">
                
                
                <?php
				
				
				if(isset($_GET['p_id'])){
					$the_post_id = $_GET['p_id'];
					$the_post_author = $_GET['author'];
				}
				else{
					die('<h1>No post has been chosen!</h1>');
				}
				
					$query = "SELECT * FROM posts WHERE post_author = '{$the_post_author}'";
					$select_all_posts_query = mysqli_query($connection, $query);
					$posts_count = mysqli_num_rows($select_all_posts_query);
					$posts_per_row = $posts_count / 3;
				
					
				
					while($row = mysqli_fetch_assoc($select_all_posts_query)){
						
						$post_title = $row['post_title'];
						$post_id = $row['post_id'];
						$post_author = $row['post_author'];
						$post_date = $row['post_date'];
						$post_image = $row['post_image'];
						$post_content = substr($row['post_content'], 0, 100);
						
						$post_date = date('F j - Y, g:i a', strtotime($post_date));
						
						?>
						
						
							<!-- First Blog Post -->
							<div class="col-dm-12 post">
								<h2 class="post_title">
									<a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title ?></a>
								</h2>

								<div id="postContent"><?php echo $post_content ?></div>
								<p class="post-info-date">Posted On: <?php echo $post_date ?></p>
								<hr>
							</div>
							
						
						
					<?php }	?>

            </div>


        </div>
        <!-- /.row -->

        <hr>

        <?php include 'includes/footer.php'; ?>
