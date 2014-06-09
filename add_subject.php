<?php
	require 'core/init.php';
	$general->logged_out_protect();
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset= utf-8" />
		<title>Summaries</title>
		<link rel="stylesheet" type="text/css" href="css/stylesheet.css" />
		<link rel="icon" type="image/png" href=""/>
		<script type="text/javascript" src="script.js"></script> 
	</head>
<body>
	<div id="container">

		<a href="index2.php"><- Back</a>

		<form action="index2.php" method="POST">
			<p>
				<label for="subject_name">Subject name: </label>
				<input type="text" name="subject_name" />
			</p>
			<input type="submit" value="Add Subject"/>
		</form>
	</div>
</body>
</html> 
