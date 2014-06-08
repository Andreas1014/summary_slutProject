<?php
	require 'core/init.php';
	$general->logged_in_protect();
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset= utf-8" />
		<title>Login and registration</title>
		<link rel="stylesheet" type="text/css" href="css/style.css" />
		<link rel="icon" type="image/png" href=""/>
		<script type="text/javascript" src="script.js"></script> 
	</head>
<body id="green">
	<div id="container">
		<ul>
			<li><a href="index.php">Home</a></li>
			<li><a href="register.php">Register</a></li>
			<li><a href="login.php">Login</a></li>
			<!--<li><a href="index2.php">Summaries</a></li>-->
		</ul>
		<h1>Welcome to School Summaries!</h1>
	</div>
</body>
</html> 