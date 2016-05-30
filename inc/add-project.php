<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	// all required files
	require_once'func/functions.php';
	require_once'db_con.php';
	// next couple of lines takes into account the data input, passes it through an array of tests then sanitized.
		
	
	
	$name = client_name($_POST['client_name']);
	$email = client_email($_POST['client_email']);
	$type = project_type($_POST['project_type']);
	$timeline = project_timeline($_POST['project_timeline']);
	$status = status($_POST['project_status']);
	$description = description($_POST['description']);
	
		
	
	/**
	**checks if all listed bellow aren't empty
	**
	**-Clients name
	**-project status
	**-clients email
	**-project-timeline
	**-description
	***----------------
	**if they arent empty the script is ran,
	**generating a tracking code and order no.. 
	*/
	if (!empty($name)  && !empty($status) && 
		!empty($email) && !empty($timeline) && 
		!empty($description)) {
		// generating a tracking code, this is what will be used by the user to track the progress of their work. Tracking number begins with SP meaning Siani Print followed by 6 random int.
		// example SP999999
		$tracking_code = tracking_code_generator();
		// generating project code, this is so we can keep track of every orders made .
		$project_code = project_code_generator($name);
		//generating a date which will stored in the set time, this is the date the order has been made. giving us a string timeline to follow	
		$date = date('y-m-d');
		
		// passing a query inserting all gathered data into the DB.
		$new_project = "INSERT INTO track ";
		$new_project .= "(client_name, status, tracking, project_name, client_email, project_type, turnaround_time, set_time, description ) ";
		$new_project .= "VALUES ('$name', '$status' , '" .$tracking_code."', '".$project_code."','$email','$type','$timeline' , '$date', '$description' )";
		
		
		$new_project_added = mysqli_query($db_con,$new_project);
		
		// if sucessefull an email is sent using the email function alocated in the functions page, all relevant data is passed through the function.
		// i will need to add some html 5 elements to this soon.
		if($new_project_added){

			if(email($client_email, $project_code, $tracking_code)){
				// if the email is successfully sent the user is redirected to the dashboard
				header('location: dashboard.php');
			}else {
	
				// if the email failed to sent this is returned
				$warning = 'email to customer failed to send';
			}
			
		}else {
			// if for any reason the code breaks when processing the new data to the DB this is the response. 
			$warning = 'OOPS THERE WAS AN ERROR SOMEWHERE - NOTHING ADDED TO THE DATABASE';
		}
		
		// closing up mysqli connection.
		// The variable doesn't have to be passed through the function but it's good practice
		mysqli_close($db_con);
			
	}
		
}

