<?php
session_start();
require(is_nearby.php);

//Connect to the database.
$servername = "weblab.salemstate.edu";
$dbusername = "mytime";
$password = "mytime20";
$dbname = "mytime";
$conn = mysqli_connect($servername, $dbusername, $password, $dbname);

//Global variables for the user's location and the ID for the location/event.
$location_id = $_GET['id'];
$user_lat = $_GET['u_lat'];
$user_long = $_GET['u_long'];
$loc_lat = $_GET['l_lat'];
$loc_long = $_GET['l_long'];
$token = $_GET['tkn'];
$user_id = $_GET['uid'];

echo($location_id );
echo($user_lat);
echo($user_long);
echo($loc_lat);
echo($loc_long);
echo($token);
echo($user_id);
//Check if the user is close by (in miles).
$distance_away = get_location($loc_lat, $loc_long, $user_lat, $user_long);

/*
 * Create cookie to expire in 1 minute to redirect the user to the report page
 * to verify the user is at the location.
 */
if($distance_away < 1)
{
	setcookie($location_verified, true, time(60), "/");
	//header("location: report_location.php?id=".$location_id);
}
else 
{
	echo("Your current location could not be validated or your current location is too far away to give a report.");
	echo('<br>');
	echo("You are " .$distance_away." miles from the location.");
	echo('<br>');
	echo('Click <a href=http://weblab.salemstate.edu/~mytime/Waiting_Time/location.php>here</a> to go back.');
}

?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Validating...</title>
</head>

<body>
</body>
</html>