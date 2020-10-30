<?php 
	session_start();
	?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>My Wait Time</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

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
	
	/* For the user to search for a location, which then brings them to the location page. */
	.search_location {
		max-width: 40%;
		padding-top: 80px;
		margin-right: 15%;
	}
	
	.search_location text {
		color: #A5ABAE;
		font-family: 'Open Sans', sans-serif;
		font-size: 1000px;
		position: absolute;
		bottom: 0px;
		width: 100%;
		text-align: center;
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
		margin-left:auto;
		margin-right: auto;
	}
	
	
</style>

<body>
	
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Sansita+Swashed:wght@900&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script type="text/javascript">
	function searchq() 
	{
		var search_txt = $("input[name='search']").val();
		if(search_txt != "")
		{
			$.post("search.php", {searchVal: search_txt}, function(output)
			{
				//Verify that the whats being typed in the keyboard is what is popping up.
				console.log(output);
				$("#output").html(output); 
			});
		}
		else
		{
			$("#output").html("");		
		}
	}
	</script>
	
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
			else
			{
				echo('<li><a href ="http://weblab.salemstate.edu/~mytime/Waiting_Time/Log_in.php"> Log in</a></li>');
				echo('<li><a href ="http://weblab.salemstate.edu/~mytime/Waiting_Time/Create_Account.php"> Create An Account</a></li>'); 
			}
			?>
			
		</ul> 
		<form action="index.php" method="post">
			<searchlabel> Find A Location. . .</searchlabel>
			<input type ="text" placeholder="(ex: Boston, MA)" name="search" onkeydown="searchq();">
			<div id="output">
		</div>
		</form>
		
	</nav>
	<div id="gradient_background">
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
