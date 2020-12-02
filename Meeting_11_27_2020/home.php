<?php 
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//Connect to the database.
ini_set('display_errors','On');
ini_set('error_reporting',E_ALL);
$databaseHost = 'weblab.salemstate.edu';
$databaseName = 'mytime';
$databaseUsername = 'mytime';
$databasePassword = 'mytime20';
$connect = mysqli_connect('weblab.salemstate.edu','mytime','mytime20','mytime')or die('Error connecting to MySQL server.');

function getUserName()
{
	if(!empty($_SESSION['user_name']))
		return $username = $_SESSION['user_name'];
	else if(!empty($_SESSION['admin']))
		return $username = $_SESSION['admin'];
	else 
		return null;
}
function getName()
{
	$databaseHost = 'weblab.salemstate.edu';
	$databaseName = 'mytime';
	$databaseUsername = 'mytime';
	$databasePassword = 'mytime20';
	$connect = mysqli_connect('weblab.salemstate.edu','mytime','mytime20','mytime')or die('Error connecting to MySQL server.');
	
	$user = getUserName();
	$sql = "SELECT * From ACCOUNT WHERE User_ID = '".$user."'";
	$query = mysqli_query($connect, $sql);
	$row = mysqli_fetch_array($query);
	$name = $row['First_Name'];
	return $name;
}
	?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>My Wait Time</title>
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> 
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
</head>
<style>
	body {
		margin: 0;
		background: skyblue; 
	}
	
	/* Background gradient. */
	#gradient_background {
        background: rgb(55,163,8);
        background: linear-gradient(13deg, rgba(55,163,8,1) 0%, rgba(83,0,255,1) 100%, rgba(0,212,255,1) 100%);		
		
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
		cursor: not-allowed;
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
	
	img {
		height: 30%;
		width: 70%;
		margin: auto 0;
		display: block;
  		margin-left: auto;
  		margin-right: auto;
		padding-top: 4%
	}
	
	h1 {
    	text-align:center;
		font-family: "Trebuchet MS", Helvetica, sans-serif;
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
<style type="text/css">
    body{
        font-family: Arail, sans-serif;
    }
    /* Formatting search box */
    .search-box{
        width: 300px;
        position: relative;
        display: inline-block;
        font-size: 14px;
    }
    .search-box input[type="text"]{
        height: 32px;
        padding: 5px 10px;
        border: 1px solid #CCCCCC;
        font-size: 14px;
    }
    .result{
        position: absolute;        
        z-index: 999;
        top: 100%;
        left: 0;
    }
    .search-box input[type="text"], .result{
        width: 100%;
        box-sizing: border-box;
    }
    /* Formatting result items */
    .result p{
        margin: 0;
        padding: 7px 10px;
        border: 1px solid #CCCCCC;
        border-top: none;
        cursor: pointer;
    }
	
	.button {
	 	color: white;
	 	background: skyblue;
	 	border: 1px solid white;
	 	border-radius: 5px;
	 	text-decoration: none;
	  	transition: all 0.3s;
	 	width: 12%;
		height: 30px;
		text-align: center;
		border-radius: 6px;
		margin-left: 44%;
		margin-right: 44%;
		padding-top:  6px;
		
	}
	
	.button:hover {
		opacity: .2;
		border: 1px solid white;
	}
	
	.button:a {
		text-decoration: none;
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
			
			else 
			{
				echo('<li><a href ="http://weblab.salemstate.edu/~mytime/Waiting_Time/Log_in.php"> Log in</a></li>');
				echo('<li><a href ="http://weblab.salemstate.edu/~mytime/Waiting_Time/Create_Account.php"> Create An Account</a></li>'); 
				echo "<li><a href=\"http://weblab.salemstate.edu/~mytime/Waiting_Time/find_location.php\">Find A Location</a></li>";
				
			}
			?>
			
		</ul> 
		
	</nav>
		<?php
		if(isset($_SESSION['loggedin']))
		{
			$name = getName();
			echo("<h1 style='color: black; padding-top: 3%; text-align: center; font-size: 50px;'>Welcome back, $name!</h1>");
		}
	
		
		?>
		<?php
			require('Favorites.php');
			$uname = getUserName();
			$favorites = new Favorites();
			$num = $favorites->get_num_of_favorites($connect, $uname);
			$array = array();
			$array = $favorites->get_favorites($uname, $connect);
	
			switch($num)
			{
				case 1:
					echo('
					<style>
						table, th, td {
						  border: 1px solid white;
						  border-collapse: collapse; background-color: white; height: 30px; 
						}
						td:hover {background-color:#EEEEEE}
						a {text-decoration: none !important; color:black;}
						.center{margin-left: auto; margin-right:auto}
						</style>
						<table style="width:50%" class="center">
							  <tr>
								<th>Location</th>
								<th>Wait Time</th> 
							  </tr>
							  <tr>
									<td><a href="http://weblab.salemstate.edu/~mytime/Waiting_Time/location.php?id='.$array[0].'">'.$favorites->get_location_name($connect, $array[0]).'</a></td>
									<td style="background-color: '.$favorites->get_color($array[0]).';">'.$favorites->getWait($array[0]).'</td>
							  </tr>
							</table>
						');
					break;
				case 2:
					echo('
					<style>
						table, th, td {
						  border: 1px solid white;
						  border-collapse: collapse; background-color: white; height: 30px;
						}
						td:hover {background-color:#EEEEEE}
						a {text-decoration: none !important; color:black;}
						.center{margin-left: auto; margin-right:auto;}
						</style>
						<table style="width:50%" class="center">
							  <tr>
								<th>Location</th>
								<th>Wait Time</th> 
							  </tr>
							  <tr>
									<td><a href="http://weblab.salemstate.edu/~mytime/Waiting_Time/location.php?id='.$array[0].'">'.$favorites->get_location_name($connect, $array[0]).'</a></td>
									<td style="background-color: '.$favorites->get_color($array[0]).';">'.$favorites->getWait($array[0]).'</td>
							  </tr>
							  <tr>
									<td><a href="http://weblab.salemstate.edu/~mytime/Waiting_Time/location.php?id='.$array[1].'">'.$favorites->get_location_name($connect, $array[1]).'</a></td>
									<td style="background-color: '.$favorites->get_color($array[1]).';">'.$favorites->getWait($array[1]).'</td>
							  </tr>
							</table>
						');
					break;
				case 3:
					echo('
					<style>
						table, th, td {
						  border: 1px solid white;
						  border-collapse: collapse; background-color: white; height: 30px;
						}
						td:hover {background-color:#EEEEEE}
						a {text-decoration: none !important; color:black;}
						.center{margin-left: auto; margin-right:auto}
						</style>
						<table style="width:50%" class="center";>
							  <tr>
								<th>Location</th>
								<th>Wait Time</th> 
							  </tr>
							  <tr>
									<td><a href="http://weblab.salemstate.edu/~mytime/Waiting_Time/location.php?id='.$array[0].'">'.$favorites->get_location_name($connect, $array[0]).'</a></td>
									<td style="background-color: '.$favorites->get_color($array[0]).';">'.$favorites->getWait($array[0]).'</td>
							  </tr>
							  <tr>
									<td><a href="http://weblab.salemstate.edu/~mytime/Waiting_Time/location.php?id='.$array[1].'">'.$favorites->get_location_name($connect, $array[1]).'</a></td>
									<td style="background-color: '.$favorites->get_color($array[1]).';">'.$favorites->getWait($array[1]).'</td>
							  </tr>
							  <tr>
									<td><a href="http://weblab.salemstate.edu/~mytime/Waiting_Time/location.php?id='.$array[2].'">'.$favorites->get_location_name($connect, $array[2]).'</a></td>
									<td style="background-color: '.$favorites->get_color($array[2]).';">'.$favorites->getWait($array[2]).'</td>
							  </tr>
							</table>
						');
					break;
				case 4:
					echo('
					 <style>
						table, th, td {
						  border: 1px solid white;
						  border-collapse: collapse; background-color: white; height: 30px;
						}
						td:hover {background-color:#EEEEEE}
						a {text-decoration: none !important; color:black;}
						.center{margin-left: auto; margin-right:auto}
						</style>
						<table style="width:50%" class="center";>
							  <tr>
								<th>Location</th>
								<th>Wait Time</th> 
							  </tr>
							  <tr>
									<td><a href="http://weblab.salemstate.edu/~mytime/Waiting_Time/location.php?id='.$array[0].'">'.$favorites->get_location_name($connect, $array[0]).'</a></td>
									<td style="background-color: '.$favorites->get_color($array[0]).';">'.$favorites->getWait($array[0]).'</td>
							  </tr>
							  <tr>
									<td><a href="http://weblab.salemstate.edu/~mytime/Waiting_Time/location.php?id='.$array[1].'">'.$favorites->get_location_name($connect, $array[1]).'</a></td>
									<td style="background-color: '.$favorites->get_color($array[1]).';">'.$favorites->getWait($array[1]).'</td>
							  </tr>
							  <tr>
									<td><a href="http://weblab.salemstate.edu/~mytime/Waiting_Time/location.php?id='.$array[2].'">'.$favorites->get_location_name($connect, $array[2]).'</a></td>
									<td style="background-color: '.$favorites->get_color($array[2]).';">'.$favorites->getWait($array[2]).'</td>
							  </tr>
							  <tr>
									<td><a href="http://weblab.salemstate.edu/~mytime/Waiting_Time/location.php?id='.$array[3].'">'.$favorites->get_location_name($connect, $array[3]).'</a></td>
									<td style="background-color: '.$favorites->get_color($array[3]).';">'.$favorites->getWait($array[3]).'</td>
							  </tr>
							</table>
						');
					break;
				case 5:
					echo('
						<style>
						table, th, td {
						  border: 1px solid white;
						  border-collapse: collapse; background-color: white; height: 30px;
						}
						td:hover {background-color:#EEEEEE}
						a {text-decoration: none !important; color:black;}
						.center{margin-left: auto; margin-right:auto}
						</style>
						<table style="width:50%" class="center";>
							  <tr>
								<th>Location</th>
								<th>Wait Time</th> 
							  </tr>
							  <tr>
									<td><a href="http://weblab.salemstate.edu/~mytime/Waiting_Time/location.php?id='.$array[0].'">'.$favorites->get_location_name($connect, $array[0]).'</a></td>
									<td style="background-color: '.$favorites->get_color($array[0]).';">'.$favorites->getWait($array[0]).'</td>
							  </tr>
							  <tr>
									<td><a href="http://weblab.salemstate.edu/~mytime/Waiting_Time/location.php?id='.$array[1].'">'.$favorites->get_location_name($connect, $array[1]).'</a></td>
									<td style="background-color: '.$favorites->get_color($array[1]).';">'.$favorites->getWait($array[1]).'</td>
							  </tr>
							  <tr>
									<td><a href="http://weblab.salemstate.edu/~mytime/Waiting_Time/location.php?id='.$array[2].'">'.$favorites->get_location_name($connect, $array[2]).'</a></td>
									<td style="background-color: '.$favorites->get_color($array[2]).';">'.$favorites->getWait($array[2]).'</td>
							  </tr>
							  <tr>
									<td><a href="http://weblab.salemstate.edu/~mytime/Waiting_Time/location.php?id='.$array[3].'">'.$favorites->get_location_name($connect, $array[3]).'</a></td>
									<td style="background-color: '.$favorites->get_color($array[3]).';">'.$favorites->getWait($array[3]).'</td>
							  </tr>
							  <tr>
									<td><a href="http://weblab.salemstate.edu/~mytime/Waiting_Time/location.php?id='.$array[4].'">'.$favorites->get_location_name($connect, $array[4]).'</a></td>
									<td style="background-color: '.$favorites->get_color($array[4]).';">'.$favorites->getWait($array[4]).'</td>
							  </tr>
							</table>
						');
					break;
					
			}

		?>
		<h1 style="color: white; padding-top: 3%;" text-align="center;">Don't like waiting in line? Yeah - neither do we.</h1>
		<img src="26199.jpg" alt="Long line">
		<br>
		<p style="text-align: center"><a href"https://www.freepik.com/vectors/food">Photo</a></p>
		<div style="text-align:center">
			<span class="picture_selection"></span>
			<span class="picture_selection"></span>
		</div>
	<br>
	<br>
	<p style="text-align:center; color: white; padding-left: 15%; padding-right: 15%; font-size: 20px;" >When people go to places such as the DMV, RMV, the airport, they are unsure and do not know how long they will have to be waiting in line for things like baggage check or security screening; and this is our main goal! This website will offer a way to check wait times in real time, so people will know what they are up against and can plan their day accordingly!
 Anyone can visit and either check a wait time or report one with an account with us! In order to check a wait time, all the user has to do is search through the list of available places until they are able to find the place they are looking for. Additionally, one we have received a substantial amount of data, we will add a calculated wait time based on past trends! 
</p>
	<h1 style="color: white; padding-top: 3%;" text-align="center;">Let's fight wait times, <i>together</i>. Get started by finding a location today!</i></h1>
	<br>
	 <div class="button"><a style="text-decoration: none; color: white;"href="http://weblab.salemstate.edu/~mytime/Waiting_Time/find_location.php">Find A Location</a></div>
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

	
