<?php
session_start();
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>You Have Been Logged Out</title>
</head>
<?php
	//Delete all the variables in the session.
	session_unset();
	
	//Destroy the session. 
	session_destroy();
?>
	<p>You have been logged out. Click <a href=http://weblab.salemstate.edu/~mytime/Waiting_Time/home.php>here</a> to go back home. OR close this window for security purposes.</p>
	<script>
    history.pushState(null, null, null);
    window.addEventListener('popstate', function () {
        history.pushState(null, null, null);
    });
		
		function noBack(){window.history.forward();}
		noBack();
		window.onload=noBack;
		window.onpageshow=function(evt){if(evt.persisted)noBack();}
		window.onunload=function(){void(0);}
</script>
<body>
</body>
</html>