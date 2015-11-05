	<?php
	
		session_start();
		if(isset($_SESSION['userName'])) {
		   $response=  "Welcome " . $_SESSION['userName'] . "!";
		}
		
		error_reporting(E_ALL ^ (E_NOTICE | E_WARNING | E_DEPRECATED));

		$db_host = 'localhost';
		$db_user = 'root';
		$db_pwd = '';
		$database = 'project';
		$table = 'events';
		$user_name = $_SESSION['userName'];

		if (!mysql_connect($db_host, $db_user, $db_pwd))
			die("Can't connect to database");

		if (!mysql_select_db($database))
			die("Can't select database");

		// finding the RSO of the user
		$query = "SELECT rso_name FROM members WHERE username='$user_name'";
		$result = mysql_query($query);
		if (!$result) {
			die("Query to show fields from table failed");
		}
		$row = mysql_fetch_array($result, MYSQL_NUM);
		$rso_name = $row[0];
		
		$result2 = mysql_query("SELECT * FROM {$table} WHERE rso_name = '$rso_name'");
		if (!$result2) {
			die("Query to show fields from table failed");
		}
		
		$maps_rows = array();
		while($r = mysql_fetch_assoc($result2)){
			$maps_rows[] = $r;
		}
		$file = fopen("events.json", "w");
		fwrite($file, "data = '");
		fwrite($file, json_encode($maps_rows));
		fwrite($file, "'");
		fclose($file);

?>



<html> 
<head> 
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" /> 
  <title>Google Maps Multiple Markers</title> 
  <script src="http://maps.google.com/maps/api/js?sensor=false" 
          type="text/javascript"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <script type="text/javascript" src="events.json"></script>
<link rel="stylesheet" href="css/bootstrap.css">
<link rel="stylesheet" href="css/main.css">


</head>
<body>
<div class="container" style="text-align:center;">
  <div class="row" style="margin-top:20px">
    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
	<form name="form4" method="post" action="view_single_event.php" style="text-align:center;">
 <h2>View specific event:</h2>
<hr> 
<?php
		$host="localhost"; // Host name 
		$username="root"; // Mysql username 
		$password=""; // Mysql password 
		$db_name="project"; // Database name 
		error_reporting(E_ALL ^ (E_NOTICE | E_WARNING | E_DEPRECATED));
		// Connect to server and select databse.
		mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
		mysql_select_db("$db_name")or die("cannot select DB");
		
		
		$student_name = $_SESSION['userName'];
		
		$sql="SELECT rso_name FROM members WHERE username='$student_name'";
		$result=mysql_query($sql);
		if (!$result) {
			die("Query to show fields from table failed");
		}
		
		$row = mysql_fetch_array($result, MYSQL_NUM);

		$result = mysql_query("SELECT * FROM events WHERE rso_name='$row[0]'");
		if (!$result) {
			die("Query to show fields from table failed");
		}
		$locations = mysql_query("SELECT name, lat, longitude FROM events WHERE rso_name='$row[0]'");
		if (!locations) {
			die("Query to lat and lng");
		}
		$array = array();
		while($row1 = mysql_fetch_array($locations)){
			$array = array_merge($array, $row1);
		}
	?>

	<select name="e_name" id="e_name" class="form-control" onchange="updateMap()" >
	<?php
		while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
	?>

	<option value="<?php echo $line['name'];?>"> <?php echo $line['name'];?> </option>
		 
	<?php
		}
	?>
	</select>

	<script type="text/javascript">
	function updateMap(){
		
		var test = <?php echo json_encode($array); ?>;		
		var x = document.getElementById("e_name").value;
		var i = 0;
		while(test[i] != x){
			i += 3;
		}
		
		var lat = parseFloat(test[i+1]);
		var lng = parseFloat(test[i+2]);
		
		var myLatLng = {lat, lng};
		

  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 14,
    center: myLatLng
  });

  var marker = new google.maps.Marker({
    position: myLatLng,
    map: map,

    title: test[i]
  });
	}</script>
	<hr>
  <div id="map" style="width: 500px; height: 400px; margin:auto;"></div>
  <hr>
  <script type="text/javascript">
    var locations = [];
	var loc = JSON.parse(data);
	document.write("<b> Events: </b><br>");
	
	var counter = 1;
	for (var key in loc) {
		if (loc.hasOwnProperty(key)) {
			var tempArray = [loc[key].name, loc[key].lat, loc[key].longitude, counter];
			locations.push(tempArray);
			counter++;
			document.write(loc[key].name + "<br>");
		}
	}
	

    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 10,
      center: new google.maps.LatLng(28.553677, -81.351903),
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    var infowindow = new google.maps.InfoWindow();
	navigator.geolocation.getCurrentPosition(function(position) {
		 new google.maps.Marker({
					position: new google.maps.LatLng(position.coords.latitude, position.coords.longitude), 
					map: map,
					icon: 'http://maps.google.com/mapfiles/ms/icons/blue-dot.png'
		  });
	});

    var marker, i;

    for (i = 0; i < locations.length; i++) {  
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
        map: map
      });

      google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
          infowindow.setContent(locations[i][0]);
          infowindow.open(map, marker);
        }
      })(marker, i));
    }
  </script>
  <hr>
  <div class="row">
				<div class="col-xs-6 col-sm-6 col-md-6">
					<input type="buton" onclick="window.history.back();" value="Back" class="btn btn-lg btn-success btn-block">
				</div>
				<div class="col-xs-6 col-sm-6 col-md-6">		 
  	<input type="submit" name="Submit" value="View" class="btn btn-lg btn-primary btn-block">
				</div>
			</div>

  </form>
		</div>
	</div>
	</div>
</body>
</html>