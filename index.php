
<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Terminal.ph</title>

<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js'></script>	
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

<link rel="stylesheet" type="text/css" href="css/sidebar.css">
    <style>
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #map {
        height: 100%;
      }
      .controls {
        margin-top: 120px;
        border: 1px solid transparent;
        border-radius: 2px 0 0 2px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        height: 32px;
        outline: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
      }

      #pac-input {
        background-color: #fff;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        margin-left: 12px;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        width: 300px;
		position:fixed;
		top:10px;
		left:50px;
      }

      #pac-input:focus {
        border-color: #4d90fe;
      }

      .pac-container {
        font-family: Roboto;
      }

      #type-selector {
        color: #fff;
        background-color: #4d90fe;
        padding: 5px 11px 0px 11px;
      }

      #type-selector label {
        font-family: Roboto;
        font-size: 13px;
        font-weight: 300;
      }
      #target {
        width: 345px;
      }
    </style>

<script type='text/javascript'>
$(document).ready(function () {
  var trigger = $('.hamburger'),
      overlay = $('.overlay'),
     isClosed = false;

    trigger.click(function () {
      hamburger_cross();      
    });

    function hamburger_cross() {

      if (isClosed == true) {          
        overlay.hide();
        trigger.removeClass('is-open');
        trigger.addClass('is-closed');
        isClosed = false;
      } else {   
        overlay.show();
        trigger.removeClass('is-closed');
        trigger.addClass('is-open');
        isClosed = true;
      }
  }
  
  $('[data-toggle="offcanvas"]').click(function () {
        $('#wrapper').toggleClass('toggled');
  });  
});
</script>
</head>

<body style="background-color:white; color:#3763ff; font-family: 'Lato',serif;">
  <div id="wrapper">
       <div class="overlay"></div>
    
        <!-- Sidebar -->
        <nav class="navbar navbar-inverse navbar-fixed-top" id="sidebar-wrapper" role="navigation">
            <ul class="nav sidebar-nav">
                <li class="sidebar-brand">
                    <a href="#">
                       Brand
                    </a>
                </li>
                <li>
					<link href="https://afeld.github.io/emoji-css/emoji.css" rel="stylesheet">

					<script type="text/javascript">
					var addFeed = {
					     init: function () {
					          addFeed.elemBind();
					     },
					     add: function () {
					          var dataparam = {
					               TerminalId     : $("#terminalId").val(),
					               Message   : $("#message").val()
					          };
					          $.ajax({
					                type: 'POST',
					                async: true,
					                url: "http://192.168.171.134/feed/add",
					                data: dataparam,
					                success: function (data) {
					                    //alert("already add");
					                    $("#message").val("");
					                },
					                error: function () {
					                    alert("An error occurred while trying to retrieve your data.", "error");
					                }
					          });

					     },
					     addMessageByText: function (message) {
					          var dataparam = {
					               TerminalId     : $("#terminalId").val(),
					               Message   : message
					          };
					          $.ajax({
					                type: 'POST',
					                async: true,
					                url: "http://192.168.171.134/feed/add",
					                data: dataparam,
					                success: function (data) {
					                    //alert("already add");
					                    $("#message").val("");
					                },
					                error: function () {
					                    alert("An error occurred while trying to retrieve your data.", "error");
					                }
					          });

					     },
					        elemBind:function(){
					          $("#addFeed").click(function() {
					               addFeed.add();
					          });
					          $("#btnhappy").click(function() {
					               addFeed.addReaction(0);
					          });
					          $("#btnangry").click(function() {
					               addFeed.addReaction(1);
					          });
					        },
					     addReaction: function (reactionId) {
					          var dataparam = {
					               ReactionId : reactionId,
					               TerminalId : $("#terminalId").val()
					          };

					            $.ajax({
					                type: 'POST',
					                async: true,
					                url: "http://192.168.171.134/transaction/reaction/add",
					                data: dataparam,
					                success: function (data) {
					                    if (reactionId == 0) {
					                         addFeed.addMessageByText("Boom - is feeling happy.");
					                    };
					                    if (reactionId == 1) {
					                         tweet = $("#message").val();
					                         addFeed.addMessageByText(tweet + " - is feeling angry.");
					                    };
					                    
					                },
					                error: function () {
					                    alert("An error occurred while trying to retrieve your data.", "error");
					                }
					            });
					   }
					};   
					$( document ).ready(function() {
					     addFeed.init();
					});
					</script>                    
					<div id="feed" style="padding:10px;">

						<script type="text/javascript">
							var TerminalDetail = function (){
								var id = window.idNum.toString();
								//$("#terminalId").val(id);
								var xurl = "http://192.168.171.134/terminal/";
								var param = 'data/' + id;
								var t = xurl + param;
								$.ajax({
									type: "GET",
									url: t,
									data: [],
									async: true, //blocks window close
									success: function(data)
									{
										querySuccess(data);
									},
									error: queryError
								});

								function queryError(){
									alert("Error Encountered!");
								}
								function querySuccess(data){
									var feeds = "";
									$.each(data, function(index, element) {
										feeds += '<div style="width:100%;"><div class="thumbnail"><div class="caption">';
										feeds += '<h3>Terminal Name</h3>';
										feeds += '<p><b>Status: ' + getStatus(element.Count) +'</b></p><p><b style="color:blue;">Statistics</b></p>';
										feeds += '<p><b>Satisfied: '+ element.NoOfHappy.toString() +' <i class="em em-satisfied"></i> | Angry: '+ element.NoOfAngry.toString() + ' <i class="em em-angry"></i></b></p>';
										feeds += '</div></div></div>';
									});
									$('#terminaldetails').html(feeds);
								}	
							}
							function getStatus(count)
							{
								console.log("test"+count);
								if (count <= 5) {
									return "Light";
								};
								if (count >= 6 && count <= 50) {
									return "Moderate";
								};
								if (count >= 51) {
									return "Heavy";									
								};
							}							
						</script>
						<div id="terminaldetails">

						</div>

					     <h3>Feed</h3>
					     <div>
					          <input type="hidden" id="terminalId" value="1">
					          <input type="text" name="review" id="message" class="form-control" placeholder="Write a review">
					          <button id="addFeed" class="btn btn-info">Publish</button>

					          <button id="btnhappy" class="btn btn-default"><i class="em em-satisfied"></i></button>
					          <button id="btnangry" class="btn btn-default"><i class="em em-angry"></i></button>

					     </div><br />
     				<div>
         				<script type="text/javascript">
						$( document ).ready(function() {
							reloadFeed();
							TerminalDetail();
						});

						var reloadFeed = function (){
							var id = window.idNum.toString();
							$("#terminalId").val(id);
							console.log(id);
							var xurl = "http://192.168.171.134/";
							var param = 'feed/' + id;
							var t = xurl + param;
							$.ajax({
								type: "GET",
								url: t,
								data: [],
								async: true, //blocks window close
								success: function(data)
								{
									querySuccess(data);
								},
								error: queryError
							});

							function queryError(){
								alert("Error Encountered!");
							}
							function querySuccess(data){
								var feeds = "";
								$.each(data, function(index, element) {
									feeds += '<div style="width:100%;"><div class="thumbnail"><div class="caption">'
									feeds += '<h4 id="feed"><img src="http://enadive.com/wp-content/uploads/2016/01/blank-avatar2.jpg" height="50" width="50" style="border-radius:50px;"> ' + element.Message.toString() + '</h4>';
									feeds += '<p><small><i id="date">' + element.DateTime.toString() + '</i></small></p>'
									feeds += '</div></div></div>';
								});
								$('#feeds').html(feeds);
							}	
						}
						</script>
						<input type="hidden" id="C_TerminalID" value="0">
						<script type="text/javascript">
						    window.setInterval(function () {
						        reloadFeed();
						        TerminalDetail();
						    }, 1000);
						</script>
						<div id="feeds">
						</div> 
						</div>
					</div>
                </li>
            </ul>
        </nav>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                            	<nav class="navbar navbar-default navbar-fixed-top" style="background-color:white; font-family: 'Lato',serif;">
								  <div class="container-fluid">
								    <!-- Brand and toggle get grouped for better mobile display -->
								    <div class="navbar-header">

								      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
								        <span class="sr-only">Toggle navigation</span>
								        <span class="icon-bar"></span>
								        <span class="icon-bar"></span>
								        <span class="icon-bar"></span>
								      </button>

								      <button type="button" class="navbar-toggle collapsed" data-toggle="offcanvas" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">Feed</button>

								      <a class="navbar-brand" href="#" style="color:#3763ff"><strong>Terminal</strong></a>
								    </div>

								    <!-- Collect the nav links, forms, and other content for toggling -->
								    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
								      <ul class="nav navbar-nav">
								        <li><a data-toggle="offcanvas" href="#" style="color:#3763ff"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Feed<span class="sr-only">(current)</span></a></li>
								        <li><a href="#" style="color:#3763ff"><span class="glyphicon glyphicon-modal-window" aria-hidden="true"></span> Nearby Terminal</a></li>
								      </ul>
								      <ul class="nav navbar-nav navbar-right">
								        <li><a href="#" style="color:#3763ff"> About</a></li>
								        <li><a href="#" style="color:#3763ff"> How to Use</a></li>
								      </ul>
								    </div><!-- /.navbar-collapse -->
								  </div><!-- /.container-fluid -->
								</nav>          
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->
			
	<!--<input id="pac-input" class="controls" type="text" placeholder="Search Box">-->
	<input list="browsers" id="pac-input" class="controls" placeholder="Search Box">

	
	<datalist id="browsers">
	
	</datalist>
	
    <div id="map"></div>
	
	<!-- Map Icons -->
	<!--<link rel="stylesheet" type="text/css" href="css/bootflat.css">-->

	<script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/script.js"></script>
    <!--<script type="text/javascript" src="js/ajax-test.js"></script>-->
	<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyDWTNzyHPeLKkTj2f--_bd-kP5ji_6e3lk&libraries=places&callback=initAutocomplete&sensor=false"
         async defer></script>
	<script type="text/javascript">
		var sendData = "aaaa";
	
		 function GetProfile(){
			$.ajax({
			type: "GET",
			//url: "http://192.168.1.100/terminal/search/all",
			url: "js/data.json",
			async: true, //blocks window closes
			success: function(data){
				querySuccess(data);
			},
			error: queryError
			});

			function queryError(){
				alert("Error Encountered!");
			}
			function querySuccess(data){
				//var obj = $.parseJSON(data);
				var name = "";

				/*$.each(obj,function(key,val){
					name+=val.Name;			
				});*/
				//var name = jQuery.parseJSON(JSON.stringify(data));
				sendData = data;
				$.each(data, function(index, element) {
					var Lonval = element.Lon;
					var Latval = element.Lat;
					
					name += '<option data-value2="' + Lonval + '" data-value3="' + Latval + '" value="' + element.Name.toString() + '">';
				});
				$('#browsers').html(name);
				setData(data);
			}
		}
		
		
		$(document).ready(function(){
				GetProfile();
				window.setTimeout(function  () {
					addMarker();
				}, 3000);
		});	
		
		$("#pac-input").on('input', function () {
			var val = $('#pac-input').val();
			
			var value2 = $('#browsers option').filter(function() {
				return this.value == val;
			}).data('value2');
			
			var value3 = $('#browsers option').filter(function() {
				return this.value == val;
			}).data('value3');
			
			var msg = value2 ? 'Longitude=' + value2 + ", Latitue=" + value3: 'No Match';
			//alert(msg);
			
			if(isNaN(parseFloat(value2))==false && isNaN(parseFloat(value2))==false){
				setLongLat(parseFloat(value2), parseFloat(value3));
			}
		});
	</script>							

  </body>
</html>