<?php
session_start();

	$servername = "weblab.salemstate.edu";
	$dbusername = "mytime";
	$password = "mytime20";
	$dbname = "mytime";

	$conn = mysqli_connect($servername, $dbusername, $password, $dbname);
	
	//Global variables
	$first_name = $last_name = $gender = $email = $phone_number = $total_reports = $dob = "";

	//Force user to leave if a user is not logged in.
	if($_SESSION["loggedin"] === true)
		echo("");
	else 
	{
		header("location: home.php");
    	exit;
	}
	
	// Check connection
	if ($conn->connect_error) 
	{
		echo("database broken or not working");
  		die("Connection failed: " . $conn->connect_error);
	} 
	
	//Double check if the user is already logged in, or else exit. 
	if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)
	{
		//Differenciate between an admin and a normal user.
		if(!empty($_SESSION['user_name']))
			$username = $_SESSION['user_name'];
		else if(!empty($_SESSION['admin']))
			$username = $_SESSION['admin'];
		
		//Run the query.
		$sql = "SELECT * From ACCOUNT WHERE User_ID = '".$username."'";
		$query = mysqli_query($conn, $sql) or die("err0r: ".mysqli_error($conn));
		$row = mysqli_fetch_array($query);
		$first_name = $row['First_Name'];
		$last_name = $row['Last_Name'];
		$gender = $row['Gender'];
		$email = $row['Email'];
		$phone_number = $row['Phone_num'];
		$total_reports = $row['Total_Reports'];
		$dob = $dob['dob'];
		
	}	
		
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title><?php echo($username)?></title>
</head>
<style>
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
	.menu ul li {
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
	body {
		margin: 0;
		background: #5e91f8; 
	}
	
	/*CSS code for the white sheet. */
	#infoBoard {
		margin-top: 5%;
		width: 55%; 
		height:70%; 
		background-color: white; 
		border-radius: 4px;
		margin: 0 auto;
	}	
	
	/* Code to fit the screen. */
	#infoBoard h1 {
		text-align: center;
		font-family: "Trebuchet MS", Helvetica, sans-serif;
	}
	@media screen and (min-width : 320px)
	{
	  #infoBoard h1{
		font-size: 8px;
	  }
	}
	@media screen and (min-width : 1200px)
	{
	  #infoBoard h1{
		font-size: 30px;
	  }
		#infoBoard h2 {
			font-size: 20px;
		}
	}
	@media screen and (min-width : 2000pm)
	{
		#infoBoard h1{
		font-size: 42px;
	  }
		#infoBoard h2 {
			font-size: 32px;
		}
	}
	@media screen and (min-width : 2800px)
	{
	  	#infoBoard h1{
		font-size: 55px;
	  }
		#infoBoard h2 {
			font-size: 45px;
		}
	}
	
	#infoBoard ul {
		margin: 0;
		paddding: 0;
		line-height: 60px;
		list-style: none;
	}
	
	#infoBoard li {
		font-family: "Trebuchet MS", Helvetica, sans-serif;
		
	}
	
	/*CSS for the change password button*/
	#password_button input {
		width: 300px;
		height: 35px;
		font-family: "Trebuchet MS", Helvetica, sans-serif;
		background-color: dodgerblue;
		font-color: white;
		font-weight: bold;
		margin-left: auto;
		margin-right: auto;
		display: block;
		cursor: pointer;
		border-color: white;
		border-radius: 8px;
		font-size: 18px;
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
				echo('<li><a href ="http://weblab.salemstate.edu/~mytime/Waiting_Time/home.php">Home</a></li>');
				
			}
			else if (!empty($_SESSION['user_name'])) 
			{ 
				$name = $_SESSION['user_name'];
				echo "<li><a href=\"http://weblab.salemstate.edu/~mytime/Waiting_Time/account.php\">$name</a></li>";
				echo('<li><a href ="http://weblab.salemstate.edu/~mytime/Waiting_Time/logout.php">Log out</a></li>');
				echo "<li><a href=\"http://weblab.salemstate.edu/~mytime/Waiting_Time/find_location.php\">Find A Location</a></li>";
				echo('<li><a href ="http://weblab.salemstate.edu/~mytime/Waiting_Time/home.php">Home</a></li>');
			}
			
			else 
			{
				echo('<li><a href ="http://weblab.salemstate.edu/~mytime/Waiting_Time/Log_in.php"> Log in</a></li>');
				echo('<li><a href ="http://weblab.salemstate.edu/~mytime/Waiting_Time/Create_Account.php"> Create An Account</a></li>'); 
				echo "<li><a href=\"http://weblab.salemstate.edu/~mytime/Waiting_Time/find_location.php\">Find A Location</a></li>";
				echo('<li><a href ="http://weblab.salemstate.edu/~mytime/Waiting_Time/home.php">Home</a></li>');
				
			}
			?>
		</ul> 
	</nav>
	
	<div id="infoBoard">
		<h1>Welcome to your profile, <?php echo($first_name);?>!</h1>
		<ul>
			<li><h2>First Name: <?php echo($first_name);?></h2></li>
			<li><h2>Last Name: <?php echo($last_name);?></h2></li>
			<li><h2>Username: <?php echo($username);?></h2></li>
			<li><h2>Date of Birth: <?php echo($dob);?></h2></li>
			<li><h2>Gender: <?php echo($gender);?></h2></li>
			<li><h2>Email: <?php echo($email);?></h2></li>
			<li><h2>Reports made: <?php echo($total_reports);?></h2></li>
		</ul>
	</div>	
	
	<div id="password_button">
		<br>
		<br>
		<form action="http://weblab.salemstate.edu/~mytime/Waiting_Time/change_password.php">
			<input type="submit" value="Change Password"/>
	</div>
		<br>
		<br>
</form>
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