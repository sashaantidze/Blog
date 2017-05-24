<?php


if(isset($_GET['edit_user'])){
	$the_user_id = $_GET['edit_user'];
	
	$query = "SELECT * FROM users WHERE user_id = $the_user_id";
	$select_users_query = mysqli_query($connection, $query);
	while($row = mysqli_fetch_assoc($select_users_query)){
		$user_id = $row['user_id'];
		$username = $row['username'];
		$user_password = $row['user_password'];
		$user_firstname = $row['user_firstname'];
		$user_lastname = $row['user_lastname'];
		$user_email = $row['user_email'];
		$user_image = $row['user_image'];
		$user_role = $row['user_role'];
		$user_date = $row['user_registration_date'];
		
	}
}



$pass_match = '';

if(isset($_POST['edit_user'])){
	$user_firstname = $_POST['user_firstname'];
	$user_lastname = $_POST['user_lastname'];
	$user_role = $_POST['user_role'];
	$confirm_password = $_POST['confirm_password'];
	
	/*$post_image = $_FILES['image']['name'];
	$post_image_temp = $_FILES['image']['tmp_name'];*/
	
	$user_password = $_POST['user_password'];
	$username = $_POST['username'];
	$user_email = $_POST['user_email'];
//	$post_date = date('d-m-y');

	
	
//	move_uploaded_file($post_image_temp, "../images/$post_image");
	
	
	
	$query = "SELECT randSalt FROM users";
	$select_randsalt_query = mysqli_query($connection, $query);
	if(!$select_randsalt_query){
		die("Query failed!" . mysqli_error($connection));
	}
	
	$row = mysqli_fetch_assoc($select_randsalt_query);
	$salt = $row['randSalt'];
	$hashed_password = crypt($user_password, $salt);
	
	
	if($user_password === $confirm_password){
		
		
		$query = "UPDATE users SET ";
		$query .="user_firstname = '{$user_firstname}', ";
		$query .="user_lastname = '{$user_lastname}', ";
		$query .="user_role = '{$user_role}', ";
		$query .="user_password = '{$hashed_password}', ";
		$query .="username = '{$username}', ";
		$query .="user_email = '{$user_email}' ";
		$query .="WHERE user_id = {$the_user_id}";
		
		$edit_user_query = mysqli_query($connection, $query);
		
		if(!$edit_user_query){
			die("Query FAILED!" . mysqli_error($connection));
		}
		else{
			echo "<h2>User Has Been Updated!</h2>";
		}
		
		
	}
	else{
		$pass_match = '<div class="alert alert-danger">Password does not match!</div>';
	}
	
	
	
	
}

?>


<form action="" method="post" enctype="multipart/form-data">

	<?php echo $pass_match; ?>
	
	<div class="form_group">
		<label for="author">First Name</label>
		<input type="text" value="<?php echo $user_firstname ?>" class="form-control" name="user_firstname">
	</div>
	
	<div class="form_group">
		<label for="post_status">Last Name</label>
		<input type="text" value="<?php echo $user_lastname ?>" class="form-control" name="user_lastname">
	</div>
	
	<div class="form_group">
		<label for="content">Password</label>
		<input type="password" value="<?php echo $user_password ?>" class="form-control" name="user_password">
	</div>
	
	<div class="form_group">
		<label for="content">Confirm Password</label>
		<input type="password" value="<?php echo $user_password ?>" class="form-control" name="confirm_password">
	</div>
	
	<div class="form-group">
		<label for="user_role">User Role</label>
		<select name="user_role" id="" class="form-control">
			<option value="<?php echo $user_role ?>" selected><?php echo $user_role ?></option>
		<?php
			if($user_role == 'admin'){
				echo "<option value='subscriber'>subsciber</option>";
			}
			   else{
				   echo "<option value='admin'>admin</option>";
			   }
			
			?>
			
			
			
		</select>
	</div>
	
	
	
	
	
	<!--<div class="form_group">
		<label for="image">User Image</label>
		<input type="file"  name="user_image">
	</div>-->
	
	<div class="form_group">
		<label for="tags">Username</label>
		<input type="text" value="<?php echo $username ?>" class="form-control" name="username">
	</div>
	
	<div class="form_group">
		<label for="content">Email</label>
		<input type="email" value="<?php echo $user_email ?>" class="form-control" name="user_email">
	</div>
	
	<br>
	
	<div class="form_group">
		<input type="submit" class="btn btn-primary" name="edit_user" value="Update User">
	</div>
</form>