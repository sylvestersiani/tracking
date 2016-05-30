<?php session_start();
include_once('inc/func/functions.php');

// checking if the user is already logged in via session, if they are they are redirected to the dashboard section
if (isset($_SESSION['user'])){header('location: dashboard.php');}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	// checking if the users input isnt empty
	if (!empty($_POST['password']) && !empty($_POST['username'])) {
	
		// assigning the users input to a var (needs to be sanitised)
		$password = clean($_POST['password']);
		$username = clean($_POST['username']);
	
		// requiring DB for query
		require_once('inc/db_con.php');
		// user query passed to the database
		$user_query = "SELECT * FROM admin_group";
		$user_result = mysqli_query($db_con, $user_query);
		// result returned through while loop
		while($user = mysqli_fetch_assoc($user_result)){
			// checking if the username is in the database
			if ($username == $user['username']) {
				// checking if the username match the password in the database
				if ($password == $user['pass']) {
					// setting session saved as the users name then redirected to the dashboard
					$_SESSION['user'] = $username;
					header('location: dashboard.php');	
				}
			}$warning = 'Login failed!';		
		}// end of while loop
		
	}else { 
		// this needs to be assigned to a var but it lets the user know that their is an error with their log in details.
		$warning = 'Login failed!';	
	}		
}// end of post request script


?>
<html>
<head>
	<title>Login</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="inc/css/main.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
</head>
<body>
	<div class="outer-container">
		<!-- page navigation-->
		<nav>
			<ul id="nav-menu">
				<li><a href="http://www.sianiprint.co.uk"><img src="http://sianiprint.co.uk/img/logo/sianiPrint-logoSmall.jpg" alt="Siani Print logo" height="25px"></a></li>
				<li><a href="http://www.tracking.sianiprint.co.uk">Track Order</a></li>
				<li><a href="#">.....</a></li>
			</ul>
		</nav><!--/end of nav-->
		<div class="view">
			<div class="container">
				<form id="login-form" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
					<span id="warning"><?php isset($warning)? print $warning : null;?></span>
					<div>
						<input type="text" name="username" value="<?php isset($username)? print $username:'';?>" placeholder="username"/>
					</div>
					<div>
						<input type="password" name="password" value="<?php isset($password)? print $password: ''?>" placeholder="password" />
					</div>
					<div>
						<button type="submit">Login</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>