<?php
	require 'core/init.php';
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
		<ul>
			<a href="index.php"><- Back</a>
			<li><a href="add_subject.php" style="color: #edf49c; font-size: 1.35em;">Add subject</a></li>
			<li><a href="add_summary.php" style="color: #edf49c; font-size: 1.35em;">Add summary</a></li>

<?php
	if(!empty($_POST))
	{
		if($_POST['subject_name'] !== "")	
		{
			$_POST = null;
			$subject_name = filter_input(INPUT_POST, 'subject_name');
			$statement = $db->prepare("INSERT INTO subjects (name) VALUES (:subject_name)");
			$statement->bindParam(":subject_name", $subject_name);
			if($statement->execute())
				print_r($statement->errorInfo());
		}
	}

	foreach($db->query("SELECT * FROM subjects ORDER BY name") as $row)
	{	
		echo "<li><a href=\"summaries.php?subject_id={$row['id']}\">{$row['name']}</a></li>";	
	}
?>
		</ul>
	</div>
</body>
</html> 

