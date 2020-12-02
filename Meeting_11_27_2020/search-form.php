<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Untitled Document</title>
</head>

<body>
</body>
</html>
<?php
$servername = "weblab.salemstate.edu";
$username = "mytime";
$dbpassword = "mytime20";
$dbname = "mytime";
$conn =  mysqli_connect($servername, $username, $dbpassword, $dbname);

if(mysqli_connect_errno())
{
	echo("Connection failed.");
}
$result = mysqli_query($conn, "select * from Location");
echo"<center>";
echo"<h1>For gods fucking sake help me</h1>";
echo"<h2>this</h2>";
echo"hr/>";
echo"<select id=search_";
echo"<option> == search locations == </option";
while($row = mysqli_fetch_array($result))
{
	echo"<option>$row[Location]</option>";
}
echo"</select>";
echo"</center>";
mysqli_close($conn);

?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css"/>

<script>
	$("search_").chosen();
</script>