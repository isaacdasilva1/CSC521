<!doctype html>
<html>
<head>
<script src="jQueryAssets/jquery-1.11.1.min.js"></script>
<script src="jQueryAssets/jquery.ui-1.10.4.button.min.js"></script>
<h2>Come join our team!</h2>
<meta charset="UTF-8">
<title>Untitled Document</title>

</head>


	
<style>
		/* Attributes for the form itself*/
		#formwrapper{
			padding-top: 100px;
			width: 300px;
			height: auto;
			background-color: transparent;
			border: none;
			margin: 0 auto;
			width:500px;
		}	
		
		/* Attributes for the form itself*/
		form{ 
			width: 300px;
			height: auto;
			background-color: white;
			border: none;
		}
		
		/* Attributes for the form itself*/
		fieldset {
			background-color: #f1FBFB;
			border: none;
			padding-bottom: 10px;
			text-align: center
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
			font-size: 20px;
			font-color: green;/*
			margin-top: 5px;
			margin-right: 5px;
			margin-bottom: 5px;
			margin-left: 0px;*/
			margin-left: auto;
			margin-right: auto;
			text-align: center;
			padding-top: 25px;
		}
		
		input{
			width: auto;
			font-size: 18px;
			border: thin solid #6CF;
			margin-bottom: 10px;
			margin-left:auto;
			margin-right: auto;
		}
		
		textarea {
			width: 250px;
			border: thin solid #6CF;
			margin-bottom: 10px;
			display: block;
			margin-left:auto;
			margin-right: auto;
		}
		
		/* Attributes for the submit button. */
		.btn {
			width: 75px;
			height: 35px;
			font-family: "Trebuchet MS", Helvetica, sans-serif;
			color: #FFF;
			font-weight: bold;
			background-color: #6CF;
			/*background-color: transparent;*/
			margin-left: auto;
			margin-right: auto;
			display: block;
			padding-top: 10px;
			cursor: pointer;
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
		
		
	</style>
<body>
	<div id="formwrapper">
	<form action="file.php" method="post">
		<fieldset>
		<h1>By creating an account with us, you will be able to report the waiting times you encounter!</h1>
		<label for="fname">First Name*</label>
		<input name="fname" type="text" size="20" maxlength="100" required>
		<label for="name">Last Name*</label>
		<input name="lname" type="text" size="20" maxlength="100" required>
		<label for="email">Email*</label>
		<input name="email" type="text" size="20" maxlength="100" required>
		<label for="phone">Phone</label>
		<input name="phone" type="tel" size="10" maxlength="13" >
		<label for="dob">Date of Birth* (MM/DD/YYYY)</label>
		<input name="dob" type="text" size="10" maxlength="10" >
		<label for="password">Password*</label>
		<input name="password" type="password" size="20" maxlength="32" id="password" autocomplete="none" required>
		<label for="strength"></label>
		<progress max="100" value="0" id="strength" style="width: 250px"></progress>
		<label for="confirmpassword">Confirm password*</label>
		<input name="confirmpassword" type="password" size="20" maxlength="32" required>
		<label for="gender">Gender</label>
		<select name="gender" id="gender">
			<option value="male">Male </option>
			<option value="female">Female </option>
			<option value="other">Other </option>
		</select>
		<label for="username">Username*</label>
		<input name="username" type="text" size="20" maxlength="20" required>
		<label for="submit"></label>
		<input class="btn buttonshape" name="sumbit" type="submit">
		<label class="loginLabel">Already have an account? Log in here! </label>
	  </fieldset>
		</form>
	</div>
</body>	
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
			var strength = 40;
			
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
			if(password.length > 5)
			{
				strength +=1;	
			}
			
			switch(strength)
			{
				case 0:
					bar.value = 20;
					break;
				case 1:
					bar.value = 40;
					break;
				case 2:
					bar.value = 60;
					break;
				case 3:
					bar.value = 80;
					break;
				case 4:
					bar.value = 100;
					break;
			}
		}
		
	</script>
</html>