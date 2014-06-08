<?php
	require 'core/init.php';
	$general->logged_out_protect();

	
	$user = $users->userdata($_SESSION['id']);
	$username = $user['username'];

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset= utf-8" />
		<title>Home</title>
		<link rel="stylesheet" type="text/css" href="css/style.css" />
		<link rel="icon" type="image/png" href=""/>
		<script type="text/javascript" src="script.js"></script> 
	</head>
<body>
	<div id="container">
		<ul>
			<li><a href="index.php">Home</a></li>
			<li><a href="logout.php">Logout</a></li>
			<li><a href="members.php">Members</a></li>
			<li><a href="index2.php">Summaries</a></li>
		</ul>
		<h1>Hello <?php echo $username, '!'; ?></h1>
	</div>
</body>
</html> 