<!-- Blog Sidebar Widgets Column -->
            <div class="col-md-5">
                
                

                <!-- Blog Search Well -->
                
                
                
                <!--Login-->
                
                <?php
				
				if(!isset($_SESSION['username'])){
					
					?>
					
					 <div class="well">
                    <h4>Login</h4>
                    <form action="includes/login.php" method="post">
                    	<div class="form-group">
							<input name="username" placeholder="Username" type="text" class="form-control">
							
                    	</div>
                    	<div class="input-group">
							<input name="password" placeholder="Password" type="password" class="form-control">
							<span class="input-group-btn">
								<button class="btn btn-primary" name="login" type="submit">
									Login
								</button>
							</span>
							
                    	</div>
                    </form>
                    <!-- /.input-group -->
                    <hr>
                    <p>Don't Have an Account? <a href="registration.php">Create</a> One</p>
                </div>
					
					<?php
					
				}
				else{
					?>
					<div class="well">
						<h3 style="width:auto; float:left;"><?php echo $_SESSION['username']; ?></h3>
						<p style="width:auto; float:right; margin-top: 25px;"><a href="#" id="flip">Profile</a></p>
						<div class="clearfix"></div>
						<h4><a href="includes/logout.php" >Log Out</a></h4>
						
						<p><a href="password_change.php">Change Password</a></p>	
						
						
						<?php
						$user_id = $_SESSION['user_id'];
						$profile_query = "SELECT * FROM users WHERE user_id = $user_id";
						$send_profile_query = mysqli_query($connection, $profile_query);
						while($row = mysqli_fetch_assoc($send_profile_query)){
							$fname = $row['user_firstname'];
							$lname = $row['user_lastname'];
							$username = $row['username'];
							$email = $row['user_email'];
							$the_user_dob = $row['user_dob'];
							$user_image = $row['user_image'];
						}
						
						?>
						
						
						<div class="well well-sm" id="profile" style="display:none;">
							<div class="row">
								<div class="col-sm-6 col-md-4">
									<?php
					
										if(!empty($user_image)){
											echo "<img src='images/$user_image' alt='' title='Change Photo' width='380' height='500' class='img-rounded img-responsive' data-toggle='modal' data-target='#myModal'>";
										}
										else if(empty($user_image)){
											echo "<img src='http://placehold.it/380x500' alt='' title='Upload Photo' class='img-rounded img-responsive' data-toggle='modal' data-target='#myModal'>";
										}

										?>
									
								</div>
								
								
								
								
								<div class="modal fade" id="myModal" role="dialog">
									<div class="modal-dialog modal-sm">

									  <!-- Modal content-->
									  <div class="modal-content">
										<div class="modal-header">
										  <button type="button" class="close" data-dismiss="modal">&times;</button>
										  <h4 class="modal-title">Select Your Photo</h4>
										</div>
										<div class="modal-body">
										  <p>
										  	<form action="includes/user_image_upload.php" method="post" enctype="multipart/form-data">
										  		<p><input type="file" name="user_photo" class="form-control btn-warning"></p>
												<p><input type="submit" name="up_photo" value="Upload" class="form-control btn-success"></p>
												
											</form>
										  </p>
										</div>
										<div class="modal-footer">
										  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
										</div>
									  </div>

									</div>
								  </div>
								
								
								
								
								
								
								
								
								
								
								
								
								
								
								
								
								<div class="col-sm-6 col-md-8">
									<h4>
										<?php
										if(!empty($fname) && !empty($lname)){
											echo $fname ." ". $lname;
										}
										else{
											echo "<a href='#'>Add</a>";
										}
										
										
										?>
									</h4>
									<p><?php echo $username; ?> <span><a href="#" id="showNameBox">Change</a></span> </p>
									<p>
										<form action="" id="unameChange" method="post">
											<input type="text" name="change_uname" value="<?php echo $username; ?>">
											<button type="submit" name="submit_uname" class="btn btn-xs btn-primary">Change</button>
										</form>
										
										<?php
										$uname = '';
										if(isset($_POST['submit_uname'])){
											$uname = $_POST['change_uname'];
											
											$query = "UPDATE users SET username = '$uname' WHERE user_id = $user_id";
											$change_uname_query = mysqli_query($connection, $query);
											
											if(!$change_uname_query){
												die("QUERY FAILED! " . mysqli_error($connection));
											}
										}
									
										?>
									</p>
									<p>
										<i class="glyphicon glyphicon-envelope"></i><?php echo " " . $email; ?>
										<br />
										<i class="glyphicon glyphicon-globe"></i><a href="http://www.jquery2dotnet.com">www.jquery2dotnet.com</a>
										<br />
										
											<?php 
											if($the_user_dob != '0000-00-00'){
												echo "<i class='glyphicon glyphicon-gift'></i> {$the_user_dob}";
											}
											else{
												echo "<i class='glyphicon glyphicon-gift'></i> <a href='#' id='dobtog'>Add</a>";
											}
										
											?>
											<form action="" method="post" id="dobform">
												<input type="date" name="dob">
												<input type="submit" value="Add" name="add_dob" class="btn btn-xs btn-success">
											</form>
											
											<?php
											$user_dob = '';	
											if(isset($_POST['add_dob'])){
												$user_dob = $_POST['dob'];
												
												$user_dob = date('Y-m-d', strtotime($user_dob));
												
												
												$query = "UPDATE users SET user_dob = '$user_dob' WHERE user_id = $user_id";
												$dob_query = mysqli_query($connection, $query);
												
												if(!$dob_query){
													die("query failed! " . mysqli_error($connection));
												}
											}
								
											?>
										
											
										
										
									</p>
									
									<script>
										$(document).ready(function(){
											$('#unameChange').hide();
											
											$('#showNameBox').click(function(){
												$('#unameChange').toggle();
											});
											
											$('#dobform').hide();
											
											$('#dobtog').click(function(){
												$('#dobform').toggle();
											});
										});
									</script>
									
								</div>
							</div>
						</div>
						
						
						
						
						
					</div>
					
					<script>
						$(document).ready(function(){
							$("#flip").click(function(){
								$("#profile").slideToggle("slow");
							});
						});
					</script>
					
					<?php
				}
				
				?>
               

                <div class="list-group">
                <h3>Most Viewed Posts</h3>
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
						
					</div>

                <!-- Side Widget Well -->
                <?php include "includes/widget.php"; ?>

            </div>