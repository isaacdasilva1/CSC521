<?php
session_start();
ob_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include('Favorites.php');
include('db.php');

//GET variables. 
$request = $_GET['request'];
$user = $_GET['uid'];
$location_id = $_GET['id'];

//Retreive the authorize variable from the db.
$request_token = $_GET['request_token'];
$sql = "SELECT token from ACCOUNT WHERE User_ID ='$user'";
$result = mysqli_query($connect, $sql);
$row = mysqli_fetch_array($result);
$tkn = $row['token'];

if(isset($_SESSION['loggedin']) && $tkn === $request_token && $user === $_SESSION['user_name'])
{
	if($request==="remove")
	{
		$favorites = new Favorites();
		$favorites->remove_favorite($connect, $user, $location_id);
		header("location: location.php?id=$location_id");
		exit();
	}

	if($request==="add")
	{
		$favorites = new Favorites();
		$favorites->add_to_favorites($connect, $user, $location_id);
		header("location: location.php?id=$location_id");
		exit();
	}
	//Update the token.
	$token = rand(10000,1000000);
	$token_hash = hash('md5',$token);
	
	//Add the token to the database 
	$sql = "UPDATE ACCOUNT SET token = '{$token_hash}' WHERE User_ID = ('{$username}')";
	mysqli_query($connect, $sql);
}
else
{
	echo('<br>');
	echo('error');
}

?>