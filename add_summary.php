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
		<title>Summaries</title>
		<link rel="stylesheet" type="text/css" href="css/stylesheet.css" />
		<link rel="icon" type="image/png" href=""/>
		<script type="text/javascript" src="script.js"></script> 
	</head>
<body>
	<div id="container">

		<a href="index2.php"><- Back</a>

		<form action="summaries.php" method="POST">
			<p>
				<label for="author_name">By Member: <?php echo "$username";?></label>
				<?php echo "<input type='hidden' value='$username' name='author_name'>";?>
			</p>
			<p>
				<label for="title">Title: </label>
				<input type="text" name="title">
			</p>
			<p>
				<label for="subject_id">Subject: </label>
				<select name="subject_id">

			<?php
				foreach($db->query("SELECT * FROM subjects ORDER BY name") as $row)
				{
					echo "<option value=\"{$row['id']}\">{$row['name']}</option>";	
				}
			?>
				</select>	
			</p>
			<p>
				<label for="content">Summarie: </label>
				<input type="text" name="content">
			</p>
				<input type="submit" value="Add summary">
		</form>
	</div>
</body>
</html> 