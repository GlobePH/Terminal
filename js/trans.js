
function addMarkerUsers(data){
//alert(data);
	var name = "";

	$.each(data, function(index, element) {
		
		var Lonval = element.Lon;
		var Latval = element.Lat;
		
		var uluru = {lat: parseFloat(Latval), lng: parseFloat(Lonval)};
		
		var contentString = '<div id="content">'+
			'<span class="terminal_id"style="display:none;">'+element.Username+'</span>' +
			'<div id="siteNotice">'+
			element.Username.toString() +
			'</div>';

		var infowindow = new google.maps.InfoWindow({
		  content: contentString
		});

		
		var picimg = "img/users.png";

		var marker = new google.maps.Marker({
		  position: uluru,
		  map: map,
		  icon: picimg,
		  title: element.Username
		});

		marker.addListener('click', function() {
		  infowindow.open(map, marker);
		  setID(idNum);
		  SetUsers();
		});
		
	});
	
}


function SetUsers(idNum){
	$.ajax({
	type: "GET",
	url: "http://192.168.166.243/terminal/dataUser/" + idNum,
	async: true, //blocks window closes
	success: function(data){
		alert(data);
		querySuccess(data);
	},
	error: queryError
	});

	function queryError(){
		alert("Error Encountered!");
	}
	function querySuccess(data){

		addMarkerUsers(data);
	}
}