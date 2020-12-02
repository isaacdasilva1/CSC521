<?php
session_start();
ob_start();
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
include('Favorites.php');
$databaseHost = 'weblab.salemstate.edu';
$databaseName = 'mytime';
$databaseUsername = 'mytime';
$databasePassword = 'mytime20';
$connect = mysqli_connect('weblab.salemstate.edu','mytime','mytime20','mytime')or die('Error connecting to MySQL server.');

//Address variables of the location and other information.
$city = "";
$state = "";
$address = "";
$zipcode = "";
$address_full = "";
$type = "";
$locationID = $_GET['id'];

//For reporting
$total_hours_one = 0;
$total_minutes_one = 0;
$total_hours_three = 0;
$total_minutes_three = 0;


if(isset($_SESSION['user_name']))
	$username = $_SESSION['user_name'];

//Get information for the address
$sql = "SELECT * From Location WHERE Event_ID = '".$_GET['id']."'";
$query = mysqli_query($connect, $sql) or die("err0r: ".mysqli_error($connect));
	
//Results from the query.
$row = mysqli_fetch_array($query);
$l_name = $row['Location_Name'];


//Check if the user already made a report.
if(($_GET['success']) == true)
{	
	echo($_GET['success']);
	echo "<script>alert('Success! Your report has been added.');</script>"; 
}
if(isset($_GET['id']))
{
	$sql = "SELECT * From Location WHERE Event_ID = '".$_GET['id']."'";
	$query = mysqli_query($connect, $sql) or die("err0r: ".mysqli_error($conn));
	
	//Results from the query.
	$row = mysqli_fetch_array($query);
	$location_name = $row['Location_Name'];
	$type = $row['TYPE'];
	$link = $row['Link'];
	
	echo(".");
	
	//Get information for the address
	$sql =  "SELECT * From Address WHERE Event_ID = '".$_GET['id']."'";
	$query = mysqli_query($connect, $sql) or die("err0r: ".mysqli_error($conn));
	$row = mysqli_fetch_array($query);
	$location_name = $row['Location_Name'];
	$city = $row['City'];
	$state = $row['State'];
	$address = $row['address'];
	$zipcode = $row['Zipcode'];
	
	//Create the full address.
	$address_full = $address. ", " .$city. ", " .$state;
}
else
	echo("error has occured.");
	
//Returns true if the time was from an hour ago.
function checkHourAgo($data_base_date)
{
	$data_base_date = strtotime($data_base_date);
	date_default_timezone_set('EST');
	$dateHourAgo = strtotime("-1 hour");
	if ($data_base_date >= $dateHourAgo) 
		return true;
	else 
		return false; 
}

//Returns true if the time was three hours ago.
function checkThreeHoursAgo($data_base_date)
{
	$data_base_date = strtotime($data_base_date);
	date_default_timezone_set('EST');
	$dateThreeHousAgo = strtotime("-3 hours");
	if ($data_base_date >= $dateThreeHousAgo) 
		return true;
	else
		return false;
}

//Returns the total wait time in total minutes. 
function getWaitTime($hour, $minute)
{
	$hours_to_minutes = $hour * 60;
	$total_minutes = $hours_to_minutes + $minute;
	
	return $total_minutes;
}

function getHours(int $total)
{
	return floor($total/60);
}

function getMinutes($total)
{
	return $total % 60;
}

function is_logged_in()
{
	if(isset($_SESSION['loggedin']))
		return true;
	else 
		return false;
}
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Location</title>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCZ-0jhHfo_Ch2KldReZMAEQFn-Dd0Qf9g&callback=initMap&libraries=&v=weekly"
      defer></script>
	<script type="text/javascript">
		var address = "<?php echo($address_full)?>";
		var latitude;
		var longitude;
		// Initialize and add the map
		function initMap() 
		{
			var address = "<?php echo($address_full)?>";
			var geocoder = new google.maps.Geocoder();
    		geocoder.geocode( { 'address': address}, function(results, status) 
			{
				if (status == google.maps.GeocoderStatus.OK) 
				{
					latitude = results[0].geometry.location.lat();
					console.log("lat: " +latitude);
					longitude = results[0].geometry.location.lng();
					console.log("long: " +longitude);
					const userLocation = { lat: latitude, lng: longitude};
					// The map, centered at where the location is
					const map = new google.maps.Map(document.getElementById("map"), {
						zoom: 14,
						center: userLocation,
					});
					const marker = new google.maps.Marker({
					position: userLocation,
					map: map,
		  			});
				}
   			});			
			
		}
    </script>
</head>
<style>
	/* CSS code for the menu bar. */
	.menu {
		width: 100%;
		background: black;
		overflow: auto;
			
	}
	body {
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
	
	/* CSS code for the map. */
	#map {
		width: 35%; float:left; height:60%; margin:10%; margin-left: 10%; margin-top: 5%; border-radius: 4px;
	}
	/* Code for the header for the name of the location. */
	h1 {
    	text-align: center;
		font-family: "Trebuchet MS", Helvetica, sans-serif;
		color: white;
	}
	/* Creates the block for the map and the info board. */
	
	/*CSS code for the info board. */
	#infoBoard {
		width: 35%; 
		float:right; 
		height:60%; 
		margin-right: 10%; 
		margin-top: 5%; 
		background-color: white; 
		border-radius: 4px;
		overflow-wrap: break-word;
	}	
	
	#infoBoard h1 {
		text-align: center;
		color: black;
		font-family: "Trebuchet MS", Helvetica, sans-serif;
		
	}
	
	#infoBoard ul {
		margin: 0;
		paddding: 0;
		line-height: 40px;
		list-style: none;
	}
	
	#infoBoard li {
		font-family: "Trebuchet MS", Helvetica, sans-serif;
	}
	
	/* Custom CSS code for the different screen sizes for the text. */
	@media screen and (min-width : 320px)
	{
	  #infoBoard h1{
		font-size: 12px;
	  }
		#infoBoard h2 {
		font-size: 8px;
		}
	}
	@media screen and (min-width : 1200px)
	{
	  	#infoBoard h1{
		font-size: 25px;
	  }
		#infoBoard h2 {
		font-size: 12px;
		}
	}
	@media screen and (min-width : 2000pm)
	{
		#infoBoard h1{
			font-size: 25px;
	  }
		#infoBoard h2 {
			font-size: 14px;
		}
	}
	@media screen and (min-width : 2800px)
	{
	  	#infoBoard h1{
			font-size: 25px;
	  }
		#infoBoard h2 {
			font-size: 20px;
		}
	}

	footer {
		float: left;
	}
	footer ul {
		text-align: center;
		color: white;
		font-family: "Trebuchet MS", Helvetica, sans-serif;
	}
	footer li {
		list-style-type: none;
	}
	
	.foot {
		display: block;
		margin: auto 0;
		text-align: center;
		color: white;
		font-family: "Trebuchet MS", Helvetica, sans-serif;
		float
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
				echo "<li><a href=\"http://weblab.salemstate.edu/~mytime/Waiting_Time/home.php\">Home</a></li>";
				
			}
			else if (!empty($_SESSION['user_name'])) 
			{ 
				$name = $_SESSION['user_name'];
				echo "<li><a href=\"http://weblab.salemstate.edu/~mytime/Waiting_Time/account.php\">$name</a></li>";
				echo('<li><a href ="http://weblab.salemstate.edu/~mytime/Waiting_Time/logout.php">Log out</a></li>');
				echo "<li><a href=\"http://weblab.salemstate.edu/~mytime/Waiting_Time/find_location.php\">Find A Location</a></li>";
				echo "<li><a href=\"http://weblab.salemstate.edu/~mytime/Waiting_Time/home.php\">Home</a></li>";
			}
			
			else 
			{
				echo('<li><a href ="http://weblab.salemstate.edu/~mytime/Waiting_Time/Log_in.php"> Log in</a></li>');
				echo('<li><a href ="http://weblab.salemstate.edu/~mytime/Waiting_Time/Create_Account.php"> Create An Account</a></li>'); 
				echo "<li><a href=\"http://weblab.salemstate.edu/~mytime/Waiting_Time/find_location.php\">Find A Location</a></li>";
				echo "<li><a href=\"http://weblab.salemstate.edu/~mytime/Waiting_Time/home.php\">Home</a></li>";
				
			}
			?>
		</ul> 
	</nav>
	<h1 style='color: white; padding-top: 3%; text-align: center; font-size: 50px;'><?php echo($l_name);?></h1>
	<h1>
		<?php 
		
		$sql = "SELECT * From Location WHERE Event_ID = '".$_GET['id']."'";
		$query = mysqli_query($connect, $sql) or die("err0r: ".mysqli_error($connect));
	
		//Results from the query.
		$row = mysqli_fetch_array($query);
		$location_name = $row['Location_Name'];
		?>
		
		<?php
		$sql = "SELECT Event_ID, HOUR, MINUTE, Time_Stamp FROM TIME WHERE Event_ID = ".$locationID;
		$query = mysqli_query($connect, $sql) or die ("error: " .mysqli_error($connect));
		$total_hours_one = 0;
		$total_minutes_one = 0;
		$total_hours_three = 0;
		$total_minutes_three = 0;
		$one_hour_rows = 0;
		$three_hour_rows = 0;
		
		//Traverse through the data.
		if (mysqli_num_rows($query) > 0) 
		{	
			while($row = mysqli_fetch_assoc($query)) 
			{
				$time_stamp = $row["Time_Stamp"];
				$hours = $row["HOUR"];
				$minutes = $row["MINUTE"];
				
				if(checkHourAgo($time_stamp))
				{
					$total_hours_one = $total_hours_one + $hours;
					$total_minutes_one = $total_minutes_one + $minutes;
					$one_hour_rows++;
				}

				
				if(checkThreeHoursAgo($time_stamp))
				{
					$total_hours_three = $total_hours_three + $hours;
					$total_minutes_three = $total_minutes_three + $minutes;
					$three_hour_rows++;
				}
			}
		} 
		
		//Final amount -- one hour section.
		if($one_hour_rows > 0)
		{
			$mins_one = getWaitTime($total_hours_one, $total_minutes_one)/$one_hour_rows;
			$total_hours_one = getHours($mins_one);
			$total_minutes_one = getMinutes($mins_one);
		}
		else{ 
			$total_minutes_one = "n/a";
			$total_hours_one = "n/a";
		}
		
		//Final amount -- three hour section.
		if($three_hour_rows > 0)
		{
			$mins_three = getWaitTime($total_hours_three, $total_minutes_three)/$three_hour_rows;
			$total_minutes_three = getMinutes($mins_three);
			$total_hours_three = getHours($mins_three);
		}
		else
		{
			$total_hours_three = "n/a";
			$total_minutes_three = "n/a";
		}
		?>
	</h1>
	<div id="map"></div>
	<div id="infoBoard">
		<h1> ⓘ </h1>
		<ul>
			<li><h2>Name: <?php echo($location_name);?></h2></li>
			<li><h2>Address: <?php echo($address_full);?></h2></li> 
			<li><h2>Category: <?php echo($type);?></h2></li> 
			<li><h2>Wait Time (Previous Hour): <?php echo("Hours: " .$total_hours_one. " Minutes: ".$total_minutes_one);?></h2></li> 
			<li><h2>Wait Time (Previous 3 Hours): <?php echo("Hours: " .$total_hours_three. " Minutes: ".$total_minutes_three)?> </h2></li> 
			<?php if($type !== "DMV/RMV")
				echo("<li><h2>Link to location's website: Click <a href=".$link.">here</a></h2></li> ");
			else
					echo("<style>h1 {font-color: blue;}</style><li><h2><i>No times on here? View alt. wait time on DMV website</i>: Click <a href=".$link.">here</a></h2></li>");
			?>
		</ul>
	</div>                                                                                                           
	<?php
	
	//Deals with the buttons on the location page.
	$token = rand(10000,1000000);
	$token_hash = hash('md5',$token);
	
	//Add the token to the database 
	$sql = "UPDATE ACCOUNT SET token = '{$token_hash}' WHERE User_ID = ('{$username}')";
	mysqli_query($connect, $sql);

	//Check if the user is logged in.
	if(isset($_SESSION['loggedin']))
	{
		//variables to check some parameters. 
		$favorites = new Favorites();
		$num_favorites = $favorites->get_num_of_favorites($connect, $username);
		$is_a_favorite = $favorites->is_a_favorite($connect, $username, $locationID);
		
		//Timestamp for user's last report.
		$sql_timestamp = 0;
		
		//Location is not a favorite and the user has less than 6 logged favorites, offer to add it.
		if(!$is_a_favorite && $num_favorites <= 4)
		{
			echo(
			'
			<a href="http://weblab.salemstate.edu/~mytime/Waiting_Time/favorite_action.php?id='.$locationID.'&uid='.$username.'&request=add&request_token='.$token_hash.'"><button type="button" class="add your class">Add To Favorites</button></a>
			');
		}
		
		//Removes the favorite.
		if($is_a_favorite)
		{
			echo(
			'
				<a href="http://weblab.salemstate.edu/~mytime/Waiting_Time/favorite_action.php?id='.$locationID.'&uid='.$username.'&request=remove&request_token='.$token_hash.'"><button type="button" class="add your class">Remove From Favorites</button></a>
			');
		}
		//Add the report button
		if(!was_thirty_mins_ago($connect, $username))
		{
			//"http://weblab.salemstate.edu/~mytime/Waiting_Time/report_location.php?id="+locationID;
			echo(
			'
			<style>.report{cursor: not-allowed;}</style>
			<a href="http://weblab.salemstate.edu/~mytime/Waiting_Time/report_location.php?id='.$locationID.'&request_token='.$token_hash.'"><button disabled="disabled"  title="Reports can only be made every 30 mins" type="button" class="report">Report A Wait Time</button></a>
			');
		}
		else
		{
			echo(
			'
			<style>.report{}</style>
			<a href="http://weblab.salemstate.edu/~mytime/Waiting_Time/report_location.php?id='.$locationID.'&request_token='.$token_hash.'"><button type="button" class="report">Report A Wait Time</button></a>
			');
		}
	}
	else 
	{
		echo(
			'
			<style>.report{}</style>
			<a href="http://weblab.salemstate.edu/~mytime/Waiting_Time/Log_in.php"><button type="button" class="report">Login To Report</button></a>
			');
	}
				
	function was_thirty_mins_ago($connect, $username)
	{
		$sql_timestamp = "SELECT TIME.Time_Stamp, Report.User_ID, Report.Report_ID FROM Report, TIME WHERE (TIME.Report_ID = Report.Report_ID AND User_ID = '$username') ORDER BY TIME.Time_Stamp Desc";
		$query = mysqli_query($connect, $sql_timestamp);
		$get_first_row = mysqli_fetch_assoc($query);
		$time = ($get_first_row['Time_Stamp']);
		if(strtotime($time) < strtotime("-30 minutes")) 
			return true;
    	else 
			return false;
	}
	?>
</div>
	
</body>
	
</html>
