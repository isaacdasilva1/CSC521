<?php
session_start();
$databaseHost = 'weblab.salemstate.edu';
$databaseName = 'mytime';
$databaseUsername = 'mytime';
$databasePassword = 'mytime20';
$connect = mysqli_connect('weblab.salemstate.edu','mytime','mytime20','mytime')or die('Error connecting to MySQL server.');

//Create the token as a global varable.
$token = rand(10000,1000000);
$token_hash = hash(md5,$token);

//Get the username from the session. 
$username = "";
if(isset($_SESSION['admin']))
	$username = "admin";
else if(isset($_SESSION['user_name']))
	$username = $_SESSION['user_name'];
else 
	header("location: location.php");

//Get the values from the GEt request.
$location_id = $_GET['id'];
$location_lat = $_GET['l_lat'];
$location_long = $_GET['l_long'];
$user_id = $_GET['uid'];
	
//Add the token to the database 
$sql = "UPDATE ACCOUNT SET report_token = '{$token_hash}' WHERE User_ID = ('{$username}')";
mysqli_query($connect, $sql);


?>

<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title></title>
</head>
<body>
	<script>
		//Global variables.
		var userLong;
		var userLat;
		var userID = "<?php echo($user_id); ?>";
		var locationLong = <?php echo($location_long); ?>;
		var locationLat = <?php echo($location_lat); ?>; 
		var locationID = <?php echo($location_id); ?>;
		var token  = "<?php echo ($token_hash); ?>";
		var e = document.getElementById("error");
		
		function getLocation()
		{
			if(navigator.geolocation)
				navigator.geolocation.getCurrentPosition(showPosition, showError);
			else
				window.location.replace("http://weblab.salemstate.edu/~mytime/Waiting_Time/home.php");
		}
		
		function showPosition(position)
		{
			userLong = position.coords.longitude;
			userLat = position.coords.latitude;
			
			//Send user to get their location validated. 
			var url = "http://weblab.salemstate.edu/~mytime/Waiting_Time/validate_location.php?id="+locationID+"&tkn="+token+"&uid="+userID+"&u_lat="+userLat+"&u_long="+userLong+"&l_lat="+locationLat+"&l_long="+locationLong;
			window.location.replace(url);
		}
		
		function showError(error) 
 		{
		 switch(error.code) 
		  {
			case error.PERMISSION_DENIED:
			  e.innerHTML = "ERROR - YOU HAVE DENIED THE REQUEST."
			  break;
			case error.POSITION_UNAVAILABLE:
			  e.innerHTML = "ERROR - GLOBAL POSITION UNAVAILABLE."
			  break;
			case error.TIMEOUT:
			  e.innerHTML = "ERROR - REQUEST TIMED OUT."
			  break;
			case error.UNKNOWN_ERROR:
			  e.innerHTML = "An unknown error occurred."
			  break;
		  }
		}
	</script>
	<p>Click the button to validate your location to continue.</p>
	<button onclick="getLocation()">Validate</button>

	<p id="error"></p>
</body>
</html>