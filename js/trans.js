
function addMarkerUsers(data){
//console.log(data);
	var name = "";

	$.each(data, function(index, element) {
		
		var Lonval = element.Lon;
		var Latval = element.Lat;
		

		var uluru = {lat: parseFloat(Latval), lng: parseFloat(Lonval)};
		
		var contentString = '';
		if (element.IsDriver==1) {
			contentString = '<div id="content">'+
			'<span class="Car_ID"style="display:none;">'+element.Username+'</span>' +
			'<div id="vehicleDetails">'+
				element.Username.toString() +
			'</div><hr />'+
			'<a href="#"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Report</a> | ' +
			'<a href="#"><span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span> Tip</a>';
		}else{
			contentString = '<div id="content">'+
			'<span class="User_ID"style="display:none;">'+element.Username+'</span>' +
			'<div id="userDetails">'+
				element.Username.toString() +
			'</div><hr />'+
			'<div><b>Mood:<i class="em em-satisfied"></i></b></div>';			
		}


		var infowindow = new google.maps.InfoWindow({
		  content: contentString
		});

		var picimg='';

		if (element.IsDriver==1){
			picimg = "img/car-icon.png";
		}else{
			picimg = "img/users.png";
		}

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
	url: "http://192.168.171.204/terminal/dataUser/" + idNum,
	async: true, //blocks window closes
	success: function(data){
		console.log(data);
		querySuccess(data);
	},
	error: queryError
	});

	function queryError(){
		console.log("Error Encountered!");
	}
	function querySuccess(data){

		addMarkerUsers(data);
	}
}
