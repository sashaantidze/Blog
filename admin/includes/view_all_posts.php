<?php


if(isset($_POST['checkBoxArray'])){
	
	foreach($_POST['checkBoxArray'] as $checkBoxIdValue){
		$bulk_options = $_POST['bulk_options'];
		
		switch($bulk_options){
			case 'published':
				$query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = $checkBoxIdValue";
				$update_to_publihed_status = mysqli_query($connection, $query);
				confirm_query($update_to_publihed_status);
				break;
				
			case 'draft':
				$query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = $checkBoxIdValue";
				$update_to_draft_status = mysqli_query($connection, $query);
				confirm_query($update_to_draft_status);
				break;
				
			case 'delete':
				$query = "DELETE FROM posts WHERE post_id = $checkBoxIdValue";
				$delete_query = mysqli_query($connection, $query);
				confirm_query($delete_query);
				break;
				
			case 'clone':
				$query = "SELECT * FROM posts WHERE post_id = $checkBoxIdValue";
				$select_post_query = mysqli_query($connection, $query);
				
				while($row = mysqli_fetch_assoc($select_post_query)){
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
				
				$query = "INSERT INTO posts(post_category_id, post_title, post_content, post_author, post_date, post_image, post_tags, post_status) ";
				$query .=" VALUES ({$post_category_id}, '{$post_title}', '{$post_content}', '{$post_author}', now(), '{$post_image}', '{$post_tags}', '{$post_status}')";
				
				$copy_query = mysqli_query($connection, $query);
				
				if(!$copy_query){
					die("QUERY FAILED! " . mysqli_error($connection));
				}
				
				break;
		}
		
	}
}

?>
                     	

<form action="" method="post">
                      	<table class="table table-bordered table-hover centered-data">
                      	
                      	
                      	
                      	<div id="bulkOptionsContainer" class="col-xs-2">
                      	
                      		<select name="bulk_options" id="bulkOptions" class="form-control">
                      			<option value="">Select Options</option>
                      			<option value="published">Publish</option>
                      			<option value="draft">Draft</option>
                      			<option value="delete">Delete</option>
                      			<option value="clone">Clone</option>
                      		</select>
                      	</div>
                      	<div class="col-xs-4">
                      		<input type="submit" name="submit" id="optionBtn" class="btn btn-success" value="Apply Option">
                      		<a class="btn btn-primary" href="posts.php?source=add_post">Add New</a>
                      	</div>
                      	
                      	<br>
                      	<br>
                      	<br>
                      	
                       	<thead>
                       		<tr>
                       			<th><input type="checkbox" id="selectAllBoxes"></th>
                       			<th>Post Id</th>
                       			<th>Author</th>
                       			<th>Title</th>
                       			<th>Category</th>
                       			<th>Status</th>
                       			<th>Image</th>
                       			<th>Tags</th>
                       			<th>Comments</th>
                       			<th>Views</th>
                       			<th>Date</th>
                       			<th>Reset Views</th>
                       			<th>Edit</th>
                       			<th>Delete</th>
                       		</tr>
                       	</thead>
                       	<tbody>
                       		
                       		<?php 
								$query = "SELECT * FROM posts ORDER BY post_id DESC";
								$select_posts = mysqli_query($connection, $query);

								while($row = mysqli_fetch_assoc($select_posts)){
									$post_id = $row['post_id'];
									$post_author = $row['post_author'];
									$post_title = $row['post_title'];
									$post_category_id = $row['post_category_id'];
									$post_status = $row['post_status'];
									$post_image = $row['post_image'];
									$post_tags = $row['post_tags'];
									$post_comments = $row['post_comment_count'];
									$post_date = $row['post_date'];
									$post_views = $row['post_views_count'];
									
									echo "<tr>";
									?>
									
										<td><input type='checkbox' class='checkboxes' name='checkBoxArray[]' value='<?php echo $post_id ?>'></td>
										
									<?php	
									
										echo "<td>{$post_id}</td>";
										echo "<td>{$post_author}</td>";
										echo "<td><a data-toggle='tooltip' data-placement='top' title='Go To &apos;$post_title&apos; Post' href='../post.php?p_id={$post_id}'>{$post_title}</a></td>";
									
								
									
									$query = "SELECT * FROM categories WHERE cat_id = {$post_category_id}";
										$select_categories_id = mysqli_query($connection, $query);

										while($row = mysqli_fetch_assoc($select_categories_id)){
											$cat_id = $row['cat_id'];
											$cat_title = $row['cat_title'];	
									
										echo "<td>{$cat_title}</td>";
										}
									
									
									
										echo "<td>{$post_status}</td>";
										echo "<td><img width='150' src='../images/$post_image'</td>";
										echo "<td>{$post_tags}</td>";
									
									
										$query = "SELECT * FROM comments WHERE comment_post_id = $post_id";
										$send_comment_query = mysqli_query($connection, $query);
										$row = mysqli_fetch_assoc($send_comment_query);
										$comment_id = $row['comment_id'];
										$count_comments = mysqli_num_rows($send_comment_query);
									
										echo "<td><a href='post_comments.php?id=$post_id'>{$count_comments}</a></td>";
									
									
									
									
									
										echo "<td>{$post_views}</td>";
										echo "<td>{$post_date}</td>";
										echo "<td><a href='posts.php?reset_views={$post_id}'>Reset</td>";
										echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</td>";
										echo "<td><a onClick=\"javascript: return confirm('Are You Sure You Want to Delete This Post?'); \" href='posts.php?delete={$post_id}'>Delete</td>";	
									
									echo "</tr>";
								}
							?>
                      			
                      			<script>
								$(document).ready(function(){
									$('[data-toggle="tooltip"]').tooltip();
								});
								
							</script>
                       			
                       		
                       	</tbody>
                       </table>
                      
</form>                        
                       
                      
<?php
if(isset($_GET['delete'])){
	
	$the_post_id = $_GET['delete'];
	
	$query = "DELETE FROM posts WHERE post_id = {$the_post_id}";
	if($delete_query = mysqli_query($connection, $query)){
		header("Location: posts.php");
	}
	
}

if(isset($_GET['reset_views'])){
	$reset_view_post_id = $_GET['reset_views'];
	
	$query = "UPDATE posts SET post_views_count = 0 WHERE post_id =" . mysqli_real_escape_string($connection, $reset_view_post_id) . " ";
	//$send_reset_query = mysqli_query($connection, $query);
	
	if($send_reset_query = mysqli_query($connection, $query)){
		header("Location: posts.php");
	}
}

?>