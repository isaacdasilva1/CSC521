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
 	$output .= '
  	<div class="table-responsive">
   <table class="table table bordered">
    	<tr>
     		<th>Name</th>
     		<th>Category</th>
    	</tr>
 ';
 while($row = mysqli_fetch_array($result))
 {
	$location_id = $row["Event_ID"];
	$output .= '
   	<tr>
		<td><a style="color: white;" href="http://weblab.salemstate.edu/~mytime/Waiting_Time/location.php?id='.$location_id.'">'.$row["Location_Name"].'</a></td>
    	<td><a style="color: white;"</a>'.$row["TYPE"].'</td>
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
?>
