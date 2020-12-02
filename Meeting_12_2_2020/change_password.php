<?php
session_start();

	$servername = "weblab.salemstate.edu";
	$dbusername = "mytime";
	$password = "mytime20";
	$dbname = "mytime";

	$conn = mysqli_connect($servername, $dbusername, $password, $dbname);

	//Force user to leave if a user is not logged in.
	if($_SESSION["loggedin"] === true)
		echo("");
	else 
	{
		header("location: home.php");
    	exit;
	}
	
	//Check if the user has inserted everything.
	if(isset($_POST['submit']) && !empty($_POST['old_password'])
               && !empty($_POST['new_password']) && !empty($_POST['confirm_password']) && !empty($_POST['username']))
	{
		//First, authenticate the user through the session_id from the DB.
		if(isset($_SESSION['admin']))
			$s_username = "admin";
		else
			$s_username = $_SESSION['user_name'];
		
		$sql = "SELECT * FROM ACCOUNT WHERE User_ID = '{$s_username}'";
		echo($_SESSION['user_name']);
		$result = mysqli_query($conn, $sql) or die("err0r: ".mysqli_error($conn));
		$rows = mysqli_fetch_array($result);
		$db_session_id = $rows['session_id'];

		if($db_session_id === $_SESSION['session_id'])
		{
			//Log the user in for double-authentication.
			$username = mysqli_real_escape_string($conn, $_POST['username']);
			$old_password = mysqli_real_escape_string($conn, $_POST['old_password']);
			$new_password = mysqli_real_escape_string($conn, $_POST['new_password']);
			$confirm_new_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);
			$old_password_enc= $rows['PASSWORD'];
			
			if(password_verify($old_password, $old_password_enc) && $s_username === $_POST['username'] )
			{
				//Check if the new passwords match.
				if($new_password === $confirm_new_password)
				{
					//Add the new password to the database.
					$new_password_hash = password_hash($new_password, PASSWORD_BCRYPT);
					$sql = "UPDATE ACCOUNT SET PASSWORD = '{$new_password_hash}' WHERE User_ID = ('{$username}')";
					mysqli_query($conn, $sql);
					
					//Delete all the variables in the session.
					session_unset();
	
					//Destroy the session. 
					session_destroy();
					
					//Force the user to log in with their new password
					header("location: successful_change.php");
				}
				else 
					echo("<script>alert('New passwords do not match.');</script>");
			}
			else
				header("location: error_authen.html");
		}
		else{
				echo($_SESSION['session_id']);
				echo($db_session_id);
			}
	}
	else 
		echo("<script>alert('Please fill in ALL the fields.');</script>");
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Change Password</title>
</head>
<style>
	body {
		margin: 0;
		background: #5e91f8; 
	}
	
	/* CSS code for the menu bar. */
	.menu {
		width: 100%;
		background: black;
		overflow: auto;
			
	}
	
	.menu ul {
		margin: 0;
		paddding: 0;
		list-style: none;
		line-height: 60px;
	}
	
	.menu li {
		float: left;
	}
	
	.menu ul li a{
		background: 142b47;
		text-decoration: none;
		width: 170px;
		display: block;
		text-align: center;
		color: #F2F2F2;
		font-size: 18px;
		font-family: sans-serif;
		letter-spacing: 0.5px;
	}
	
	.menu li a:hover {
		color:#fff;
		opacity:0.5;
		font-size:19px;
	}
	
	/*Attributes for the labels in the form*/
	#formwrapper{
		padding-top: 5%;
		width: 300px;
		height: auto;
		background-color: 5e91f8;
		border: none;
		margin: 0 auto;
		width:25%;
	}	
		
	/* Attributes for the form itself*/
	form{ 
		width: 300px;
		height: auto;
		background-color: transparent;
		border: none;
	}
		
	/* Attributes for the form itself*/
	fieldset {
		background-color: white;
		border: none;
		padding-bottom: 10px;
		text-align: center;
		border-radius: 12px;
	}
		
	/* Attributes for the header in the form.*/
	h1{
		font-family: Segoe, 'Segoe UI', 'DejaVu Sans', 'Trebuchet MS', Verdana, 'sans-serif';
		font-size: 16px;
		color: black;
	}
		
	/* Attributes for the header on the top of the page.*/
	h2{
		color: blue;
    	text-align: center;
    	font-family: 'Crimson Text', serif;
	}
		
	label {
		width:250px;
		display: block;
		font-family: "Trebuchet MS", Helvetica, sans-serif;
		font-size:15px;
		margin-left: auto;
		margin-right: auto;
		text-align: center;
		padding-top: 25px;
		color: black;
	}
		
	input{
		width: auto;
		font-size: 18px;
		border: thin solid #6CF;
		border-color: gray;
		margin-bottom: 10px;
		margin-left:auto;
		margin-right: auto;
		width: 300px;
		border-radius: 4px;
		height: 27px;
	}
		
	textarea {
		width: 250px;
		border: thin solid;
		border-color: gray;
		margin-bottom: 10px;
		display: block;
		margin-left:auto;
		margin-right: auto;
	}
		
	/* Attributes for the submit button. */
	.btn {
		width: 300px;
		height: 35px;
		font-family: "Trebuchet MS", Helvetica, sans-serif;
		color: white;
		font-size: 18px;
		font-weight: bold;
		background-color: dodgerblue;
		margin-left: auto;
		margin-right: auto;
		display: block;
		padding-top: 10px;
		cursor: pointer;
		border-color: #5e91f8;
	}
	/* Dimensions for the shape of the button.*/
	.buttonshape {
		border-radius: 12px;
	}
	
	.loginLabel {
		width:250px;
		display: block;
		font-family: "Trebuchet MS", Helvetica, sans-serif;
		font-size: 14px;
		font-color: green;/*
		margin-top: 5px;
		margin-right: 5px;
		margin-bottom: 5px;
		margin-left: 0px;*/
		margin-left: auto;
		margin-right: auto;
		text-align: center;
		padding-top: 10px;
	}
	
	/*CSS for the log in form ends. */
	
	footer ul {
		text-align: center;
		color: white;
		font-family: "Trebuchet MS", Helvetica, sans-serif;
	}
	footer li {
		list-style-type: none;
	}
</style>
<body>
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Sansita+Swashed:wght@900&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	
	<nav class ="menu">
		<a style="font-family: 'Sansita Swashed', cursive; display: flex;
			justify-content: center;; color: aliceblue; font-size: 30px;">My Wait Time</a>
		<ul>
			<?php
			if(!empty($_SESSION['is_admin']))
			{
				echo "<li><a href=\"http://weblab.salemstate.edu/~mytime/Waiting_Time/account.php\">Admin</a></li>";
				echo('<li><a href ="http://weblab.salemstate.edu/~mytime/Waiting_Time/logout.php">Log out</a></li>');
				
				echo('<li><a href ="http://weblab.salemstate.edu/~mytime/Waiting_Time/add_location.php">Add A Location</a></li>');
				echo "<li><a href=\"http://weblab.salemstate.edu/~mytime/Waiting_Time/find_location.php\">Find A Location</a></li>";
				
			}
			else if (!empty($_SESSION['user_name'])) 
			{ 
				$name = $_SESSION['user_name'];
				echo "<li><a href=\"http://weblab.salemstate.edu/~mytime/Waiting_Time/account.php\">$name</a></li>";
				echo('<li><a href ="http://weblab.salemstate.edu/~mytime/Waiting_Time/logout.php">Log out</a></li>');
				echo "<li><a href=\"http://weblab.salemstate.edu/~mytime/Waiting_Time/find_location.php\">Find A Location</a></li>";
			}
			
			?>
		</ul> 
	</nav>
	
	<div id="formwrapper">
		<form action="" method="post"> 
			<fieldset>
			<h1>Let's get that fixed for you.</h1>
			<label for="username">Username*</label>
			<input name="username" type="text" size="20" maxlength="20" required>
			<label for="old_password"> Current Password*</label>
			<input name="old_password" type="password" size="20" maxlength="32" id="password" autocomplete="none" required>
			<label for="new_password"> New Password*</label>
			<input name="new_password" type="password" size="20" maxlength="32" id="password" autocomplete="none" required>
			<label for="confirm_password"> Confirm Password*</label>
			<input name="confirm_password" type="password" size="20" maxlength="32" id="password" autocomplete="none" required>
			<label for="submit"></label>
			<input class="btn buttonshape" name="submit" type="submit">
			<label class="loginLabel">Don't have an account? Create one here! </label>
			<label class="loginLabel">Forgot Password</label>
		  </fieldset>
		</form>
	</div>
<footer>
	<hr>
	<ul>
		<li>My Wait Time - 352 Lafayette St, Salem, MA</li>
		<li><a style="text-decoration: none;"href="http://weblab.salemstate.edu/~mytime/Waiting_Time/contact_us.php">Contact Us</a></li>
		<li><a style="text-decoration: none;"href="http://weblab.salemstate.edu/~mytime/Waiting_Time/suggest_location.php">Request A Location</a></li>
	</ul>
</footer>
</body>
</html>