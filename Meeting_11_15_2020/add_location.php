<?php 
session_start();

$servername = "weblab.salemstate.edu";
$dbusername = "mytime";
$dbpassword = "mytime20";
$dbname = "mytime";

$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);
// Check connection
if ($conn->connect_error) 
{
	echo("database broken or not working");
	die("Connection failed: " . $conn->connect_error);
} 	
	
//Double check if the user is already checked, logged in if so, bring the home. 
if(!empty($_SESSION['admin']))
{
	//Create values. 
	$location_name = $zipcode = $address = $state = $city = $link = $location_ID = $category = "";

	if(isset($_POST['submit']))
	{

		$location_name = mysqli_real_escape_string($conn,$_POST['locationName']);
		$address = mysqli_real_escape_string($conn,$_POST['locationAddress']);
		$city = mysqli_real_escape_string($conn,$_POST['locationCity']);
		$zipcode = mysqli_real_escape_string($conn,$_POST['zipcode']);
		$link = mysqli_real_escape_string($conn,$_POST['link']);
		$category = mysqli_real_escape_string($conn,$_POST['locationType']);
		$state = mysqli_real_escape_string($conn,$_POST['locationState']);

		//Create random number for the location ID then check if it's unique.
		$location_ID = rand(1000,1000000);
		$result = mysqli_query($conn, "SELECT * FROM Location WHERE Event_ID = '{$location_ID}'");
		$rows = mysqli_num_rows($result);
		if($rows > 0)
		{
			//If that ID already exits, pick another.
			while($rows > 0)
			{
				$location_ID = rand(1000,1000000);
				$result = mysqli_query($conn, "SELECT * FROM Location WHERE Event_ID = '{$location_ID}'");
				$rows = mysqli_num_rows($result);
			}
		}

		//insert to the database 
		$sql = "INSERT INTO Location (Location_Name, Link, TYPE,Event_ID) VALUES ('{$location_name}','{$link}','{$category}','{$location_ID}')";
		
		//Add into the address table.
		$sql_address = "INSERT INTO Address (City, Address, Zipcode, State) VALUES ('{$city}','{$address}','{$location_ID}','{$zipcode}','{$state}')";
		
		if(mysqli_query($conn, $sql)) 
		{
			header("location: home.php");
			echo "<script>alert('Your new location has been added.');</script>";
		}
		else
			echo "<script>alert('There was an error, try again.');</script>";
	}
}
else{
	echo("Forbidden access.");
	exit;
}
	
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Add Location</title>
</head>
<style> 
	
	/* Attributes for the form itself */		
	#formwrapper {
		padding-top: 100px;
		height: 800px;
		background-color: 5e91f8;
		border: none;
		border-radius: 12px;
		display: block;
		margin: 0 auto;
		width:50%;
	}	
	/* Attributes for the fieldset itself */
	fieldset {
		background-color: transparent;
		border: none;
		padding-bottom: 10px;
		text-align: center;
		border-radius: 12px;
		margin: 0 auto;
		width:50%;
	}
	
	/* Attributes for the form itself*/
	form { 
		width: auto%;
		height: auto;
		border: none;
		margin: 0 auto;
	}
	
	#formwrapper label {
		width: auto;
		font-family: "Trebuchet MS", Helvetica, sans-serif;
		font-size: 18px;
		margin-bottom: 10px;
		margin-left:auto;
		margin-right: auto;
		width: 300px;
		border-radius: 4px;
		height: 27px;
	}
	
	#formwrapper input {
		display: block;
		font-family: "Trebuchet MS", Helvetica, sans-serif;
		font-size:15px;
		margin-left: auto;
		margin-right: auto;
		text-align: left;
		color: black;
		height: 25px;
		border-radius: 4px;
	}
	
	
	/* CSS for the nav. bar */
	.menu {
		width: 100%;
		background:#142b47;
		overflow: auto;
			
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
		width: 170px;
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
	
	.search-bar {
		margin-top: 15px;
		float: right;
		margin-right: 100px;
		
	}
	
	.search-bar input[type=text] {
		padding: 7px;
		border: none;
		font-size: 16px;
		font-family: sans-serif;
		height: 15px;
		padding-top: 10px;
		border-radius: 4px;
		width: 300px;
	}
	
	button {
		float: right;
		background: orange;
		color:white;
		border-radius 0 5px 5px 0;
		cursor: pointer;
		position: relative;
		padding: 7px;
		font-family: sans-serif;
		border:none;
		font-size: 16px;
		padding-top: 15px;
	}
	
	searchlabel {
		float: left;
		font-family: sans-serif;
		color: white;
		padding-top: 10px;
	}
	/* CSS code for the navigation bar ends here. */
	
	
</style>
<body style="background-color: #D8DBDB">
	<nav class ="menu">
		<ul>
			<li><a href ="http://weblab.salemstate.edu/~mytime/Waiting_Time/home.php"> Home</a></li>
		</ul>
		<div class ="search-bar">
			<searchlabel> Find A Location:</searchlabel>
			<input type ="text" placeholder ="Search...">
		</div>
	</nav>
	<div id="formwrapper"> 
		<form action="" method="post">
			<fieldset>
				<label for="locationName">Location Name:*</label>
				<input name="locationName" type="text" size="75" maxlength="100" placeholder="Location Name - SubLocation Name (Optional)"required>
				<label for="locationAddress">Location Address*:</label>
				<br>
				<input name="locationAddress" type="text" size="75" maxlength="100" placeholder="123 Example St" required>
				<label for="locationCity">Location City*:</label>
				<br>
				<input name="locationCity" type="text" size="75" maxlength="100" placeholder="Boston" required>
				<label for="locationState">Location State*:</label>
				<select name="locationState" placeholder="MA"required>
					<option value="AL">Alabama</option>
					<option value="AK">Alaska</option>
					<option value="AZ">Arizona</option>
					<option value="AR">Arkansas</option>
					<option value="CA">California</option>
					<option value="CO">Colorado</option>
					<option value="CT">Connecticut</option>
					<option value="DE">Delaware</option>
					<option value="DC">District Of Columbia</option>
					<option value="FL">Florida</option>
					<option value="GA">Georgia</option>
					<option value="HI">Hawaii</option>
					<option value="ID">Idaho</option>
					<option value="IL">Illinois</option>
					<option value="IN">Indiana</option>
					<option value="IA">Iowa</option>
					<option value="KS">Kansas</option>
					<option value="KY">Kentucky</option>
					<option value="LA">Louisiana</option>
					<option value="ME">Maine</option>
					<option value="MD">Maryland</option>
					<option value="MA">Massachusetts</option>
					<option value="MI">Michigan</option>
					<option value="MN">Minnesota</option>
					<option value="MS">Mississippi</option>
					<option value="MO">Missouri</option>
					<option value="MT">Montana</option>
					<option value="NE">Nebraska</option>
					<option value="NV">Nevada</option>
					<option value="NH">New Hampshire</option>
					<option value="NJ">New Jersey</option>
					<option value="NM">New Mexico</option>
					<option value="NY">New York</option>
					<option value="NC">North Carolina</option>
					<option value="ND">North Dakota</option>
					<option value="OH">Ohio</option>
					<option value="OK">Oklahoma</option>
					<option value="OR">Oregon</option>
					<option value="PA">Pennsylvania</option>
					<option value="RI">Rhode Island</option>
					<option value="SC">South Carolina</option>
					<option value="SD">South Dakota</option>
					<option value="TN">Tennessee</option>
					<option value="TX">Texas</option>
					<option value="UT">Utah</option>
					<option value="VT">Vermont</option>
					<option value="VA">Virginia</option>
					<option value="WA">Washington</option>
					<option value="WV">West Virginia</option>
					<option value="WI">Wisconsin</option>
					<option value="WY">Wyoming</option>
				</select>
				<br>
				<label for="zipcode">Zipcode*:</label>
				<input name="zipcode" type="text" size="5" maxlength="5" required>
				<br>
				<label for="link">Website Link:</label>
				<input name="link" type="text" size="75" maxlength="100" placeholder="www.example.com">
				<br>
				<label for="locationType">Location category*:</label>
				<input name="locationType" type="text" size="20" maxlength="20" placeholder="Airport" required>
				<input type="submit" name="submit">
			</fieldset>
		</form>
	</div>
</body>
</html>
