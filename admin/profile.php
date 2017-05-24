<?php include 'includes/admin_header.php' ?>


	<?php

if(isset($_SESSION['username'])){
	$username = $_SESSION['username'];
	
	$query = "SELECT * FROM users WHERE username = '{$username}'";
	
	$select_user_profile_query = mysqli_query($connection, $query);
	
	while($row = mysqli_fetch_assoc($select_user_profile_query)){
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

?>



<?php 
$pass_match = '';
$update_succes = '';

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
	
	
	if($user_password === $confirm_password){
		
		
		$query = "UPDATE users SET ";
		$query .="user_firstname = '{$user_firstname}', ";
		$query .="user_firstname = '{$user_firstname}', ";
		$query .="user_role = '{$user_role}', ";
		$query .="user_password = '{$user_password}', ";
		$query .="username = '{$username}', ";
		$query .="user_email = '{$user_email}' ";
		$query .="WHERE username = '{$username}'";
		
		$edit_user_query = mysqli_query($connection, $query);
		
		if(!$edit_user_query){
			die("Query FAILED!" . mysqli_error($connection));
		}
		else{
			$update_succes = "<h2>Profile Has Been Updated!</h2>";
		}
		
		
	}
	else{
		$pass_match = '<div class="alert alert-danger">Password does not match!</div>';
	}
	

}

?>


    <div id="wrapper">
    
        <!-- Navigation -->
        <?php include 'includes/admin_navigation.php' ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                     <h1 class="page-header">
                         Welcome to admin
                         <small>Author</small>
                      </h1>
                       
                       
  <form action="" method="post" enctype="multipart/form-data">

	<?php echo $pass_match; ?>
	<?php echo $update_succes; ?>
	
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
		<input type="password" class="form-control" name="confirm_password">
	</div>
	
	<div class="form-group">
		<label for="user_role">User Role</label>
		<select name="user_role" id="" class="form-control">
			<option value="subscriber" selected><?php echo $user_role ?></option>
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
		<input type="submit" class="btn btn-primary" name="edit_user" value="Update Profile">
	</div>
</form>
                       
                       
                        
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

   <?php include 'includes/admin_footer.php'; ?>