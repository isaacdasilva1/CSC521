# Meeting October 21, 2020

## Assigned Tasks For Next Meeting
- When the user creates an account, verify that the user cannot enter garbage information.
	- EX: Can't enter "10" for DOB when expecting format such 10/10/2000
- When a user signs up, make sure info is sent to the DB and it can be retrieved on account.php

## Problems Occurred Prior To Meeting. 
I did not really know nor understood how to run HTML and PHP together to show the information on the database using HTML/CSS and whatnot. 

## Problem Solutions
I learned that one can implement an ```php echo();``` statement that includes HTML. I was able to use this to include database data with HTML! 

```php
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
```
## Contributing
Author: Isaac Da Silva
Advisor: Dr. Fatema Nafa

## License
www.weblab.salemstate.edu
