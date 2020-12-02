<?php
require('Wait.php');
class Favorites 
{
	private $username;
	
	//Function that retreives the number of favorites the user currently has. 
	function get_num_of_favorites($connect, $username)
	{
		$sql = "SELECT * FROM Favorites WHERE User_ID= '$username'";
		$query = mysqli_query($connect, $sql);
		$rows = mysqli_num_rows($query);
		
		return $rows;
	}
	
	//Function that returns the name of the location.
	function get_location_name($connect, $event_id)
	{
		$sql = "SELECT Location.Location_Name FROM Location INNER JOIN Favorites where '".$event_id."' = Location.Event_ID";
		$query = mysqli_query($connect, $sql);
		$row = mysqli_fetch_array($query);
		$location_name = $row['Location_Name'];
		return $location_name;
	}
	
	//Function that returns the wait time of a certain location.
	function getWait($locationID)
	{
		$wait = new Wait();
		$wait_time = $wait->getWait($locationID);
		return $wait_time;
	}
	
	//Returns an array of all the location_ids belonging to the user's favorites. 
	function get_favorites($username, $connect)
	{
		$sql = "SELECT Event_ID from Favorites WHERE User_ID = '".$username."'";
		$query = mysqli_query($connect, $sql);
		$favorites_array = array();
		$count = 0;
		if(mysqli_num_rows($query) > 0)
		{
			while($row = mysqli_fetch_assoc($query))
			{
				$location_id = $row['Event_ID'];
				$favorites_array[$count] = $location_id;
				$count++;
			}
		}
		return $favorites_array;
		
	}
	
	//Returns weather the location is a favorite by the user.
	function is_a_favorite($connect, $username, $event_id)
	{
		$sql = "SELECT Event_ID from Favorites WHERE (User_ID = '".$username."' AND Event_ID ='".$event_id."')";
		$query = mysqli_query($connect, $sql);
		
		if(mysqli_num_rows($query) > 0)
			return true;
		else 
			return false;
	}
	
	//Removes a favorite from the user's account. 
	function remove_favorite($connect, $username, $event_id)
	{		
		$sql = "DELETE FROM Favorites WHERE (User_ID ='".$username."' AND Event_ID='".$event_id."')";
		$query = mysqli_query($connect, $sql);
		
		if($query)
			return true;
		else
			return false;
	}
	
	//Returns the color depending on how bad the wait is.
	function get_color($location_id)
	{
		$wait = new Wait();
		$mins = $wait->get_total_minutes($location_id);
		
		switch($mins)
		{
			case ($mins > 0 && $mins < 30):
				return "green";
				break;
			case ($mins >= 30 && $mins < 45):
				return "orange";
				break;
			case ($mins >= 45):
				return "red";
				break;
			default:
				return "white";
				break; 
		}
	}
	
	//Add to the favorites table in the DB>
	function add_to_favorites($connect, $username, $event_id)
	{
		$sql = "INSERT INTO Favorites(Event_ID, User_ID) VALUES('".$event_id."','".$username."')";
		$query = mysqli_query($connect, $sql);
		
		if($query)
			return true;
		else
			return false;
	}
	
}

?>