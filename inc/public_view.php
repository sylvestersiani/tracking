<?php 

require_once('db_con.php');
require('func/functions.php');
  
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	// users input from form submit
	$tracking_code = strtoupper(clean($_POST['tracking_code'])) ;

	// seeing if there is anything such as in our database like the tracking code
	$view_query = "SELECT * FROM track WHERE tracking LIKE '". $tracking_code ."' ";

	// passing the query to our mysqli connection
	$tracking_result = mysqli_query($db_con,$view_query);
	
	// checking if theres any value inside the result variable
	if(mysqli_num_rows($tracking_result) > 0){
		// if unsuccessfull this is the responce.
		// returning relevant detail from databse if successfull
			while($tracking_detail = mysqli_fetch_assoc($tracking_result)){	
				
				$order_client_name = ucwords($tracking_detail['client_name']);
				$order_number = ucwords($tracking_detail['project_name']); 
				$order_status = $tracking_detail['status'];
				$order_turnaround = $tracking_detail['turnaround_time'];
				$order_set_date = $tracking_detail['set_time'];
				$order_tracking_number = $tracking_detail['tracking'];
			}
		
			// need to turn this into a function and simply pa
			mysqli_free_result($tracking_result);
			
	}else {
		$tracking_error = 'Nothing to track';
	}
	
		
	// this will be included in the footer
	mysqli_close($db_con);
	
}
	