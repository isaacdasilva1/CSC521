<?php
session_start();
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Create An Account</title>
</head>
<style>
		/* Attributes for the form itself*/
		#formwrapper{
			padding-top: 100px;
			height: auto;
			background-color: 5e91f8;
			border: none;
			margin-left: 25%;
    		margin-right:25%;
    		width: 50%;
			background-color: white;
			border-radius: 12px;
		}	
		/* Attributes for the form itself*/
		form{ 
			width: 0px;
			height: auto;
			background-color: white;
			border: none;
			margin-left: 25%;
    		margin-right:25%;
		}
		
		/* Attributes for the form itself*/
		fieldset {
			background-color: transparent;
			border: none;
			padding-bottom: 10px;
			text-align: center;
			border-radius: 12px;
			margin-left: 25%;
    		margin-right:25%;
		}
		
		/* Attributes for the header in the form.*/
		h1{
			font-family: Segoe, 'Segoe UI', 'DejaVu Sans', 'Trebuchet MS', Verdana, 'sans-serif';
			font-size: 16px;
			color: black;
		}
		
		/* Attributes for the header on the top of the page.*/
		h2{
			color: blue;
    		text-align: center;
    		font-family: 'Crimson Text', serif;
		}
		
		/*Attributes for the labels in the form*/
		label {
			width:250px;
			display: block;
			font-family: "Trebuchet MS", Helvetica, sans-serif;
			font-size:15px;
			margin-left: auto;
			margin-right: auto;
			text-align: center;
			padding-top: 25px;
			color: black;
		}
		
		input{
			width: auto;
			font-size: 18px;
			border: thin solid #6CF;
			border-color: gray;
			margin-bottom: 10px;
			margin-left:auto;
			margin-right: auto;
			width: 300px;
			border-radius: 4px;
			height: 27px;
		}
		
		textarea {
			width: 250px;
			border: thin solid;
			border-color: gray;
			margin-bottom: 10px;
			display: block;
			margin-left:auto;
			margin-right: auto;
		}
		
		/* Attributes for the submit button. */
		.btn {
			width: 300px;
			height: 35px;
			font-family: "Trebuchet MS", Helvetica, sans-serif;
			color: #FFF;
			font-weight: bold;
			background-color: dodgerblue;
			/* #6CF*/
			/*background-color: transparent;*/
			margin-left: auto;
			margin-right: auto;
			display: block;
			padding-top: 10px;
			cursor: pointer;
			border-color: #5e91f8;
		}
		/* Dimensions for the shape of the button.*/
		.buttonshape {
			border-radius: 12px;
		}
		.loginLabel {
			width:250px;
			display: block;
			font-family: "Trebuchet MS", Helvetica, sans-serif;
			font-size: 14px;
			font-color: green;/*
			margin-top: 5px;
			margin-right: 5px;
			margin-bottom: 5px;
			margin-left: 0px;*/
			margin-left: auto;
			margin-right: auto;
			text-align: center;
			padding-top: 10px;
		}
		/* Shown when the user clicks on the password field */
		#password_status 
		{
			display:none;
			background: white;
			color: #000;
			font-family: Arial, sans-serif;		
			width: 400px;
			length: 100px;
			margin-left: auto;
			margin-right: auto;
			border-color: black;
		}

		#password_status p {
		  	font-size: 12px;
			text-align: left;
			padding-left: 150px;
		}

		/* Green text */
		.met_requirement {
		  	color: green;
		}

		.met_requirement:before {
		  	left: -5px;
		  	content: "✓  ";
		}

		/* Red text */
		.did_not_meet_requirement {
		  	color: red;
		}

		.did_not_meet_requirement:before {
		  	left: -5px;
		  	content: "✘  ";
		}
	
		/* When the user inputs their password; and gets very weak. */
		.very_weak {
			color: darkred;
		}
		/* When the user inputs their password; and gets weak. */
		.weak {
			color: red;
		}
		/* When the user inputs their password; and gets moderate. */
		.moderate {
			color: gray;
		}
		/* When the user inputs their password; and gets secure. */
		.secure {
			color: lightgreen;
		}
		/* When the user inputs their password; and gets very secure. */
		.very_secure {
			color: darkgreen;
		}
		/* Extra links at the bottom of the page. */
		#bottom {
			align-content: center;
			
		}
		.bottom {
			float: center;
			text-align: center;
			color: whitesmoke;
		}
	body{
		background: skyblue;
		margin: 0;
	}
	
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
		width: 100px;
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
		margin-right: 40px;
		
	}
	
	.search-bar input[type=text] {
		padding: 7px;
		border: none;
		font-size: 16px;
		font-family: sans-serif;
		height: 15px;
		padding-top: 15px;
	}
	
	searchlabel {
		float: left;
		font-family: sans-serif;
		color: white;
		padding-top: 10px;
	}
		
	</style>
<body style="background-color: #5e91f8">
	<nav class ="menu">
		<ul>
			<li><a href ="http://weblab.salemstate.edu/~mytime/Waiting_Time/home.html"> Home</a></li>
			<li><a href ="http://weblab.salemstate.edu/~mytime/Waiting_Time/Log_in.html"> Log in</a></li>
		</ul>
		<div class ="search-bar">
			<searchlabel> Find A Location:</searchlabel>
			<input type ="text" placeholder ="Search...">
		</div>
	</nav>
	
	<div id="formwrapper">
	<form action="" method="post"> 
		<fieldset>
		<h1>By creating an account with us, you will be able to report the waiting times you encounter!</h1>
		<label for="fname">First Name*</label>
		<input name="fname" type="text" size="20" maxlength="100" required>
		<label for="lname">Last Name*</label>
		<input name="lname" type="text" size="20" maxlength="100" required>
		<label for="email">Email*</label>
		<input name="email" type="text" size="20" maxlength="100" required>
		<label for="phone">Phone</label>
		<input name="phone" type="text" size="10" maxlength="13" id="phone" onBlur="phonenumber()" onfocusout ="validateAllFeilds()" placeholder="1234567890"required>
		<label for="dob">Date of Birth*</label>
		<input name="dob" type="text" size="10" maxlength="10" placeholder="MM/DD/YYYY" onBlur="validateDOB()" id="dob" onfocusout ="validateAllFeilds()"required>
		<span id="dateError"></span>
		<label for="password">Password*</label>
		<input name="password" type="password" size="20" maxlength="32" id="password" autocomplete="none" onBlur="passwordVerify()" onBlur ="validateAllFeilds()" required>
		<label for="strength">Password Strength</label>
		<label id="strength_comment" ></label>
		<progress max="100" value="0" id="strength" style="width: 250px"></progress>
		<div id="password_status" class="buttonshape">
		  <h3>Password Requirements:</h3>
		  <p id="letters" class="did_not_meet_requirement">A <b>lowercase</b> letter</p>
		  <p id="capital_letters" class="did_not_meet_requirement">An <b>unpercase</b> letter</p>
		  <p id="numbers" class="did_not_meet_requirement">A <b>number</b></p>
		  <p id="password_length" class="did_not_meet_requirement">Minimum <b>8 characters</b></p>
		</div>
		<label for="confirmpassword">Confirm password*</label>
		<input name="confirmpassword" type="password" size="20" maxlength="32" id="confirmpassword" onBlur="passwordVerify()" onfocusout ="validateAllFeilds()"required>
		<label for="gender">Gender</label>
		<select name="gender" id="gender">
			<option value="male">Male </option>
			<option value="female">Female </option>
			<option value="other">Other </option>
		</select>
		<label for="username">Username*</label>
		<input name="username" type="text" size="20" maxlength="20" required>
		<label for="submit"></label>
		<input class="btn buttonshape" name="submit" type="submit" value="submit" id="submit">
		<label class="loginLabel">Already have an account? Log in here! </label>
	  </fieldset>
		</form>
	</div>
	<br><br><br><br><br><br>
	<hr style="width:90%; text-align:center; color: whitesmoke"> <br>
	<div id = "bottom">
		<p class="bottom">Contact Us</p>
		<p class="bottom">About Us</p>
		<p class="bottom">How It Works</p>
		<p class="bottom">352 Lafayette St, Salem, MA 01970</p>
	</div>
	
</body>	
	
	<?php
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
	if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)
	{
    	header("location: home.php");
    	exit;
	}	
	
	//Create the variables with it's error counterpart. 
	$fname = $lname = $email = $phone = $dob = $username ="";
		if(isset($_POST['submit']))
		{
			//Obtain all the information from the log in form.
			$fname = mysqli_real_escape_string($conn,$_POST['fname']);
			$lname = mysqli_real_escape_string($conn,$_POST['lname']);
			$email = mysqli_real_escape_string($conn,$_POST['email']);
			$phone = mysqli_real_escape_string($conn,$_POST['phone']);
			$dob = mysqli_real_escape_string($conn,$_POST['dob']);
			$username = mysqli_real_escape_string($conn,$_POST['username']);	
			$gender = mysqli_real_escape_string($conn,$_POST['gender']);
			$password = mysqli_real_escape_string($conn,$_POST['password']);
			
			//Check if the email is already used by finding the amount of rows. 
			$check_email = mysqli_query($conn, "SELECT * FROM ACCOUNT WHERE Email = '{$email}'");
			$rows = mysqli_num_rows($check_email);
			if($rows > 0)
			{
				$email_exist = true;
				echo "<script>alert('This email is already associated with an account. Try again.');</script>";
			}
			
			//Reset rows. 
			$rows = 0;
			
			//Check if the username is already used by finding the amount of rows. 
			$check_username = mysqli_query($conn, "SELECT * FROM ACCOUNT WHERE User_ID = '{$username}'");
			$rows = mysqli_num_rows($check_username);
			if($rows > 0)
			{
				$username_exist = true;
				echo "<script>alert('This username is already associated with an account. Try again.');</script>";
			}
			
			//Reset rows.
			$rows = 0;
			
			//Check if the phone number is already taken.
			$check_username = mysqli_query($conn, "SELECT * FROM ACCOUNT WHERE Phone_num = '{$phone}'");
			$rows = mysqli_num_rows($check_username);
			if($rows > 0)
			{
				$phone_number_exist = true;
				echo "<script>alert('A phone number is associated with an account. Try again.');</script>";
			}
			
			if(preg_match("/^[a-zA-Z ]*$/", $fname)&&
			   preg_match("/^[a-zA-Z ]*$/", $lanme)&&
			   filter_var($email, FILTER_VALIDATE_EMAIL)&&
			   preg_match("/^[0-9]{10}+$/", $phone))
			{
				 $password_enc = password_hash($password, PASSWORD_BCRYPT);
				 $password_enc = trim($password_enc);
				 echo($password);
				 $sql = "INSERT INTO ACCOUNT (First_Name, Last_Name, Gender, User_ID, Email, Phone_num, dob, PASSWORD) VALUES ('{$fname}', '{$lname}', '{$gender}', '{$username}','{$email}', '{$phone}', '{$dob}','{$password_enc}')";
			 }
		    
			if (mysqli_query($conn, $sql)) 
			{
  				echo "<script>alert('Record has been added successfully!');</script>";
			} 
			else 
			{
  				echo "Error: " . $sql . "<br>" . mysqli_error($conn);
				echo "<script>alert('Record has NOT been added successfully!');</script>";
			}
		}
	?>
	<script>
		var password = document.getElementById("password");
		var letter = document.getElementById("letters");
		var capital = document.getElementById("capital_letters");
		var number = document.getElementById("numbers");
		var length = document.getElementById("password_length");

		/* Status of the password check shows up once user clicks on the textfield. */
		password.onfocus = function() {
		  document.getElementById("password_status").style.display = "block";
		}

		/* Status of the password disappears when the user clicks outside of the box. */
		password.onblur = function() {
		  document.getElementById("password_status").style.display = "none";
		}

		// When the user starts to type something inside the password field
		password.onkeyup = function() 
		{
			 // met_requirementate lowercase letters
			 var lowerCaseLetters = /[a-z]/g;
			 if(password.value.match(lowerCaseLetters)) 
			 { 
				letter.classList.remove("did_not_meet_requirement");
				letter.classList.add("met_requirement");
			 } 
			 else 
			 {
				letter.classList.remove("met_requirement");
				letter.classList.add("did_not_meet_requirement");
			 }
		
		  // met_requirementate capital letters
		  var upperCaseLetters = /[A-Z]/g;
		  if(password.value.match(upperCaseLetters)) { 
			capital.classList.remove("did_not_meet_requirement");
			capital.classList.add("met_requirement");
		  } else {
			capital.classList.remove("met_requirement");
			capital.classList.add("did_not_meet_requirement");
		  }

		  // met_requirementate numbers
		  var numbers = /[0-9]/g;
		  if(password.value.match(numbers)) 
		  { 
			number.classList.remove("did_not_meet_requirement");
			number.classList.add("met_requirement");
		  } else 
		  {
			number.classList.remove("met_requirement");
			number.classList.add("did_not_meet_requirement");
		  }

		  // met_requirementate length
		  if(password.value.length >= 8) 
		  {
			console.log(password.value.length);
			length.classList.remove("did_not_meet_requirement");
			length.classList.add("met_requirement");
		  } else
			{
			length.classList.remove("met_requirement");
			length.classList.add("did_not_meet_requirement");
		  }
		}

	</script>
	<script type="text/javascript">
		/*Script responsible for checking password strength by user and the status bar. */
		var password = document.getElementById("password")
		password.addEventListener('keyup', function()
		{
			passWordChecker(password.value);
		})
		/* Function for testing the strength of the password. */
		function passWordChecker(password)
		{
			var bar = document.getElementById("strength");
			var comment = document.getElementById("strength_comment");
			var strength = 0;
			
			//Check if the password has letters, numbers.
			if(password.match(/[a-zA-Z0-9][a-zA-Z0-9]+/))
			{
				strength +=1;
			}
			if(password.match(/[~<>?]+/))
			{
				strength+=1;
			}
			if(password.match(/[!@$%^&*()]+/))
			{
				strength +=1;
			}
			if(password.length > 8)
			{
				strength +=1;	
			}
			switch(strength)
			{
				case 0:
					bar.value = 0;
					comment.innerHTML = "Very Weak";
					comment.classList.add("very_weak");
					//Remove all others
					comment.classList.remove("weak");
					comment.classList.remove("moderate");
					comment.classList.remove("secure");
					comment.classList.remove("very_secure");
					break;
				case 1:
					bar.value = 40;
					comment.innerHTML = "Weak";
					comment.classList.add("weak");
					//Remove all others
					comment.classList.remove("very_weak");
					comment.classList.remove("moderate");
					comment.classList.remove("secure");
					comment.classList.remove("very_secure");
					break;
				case 2:
					bar.value = 60;
					comment.innerHTML = "Moderate";
					comment.classList.add("moderate");
					//Remove all others
					comment.classList.remove("very_weak");
					comment.classList.remove("weak");
					comment.classList.remove("secure");
					comment.classList.remove("very_secure");
					break;
				case 3:
					bar.value = 80;
					comment.innerHTML = "Secure";
					//Remove all others
					comment.classList.remove("very_weak");
					comment.classList.remove("moderate");
					comment.classList.remove("weak");
					comment.classList.remove("very_secure");
					comment.classList.add("secure");
					break;
				case 4:
					bar.value = 100;
					comment.innerHTML = "Very Secure";
					//Remove all others
					comment.classList.remove("weak");
					comment.classList.remove("moderate");
					comment.classList.remove("secure");
					comment.classList.remove("very_secure");
					comment.classList.add("very_secure");
					break;
			}
		}
	</script>
	<script type="text/javascript">
		function validateDOB()
		{
			var errorMessage = "";
			var errorMessage = document.getElementById("dateError").value;
			var date = document.getElementById("dob").value;
			
			//The ranges of the dates. 
			var ranges = /((0[1-9]|1[0-2])\/((0|1)[0-9]|2[0-9]|3[0-1])\/((19|20)\d\d))$/;
			
			if(ranges.test(date))
			{
				var splitDate = date.split("/");
				var month = splitDate[0];
				var day = splitDate[1];
				var year = splitDate[2];
				
				var userDOB = new Date(month + "/" + day + "/" + year);
				var todaysDate = new Date();

				//If the size of the tex is less than 10 characters
				var userDOBtoString = userDOB.toDateString();
				
				if(userDOBtoString.length < 10)
				{
					alert("Invalid date");
					return false;
				}
				if (todaysDate.getFullYear() - userDOB.getFullYear() < 10) 
				{
					alert("Invalid date over 10.");
					//errorMessage.innerHTML = "Eligibility is 10 years of age."
                	return false;
				}
				//If the month is Feb, check for a leap year.
				if(userDOB.getMonth() == 2)
				{
					if(userDOB.getFullYear % 4 == 0) //Check if it is a leap year.
					{
						if(userDOB.getDay > 29) //Check if there are more than 29 days
						{
							return false;
							alert("Invalid date.");
						}
					}
				}
				
				//Check for Sept, April, June, November that days are not over 
				if(userDOB.getMonth != 9 || userDOB.getMonth != 4 || userDOB.getMonth != 6 || userDOB.getMonth != 11 || userDOB.getMonth !=2)
				{
					if(userDOB.getDay > 30)
					{
						return false;
						alert("Invalid date.");
					}
				}
				//errorMessage.innerHTML = "";
				return true;
            }	
			else 
			{
				//errorMessage.innerHTML = "Enter birthdate in MM/DD/YYYY format to continue";
				alert("Invalid date; use mm/dd/yyyy");
				return false;
			}
		}

	//Check to see if the phone number is valid or not.
	function phonenumber()
	{
		var phoneNumber = document.getElementById("phone").value;
  		var phoneno = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
		
		//toString just in case.
		phoneNumber = phoneNumber.toString();
		var lengthOfPhoneNumber = phoneNumber.length;
		
		//Check to see if this number is valid.
  		if((phoneNumber.match(phoneno) || lengthOfPhoneNumber >= 10))
      		return true;
      	else
        {
        	alert("Invalid phone number");
        	return false;
        }
	}
	
	//Check to see if the passwords are the same or not.
	function passwordVerify()
	{		
		var password = document.getElementById("password").value;
		var confirmPassword = document.getElementById("confirmpassword").value;
		
		if(password.localeCompare(confirmPassword)!=0)
		{
			alert("Passwords do not match.");	
			console.log("passwords do not match.");
			return false;
		}
		else
			return true;
	}
	
	/* Validate all of the fields, if any of the fields are not valid
	do not let the user create a account, or let them. */
	function validateAllFeilds()
	{
		if(!passwordVerify() || !phonenumber() || !validateDOB())
		{
			document.getElementById("submit").disabled = true;
			document.getElementById("submit").style.cursor = "not-allowed";
			console.log("this function was called to enter if.");
		}
		else 
		{
			document.getElementById("submit").disabled = false;
			document.getElementById("submit").style.cursor = "grabbing";	
			console.log("this function was called to enter else.");
		}
		console.log("this function never went trhough .");
	}
	</script>
</html>

