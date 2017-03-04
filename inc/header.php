<?php  	require_once('inc/model/verify_login.php'); // checking if user is already logged in
		require_once('inc/func/functions.php');	// including all necessary functions
?>
<!doctype html>
<html lang="en">
<head>
	<title>
		<?php isset($page_title)? print $page_title: '' ; ?>
	</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="inc/css/main.css" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
</head>
<body>
	<div class="outer-container">
	<!-- page navigation-->
		<?php include('nav.php');?>
	<!--/end of nav-->
	