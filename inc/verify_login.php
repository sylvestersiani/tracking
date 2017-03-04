<?php session_start();
// checking if the user is already signed in.
if (isset($_SESSION['user'])) {
	// assigning the session to a variable
	$session_id = $_SESSION['user'];
	// DB connection and query to check if the session user is int he database. Not sure if this is unecessary but it makes total sense to have it their just for precaution also would be handy if the user no longer exists in our DB
	require_once('../model/db_con.php');
	$user_query = "SELECT * FROM admin_group";
	$user_result = mysqli_query($db_con, $user_query);
	
	// looping through the returned data to find if the session user match a user in our DB
	while ($user = mysqli_fetch_assoc($user_result)) {
		if ($user['username'] == $session_id) {
			// for now nothing happens but it would be cool to add detailed such as how many times the user loged in or anything useful
		}
	}// end of while loop	
}else {
	/// this is if there isn't an alreadys set session the user is sent back to the login page
	header('location: login.php');
	exit;
}
