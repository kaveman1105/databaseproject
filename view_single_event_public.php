
<?php	
	$public_event=$_POST['pub_name'];
	session_start();
	$_SESSION['public_event_name'] = $public_event;
	$_SESSION['event_name'] = $public_event;

	$host="localhost"; // Host name 
	$username="root"; // Mysql username 
	$password=""; // Mysql password 
	$db_name="project"; // Database name 
	error_reporting(E_ALL ^ (E_NOTICE | E_WARNING | E_DEPRECATED));
	// Connect to server and select databse.
	mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
	mysql_select_db("$db_name")or die("cannot select DB");

	// Selecting all events with the users university
	$result = mysql_query("SELECT username, date, comment FROM comments WHERE event_name='$public_event'");
	if (!$result) {
		die("Query to show fields from table failed");
	}
	$result2 = mysql_query("SELECT * FROM publicevent WHERE name='$public_event'");
	if (!$result2) {
		die("Query to show fields from table failed");
	}
	
	$maps_rows = array();
	while($r = mysql_fetch_assoc($result2)){
		$maps_rows[] = $r;
	}
	$file = fopen("public_event.json", "w");
	fwrite($file, "data = '");
	fwrite($file, json_encode($maps_rows));
	fwrite($file, "'");
	fclose($file);
	$fields_num = mysql_num_fields($result);

	echo "<table border='1'><tr>";
	// printing table headers
	for($i=0; $i<$fields_num; $i++)
	{
		$field = mysql_fetch_field($result);
		echo "<td>{$field->name}</td>";
	}
	echo "</tr>\n";
	// printing table rows
	while($row = mysql_fetch_row($result))
	{
		echo "<tr>";

		// $row is array... foreach( .. ) puts every element
		// of $row to $cell variable
		foreach($row as $cell)
			echo "<td>$cell</td>";

		echo "</tr>\n";
	}

	
	mysql_free_result($result);
?>
<html> 
<head> 
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" /> 
  <title>Google Maps Multiple Markers</title> 
  <script src="http://maps.google.com/maps/api/js?sensor=false" 
          type="text/javascript"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <script type="text/javascript" src="public_event.json"></script>
</head> 
<body>
	<div class="fb-share-button" data-href="what" data-layout="button_count"></div>
	<div id="map" style="width: 500px; height: 400px;"></div>
<br>
	<script type="text/javascript">
		var locations = [];
		var loc = JSON.parse(data);
		
		var counter = 1;
		for (var key in loc) {
			if (loc.hasOwnProperty(key)) {
				var tempArray = [loc[key].name, loc[key].latitude, loc[key].longitude, counter];
				locations.push(tempArray);
				counter++;
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
		document.write("<b>Name: </b>" + loc[0].name + "<br>");
		document.write("<b>Description: </b>" + loc[0].description + "<br>");
		document.write("<b>Date: </b>" + loc[0].date + "<br>");
		document.write("<b>Time: </b>" + loc[0].time + "<br>");
		document.write("<b>Contact Phone: </b>" + loc[0].phone + "<br>");
		document.write("<b>Contact Email: </b>" + loc[0].email + "<br>");
		document.write("<b>Event Rating: </b>" + loc[0].rating + "<br>");
	</script>
	<!-- Facebook functionality script -->
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) return;
		js = d.createElement(s); js.id = id;
		js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3";
		fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script>
	<form name="form1" method="post" action="rate_event_public.php">
		<br>Rate the event: 
		<select name="rating" id="rating">
			  <option value="1">1</option>
			  <option value="2">2</option>
			  <option value="3">3</option>
			  <option value="4">4</option>
			  <option value="5">5</option>
		</select>
		<input type="submit" name="Submit" value="Rate">
	</form>
	<br><br>
	<form name="form2" method="post" action="post_comment.php">
		<textarea rows="6" cols="50" name="comment" id="comment"></textarea><br>
		<input type="submit" name="Submit" value="Post Comment">
	</form>
	<br><br>
</body>
</html>

