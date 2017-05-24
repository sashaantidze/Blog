<table class="table table-bordered table-hover centered-data">
                       	<thead>
                       		<tr>
                       			<th>Id</th>
                       			<th>Username</th>
                       			<th>First Name</th>
                       			<th>Last Name</th>
                       			<th>Date of Birth</th>
                       			<th>User Email</th>
                       			<th>User Image</th>
                       			<th>Role</th>
                       			<th>Last Updated</th>
                       			<th colspan="2">Convert User To</th>
                       			<th colspan="2">Actions</th>
                       		</tr>
                       	</thead>
                       	<tbody>
                       		
                       		<?php 
								$query = "SELECT * FROM users";
								$select_users = mysqli_query($connection, $query);

								while($row = mysqli_fetch_assoc($select_users)){
									$user_id = $row['user_id'];
									$username = $row['username'];
									$user_password = $row['user_password'];
									$user_firstname = $row['user_firstname'];
									$user_lastname = $row['user_lastname'];
									$user_email = $row['user_email'];
									$user_image = $row['user_image'];
									$user_role = $row['user_role'];
									$user_date = $row['user_registration_date'];
									$dob = $row['user_dob'];
									
									
									echo "<tr>";
										echo "<td>{$user_id}</td>";
										echo "<td>{$username}</td>";
										echo "<td>{$user_firstname}</td>";
										echo "<td>{$user_lastname}</td>";
									
										if($dob != '0000-00-00'){
											echo "<td>{$dob}</td>";
										}
										else{
											echo "<td>N/A</td>";
										}
									
										
										echo "<td>{$user_email}</td>";
									
										if(!empty($user_image)){
											echo "<td><img width='100' height='150' src='../images/$user_image'></td>";
										}
										else{
											echo "<td>Image Unavailable</td>";
										}
									
										
										echo "<td>{$user_role}</td>";
										echo "<td>{$user_date}</td>";
										echo "<td><a href='users.php?change_to_admin={$user_id}'>To Admin</a></td>";
										echo "<td><a href='users.php?change_to_sub={$user_id}'>To Subscriber</a></td>";
										echo "<td><a class='btn btn-danger' href='users.php?delete=$user_id'>Delete User</a></td>";
										echo "<td><a class='btn btn-warning' href='users.php?source=edit_user&edit_user=$user_id'>Edit User</a></td>";
										
								
									echo "</tr>";
									
						
							} 
							
 							?>													
                       		
                       	</tbody>
                       </table> 
                       
                      
<?php


if(isset($_GET['change_to_admin'])){
	
	$the_user_id = $_GET['change_to_admin'];
	
	$query = "UPDATE users SET user_role = 'admin' WHERE user_id = $the_user_id ";
	$change_to_admin_query = mysqli_query($connection, $query);
		header("Location: users.php");
	
	
}



if(isset($_GET['change_to_sub'])){
	
	$the_user_id = $_GET['change_to_sub'];
	
	$query = "UPDATE users SET user_role = 'subscriber' WHERE user_id = $the_user_id ";
	$change_to_subscriber_query = mysqli_query($connection, $query);
		header("Location: users.php");
	
	
	
}





if(isset($_GET['delete'])){
	
	if(isset($_SESSION['user_role'])){
		
		if($_SESSION['user_role'] == 'admin'){
			$the_user_id = $_GET['delete'];
	
			$query = "DELETE FROM users WHERE user_id = {$the_user_id}";
			if($delete_user_query = mysqli_query($connection, $query)){
				header("Location: users.php");
			}
		}
	}
	
}

?>