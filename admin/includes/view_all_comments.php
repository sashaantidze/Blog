<table class="table table-bordered table-hover centered-data">
                       	<thead>
                       		<tr>
                       			<th>Id</th>
                       			<th>Author</th>
                       			<th>Comment</th>
                       			<th>Email</th>
                       			<th>Status</th>
                       			<th>In Response to Post</th>
                       			<th>Replied to (Comment ID)</th>
                       			<th>Date</th>
                       			<th>Approve</th>
                       			<th>Disapprove</th>
                       			<th>Delete</th>
                       		</tr>
                       	</thead>
                       	<tbody>
                       		
                       		<?php 
								$query = "SELECT * FROM comments ";
								$select_comments = mysqli_query($connection, $query);

								while($row = mysqli_fetch_assoc($select_comments)){
									$comment_id = $row['comment_id'];
									$comment_post_id = $row['comment_post_id'];
									$comment_author = $row['comment_author'];
									$comment_email = $row['comment_email'];
									$comment_content = $row['comment_content'];
									$comment_status = $row['comment_status'];
									$comment_date = $row['comment_date'];
									$in_response_to = $row['in_response_to'];
									
									
									echo "<tr>";
										echo "<td>{$comment_id}</td>";
										echo "<td>{$comment_author}</td>";
										echo "<td>{$comment_content}</td>";
									
//									$query = "SELECT * FROM categories WHERE cat_id = {$post_category_id}";
//										$select_categories_id = mysqli_query($connection, $query);
//
//										while($row = mysqli_fetch_assoc($select_categories_id)){
//											$cat_id = $row['cat_id'];
//											$cat_title = $row['cat_title'];	
//									
//										echo "<td>{$cat_title}</td>";
//										}
									
									
									
										echo "<td>{$comment_email}</td>";
										if($comment_status == 'approved'){
											echo "<td class='success'>".ucfirst($comment_status)."</td>";
										}
										else{
											echo "<td class='danger'>".ucfirst($comment_status)."</td>";
										}
									
										$query = "SELECT * FROM posts WHERE post_id = $comment_post_id";
										$select_post_id_query = mysqli_query($connection, $query);
										while($row = mysqli_fetch_assoc($select_post_id_query)){
											$post_id = $row['post_id'];
											$post_title = $row['post_title'];
											
											echo "<td><a href='../post.php?p_id={$post_id}'>{$post_title}</a></td>";
										}
									
									
										if($in_response_to == 0){
											echo "<td>1st Level Comment</td>";
										}
										else{
											echo "<td>{$in_response_to}</td>";
										}
										
									
									
									
									
										echo "<td>{$comment_date}</td>";
										echo "<td><a href='comments.php?approve={$comment_id}' class='btn btn-success'>Approve</td>";
										echo "<td><a href='comments.php?disapprove={$comment_id}' class='btn btn-warning'>Disapprove</td>";
										echo "<td><a href='comments.php?delete={$comment_id}' class='btn btn-danger'>Delete</td>";	
									
									echo "</tr>";
								}
							?>
                       			
                       		
                       	</tbody>
                       </table>
                       
                      
<?php


if(isset($_GET['approve'])){
	
	$the_comment_id = $_GET['approve'];
	
	$query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = $the_comment_id ";
	$disparove_comment_query = mysqli_query($connection, $query);
		header("Location: comments.php");
	
	
}



if(isset($_GET['disapprove'])){
	
	$the_comment_id = $_GET['disapprove'];
	
	$query = "UPDATE comments SET comment_status = 'disapproved' WHERE comment_id = $the_comment_id ";
	$disparove_comment_query = mysqli_query($connection, $query);
		header("Location: comments.php");
	
	
}





if(isset($_GET['delete'])){
	
	$the_comment_id = $_GET['delete'];
	
	$query = "DELETE FROM comments WHERE comment_id = {$the_comment_id}";
	if($delete_query = mysqli_query($connection, $query)){
		header("Location: comments.php");
	}
	
}

?>