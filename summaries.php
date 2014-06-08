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
<?php
		if(!empty($_POST)) 
		{
		if(isset($_POST['author_name']) && isset($_POST['title']) && isset($_POST['content']) && isset($_POST['subject_id']))
		{
			if($_POST['author_name'] !== "" && $_POST['title'] !== "" && $_POST['content'] !== "" && $_POST['subject_id'] !== "")
			{
				$author_name = filter_input(INPUT_POST, 'author_name', FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_STRIP_LOW);
				$title       = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_STRIP_LOW);
				$content     = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_STRIP_LOW);
				$subject_id  = filter_input(INPUT_POST, 'subject_id', FILTER_VALIDATE_INT);
				$statement = $db->prepare("INSERT INTO summaries (subject_id, author_name, date, title, content) VALUES (:subject_id, :author_name, NOW(), :title, :content)");
				$statement->bindParam(":subject_id", $subject_id);
				$statement->bindParam(":author_name", $author_name);
				$statement->bindParam(":title", $title);
				$statement->bindParam(":content", $content);
				if($statement->execute())
					print_r($statement->errorInfo());
			}
		}
		
		else if(isset($_POST['summary_id']) && isset($_POST['author_name']) && isset($_POST['content']))
		{
			if($_POST['summary_id'] !== "" && $_POST['author_name'] !== "" && $_POST['content'] !== "")
			{
				$summary_id  = filter_input(INPUT_POST, 'summary_id', FILTER_VALIDATE_INT);
				$author_name = filter_input(INPUT_POST, 'author_name', FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_STRIP_LOW);
				$content     = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_STRIP_LOW);
				$statement = $db->prepare("INSERT INTO comments (summary_id, author_name, date, content) VALUES (:summary_id, :author_name, NOW(), :content)");
				$statement->bindParam(":summary_id", $summary_id);
				$statement->bindParam(":author_name", $author_name);
				$statement->bindParam(":content", $content);
				if($statement->execute())
					print_r($statement->errorInfo());
			}
		}
	}

	if(!empty($_GET) && isset($_GET['summary_id']))
	{
		if($_GET['summary_id'] !== "")
		{
			$summary_id = filter_input(INPUT_GET, "summary_id", FILTER_VALIDATE_INT);
			
			$sum_statement = $db->prepare("SELECT summaries.*, subjects.name AS 'subject_name' FROM summaries JOIN subjects ON summaries.subject_id=subjects.id WHERE summaries.id=:summary_id");
			$sum_statement->bindParam(":summary_id", $summary_id);
			if($sum_statement->execute())
			{
				if($row = $sum_statement->fetch())
				{
					echo "<h1>{$row['title']}</h1>
							<p style=\"color: #9ccef4\">{$row['date']}</p>
							<p style=\"color: #9ccef4\">by {$row['author_name']}</p>
							<p style=\"color: #9ccef4\">Subject: {$row['subject_name']}</p>
							<p>{$row['content']}</p>
							<p><a href=\"summaries.php\"><- Back</a></p>";
					
					echo "<form action=\"summaries.php?summary_id={$row['id']}\" method=\"POST\">";
					echo "<input type=\"hidden\" name=\"summary_id\" value=\"{$row['id']}\" />";
					?>
							<p>
								<label for="author_name">Your name: </label>
								<input type="text" name="author_name" />
							</p>
							<p>
								<label for="content">Comment: </label>
								<input type="text" name="content" />
							</p>
							<input type="submit" />
						</form>

					<?php

					$com_statement = $db->prepare("SELECT * FROM comments WHERE summary_id=:summary_id ORDER BY date ASC");
					$com_statement->bindParam(":summary_id", $summary_id);
					if($com_statement->execute())
					{
						while($comment = $com_statement->fetch())
						{
							echo "<p style=\"color: #9ccef4\">{$comment['author_name']} ({$comment['date']}): {$comment['content']}</p>";
						}	
					}
					else
						print_r($com_statement->errorInfo());
				}			
			}	
			else
				print_r($sum_statement->errorInfo());
		}
	}
	else
	{
		echo "<ul>";
		foreach ($db->query("SELECT * FROM summaries ORDER BY date DESC") as $row)
		{
			echo "<li><a href=\"?summary_id={$row['id']}\">{$row['title']} made by {$row['author_name']} ({$row['date']})</a></li>";
		}	
		echo "</ul>";
	}
?>

		<a href="index2.php"><- Back</a>
	</div>
</body>
</html> 