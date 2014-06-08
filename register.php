<?php
	require 'core/init.php';
	$general->logged_in_protect();

	if (isset($_POST['submit']))
	{
		if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email']))
		{
			$errors[] = 'All fields are required';
		}else
		{
			if ($users->user_exists($_POST['username']))
			{
				$errors[] = 'That username already exists';
			}
			if (!ctype_alnum($_POST['username']))
			{
				$errors[] = 'Please enter a username with only alphabets and numbers';
			}
			if (strlen($_POST['password']) < 3)
			{
				$errors[] = 'Your password must be at least 6 characters';
			} else if (strlen($_POST['password']) > 18)
			{
				$errors[] = 'Your password cannot be more than 18 characters long';
			}
			if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false)
			{
				$errors[] = 'Please enter a valid email adress';
			} else if ($users->email_exists($_POST['email']) === true)
			{
				$errors[] = 'That email already exists';
			}
		}

		if (empty($errors) === true)
		{
			$username = htmlentities($_POST['username']);
			$password = $_POST['password'];
			$email = htmlentities($_POST['email']);

			$users->register($username, $password, $email);
			header('Location: register.php?success');
			exit();
		}
	}

	if (isset($_GET['success']) && empty($_GET['success']))
	{
		echo 'Thank you for registering. Your free to log in.';
	}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset= utf-8" />
		<title>Register</title>
		<link rel="stylesheet" type="text/css" href="css/style.css" />
		<link rel="icon" type="image/png" href=""/>
		<script type="text/javascript" src="script.js"></script> 
	</head>
<body>
	<div id="container">
		<ul>
			<li><a href="index.php"><- Back</a></li>
			<li><a href="index.php">Home</a></li>
			<li><a href="register.php">Register</a></li>
			<li><a href="login.php">Login</a></li>
		</ul>
		<h1>Register</h1>

		<form method="post" actione="">
			<h4>Username:</h4>
			<input type="text" name="username" />
			<h4>Password:</h4>
			<input type="password" name="password" />
			<h4>Email:</h4>
			<input type="text" name="email" />
			<br>
			<input type="submit" name="submit" />
		</form>

		<?php
			if (empty($errors) === false)
			{
				echo '<p>' . implode('</p><p>', $errors) . '</p>';
			}
		?>
		
	</div>
</body>
</html> 