 <!-- Blog Comments -->
                
            
			

               <?php
//				$username = '';
//				$user_email = '';
				$user_email = $_SESSION['email'];
				$username = $_SESSION['username'];
				

				if(isset($_POST['create_comment'])){
					
					$the_post_id = $_GET['p_id'];
					
					
					/*$comment_author = $_POST['comment_author'];
					$comment_email = $_POST['comment_email'];*/
					
					
					
					$comment_content = $_POST['comment_content'];
					
					
					if(!empty($comment_content)) {
						
							$query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) ";
						$query .= "VALUES ($the_post_id, '{$username}', '{$user_email}', '{$comment_content}', 'disapproved', now())";

						$comment_query = mysqli_query($connection, $query);

						confirm_query($comment_query);


						/*$query = "UPDATE posts SET post_comment_count = post_comment_count + 1 ";
						$query .= "WHERE post_id = $the_post_id";

						$update_comment_count = mysqli_query($connection, $query);
						*/
					}
					else{
						echo "<script>alert('Comment Fields cannot be empty')</script>";
					}
					
					
					
				}
				
				
				?>

                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form role="form" action="" method="post">
                      
                      	<!--<div class="form-group">
                      	<label for="Author">Author</label>
                      		<input type="text" class="form-control" name="comment_author">
                        </div>
                        
                        <div class="form-group">
                        <label for="Email">Email</label>
                      		<input type="email" class="form-control" name="comment_email">
                        </div>-->
                       
                        <div class="form-group">
                           <!--<label for="comment">Your Comment</label>-->
                            <textarea class="form-control" name="comment_content" rows="3" placeholder="Commenting As <?php echo $username; ?>"></textarea>
                        </div>
                        
                        <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
                    </form>
                </div>
                
                
                
                <!-- Posted Comments -->
                
                
                <?php
				$res = 0;
				$query = "SELECT * FROM comments WHERE comment_post_id = {$the_post_id} ";
				$query .= "AND comment_status = 'approved' ";
				$query .= "AND in_response_to = $res ";
				//$query .= "ORDER BY comment_id DESC ";
				$select_comment_query = mysqli_query($connection, $query);
				
				if(!$select_comment_query){
					die('<h2>Query FAILED!</h2>' . mysqli_error($connection));
				}
				
				while($row = mysqli_fetch_assoc($select_comment_query)){
					$comment_date = $row['comment_date'];
					$comment_content = $row['comment_content'];
					$comment_author = $row['comment_author'];
					$comment_id = $row['comment_id'];
					$response = $row['in_response_to'];
					
					
				$pic_query = "SELECT * FROM users WHERE username = '$comment_author'";
				$send_pic_query = mysqli_query($connection, $pic_query);
					
				if(!$send_pic_query){
					die("query failed" . mysqli_error($connection));
				}
					
				while($row = mysqli_fetch_assoc($send_pic_query)){
					$user_image = $row['user_image'];
				}	
					
					
					
					?>
					
					<div class="media">
						<a class="pull-left" href="#">
							<?php
							if(!empty($user_image)){
								$image = "images/".$user_image; 
							}
							else{
								$image = "http://placehold.it/64x64?text=image";
							}
							
							?>
							<img class="media-object" src="<?php echo $image; ?>" width="64" height="64" alt="">
						</a>
						<div class="media-body">
							<h4 class="media-heading"><?php print $comment_author; ?>
								<i><small>Commented on: &nbsp;&nbsp;</small></i><small><?php print $comment_date; ?></small>
							</h4>
							<?php print $comment_content; ?>
							
							<?php
							if($response == 0){
								echo "<p><a href='post.php?p_id=$the_post_id&reply_to=$comment_id'>Reply</a></p>";
							}
							
							?>
							
							
						</div>
						
						
					
						<?php

						// Comments reply
						if(isset($_GET['reply_to']) && $_GET['reply_to'] == $comment_id){
							//$reply_to = $_GET['reply_to'];
							?>
							<div class="reply-comm" style="margin-left: 75px;">
								<form action="" method="post">
									<div class="form-group">
										<input type="text" class="form-control" placeholder="Author" name="comment_author">
									</div>


									<div class="form-group">
										<textarea class="form-control" name="comment_content" placeholder="Reply" rows="3"></textarea>
									</div>

									<button type="submit" name="reply_comment" class="btn btn-primary">Reply</button>
								</form>
							</div>
							
							
								<?php	

									if(isset($_POST['reply_comment'])){
										$reply_to = $_GET['reply_to'];

										$comm_author = $_POST['comment_author'];
										$comm_content = $_POST['comment_content'];

										$reply_comment_query = "INSERT INTO comments (comment_post_id, comment_author, comment_content, comment_status, in_response_to) ";
										$reply_comment_query .= "VALUES ($the_post_id, '$comm_author', '$comm_content', 'approved', $comment_id)";

										$run_reply_query = mysqli_query($connection, $reply_comment_query);

										if(!$run_reply_query){
											die("QUERY FAILED! " . mysqli_error($connection));
										}


									}

								?>	
							
							
							
					<?php	} ?>
		
						


					</div>
					
					
				<?php } ?>