<?php
session_start();
ob_start();
/*
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/
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
			height: auto;
			border: none;
			border-radius: 12px;
		}	
		/* Attributes for the form itself*/
		form{ 
			padding-top: 5%;
			width: 50%;
			height: auto;
			background-color: transparent;
			border: thin;
			margin-left: 25%;
			margin-right: 25%;
		}
		
		/* Attributes for the form itself*/
		fieldset {
			background-color: white;
			border: none;
			padding-bottom: 10px;
			text-align: center;
			border-radius: 12px;
			
		
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
			margin-left: auto;
			margin-right: auto;
			display: block;
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
		background: black;
		overflow: auto;
			
	}
	body {
		margin: 0;
		background: #5e91f8; 
	}
	
	.menu ul {
		margin: 0;
		padding: 0;
		list-style: none;
		line-height: 60px;
	}
	
	.menu li {
		float: left;
	}
	
	.menu ul li a{
		background: 142b47;
		width: 200px;
		text-decoration: none;
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
<body style="background-color: #5e91f8">
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Sansita+Swashed:wght@900&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	
	
	<nav class ="menu">
		<a style="font-family: 'Sansita Swashed', cursive; display: flex;
			justify-content: center;; color: aliceblue; font-size: 30px;">My Wait Time</a>
		<ul>
			<?php
			if(isset($_SESSION['user_name'])) 
			{ 
				ob_start();
				header("location: home.php");
				exit();
				
			}
			else if(isset($_SESSION['admin']))
			{
				ob_start();
				header("location: home.php");
				exit();
			}
			else {
				echo('<li><a href ="http://weblab.salemstate.edu/~mytime/Waiting_Time/Log_in.php"> Log in</a></li>');
				echo('<li><a href ="http://weblab.salemstate.edu/~mytime/Waiting_Time/Create_Account.php"> Create An Account</a></li>'); 
				echo('<li><a href ="http://weblab.salemstate.edu/~mytime/Waiting_Time/home.php">Home</a></li>');
				//
			}
			?>
		</ul> 
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
		<label class="loginLabel" href >Already have an account? Log in <a href="http://weblab.salemstate.edu/~mytime/Waiting_Time/Log_in.php">here</a>! </label>
	  </fieldset>
		</form>
	</div>
	<footer>
	<hr>
	<ul>
		<li>My Wait Time - 352 Lafayette St, Salem, MA</li>
		<li><a style="text-decoration: none;"href="http://weblab.salemstate.edu/~mytime/Waiting_Time/contact_us.php">Contact Us</a></li>
		<li><a style="text-decoration: none;"href="http://weblab.salemstate.edu/~mytime/Waiting_Time/suggest_location.php">Request A Location</a></li>
	</ul>
</footer>	
</body>	
	
	<?php
	$servername = "weblab.salemstate.edu";
	$dbusername = "mytime";
	$dbpassword = "mytime20";
	$dbname = "mytime";
	
	$connect = new mysqli($servername, $dbusername, $dbpassword, $dbname);
	
	//Check the connection
	if($connect->connect_error)
	{
		die("error: " .$connect->connect_error);
	}
	
	//initialize the boolean flags. 
	$phone_number_exist = false; $email_exist = false; $username_exist = false;
	
	if(isset($_POST['submit']) && !$phone_number_exist && !$email_exist && !$username_exist)
	{
		//Ret. all the variables. 
		//Obtain all the information from the log in form.
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$email = $_POST['email'];
		$phone = $_POST['phone'];
		$dob = $_POST['dob'];
		$username = $_POST['username'];	
		$gender = $_POST['gender'];
		$password = $_POST['password'];

		//check if the email is already used.
		//************************************
		$sql = "SELECT * FROM ACCOUNT WHERE Email = ?";
		$stmt = $connect->prepare($sql);
		$stmt->bind_param("s", $email);
		$stmt->execute();
		$result = $stmt->get_result();

		if($result->num_rows > 0)
		{
			$email_exist = true;
			echo "<script>alert('This email is already associated with an account. Try again.');</script>";
		}

		//check if the phone_num is already used.
		//************************************
		$sql = "SELECT * FROM ACCOUNT WHERE Phone_num = ?";
		$stmt = $connect->prepare($sql);
		$stmt->bind_param("s", $phone);
		$stmt->execute();
		$result = $stmt->get_result();

		if($result->num_rows > 0)
		{
			$phone_number_exist = true;
			echo "<script>alert('This number is already associated with an account. Try again.');</script>";
		}

		//check if the username is already used.
		//************************************
		$sql = "SELECT * FROM ACCOUNT WHERE User_ID = ?";
		$stmt = $connect->prepare($sql);
		$stmt->bind_param("s", $username);
		$stmt->execute();
		$result = $stmt->get_result();

		if($result->num_rows > 0)
		{
			$phone_number_exist = true;
			echo "<script>alert('This number is already associated with an account. Try again.');</script>";
		}
		
		if(preg_match("/^[a-zA-Z ]*$/", $fname)&&
			   preg_match("/^[a-zA-Z ]*$/", $lanme)&&
			   filter_var($email, FILTER_VALIDATE_EMAIL)&&
			   preg_match("/^[0-9]{10}+$/", $phone))
			{
				 $password_enc = password_hash($password, PASSWORD_BCRYPT);
				 $password_enc = trim($password_enc);
			
				//prepare to do the statement. 
				$stmt = $connect->prepare("INSERT INTO ACCOUNT (First_Name, Last_Name, Gender, User_ID, Email, Phone_num, dob, PASSWORD) VALUES(?,?,?,?,?,?,?,?)");
				$stmt->bind_param("ssssssss", $fname, $lname, $gender, $username, $email, $phone, $dob, $password_enc);
				$stmt->execute();
				$result = $stmt->get_result();
				$stmt->close();
			
				ob_start();
				header("location: Log_in.php?tkn=success");
				exit();
				
			
			}
		$stmt->close();
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
			
			//If the user hasn't inserted anything yet; html wont load anyway - just ignores error msg.
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
			
			else if(date.length == 0)
					return true;
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
  		if(phoneNumber.match(phoneno) || lengthOfPhoneNumber >= 10)
      		return true;
      	
		else if(phoneNumber.length == 0)
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
			console.log("user error detected: passwords do not match.");
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
		}
		else 
		{
			document.getElementById("submit").disabled = false;
			document.getElementById("submit").style.cursor = "pointer";	
		}

	 }
	</script>
</html>

