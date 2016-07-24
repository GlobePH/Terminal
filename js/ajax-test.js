
<!-- 
//Browser Support Code
var ajaxRequest;  // The variable that makes Ajax possible!
	
try{
	// Opera 8.0+, Firefox, Safari
	ajaxRequest = new XMLHttpRequest();
} catch (e){
	// Internet Explorer Browsers
	try{
		ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
	} catch (e) {
		try{
			ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
		} catch (e){
			// Something went wrong
			alert("Your browser broke!");
			return false;
		}
	}
}

function selectdata(){
	var first = document.getElementById('first').value;
	var last = document.getElementById('last').value;
	var queryString = "?first=" + first + "&last=" + last;
	ajaxRequest.open("GET", "selectdata.php" + queryString, true);
	ajaxRequest.send(null);
}


// Create a function that will receive data sent from the server
ajaxRequest.onreadystatechange = function(){
	if(ajaxRequest.readyState == 4){
		var ajaxDisplay = document.getElementById('display');
		ajaxDisplay.innerHTML = ajaxRequest.responseText;
	}
}

var i = 0;
function sleep(){
	i=i+1;
	setTimeout(sleep,100);
	selectdata();
}
sleep();		
//-->
	