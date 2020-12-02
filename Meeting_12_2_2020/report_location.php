<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
session_start();

//Connect to the database.
$databaseHost = 'weblab.salemstate.edu';
$databaseName = 'mytime';
$databaseUsername = 'mytime';
$databasePassword = 'mytime20';
$connect = new mysqli('weblab.salemstate.edu','mytime','mytime20','mytime')or die('Error connecting to MySQL server.');

//Location variable and other global variables.
$location_id = "";
$location_name = "";
$user_id = "";
$username = $_SESSION['user_name'];
$location_id = $_GET['id'];
$token = $_GET['request_token'];
	
//If a user is logged-on they can only create a report, otherwise kick them off.
if(isset($_SESSION['is_admin']))
{}
elseif (isset($_SESSION['user_name']))
{}
else
{
    header("location: location.php?id=".$_GET['id']);
    exit;
}

//Get the token from the db.
//Retreive the authorize variable from the db.
$request_token = $_GET['request_token'];
$sql = "SELECT token from ACCOUNT WHERE User_ID = ?";
$stmt = $connect->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$tkn = $row['token'];

//Checks if the user is logged in, has the correct token, and they have not reported in 30 minutes. 
if($tkn === $token && was_thirty_mins_ago($connect, $username))
	;
else{

	header("location: location.php?id=".$_GET['id']);
}

if(isset($_POST['submit']) && $tkn == $token && was_thirty_mins_ago($connect, $username))
{
	
	//Get the User_ID
	$location_id = $_GET['id'];
	
	//Get information from the database. 
	$sql = "SELECT * From Location WHERE Event_ID = ?";
	$stmt = $connect->prepare($sql);
	$stmt->bind_param("s", $location_id);
	$stmt->execute();
	$result = $stmt->get_result();
	$row = $result->fetch_assoc();
	$location_name = $row['Location_Name'];
	
    
    $minutes = $_POST['minutes'];
    $hours = $_POST['hours'];
    $description = $_POST['description'];
    $report_ID = get_report_id($connect);
    
    //Push information into the database - report.
    $sql_report = "INSERT INTO Report (Description, Report_ID, User_ID) VALUES (?,?,?)";
	
	
    //Variables that make detect if the report went through OK.
    $query1 = false;
    $query2 = false;
	
    if($stmt = $connect->prepare($sql_report))
	{
		$stmt->bind_param("sss", $description, $report_ID, $username);
        $query1 = true;
		$stmt->execute();
	}
	
	$stmt->close();
   
	$sql_time = "INSERT INTO TIME (Event_ID, HOUR, MINUTE, Report_ID, SECOND, Time_Stamp) VALUES (?,?,?, ?, 0, NULL)";
    
    
	if($stmt = $connect->prepare($sql_time))
	{
		$stmt->bind_param("siis",$location_id, $hours, $minutes, $report_ID);
		$stmt->execute();
        $query2 = true;
	}
	//Update the token.
	$token = rand(10000,1000000);
	$token_hash = hash('md5',$token);
	
	//Add the token to the database 
	$sql = "UPDATE ACCOUNT SET token = '{$token_hash}' WHERE User_ID = ('{$username}')";
	mysqli_query($connect, $sql);
	
    if($query1 && $query2)
    {
		//Make the cookie.
		//setcookie("made_a_post","true", time() * 3600);
		$query = http_build_query($_GET);
        header("location: location.php?id=".$_GET['id']."&success=true");
    }
	else
	{
		header("location: location.php?id=".$_GET['id']);	
	}
		$stmt->close();

}

function get_username()
{
	if(isset($_SESSION['user_name']))
		return $username = $_SESSION['user_name'];
	else 
	{
		return NULL;
		header("location: location.php");
	}
}

//Function gets unique ID
function get_report_id($connect)
{
	$id = rand(1000,10000000);
	$sql = "SELECT * FROM Report WHERE Report_ID = ?";
	$stmt = $connect->prepare($sql);
	$stmt->bind_param("s", $id);
	$result = $stmt->get_result();
	$rows = $result->num_rows;
	
	if($rows > 0)
	{
		//If that ID already exits, pick another.
		while($rows > 0)
		{
			$sql = "SELECT * FROM Report WHERE Report_ID = ?";
			$stmt = $connect->prepare($sql);
			$stmt->bind_param("s", $id);
			$result = $stmt->get_result();
			$rows = $result->num_rows;
			$id = rand(1,100000000);
		}
	}
	
	return $id;
}

function was_thirty_mins_ago($connect, $username)
	{
		$sql_timestamp = "SELECT TIME.Time_Stamp, Report.User_ID, Report.Report_ID FROM Report, TIME WHERE (TIME.Report_ID = Report.Report_ID AND User_ID = '$username') ORDER BY TIME.Time_Stamp Desc";
		$query = mysqli_query($connect, $sql_timestamp);
		$num_rows = mysqli_num_rows($query);
		$get_first_row = mysqli_fetch_assoc($query);
	
		if($num_rows > 0)
		{
			$time = ($get_first_row['Time_Stamp']);

			if(strtotime($time) < strtotime("-30 minutes")) 
				 return true;
			else 
				return false;
		}
		else 
			return true;
}
	

?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Report: <?php echo($location_name);?></title>
</head>
<style>
	/* CSS code for the menu bar. */
	.menu {
		width: 100%;
		background: black;
		overflow: auto;
			
	}
	body {
		margin: 0;
		background: #5e91f8; 
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
		width: 190px;
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
	
	#pad {
		padding-top: 5%;
	}
	
	#selectWrapper {
		height: 40%;
		width: 35%;
		background-color: white;
		border-radius: 4px;
		border: thin;
		border-color: white;
		margin: auto;
	}
	
	body {
		background-color: skyblue;
	}
	
	select {
		display: block;
		margin: auto;
		width: 80%;
		height: 5%;
	}
	
	#selects {
		padding-top: 5%;
		text-align: center;
		font-family: "Trebuchet MS", Verdana, "sans-serif";
	}
	
	#selects input {
		padding-top: 5%;
		display: block;
		margin: auto;
	}
	
	.btn {
		border-radius: 4px;
		background-color: transparent;
		border-color: skyblue;
		cursor: pointer;
		width: 20%;
		height: 10px;
		text-align: center;
		display: block;
		margin: auto;
		padding: 15px 5px;
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
	<div id="pad">
	<div id= "selectWrapper">
		<div id="selects">
			<form class="select" action="" method="post">
				<label for="hours">Select How Long You Waited</label>
				<select name="hours">
					<option value="0">0 hours</option>
					<option value="1">1 hour</option>
					<option value="2">2 hours</option>
					<option value="3">3 hours</option>
					<option value="4">4 hours</option>
				</select>
				<br>
				<select name="minutes">
					<option value="0">0 minutes</option>
					<option value="5">5 minutes</option>
					<option value="10">10 minutes</option>
					<option value="15">15 minutes</option>
					<option value="15">20 minutes</option>
					<option value="30">30 minutes</option>
					<option value="45">45 minutes</option>
				</select>
				<br>
				<select name="description">
					<option value="Long lines - during peak hours.">Very long lines during peak hours.</option>
					<option value="Long lines - but too few lanes are open.">Long lines - but too few lanes are open.</option>
					<option value="Very busy.">Very busy.</option>
					<option value="Slower than normal.">Slower than normal.</option>
					<option value="Exceptionally busy.">Exceptionally busy.</option>
					<option value="Normal.">Normal.</option>
				</select>
				<br>
				<input class ="btn"name="submit" type="submit">
			</form>
		</div>
	</div>
</div>
<br>
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
