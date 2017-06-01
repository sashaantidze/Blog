<?php include 'includes/db.php'; ?> 
<?php include 'includes/header.php'; ?>
<?php include 'includes/navigation.php'; ?>   
 
    

    <div class="container-fluid text-center" id="searchPagebg">
    <?php
		if(isset($_POST['search']) && !empty($_POST['search'])){
			$search_keyword = $_POST['search'];
			$search = "Search results for <span>$search_keyword</span>";
		}
		else{
			$search = "Please Enter a Searching Keyword. <a href='index.php'>Search Again</a>";
		}
		
		
		?>
    	<h1 id="intro"><?php echo $search; ?></h1>
 
    </div>

    <!-- Page Content -->
    <div class="container">
		
        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-7">
                
                <?php
	
				if(isset($_POST['search'])){
					$search = $_POST['search'];
					
					$query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%' AND post_status = 'published'";
					$search_query = mysqli_query($connection, $query);
					
					if(!$search_query){
						die("QUERY FAILED" . mysqli_error($connection));
					}
					
					$count = mysqli_num_rows($search_query);
					
					if($count == 0){
						echo "<h1>NO RESULT</h1>";
					}
					else{
						
					
				
					while($row = mysqli_fetch_assoc($search_query)){
						
						$post_title = $row['post_title'];
						$post_id = $row['post_id'];
						$post_author = $row['post_author'];
						$post_date = $row['post_date'];
						$post_image = $row['post_image'];
						$post_content = substr($row['post_content'], 0, 150);
						
						?>
						
						<h1 class="page-header">
						
						</h1>
						
						<!-- First Blog Post -->
						<h2>
							<a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title ?></a>
						</h2>
						<p class="lead">
							by <a href="index.php"><?php echo $post_author ?></a>
						</p>
						<p><span class="glyphicon glyphicon-time"></span><?php echo $post_date ?></p>
						<hr>
						<a href="post.php?p_id=<?php echo $post_id; ?>"><img class="img-responsive" src="images/<?php echo $post_image ?>" alt=""></a>
						<hr>
						<p><?php echo $post_content ?></p>
						<a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

						<hr>
						
					<?php }	
					}
				}
				else{
					echo "<h2>You did not search for anything!</h2>";
				}
				?>
				
	
            </div>

           

        </div>
        <!-- /.row -->

        <hr>

        <?php include 'includes/footer.php'; ?>
