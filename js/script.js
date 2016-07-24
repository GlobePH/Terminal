// This example adds a search box to a map, using the Google Place Autocomplete
// feature. People can enter geographical searches. The search box will return a
// pick list containing a mix of places and predicted search terms.

// This example requires the Places library. Include the libraries=places
// parameter when you first load the API. For example:
// <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">
var latVal = 14.553406;
var longiVal = 121.04992259999995;
var data = null;
var idNum = 1;

var map = null;

var TerminalName = '';
function setTerminalName(terminal){
	window.TerminalName = terminal;
}
function getTerminalName(){
	return window.TerminalName;
}

function setLongLat(longi,lati){
	latVal = lati;
	longiVal = longi;
	updateMap();
}

function setData(sentData){
	window.data = sentData;
	
}

function setID(sentidNum){
	window.idNum = sentidNum;
}

function getID(){
	return window.idNum;
}

function getMap(){
	return map;
}

function updateMap(){   
   //alert(latVal);
   map.panTo({lat: parseFloat(latVal), lng: parseFloat(longiVal)});
   
   google.maps.event.addListenerOnce(map, 'bounds_changed', function(event) {
	  if (this.getZoom() < 15 || this.getZoom() > 15) {
		this.setZoom(15);
	  }
	});
   
}

function initAutocomplete( ) {   
 map = new google.maps.Map(document.getElementById('map'), {
  center: {lat: parseFloat(latVal), lng: parseFloat(longiVal)},
  zoom: 9,
  mapTypeId: google.maps.MapTypeId.ROADMAP,
	styles: [
		{stylers: [{ visibility: 'simplified' }]},
		{elementType: 'labels', stylers: [{ visibility: 'off' }]}
	]
});


// Create the search box and link it to the UI element.
var input = document.getElementById('pac-input');
//var searchBox = new google.maps.places.SearchBox(input);
map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);	
	
// Bias the SearchBox results towards current map's viewport.
map.addListener('bounds_changed', function() {
  //searchBox.setBounds(map.getBounds());
});

var markers = [];
}

function addMarker(){
//alert(data);
	var name = "";

	$.each(data, function(index, element) {
		var Lonval = element.Lon;
		var Latval = element.Lat;
		var idNum = element.id;
		
		var terminalName =  element.Name.toString();

		var uluru = {lat: parseFloat(Latval), lng: parseFloat(Lonval)};
		var contentString = '<div id="content">'+
			'<span class="terminal_id"style="display:none;">'+idNum+'</span>' +
			'<div id="siteNotice">'+
			 terminalName +
			'</div>';

		var infowindow = new google.maps.InfoWindow({
		  content: contentString
		});
		
		var bus = "img/terminal2-green.png";

		var marker = new google.maps.Marker({
		  position: uluru,
		  map: map,
		  icon: bus
		});

		marker.addListener('click', function() {
		  infowindow.open(map, marker);
		  setID(idNum);
		  SetUsers(idNum);
		  setTerminalName(terminalName);
		});

		var circle = new google.maps.Circle({
		  map: map,
		  radius: 300,    // 10 miles in metres
		  fillColor: '#AA0000'
		});
		circle.bindTo('center', marker, 'position');
		
	});
	
}
