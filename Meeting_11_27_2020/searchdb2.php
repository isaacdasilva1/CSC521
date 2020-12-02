<?php

$databaseHost = 'weblab.salemstate.edu';
$databaseName = 'mytime';
$databaseUsername = 'mytime';
$databasePassword = 'mytime20';
$connect = mysqli_connect('weblab.salemstate.edu','mytime','mytime20','mytime')or die('Error connecting to MySQL server.');
 $link = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName); 
//

//$connect = mysqli_connect("localhost", "root", "", "testing");
$output = '';
if(isset($_POST["query"]))
{
 	$search = mysqli_real_escape_string($connect, $_POST["query"]);
 	$query = " 
  	SELECT * FROM Location 
  	WHERE Location_Name LIKE '%".$search."%'
 	 OR Event_ID LIKE '%".$search."%' 
	 ";
}
else
{
 	$query = "";
}
$result = mysqli_query($connect, $query) or die(mysqli_error($link));
if(mysqli_num_rows($result) > 0)
{
 	$output .= '<div class="table-responsive">
		<table class="table table bordered"><tr>
				<th>Name</th>
				<th>Category</th>
				<th>Wait Time</th>
			</tr>
	</div>
 ';
 while($row = mysqli_fetch_array($result))
 {
	$location_id = $row["Event_ID"];
	$getWait =  getWait($location_id);
	$output .= '<style>
		td:hover {
			text-decoration: none;
			color:#424040;
			opacity:0.5;
		}
		a:hover 
		{
			text-decoration: none;
		}
	</style>
   	<tr>
		<td><a style="color: black;" href="http://weblab.salemstate.edu/~mytime/Waiting_Time/location.php?id='.$location_id.'">'.$row["Location_Name"].'</a></td>
    	<td><a href="http://weblab.salemstate.edu/~mytime/Waiting_Time/location.php?id='.$location_id.'"style="color: black;"</a>'.$row["TYPE"].'</td>
		<td><a href="http://weblab.salemstate.edu/~mytime/Waiting_Time/location.php?id='.$location_id.'"style="color: black;"</a>'.$getWait.'</td>
    </tr>   
  ';
 }
 echo $output;
 
}
else
{
 	echo 'Data Not Found';
}
//

function getWait($locationID)
{
		/*$databaseHost = 'weblab.salemstate.edu';
		$databaseName = 'mytime';
		$databaseUsername = 'mytime';
		$databasePassword = 'mytime20';
		$connect = mysqli_connect('weblab.salemstate.edu','mytime','mytime20','mytime')or die('Error connecting to MySQL server.');
		$sql = "SELECT Event_ID, HOUR, MINUTE, Time_Stamp FROM TIME WHERE Event_ID = ".$locationID;
		$query = mysqli_query($connect, $sql) or die ("error:/// " .mysqli_error($connect));
		$total_hours_one = 0;
		$total_minutes_one = 0;
		$one_hour_rows = 0;

		//Traverse through the data.
		if(mysqli_num_rows($query) > 0) 
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
			}
		} */
		$databaseHost = 'weblab.salemstate.edu';
		$databaseName = 'mytime';
		$databaseUsername = 'mytime';
		$databasePassword = 'mytime20';
		$total_hours_one = 0;
		$total_minutes_one = 0;
		$one_hour_rows = 0;
		$connect = mysqli_connect('weblab.salemstate.edu','mytime','mytime20','mytime')or die('Error connecting to MySQL server.');
		$sql = "SELECT Event_ID, HOUR, MINUTE, Time_Stamp FROM TIME WHERE Event_ID = ?";
		$stmt = $connect->prepare($sql);
		$stmt->bind_param("s", $locationID);
		$stmt->execute();
		$result = $stmt->get_result();
		if($stmt->num_rows > 0)
		{
			while($row = $result->fetch_assoc())
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
			}
		}
	
		$mins;
		$hours;
		
		//Final amount -- one hour section.
		if($one_hour_rows > 0)
		{
			$mins_one = getWaitTime($total_hours_one, $total_minutes_one)/$one_hour_rows;
			$hours = getHours($mins_one);
			$mins = getMinutes($mins_one);
			return "h:$hours-m:$mins";
		}
		else
		{ 
			$total_minutes_one = "n/a";
			$total_hours_one = "n/a";
			return "h:$total_hours_one-m:$total_minutes_one";
		}
		//return "h:$total_hours_one-m:$total_hours_one";
	
}
	
	
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

?>
