<?php
session_start();
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Untitled Document</title>
</head>
<?php
	$servername = "weblab.salemstate.edu";
	$dbusername = "mytime";
	$password = "mytime20";
	$dbname = "mytime";

	$conn = mysqli_connect($servername, $dbusername, $password, $dbname);
	
	// Check connection
	if ($conn->connect_error) 
	{
		echo("database broken or not working");
  		die("Connection failed: " . $conn->connect_error);
	} 
	
	//Double check if the user is already logged in, or else exit. 
	if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)
	{
		//Retreive the username from the session.
    	$username = $_SESSION['user_name'];
		
		//Run the query.
		$sql = "SELECT * From ACCOUNT WHERE User_ID = '".$username."'";
		$query = mysqli_query($conn, $sql) or die("err0r: ".mysqli_error($conn));
		$row = mysqli_fetch_array($query);
		$first_name = $row['First_Name'];
		$last_name = $row['Last_Name'];
		$gender = $row['Gender'];
		$email = $row['Email'];
		$phone_number = $row['Phone_num'];
		
		//Populate the variables.
		echo("--- Account Information for " .$username. " ---");
		echo("<br>");
		echo("First Name: " .$first_name);
		echo("<br>");
		echo("Last name: " .$last_name);
		echo("<br>");
		echo("Gender: " .$gender);
		echo("<br>");
		echo("Email: " .$email);
		echo("<br>");
		echo("Phone number: " .$phone_number);
	}	
	else 
	{	echo("Page broken.");
		exit;
	}
		
?>
<body>
	<p>Click <a href=http://weblab.salemstate.edu/~mytime/Waiting_Time/home.php>here</a> to go back home.</p>
</body>
</html>