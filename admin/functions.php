<?php

function confirm_query($query_result){
	
	global $connection;
	
	if(!$query_result){
		die("Query FAILED! " . mysqli_error($connection));
	}
	
}



function insert_categories(){
	global $connection;
	
	if(isset($_POST['submit'])){
		$cat_title = $_POST['cat_title'];
		
		if($cat_title == "" || empty($cat_title)){
			echo '
			<div class="panel panel-danger">
			<div class="panel-heading"><h4>Please Enter Category</h4></div>
			</div>
			';
		}
		else{
			$query = "INSERT INTO categories (cat_title) ";
			$query .= "VALUE('{$cat_title}')";
			
			$create_category = mysqli_query($connection, $query);
			
			if(!$create_category){
				die("QEURY FAILED" . mysqli_error($connection));
			}
			else{
				echo '
				<div class="panel panel-success">
				<div class="panel-heading"><h4>Category &apos;'.$cat_title.'&apos; Has Been Added</h4></div>
				</div>
				';
			}
		}
	}
	
}



function find_all_categories(){
	global $connection;
	
	//Getting all categories query
	$query = "SELECT * FROM categories";
	$select_categories = mysqli_query($connection, $query);

	while($row = mysqli_fetch_assoc($select_categories)){
		$cat_id = $row['cat_id'];
		$cat_title = $row['cat_title'];
												
		echo '<tr>';
		echo "<td>{$cat_id}</td>";
		echo "<td>{$cat_title}</td>";
		echo "<td><a class='btn btn-xs btn-danger' href='categories.php?delete={$cat_id}'>Delete</td>";
		echo "<td><a class='btn btn-xs btn-info' href='categories.php?edit={$cat_id}'>Edit</td>";
		echo '</tr>';
	}
}



function delete_categories(){
	global $connection;
	
	if(isset($_GET['delete'])){
		$the_cat_id = $_GET['delete'];
		$query = "DELETE FROM categories WHERE cat_id = {$the_cat_id}";
		
		$delete_query = mysqli_query($connection, $query);
		header("Location: categories.php");
	}
}


function users_online(){
	global $connection;
	
	
	$session = session_id();
	$time = time();
	$time_out_in_seconds = 600;
	$time_out = $time - $time_out_in_seconds;

	$username = $_SESSION['username'];

	$query = "SELECT * FROM users_online WHERE session = '$session'";
	$send_query = mysqli_query($connection, $query);
	$count = mysqli_num_rows($send_query);

	if($count == NULL){
		mysqli_query($connection, "INSERT INTO users_online(session, session_name, time) VALUES('$session', '$username', '$time')");
	}
	else{
		mysqli_query($connection, "UPDATE users_online SET time = '$time' WHERE session = $session");
	}


	$users_online = mysqli_query($connection, "SELECT * FROM users_online WHERE time > $time_out");

	return $count_users = mysqli_num_rows($users_online);
}

?>