<?php include 'includes/db.php'; ?> 
<?php include 'includes/header.php'; ?>
<?php include 'includes/navigation.php'; ?>   
<?php include 'admin/functions.php'; ?> 
<?php
				
				
				if(isset($_GET['p_id'])){
					$the_post_id = $_GET['p_id'];
					
					$view_query = "UPDATE posts set post_views_count = post_views_count + 1 WHERE post_id = $the_post_id";
					$send_query = mysqli_query($connection, $view_query);
				
					if(!$send_query){
						die("QUERY FAILED! " . mysqli_error($connection));
					}
				
					$query = "SELECT * FROM posts WHERE post_id = $the_post_id";
					$select_all_posts_query = mysqli_query($connection, $query);
					
					
				
					$row = mysqli_fetch_assoc($select_all_posts_query);
						
						$post_title = $row['post_title'];
						$post_author = $row['post_author'];
						$post_date = $row['post_date'];
						$post_image = $row['post_image'];
						$post_content = $row['post_content'];
						
						?>
 
 
 <div class="container-fluid text-center" id="post_bg">

    
    <div class="container" style="margin-top: 160px;">
    	
    </div>
    
    
    
    
    
    
    	<h1 id="introP"><?php echo $post_title; ?></h1>
    	<hr class="ruler">
    	<h3>Posted By <?php echo $post_author; ?> On <?php echo $post_date; ?> </h3>
    </div>
  

    

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-7 col-md-offset-2">
                
                
						
						<h1 class="page-header">
							Page Heading
							<small>Secondary Text</small>
						</h1>
						
						
						<hr>
						<img class="img-responsive" id="postImage" src="images/<?php echo $post_image ?>" alt="">
						<hr>
						<p><?php echo $post_content ?></p>

						<hr>
						
					<?php 	}
				
				else{
					die('<h1>No post has been chosen!</h1>');
				}
				
				?>
				
					
				<?php
				
				if(isset($_SESSION['username'])){
					include 'includes/commenting.php';
				}
				
				?>	

            </div>

        </div>
        <!-- /.row -->

        <hr>

        <?php include 'includes/footer.php'; ?>
