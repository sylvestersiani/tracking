<?php
// checks if user is logged in
function active_user() {
	if(isset($_SESSION['user'])){
		return ucwords($_SESSION['user']);
	}
}


// this function takes in an already set variable if user has selected an option from the dropdown list
// and the value of the option, if they do match in case there is an error with the from completion
// the value remains so the user would not have to select it again, this allow for great user experience.
// example of how the could should be ran -- isset($var)? print selected_option($var, 'option_value'): '' ;
function selected_option($set_var, $input_name){
	if (isset($set_var) && $set_var == $input_name) {
		return 'selected="selected"';
	}
}


// cleaningf users input
function clean($data){
	$data = trim($data);
	$data = htmlspecialchars($data);
	$data = stripslashes($data);
	$data = strip_tags($data);
	$data = strtolower($data);		
	return $data;
}	




// takes the company code and appends a random number between 1000000 to 9999999 that will enable the client to track the progress of their project
function tracking_code_generator() {
	$company_code = 'SP';
	$tracking_code = $company_code.'-'.rand(100000, 999999);
	return $tracking_code;
}	
	
// generaring project code this takes in our automated tracking number and appends the first 3 letters of or client name this is then added to our database under the row of project name
function project_code_generator($name, $company_code = 'SIA') {
	if (isset($name)) {
		$client_name_code = preg_replace('/\s+/', '',$name);
		$client_name_code = substr($client_name_code, 0, 3);
		$project_code = $company_code.rand(100, 999).'-'. date('y-m') .'-' . strtoupper($client_name_code);
		return $project_code;
	}			
}





function client_email($data) {
	if (!empty($data)){
		if (filter_var($data, FILTER_VALIDATE_EMAIL)) {
			$client_email = clean($data);
			return $client_email;
		}else {
			$email_error = 'Enter a valid email address';
			return $email_error;
		}
	}else{
		$email_error = "Email required.";
		return $email_error;
	}	
}

function client_name($data){
	if (!empty($data)) {
		if (preg_match('/[^0-9]+$/', $data)) {
			$client_name = clean($data);
			return $client_name;
		}else {
			$name_error = "No numbers in the clients name!";
			return $name_error;
		}
	}else {
		$name_error = "Clients name required!";
		return $name_error;
	}
}

function project_type($data) {
	if (!empty($data)){
		$project_type = clean($data);
		return $project_type;
	}else{
		$project_type_error = "Select project Type";
		return $project_type_error;
	}	
}

function project_timeline($data) {
	if (!empty($data)){
		$project_timeline = clean($data);
		return $project_timeline;
	}else{
		$timeline_error = "Select a timeline";
		return $timeline_error;
	}	
}
function status($data){
	if (!empty($data)) {
		$project_status = clean($data);
		return $project_status;
	}
}

function description($data){
	if (!empty($data)) {
		$description = clean($data);
		return $description;
	}
}


// if the project was added we send an automated email to the client/ 
// the script bellow will need to be refractored maybe using class and mail.php
// or clean it up in a nice function, for now it remains like this.	

function email($to,$order_number,$tracking_number){

	$header = 'from: info@sianiprint.co.uk' . "\n";
	$subject = 'Your order '. $order_number . ' is in production';		
			
	// body
	$message = "This is an automatic notification to inform you that your order has been despatched.\n\n";

	$message .= 'Your Order Number : '.$order_number."\n";
	$message .= 'Your tracking Number : '. $tracking_number . "\n\n";
	$message .= 'You can track your order by visiting wwww.tracking.sianiprint.co.uk' . "\n\n";
	$message .= 'Siani Print London'. "\n\n";
	$message = wordwrap($message, 70);
	
	return mail($to, $subject, $message, $header);
}	
