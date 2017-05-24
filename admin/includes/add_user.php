<?php
$pass_match = '';

if(isset($_POST['create_user'])){
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
	
	
	if($user_password === $confirm_password){
		$query = "INSERT INTO users(user_firstname, user_lastname, user_role, username, user_email, user_password) ";
		$query .=" VALUES ('{$user_firstname}', '{$user_lastname}', '{$user_role}', '{$username}', '{$user_email}', '{$user_password}')";

		$create_user_query = mysqli_query($connection, $query);
		
		confirm_query($create_user_query);
		
		echo "<h3>User Created: " . " " . "  <a href='users.php'>View Users</a></h3> ";
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
		<input type="text" class="form-control" name="user_firstname">
	</div>
	
	<div class="form_group">
		<label for="post_status">Last Name</label>
		<input type="text" class="form-control" name="user_lastname">
	</div>
	
	<div class="form_group">
		<label for="content">Password</label>
		<input type="password" class="form-control" name="user_password">
	</div>
	
	<div class="form_group">
		<label for="content">Confirm Password</label>
		<input type="password" class="form-control" name="confirm_password">
	</div>
	
	<div class="form-group">
		<label for="user_role">User Role</label>
		<select name="user_role" id="" class="form-control">
			<option value="subscriber" selected>Select Role</option>
			<option value="admin">Admin</option>
			<option value="subscriber">Subsciber</option>
			
		</select>
	</div>
	
	
	
	
	
	<!--<div class="form_group">
		<label for="image">User Image</label>
		<input type="file"  name="user_image">
	</div>-->
	
	<div class="form_group">
		<label for="tags">Username</label>
		<input type="text" class="form-control" name="username">
	</div>
	
	<div class="form_group">
		<label for="content">Email</label>
		<input type="email" class="form-control" name="user_email">
	</div>
	
	
	
	<div class="form_group">
		<input type="submit" class="btn btn-primary" name="create_user" value="Add User">
	</div>
</form>