<?php
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		require_once('../model/db_con.php');
		// hidden id tring assigned to a var (might need to sanitize this)
		$id = $_POST['id_update'];	
		// assigning new status update to a string, will also need to sanitize this - maybe
		$status_update = $_POST['status_update'];
		
		// passing a query to the db telling is wht and where to update
		$update_query = "UPDATE track SET ";
		$update_query .= "status = '$status_update' ";
		$update_query .= "WHERE ID = '{$id}'"; 
		$update_data = mysqli_query($db_con,$update_query);
		
		// if sucessefull the user is sent back to dashboard
		if($update_data && mysqli_affected_rows($db_con) > 0){
			//echo 'success';
			 header('location: ../dashboard.php');
		}else {
			// if unsuccessfull we'll need to pass a cookie back to the 
			header('location: ../edit.php?id='.$id.'');	
		}
		mysqli_close($db_con);
	}
	
	
	