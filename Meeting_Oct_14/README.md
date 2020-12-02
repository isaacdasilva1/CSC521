# Meeting October 14, 2020

During this meeting, the design of the HTML documents were looked at and discussed. 

## Assigned Tasks For Next Meeting
- Link all navigation bar buttons to the designated webpages (HTML)
## Problems Occurred Prior To Meeting. 

Issue regarding the javascript code not executing the password checker correctly and not displaying the status bar. 

## Problem Solutions
```javascript
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
```

## Usage


## Contributing
Author: Isaac Da Silva
Advisor: Dr. Fatema Nafa

## License
www.weblab.salemstate.edu
