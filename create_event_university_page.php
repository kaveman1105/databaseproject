<?php
	session_start();
	if(isset($_SESSION['userName'])) {
	  $response = "Please create your event: <br> " . $_SESSION['userName'];
	}

	error_reporting(E_ALL ^ (E_NOTICE | E_WARNING | E_DEPRECATED));

?>
	

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>COP4710</title>
<meta name="description" content="">
<meta name="viewport" content="width=device-width">
<link rel="stylesheet" href="css/bootstrap.css">
<link rel="stylesheet" href="css/main.css">

		<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
		<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?language=us"></script>
		<script src="http://rawgit.com/Logicify/jquery-locationpicker-plugin/master/dist/locationpicker.jquery.js"></script>
	</head>
<body>
<div class="container" style="text-align:center;">
  <div class="row" style="margin-top:20px" >
    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
	<form name="form1" method="post" action="create_event_university.php" style="text-align:center;">
	<fieldset>
	<h2><?php echo $response ?></h2>
		<br>

		<hr>
		<h3>Please select the location of the event: </h3>
		<hr>
		Location: <input type="text" id="us2-address" style="width: 200px"/>
		Radius: <input type="text" id="us2-radius"/>
		<br>
		<br>
		<div id="us2" style="width: 500px; height: 400px; margin: auto;"></div>	
		<br>		
		Lat.: <input type="text" id="us2-lat" name="us2-lat"/>
		Long.: <input type="text" id="us2-lon" name="us2-long"/><br><br>
		<script>$('#us2').locationpicker({
			location: {latitude: 28.538598, longitude: -81.386236},	
			radius: 300,
			inputBinding: {
				latitudeInput: $('#us2-lat'),
				longitudeInput: $('#us2-lon'),
				radiusInput: $('#us2-radius'),
				locationNameInput: $('#us2-address')
			}
			});
		</script>	
	          		<hr><h3>Create Event</h3><hr>
		<div class="form-group">
		<input name="event_name" type="text" placeholder="Event Name"  id="event_name" class="form-control input-lg">
		</div>
		<div class="form-group">
		<input name="event_description" type="text" placeholder="Description" id="event_description" class="form-control input-lg">
		</div>
		<div class="form-group">
			<input name="event_time" type="text" placeholder="Time" id="event_time" class="form-control input-lg">
		</div>
		<div class="form-group">
		<input name="event_date" type="text" placeholder="Date" id="event_date" class="form-control input-lg">
		</div>
		<div class="form-group">
		<input name="event_phone" type="text" placeholder="Contact Phone" id="event_phone" class="form-control input-lg">
		</div>
		<div class="form-group">
		<input name="event_email" type="text" placeholder="Contact Email" id="event_email" class="form-control input-lg">
		</div>
		 <div class="dropdown">
		<?php
			$servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "project";
			mysql_connect("$servername", "$username", "$password")or die("cannot connect"); 
			mysql_select_db("$dbname")or die("cannot select DB");
			$query = "SELECT * FROM university";
			$result = mysql_query($query);
		?>
		
		<select name="event_university" id="event_university" class="form-control" >
		<option value="" disabled selected> University</option>

		
		<?php
			while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
		?>
		
		<option value="<?php echo $line['name'];?>"> <?php echo $line['name'];?> </option>
			 
		<?php
			}
		?>		
		</select>
		</div>
		<hr>
 <div class="row" style="margin-bottom: 20px;">
            <div class="col-xs-6 col-sm-6 col-md-6">
              <input type="button"  value="Back" onclick="window.history.back();" class="btn btn-lg btn-success btn-block">
            </div>
			 <div class="col-xs-6 col-sm-6 col-md-6"> 
              <input type="submit" name="Submit" value="Create" class="btn btn-lg btn-primary btn-block">
	</div>
		
		
	   </fieldset>
	</form>
  
	</div>
	</div>
	</fieldset>
	</div>
	</div>
	</div>

	</body>
</html>
