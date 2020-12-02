
<?php

	session_start();
	//Double check if the user is already checked, logged in if so, bring the home. 
	if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)
	{
    	header("location: home.php");
    	exit;
	}	

	if($_GET['tkn'] === "success")
	{
		echo "<script>alert('Account creation was successful!');</script>"; 
	}

	$servername = "weblab.salemstate.edu";
	$dbusername = "mytime";
	$password = "mytime20";
	$dbname = "mytime";
	
	//Global variable to make the session_id
	$session_id = "";

	$conn = new mysqli($servername, $dbusername, $password, $dbname);
	// Check connection
	if ($conn->connect_error) 
	{
		echo("database broken or not working");
  		die("Connection failed: " . $conn->connect_error);
	} 
	
	
	if(isset($_POST['submit']) && !empty($_POST['username']) 
               && !empty($_POST['password']))
	{
		$username = mysqli_real_escape_string($conn,$_POST['username']);
      	$password = mysqli_real_escape_string($conn,$_POST['password']);
		$sql = "SELECT * FROM ACCOUNT WHERE User_ID = '$username'";
	  	$result = mysqli_query($conn,$sql);
		
		//The number of rows should be 1 if the username exists.
      	$counter = mysqli_num_rows($result);
		$row = mysqli_fetch_array($result);
		$check_for_admin = $row['admin'];
		if($counter == 1)
		{
			//Logs the admin in.
			if($username == "admin" || $check_for_admin ==1)
			{
				$hash = $row["PASSWORD"];
				
				if(password_verify($password, $hash))
				{ 
					$_SESSION['user_name'] = $username;
					$_SESSION['loggedin'] = true;
					$_SESSION['is_admin'] = true;
					
					//Random number to make the session_id
					$rand_num = rand(10000,1000000);
					
					//Hash the rand_num and store it as a session variable and add it to the DB.
					$session_id = hash(md5,$rand_num);
					$_SESSION['session_id'] = $session_id;
					$sql = "UPDATE ACCOUNT SET session_id = '{$session_id}' WHERE User_ID = ('{$username}')";
					mysqli_query($conn, $sql);
					
					header("location: home.php");
				} 
				else
					echo "<script>alert('The username or password is incorrect...');</script>"; 
			}
			
			//Otherwise login a regular user.
			else
			{
				$hash = "${row['PASSWORD']}";
				if(password_verify($password, $hash))
				{ 
					//Random number to make the session_id
					$rand_num = rand(10000,1000000);
				
					//Hash the rand_num and store it as a session variable and add it to the DB.
					$session_id = hash(md5,$rand_num);
					$_SESSION['session_id'] = $session_id;
					$sql = "UPDATE ACCOUNT SET session_id = '{$session_id}' WHERE User_ID = ('{$username}')";
					mysqli_query($conn, $sql);
					
					$_SESSION['user_name'] = $username;
					$_SESSION['loggedin'] = true;
					header("location: home.php");
				} 
				else
					echo "<script>alert('The username or password is incorrect..');</script>"; 
			}	
		}
		else 
         	echo "<script>alert('The username of password is incorrect.?');</script>"; 
	}
	?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Log In</title>
</head>
<style>
	
	body {
		margin: 0;
	}
	/* CSS code for the menu bar. */
	.menu {
		width: 100%;
		background:black;
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
	
	.search-bar {
		margin-top: 15px;
		float: right;
		margin-right: 100px;
		
	}
	
	.search-bar input[type=text] {
		padding: 7px;
		border: none;
		font-size: 16px;
		font-family: sans-serif;
		height: 15px;
		padding-top: 10px;
		border-radius: 4px;
		width: 300px;
	}
	
	button {
		float: right;
		background: orange;
		color:white;
		border-radius 0 5px 5px 0;
		cursor: pointer;
		position: relative;
		padding: 7px;
		font-family: sans-serif;
		border:none;
		font-size: 16px;
		padding-top: 15px;
	}
	
	searchlabel {
		float: left;
		font-family: sans-serif;
		color: white;
		padding-top: 10px;
	}
	/* CSS code for the navigation bar ends here. */
	
	/*CSS code for the log in form begins here. */
	/* Attributes for the form itself*/
	#formwrapper{
		padding-top: 100px;
		width: 300px;
		height: auto;
		background-color: 5e91f8;
		border: none;
		margin: 0 auto;
		width:25%;
		padding-top: 10%;
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
		
	/*Attributes for the labels in the form*/
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
		color: #FFF;
		font-weight: bold;
		background-color: dodgerblue;
			/* #6CF*/
			/*background-color: transparent;*/
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
	
	/* CSS for the links at the bottom of the page. */
		#bottom {
			align-content: center;
			
		}
		.bottom {
			float: center;
			text-align: center;
			color: whitesmoke;
		}

footer ul {
		text-align: center;
		color: white;
		font-family: "Trebuchet MS", Helvetica, sans-serif;
	}
	footer li {
		list-style-type: none;
	}
	
</style>
<body
	style="background-color: #5e91f8">
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Sansita+Swashed:wght@900&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	
	
	<nav class ="menu">
		<a style="font-family: 'Sansita Swashed', cursive; display: flex;
			justify-content: center;; color: aliceblue; font-size: 30px;">My Wait Time</a>
		<ul>
			<?php
			if (!empty($_SESSION['user_name'])) 
			{ 
				$name = $_SESSION['user_name'];
				echo "<li><a href=\"http://weblab.salemstate.edu/~mytime/Waiting_Time/account.php\">$name</a></li>";
				echo('<li><a href ="http://weblab.salemstate.edu/~mytime/Waiting_Time/logout.php">Log out</a></li>');
				echo('<li><a href ="http://weblab.salemstate.edu/~mytime/Waiting_Time/home.php">Home</a></li>');
			}
			else if(!empty($_SESSION['is_admin']))
			{
				echo "<li><a href=\"http://weblab.salemstate.edu/~mytime/Waiting_Time/account.php\">Admin</a></li>";
				echo('<li><a href ="http://weblab.salemstate.edu/~mytime/Waiting_Time/logout.php">Log out</a></li>');
				
				echo('<li><a href ="http://weblab.salemstate.edu/~mytime/Waiting_Time/add_location.php">Add location</a></li>');
				echo('<li><a href ="http://weblab.salemstate.edu/~mytime/Waiting_Time/home.php">Home</a></li>');
				
			}
			else {
				echo('<li><a href ="http://weblab.salemstate.edu/~mytime/Waiting_Time/Create_Account.php"> Create An Account</a></li>'); 
				echo "<li><a href=\"http://weblab.salemstate.edu/~mytime/Waiting_Time/find_location.php\">Find A Location</a></li>";
				echo('<li><a href ="http://weblab.salemstate.edu/~mytime/Waiting_Time/home.php">Home</a></li>');
				
			}
			?>
			
		</ul> 
		
	</nav>
	
	<div id="formwrapper">
	<form action="" method="post"> 
		<fieldset>
		<h1>Log in.</h1>
		<label for="username">Username*</label>
		<input name="username" type="text" size="20" maxlength="20" required>
		<label for="password">Password*</label>
		<input name="password" type="password" size="20" maxlength="32" id="password" autocomplete="none" required>
		<label for="submit"></label>
		<input class="btn buttonshape" name="submit" type="submit">
		<label class="loginLabel" href >Don't have an account? Create one <a href="http://weblab.salemstate.edu/~mytime/Waiting_Time/Create_Account.php">here</a>! </label>
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
