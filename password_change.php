<?php include 'includes/db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link href='https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300' rel='stylesheet' type='text/css'>
	
	<link href="css/blog-home.css" rel="stylesheet">
	 <link href="css/bootstrap.min.css" rel="stylesheet">
	 <!--<link rel="stylesheet" href="css/regstyle.css" type="text/css">-->
	 <style>
		 .home-link:hover{
			 color: tomato;
		 }
		 
	
	</style>
</head>
<body>
	
	<?php include 'includes/navigation.php'; ?>  

	<?php
	$pass_messege = '';
	
	if(isset($_POST['submit_new_password'])){
										
	$curr_pass = $_POST['curr_password'];
	$new_pass = $_POST['new_password'];
										
										
	if(isset($_SESSION['user_id'])){
	if(!empty($curr_pass) && !empty($new_pass)){
	$pullquery = "SELECT randSalt, user_password FROM users WHERE username = '$_SESSION[username]'";

	$select_randsalt_query = mysqli_query($connection, $pullquery);
	if(!$select_randsalt_query){
	die("Query failed!" . mysqli_error($connection));
	}

	$row = mysqli_fetch_assoc($select_randsalt_query);
	$salt = $row['randSalt'];
	$user_password = $row['user_password'];												
												

	$curr_hashed_password = crypt($curr_pass, $salt);

	if($curr_hashed_password === $user_password){
	$new_hashed_password = crypt($new_pass, $salt);
	$query = "UPDATE users SET user_password = '$new_hashed_password' WHERE user_id = $_SESSION[user_id]";
	
	$update_password_query = mysqli_query($connection, $query);

	if(!$update_password_query){
	die("QUERY FAILED!" . mysqli_error($connection));
	}
	else{
	$pass_messege = "<h3>Password Changed!</h3>";
	}
	}
	else{
	$pass_messege = "<h3>Password does not match!</h3>";
													}

	}
	else{
	$pass_messege = '<h3>Fill in password fields!</h3>';
	}
	}
	else{
	echo '<h1>NOT ISSET </h1>';
	}
	}
									
	?>

	<div class="container">
	<?php echo $pass_messege; ?>
	 <form action="" method="post">
	<div class="form-group">
	<label for="old password">Old Password</label>
	<input type="password" name="curr_password" class="form-control" placeholder="Your Current Password">
	</div>
								  	
	<div class="form-group">
	<label for="new password">New Password</label>
	<input type="password" name="new_password" class="form-control" placeholder="Your New Password">
	</div>
								  	
	<button class="btn btn-primary" name="submit_new_password" type="submit">Submit</button>
						
	</form>
    
</div>
</body>
</html>
