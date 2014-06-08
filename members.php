<?php
	require 'core/init.php';

	$members = $users->get_users();
	$member_count = count($members);
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset= utf-8" />
		<title>Members</title>
		<link rel="stylesheet" type="text/css" href="css/style.css" />
		<link rel="icon" type="image/png" href=""/>
		<script type="text/javascript" src="script.js"></script> 
	</head>
<body>
	<div id="container">

		<ul>
			<li><a href="home.php"><- Back</a></li>
		</ul>

		<h1>Our members</h1>
		<p style="color: #9ccef4">We have a total of <strong><?php echo $member_count; ?></strong> registered users.</p>
		
		<?php

			foreach ($members as $member) {
				echo '<p>', $member['username'], ' ', 'joined', ' ', date('F j, Y', $member['time']), '</p>';
			}
		?>
	</div>
</body>
</html> 