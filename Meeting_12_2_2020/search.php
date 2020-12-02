<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Search.php</title>
</head>
<style>
</style>
<body>
<?php
	$servername = "weblab.salemstate.edu";
	$username = "mytime";
	$dbpassword = "mytime20";
	$dbname = "mytime";
	//$connection = mysqli_connect($servername, $username, $dbpassword, $dbname);
	
	$connection = new mysqli($servername, $username, $dbpassword, $dbname);
	
	//Verify that the connection works.
	if ($connection->connect_error) 
	{
		echo("database broken or not working");
  		die("Connection failed: " . $connection->connect_error);
	} 

	//Check the connection.
	//mysqli_select_db("Search test") or die("something went wrong!". mysqli_connect_error());
	$output = '';
	if(isset($_POST['searchVal']))
	{
		$searchq =$_POST['searchVal'];
		
		//Sanitize the data.
		$searchq = preg_replace("#[^0-9a-z]#i","",$searchq);
		
		//Run SQL to get the names of the places.
		$sql = "SELECT * FROM Location WHERE Location_Name LIKE '%$searchq%'";
		
		$results = mysqli_query($connection, $sql);
		$count = mysqli_num_rows($results);
		
		//Display the results.
		if($count == 0)
			$output = "No results.";
		else
		{
			while($row = mysqli_fetch_array($results))
			{
				$location = $row['Location_Name'];
				$output .= '<div>' .$location. '</div>';
			}
		}
	}
	
	echo($output);
	?>
	</body>
</html>