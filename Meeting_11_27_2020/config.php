<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Untitled Document</title>
</head>
<?php
	$databaseHost = 'weblab.salemstate.edu';
	$databaseName = 'mytime';
	$databaseUsername = 'mytime';
	$databasePassword = 'mytime20';
 	$db = mysqli_connect('weblab.salemstate.edu','mytime','mytime20','mytime')
 	or die('Error connecting to MySQL server... Sorry!');
 	$mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName); 
?>
<body>
</body>
</html>