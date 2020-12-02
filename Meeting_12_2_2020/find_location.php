<?php
session_start();

//Connect to the database. 
require('db.php');


?>

<!doctype html> 
<html>
<head>
<meta charset="UTF-8">
<title>Find A Location</title>
</head>
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> 
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
	<script type="text/javascript">
		$(document).ready(function()
		{
			$('.search-box input[type="text"]').on("keyup input", function(){
				/* Get input value on change */
				var inputVal = $(this).val();
				var resultDropdown = $(this).siblings(".result");
				if(inputVal.length){
					$.get("searchdb2.php", {term: inputVal}).done(function(data){
						// Display the returned data in browser
						console.log(data);
						resultDropdown.html(data);
					});
				} else{
					resultDropdown.empty();
				}
			});

			// Set search input value on click of result item
			$(document).on("click", ".result p", function(){
				$(this).parents(".search-box").find('input[type="text"]').val($(this).text());
				$(this).parent(".result").empty();
			});
		});
	</script>
<style>
	body {
		margin: 0;
		background: skyblue; 
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
		cursor: not-allowed;
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
	}
	*{
    margin:0;
    padding:0;
}
	h1 {
    	text-align: center;
		font-family: "Trebuchet MS", Helvetica, sans-serif;
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
echo('<li><a href ="http://weblab.salemstate.edu/~mytime/Waiting_Time/home.php">Home</a></li>');
				
			}
			else if (!empty($_SESSION['user_name'])) 
			{ 
				$name = $_SESSION['user_name'];
				echo "<li><a href=\"http://weblab.salemstate.edu/~mytime/Waiting_Time/account.php\">$name</a></li>";
				echo('<li><a href ="http://weblab.salemstate.edu/~mytime/Waiting_Time/logout.php">Log out</a></li>');
				echo "<li><a href=\"http://weblab.salemstate.edu/~mytime/Waiting_Time/find_location.php\">Find A Location</a></li>";
echo('<li><a href ="http://weblab.salemstate.edu/~mytime/Waiting_Time/home.php">Home</a></li>');
			}
			
			else 
			{
				echo('<li><a href ="http://weblab.salemstate.edu/~mytime/Waiting_Time/Log_in.php"> Log in</a></li>');
				echo('<li><a href ="http://weblab.salemstate.edu/~mytime/Waiting_Time/Create_Account.php"> Create An Account</a></li>'); 
				echo "<li><a href=\"http://weblab.salemstate.edu/~mytime/Waiting_Time/find_location.php\">Find A Location</a></li>";
echo('<li><a href ="http://weblab.salemstate.edu/~mytime/Waiting_Time/home.php">Home</a></li>');
				
			}			?>
			
		</ul> 
		
	</nav>
	<h1 style="color: white; text-align: center;">Search For A Location</h1>
	<br><br><br>
	<div  class="container">
   		<div class="form-group" style="padding: 0px; line-height: 0px;">
    		<div style="width: 50%; margin: 0 auto; line-height: 0px;" class="input-group">
     			<span class="input-group-addon">Search</span>
     			<input type="text" name="search_text" id="search_text" placeholder="(Example: Logan International Airport)" class="form-control">
    		</div>
   		<div style="border-color: black; background-color: white; width: 50%; margin: 0 auto; border-radius: 4px;"id="result"></div>
  	</div>
	<br><br><br>
	<h2 style="color: white; text-align: center;">Can't find the location you're looking for? Suggest it and we'll try to post it!</h2>

<footer>
	<hr>
	<ul>
		<li>My Wait Time - 352 Lafayette St, Salem, MA</li>
		<li><a style="text-decoration: none;"href="http://weblab.salemstate.edu/~mytime/Waiting_Time/contact_us.php">Contact Us</a></li>
		<li><a style="text-decoration: none;"href="http://weblab.salemstate.edu/~mytime/Waiting_Time/suggest_location.php">Request A Location</a></li>
	</ul>
</footer>
		
</body>
</html>
<script>
$(document).ready(function(){

 load_data();

 function load_data(query)
 {
	$.ajax({
	url:"searchdb2.php",
   	method:"POST",
   	data:{query:query},
   	success:function(data)
   {
    	$('#result').html(data);
   }
  });
 }
 $('#search_text').keyup(function(){
  var search = $(this).val();
  if(search != '')
  {
   	load_data(search);
  }
  else
  {
   	load_data();
  }
 });
});
	//photo attribute <a href="https://www.freepik.com/vectors/food">Food vector created by macrovector - www.freepik.com</a>
</script>
