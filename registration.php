<?php
//session_start();
include 'includes/db.php';
include 'includes/navigation.php';  

if(isset($_SESSION['username'])){
	header("Location: index.php");
}
?>
 

<?php 

if(isset($_POST['submit'])) {
	
	$username = $_POST['username'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	
	if(!empty($username) && !empty($email) && !empty($password) && !empty($fname) && !empty($lname)){
		
		$username = mysqli_real_escape_string($connection, $username);
		$email    = mysqli_real_escape_string($connection, $email); 
		$password = mysqli_real_escape_string($connection, $password); 
		$fname = mysqli_real_escape_string($connection, $fname);
		$lname = mysqli_real_escape_string($connection, $lname);



		$query = "SELECT randSalt FROM users";

		$select_randSalt_query = mysqli_query($connection, $query);

		if(!$select_randSalt_query){
			die("query failed!" . mysqli_error($connection));
		}

		$row = mysqli_fetch_array($select_randSalt_query);
		$salt = $row['randSalt'];
			
		$password = crypt($password, $salt);
		
		
		$email_query = "SELECT user_email FROM users WHERE user_email = '$email'";
		$select_users_email_query = mysqli_query($connection, $email_query);
		
		/*while($row = mysqli_fetch_assoc($select_users_email_query)){
			$user_email = $row['user_email'];
		}*/
		
		if(mysqli_num_rows($select_users_email_query) == 1){
			$messege = "This email already exists";
			$style = '';
		}
		else{
			$query = "INSERT INTO users (username, user_email, user_firstname, user_lastname, user_password, user_role) ";
			$query .= "VALUES ('{$username}', '{$email}', '{$fname}', '{$lname}', '{$password}', 'subscriber')";

			$register_user_query = mysqli_query($connection, $query);

			if(!$register_user_query){
				die("QUERY FAILED!" . mysqli_error($connection));
			}

			$messege = "Your Registration Has Been Submitted! Go To <a class='home-link' href='index.php'>Home</a> Page To Login.";
			$style = "style='display:none;'";
		}
		

		
		
		
	}
	else{
		$messege = "Fields Cannot Be empty";
		$style = '';
	}

}
else{
	$messege = "";
	$style = '';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link href='https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300' rel='stylesheet' type='text/css'>
	
	<link href="css/blog-home.css" rel="stylesheet">
	 <link href="css/bootstrap.min.css" rel="stylesheet">
	 <link rel="stylesheet" href="css/regstyle.css" type="text/css">
	 <style>
		 .home-link:hover{
			 color: tomato;
			 text-decoration: none;
		 }

	
	</style>
</head>
<body>
	
	

	<div class="container">
		
		
			
			<form action="registration.php" method="post" class="register-form" id="login-form" autocomplete="off" > 
     		<h3 class="text-center" style="width:429px; color:#fff;"><?php echo $messege; ?></h3>
		     <div class="row" <?php echo $style; ?>>
		      <div class="row">      
		           <div class="col-md-4 col-sm-4 col-lg-4">
		              <label for="username">NAME</label>
		               <input name="username" class="form-control" type="text" placeholder="USERNAME">    
		           </div>            
		      </div>
		      <div class="row">      
		           <div class="col-md-4 col-sm-4 col-lg-4">
		              <label for="fisrtname">FIRST NAME</label>
		               <input name="fname" class="form-control" type="text" placeholder="FIRST NAME">    
		           </div>            
		      </div>
		      <div class="row">      
		           <div class="col-md-4 col-sm-4 col-lg-4">
		              <label for="lastname">LAST NAME</label>
		               <input name="lname" class="form-control" type="text" placeholder="LAST NAME">    
		           </div>            
		      </div>
		      <div class="row">
		           <div class="col-md-4 col-sm-4 col-lg-4">
		              <label for="email">EMAIL</label>
		               <input name="email" id="email" class="form-control" type="email" placeholder="SOMEBODY@EXAMPLE.COM">             
		           </div>            
		      </div>
		      <div class="row">
		           <div class="col-md-4 col-sm-4 col-lg-4">
		              <label for="password">PASSWORD</label>
		               <input name="password" class="form-control" type="password" placeholder="PASSWORD" id="key">             
		           </div>            
		      </div>
		      <hr>
		      <div class="row">
		           <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
		           <button class="btn btn-default regbutton" type="submit" name="submit" id="btn-login">Register</button>
		           
		          </div>
		          <!--<div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
		           <button class="btn btn-default logbutton">Sign up</button>           
		          </div> -->         
		      </div> 
		  	</div>   
		    </form>
		
	 
    
</div>
</body>
</html>











