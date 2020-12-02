
<?php
class Wait
{ 
	public $total_minutes;
	//Function that returns the wait time of a certain location.
	function getWait($locationID)
	{
		$databaseHost = 'weblab.salemstate.edu';
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
		if (mysqli_num_rows($query) > 0) 
		{	
			while($row = mysqli_fetch_assoc($query)) 
			{
				$time_stamp = $row["Time_Stamp"];
				$hours = $row["HOUR"];
				$minutes = $row["MINUTE"];
				
				if($this->checkHourAgo($time_stamp))
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
			$mins_one = $this->getWaitTime($total_hours_one, $total_minutes_one)/$one_hour_rows;
			$hours = $this->getHours($mins_one);
			$mins = $this->getMinutes($mins_one);
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
	function get_total_minutes($locationID)
	{
		$databaseHost = 'weblab.salemstate.edu';
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
		if (mysqli_num_rows($query) > 0) 
		{	
			while($row = mysqli_fetch_assoc($query)) 
			{
				$time_stamp = $row["Time_Stamp"];
				$hours = $row["HOUR"];
				$minutes = $row["MINUTE"];
				
				if($this->checkHourAgo($time_stamp))
				{
					$total_hours_one = $total_hours_one + $hours;
					$total_minutes_one = $total_minutes_one + $minutes;
					$one_hour_rows++;
				}
			}
		} 
		if($one_hour_rows > 0)
			$mins_one = $this->getWaitTime($total_hours_one, $total_minutes_one)/$one_hour_rows;
		else
			$mins_one = 0;
	
		return $mins_one;
	}
	
}
?>