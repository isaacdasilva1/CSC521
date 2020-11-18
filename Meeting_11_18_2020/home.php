<?php 
	session_start();
	?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>My Wait Time</title>
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
</head>
<style>
	body {
		margin: 0;
		background: skyblue; 
	}
	
	/* Background gradient. */
	#gradient_background {
        background: rgb(55,163,8);
        background: linear-gradient(13deg, rgba(55,163,8,1) 0%, rgba(83,0,255,1) 100%, rgba(0,212,255,1) 100%);		
		
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
		padding-top: 10px;
	}
	
	/* CSS Code for the slideshow */
	/* Slides, images container. */
	.slides {
		display: none;
	}
	img {
		vertical-align: middle;
		border: 5px solid #eee;
	}
	.slide-container {
		max-width: 40%;
		padding-top: 80px;
		margin-left: 15%;
	}
	
	/* The captions on each of the pictures of the slideshow. */
	.text slide-container {
		color: #A5ABAE;
		font-family: 'Open Sans', sans-serif;
		font-size: 15px;
		/*padding: 8px 12px;*/
		position: absolute;
		bottom: 0px;
		width: 100%;
		text-align: center;
	}
		
	/* Fading animation 
	   Source: https://www.w3schools.com/howto/howto_js_slideshow.asp
	*/
	.fade {
	  -webkit-animation-name: fade;
	  -webkit-animation-duration: 1.5s;
	  animation-name: fade;
	  animation-duration: 1.5s;
	}

	@-webkit-keyframes fade {
	  from {opacity: .4} 
	  to {opacity: 1}
	}

	@keyframes fade {
	  from {opacity: .4} 
	  to {opacity: 1}
	}
	/* For smaller screens only... */
	@media only screen and (max-width: 300px) {
		.text {font-size: 11px}
	}
	
	/* For the user to search for a location, which then brings them to the location page. 
	.search_location {
		max-width: 40%;
		padding-top: 80px;
		margin-right: 15%;
	}
	
	.search_location text {
		color: #A5ABAE;
		font-family: 'Open Sans', sans-serif;
		font-size: 1000px;
		position: left;
		bottom: 0px;
		width: 100%;
		text-align: right;
	}
	
	.button search_location {
		width: 300px;
		height: 35px;
		font-family: "Trebuchet MS", Helvetica, sans-serif;
		color: #FFF;
		font-weight: bold;
		background-color: transparent;
		margin-left: auto;
		margin-right: auto;
		display: block;
		padding-top: 10px;
		cursor: pointer;
		border-color: #5e91f8;
	}
	
	.textarea search_location {
		width: 250px;
		border: thin solid;
		border-color: gray;
		margin-bottom: 10px;
		display: block;
		/*margin-left:auto;
		margin-right: 10%;
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
	*/
	h1 {
    	text-align:center;
		font-family: "Trebuchet MS", Helvetica, sans-serif;
	}
</style>
<style type="text/css">
    body{
        font-family: Arail, sans-serif;
h    }
    /* Formatting search box */
    .search-box{
        width: 300px;
        position: relative;
        display: inline-block;
        font-size: 14px;
    }
    .search-box input[type="text"]{
        height: 32px;
        padding: 5px 10px;
        border: 1px solid #CCCCCC;
        font-size: 14px;
    }
    .result{
        position: absolute;        
        z-index: 999;
        top: 100%;
        left: 0;
    }
    .search-box input[type="text"], .result{
        width: 100%;
        box-sizing: border-box;
    }
    /* Formatting result items */
    .result p{
        margin: 0;
        padding: 7px 10px;
        border: 1px solid #CCCCCC;
        border-top: none;
        cursor: pointer;
    }
    .result p:hover{
        background: #f2f2f2;
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
			if (!empty($_SESSION['user_name'])) 
			{ 
				$name = $_SESSION['user_name'];
				echo "<li><a href=\"http://weblab.salemstate.edu/~mytime/Waiting_Time/account.php\">$name</a></li>";
				echo('<li><a href ="http://weblab.salemstate.edu/~mytime/Waiting_Time/logout.php">Log out</a></li>');
			}
			else if(!empty($_SESSION['admin']))
			{
				echo "<li><a href=\"http://weblab.salemstate.edu/~mytime/Waiting_Time/account.php\">Admin</a></li>";
				echo('<li><a href ="http://weblab.salemstate.edu/~mytime/Waiting_Time/logout.php">Log out</a></li>');
				
				echo('<li><a href ="http://weblab.salemstate.edu/~mytime/Waiting_Time/add_location.php">Add location</a></li>');
				
			}
			else {
				echo('<li><a href ="http://weblab.salemstate.edu/~mytime/Waiting_Time/Log_in.php"> Log in</a></li>');
				echo('<li><a href ="http://weblab.salemstate.edu/~mytime/Waiting_Time/Create_Account.php"> Create An Account</a></li>'); 
				
			}
			?>
			
		</ul> 
		
	</nav>
	<div id="gradient_background">
		<div  class="container">
			<h1 style="color: white;" text-align="center;">Search For A Location</h1>
   		<br />
   			<div class="form-group">
    			<div style="width: 50%; margin: 0 auto;" class="input-group">
     			<span class="input-group-addon">Search</span>
     			<input type="text" name="search_text" id="search_text" placeholder="(Example: Logan International Airport)" class="form-control" />
    		</div>
   		</div>
   		<br />
   		<div style="border-color: white"id="result"></div>
  		</div>
		<div class= "slide-container">
			<div class= "slides fade">
				<img src="monitor.JPG" style="width:100%">
				<div class = "text " style="font-family: 'Open Sans', sans-serif; color: whitesmoke;">Breeze your way through the airport worry-free by keeping up with airport wait times.</div>
			</div>
			<div class="slides fade">
				<img src="wing.jpg" style="width:100%">
				<div class = "text " style="font-family: 'Open Sans', sans-serif; color: whitesmoke;">Get to your get-a-way worry-free.</div>
			</div>	
		</div>
		<br>
		<div style="text-align:center">
			<span class="picture_selection"></span>
			<span class="picture_selection"></span>
		</div>
		<div class="search_location">
			<div class ="text">_</div>
		</div>
	</div>
	<script>
		var index = 0;
		slideshow();
		
		/* Javascript function puts everything together to traverse the pictures. */
		function slideshow()
		{
			var i;
			var slides = document.getElementsByClassName("slides");
			var dots = document.getElementsByClassName("picture_selection");
			
			for(i=0; i < slides.length; i++)
				slides[i].style.display = "none";
			index++;
			
			if(index > slides.length)
				index = 1;
			
			for(i = 0; i < dots.length; i++)
				dots[i].className = dots[i].className.replace(" active","");
			
			slides[index-1].style.display = "block";
			dots[index-1].className += " active";
			setTimeout(slideshow, 7000);
		}
		
	</script>
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
</script>
