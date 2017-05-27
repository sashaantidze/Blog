<?php session_start(); ?>

   <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">shitFuck</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                  <li class="dropdown">
					  <a href="#" class="dropdown-toggle" type="button" data-toggle="dropdown">Categories
					  <span class="caret"></span></a>
					  <ul class="dropdown-menu">
						<?php
						  
						  $query = "SELECT * FROM categories";
					$select_all_categories_query = mysqli_query($connection, $query);
					while($row = mysqli_fetch_assoc($select_all_categories_query)){
						$cat_id = $row['cat_id'];
						$cat_title = $row['cat_title'];
						
						echo "<li><a href='category.php?category={$cat_id}'>{$cat_title}</a></li>";
					}
					
						  
						  ?>
					  </ul>
					  
					</li>
                  <li class="dropdown">
					  <a href="#" class="dropdown-toggle" type="button" data-toggle="dropdown">Popular Posts
					  <span class="caret"></span></a>
					  <ul class="dropdown-menu list-group" id="popularPosts">
						<?php 
							$sel_side = "SELECT * FROM posts WHERE post_status = 'published' ORDER BY post_views_count DESC LIMIT 5";
							$run_side = mysqli_query($connection, $sel_side);
							while($rows = mysqli_fetch_assoc($run_side)){
								if(isset($_GET['p_id'])){
									if($_GET['p_id'] == $rows['post_id']){
										$class = "active";
									}
									else{
										$class = "";
									}	
								}
								else{
									$class = "";
								}
								echo '

									<a href="post.php?p_id='.$rows['post_id'].'" class="list-group-item '.$class.'">
										<div class="col-sm-4">
											'.(empty($rows['post_image']) ? 'No image' : '<img src="images/'.$rows['post_image'].'" width="100%">').'
										</div>
										<div class="col-sm-8">
											<h4 class="list-group-item-heading">'.$rows['post_title'].'</h4>
											<p class="list-group-item-text">'.strip_tags(substr($rows['post_content'], 0, 80)).'...</p>
										</div>
										<div style="clear:both;"></div>
										
									</a>
								';
							}
						 ?>
					  </ul>
					</li>
                   
                   
                   
                    
                   
                   
                   <?php
					
					if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin'){
						
						print "<li><a href='admin'>Admin</a></li>";
						
						if(isset($_GET['p_id'])){
							
							$the_post_id = $_GET['p_id'];
							
							print "<li><a href='admin/posts.php?source=edit_post&p_id={$the_post_id}'>Edit Post</a></li>";
					
							
						}
					
					}
					
					
					?>
                 
                 	
                  
          			
                </ul>
                <ul class="nav navbar-nav navbar-right">
				  <li><a href="registration.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
				  <li class="dropdown"><a href="#" class="dropdown-toggle" type="button" data-toggle="dropdown"><span class="glyphicon glyphicon-login"></span>Login</a>
				  	<ul class="dropdown-menu">
				  	<li>
				  		<?php include 'sidebar.php'; ?>
				  	</li>
				  		
				  	</ul>
				  </li>
				</ul>
            </div>
           
            <!-- /.navbar-collapse -->
        </div>
        
        <!-- /.container -->
    </nav>
