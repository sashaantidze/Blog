<?php session_start(); ?>
<?php include "db.php"; ?>


<?php

$user_id = $_SESSION['user_id'];
									//$user_photo = '';
									if(isset($_POST['up_photo'])){
										
										$user_photo = $_FILES['user_photo']['name'];
										$user_photo_temp = $_FILES['user_photo']['tmp_name'];


										move_uploaded_file($user_photo_temp, "../images/$user_photo");

										$query = "UPDATE users SET user_image = '{$user_photo}' WHERE user_id = $user_id";

										$photo_query = mysqli_query($connection, $query);

										if(!$photo_query){
											die("query failed! " . mysqli_error($connection));
										}
										header("Location: ../index.php");
									}


									?>