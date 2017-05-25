<?php include 'includes/db.php'; ?> 
<?php include 'includes/header.php'; ?>
<?php include 'includes/navigation.php'; ?>   
<script>
$(document).ready(function () {
	$('#searchBox').hide();
	$(window).on('load', function () {
		$('#intro').delay(2000).fadeOut('medium', function () {
			$('#searchBox').fadeIn('medium')
		});
		
	});
});

</script>  
    

    <div class="container-fluid text-center" id="main_bg">
    
    <div class="container" style="margin-top: 160px;">
    	<div class="well" id="searchBox">
                    <h4>Blog Search</h4>
                    <form action="search.php" method="post">
                    	<div class="input-group">
							<input name="search" placeholder="Search Blog" type="text" class="form-control">
							<span class="input-group-btn">
								<button name="submit" class="btn btn-default" type="submit">
									<span class="glyphicon glyphicon-search"></span>
								</button>
                        	</span>
                    	</div>
                    </form>
                    <!-- /.input-group -->
                </div>
    </div>
    
    
    
    
    
    
    	<h1 id="intro">Blog</h1>
    </div>

    <!-- Page Content -->
    <div class="container">
		
        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-7">
               <h1 class="page-header">
					Page Heading
					<?php
				   	if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == "subscriber"){
						echo "<small><a href='new_post.php'>Add New Post</a></small>";
					}
				   
				   
				   
				   	?>
					
					
					
							
				</h1>
                
                <?php
				
					if(isset($_GET['page'])){
						$page = $_GET['page'];
					}
					else{
						$page = '';
					}
				
				
					if($page == '' || $page == 1){
						$page_1 = 0;
					}
					else{
						$page_1 = ($page * 5) - 5;
					}
				
				
					$post_query_count = "SELECT * FROM posts";
					$find_count = mysqli_query($connection, $post_query_count);
					$count = mysqli_num_rows($find_count);
				
					$count = ceil($count / 5);
				
				
				
					
				
					$query = "SELECT * FROM posts WHERE post_status = 'published' ORDER BY post_id DESC LIMIT $page_1, 5";
					$select_all_posts_query = mysqli_query($connection, $query);
				
					if(mysqli_num_rows($select_all_posts_query) == 0){
						echo "<h1>There is Lonely in Here</h1>";
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
						
						
						
						<!-- First Blog Post -->
						<h2 class="post_title text-center">
							<a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title ?></a>
						</h2>
						<p class="lead">
							by <a href="author_posts.php?author=<?php echo $post_author; ?>&p_id=<?php echo $post_id; ?>"><?php echo $post_author ?></a>
						</p>
						<p><span class="glyphicon glyphicon-time"></span><?php echo $post_date ?></p>
						<hr>
						<a href="post.php?p_id=<?php echo $post_id; ?>"><img class="img-responsive" src="images/<?php echo $post_image ?>" alt=""></a>
						<hr>
						<p><?php echo $post_content ?></p>
						<a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

						<hr>
						
					<?php } }	?>
				
						
			
            </div>

            <?php include 'includes/sidebar.php'; echo $_SERVER['HTTP_HOST']; ?>

        </div>
        <!-- /.row -->

        <hr>
        
        <ul class="pager">
        	<?php
			
			for($i = 1; $i <= $count; $i++){
				
				if($i == $page){
					echo "<li><a class='active_link' href='index.php?page={$i}'>$i</li>";
				}
				else{
					echo "<li><a href='index.php?page={$i}'>$i</li>";
				}
				
				
			}
			
			
			?>
        </ul>

        <?php include 'includes/footer.php'; ?>
