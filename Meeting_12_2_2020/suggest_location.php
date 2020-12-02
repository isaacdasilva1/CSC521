<?php
session_start();

$servername = "weblab.salemstate.edu";
$dbusername = "mytime";
$dbpassword = "mytime20";
$dbname = "mytime";

$connect = new mysqli($servername, $dbusername, $dbpassword, $dbname);

if ($conn->connect_error) 
{
	echo("database broken or not working");
	die("Connection failed: " . $conn->connect_error);
} 	

//Once the user submits their data.
if(isset($_POST['submit']))
{
	$location_name = $_POST['locationName'];
	$address = $_POST['locationAddress'];
	$city = $_POST['locationCity'];
	$zipcode = $_POST['zipcode'];
	$link = $_POST['link'];
	$category = $_POST['locationType'];
	$state = $_POST['locationState'];
	
	//SQL to add into the db.
	$sql= "INSERT INTO Suggest_Location(address, category, city, link, location_name, state) VALUES (?, ?, ?, ?, ?, ?)";
	$stmt = $connect->prepare($sql);
	$stmt->bind_param("ssssss", $address, $category, $city, $link, $location_name, $state);
	$stmt->execute();
	$stmt->close();
	
	//Redirect the user.
	header("location: thanks.html");
	exit();
}
?>

<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Suggest A Location</title>
</head>
<style> 
	
	/* Attributes for the form itself */		
	#formwrapper {
		padding-top: 100px;
		height: 800px;
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
	
	
	/* CSS code for the menu bar. */
	.menu {
		width: 100%;
		background: black;
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
	.menu ul li {
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
	footer ul {
		text-align: center;
		color: white;
		font-family: "Trebuchet MS", Helvetica, sans-serif;
	}
	footer li {
		list-style-type: none;
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
				<input name="link" type="text" size="75" maxlength="100" placeholder="www.example.com" required>
				<br>
				<label for="locationType">Location category*:</label>
				<select name="locationType" required>
					<option value="Airport: TSA Security">Airport: TSA Security</option>
					<option value="Airport: Airline Ticketing">Airport: Airline Ticketing</option>
					<option value="DMV/RMV">DMV/RMV</option>
					<option value="Store">Store</option>
					<option value="Other">Other</option>
				</select>
				<input type="submit" name="submit">
			</fieldset>
		</form>
	</div>
<footer>
	<hr>
	<ul>
		<li style="color: black;">My Wait Time - 352 Lafayette St, Salem, MA</li>
		<li><a style="text-decoration: none;"href="http://weblab.salemstate.edu/~mytime/Waiting_Time/contact_us.php">Contact Us</a></li>
		<li><a style="text-decoration: none;"href="http://weblab.salemstate.edu/~mytime/Waiting_Time/suggest_location.php">Request A Location</a></li>
	</ul>
</footer>
</body>
</html>