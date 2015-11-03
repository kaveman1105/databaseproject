<?php
	session_start();
	if(isset($_SESSION['userName'])) {
		$response= "Hello " . $_SESSION['userName'] . "!";
	}

	error_reporting(E_ALL ^ (E_NOTICE | E_WARNING | E_DEPRECATED));
?>

<html>
	<head>
		<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
		<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?language=us"></script>
		<script src="http://rawgit.com/Logicify/jquery-locationpicker-plugin/master/dist/locationpicker.jquery.js"></script>
		<link rel="stylesheet" href="css/bootstrap.css">
		<link rel="stylesheet" href="css/main.css">
	</head>
	<body>
	<div class="container" style="text-align:center;">
		<h2><?php echo $response ?></h2>
		<div class="row" style="margin-top:20px" >
			<div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
			<hr>
				<h3> Events awaiting approval:</h3>
				<form name="form1" method="post" action="approve_event.php">
				<fieldset>
			<?php			
				$servername = "localhost";
				$username = "root";
				$password = "";
				$dbname = "project";
				$student_name = $_SESSION['userName'];
				mysql_connect("$servername", "$username", "$password")or die("cannot connect"); 
				mysql_select_db("$dbname")or die("cannot select DB");
				$query = "SELECT * FROM publicevent WHERE approved IS NULL";
				$result = mysql_query($query);
			?>
			
			<select name="event_approval" id="event_approval" class="form-control">
			<option value="" disabled selected>Events Approval</option>

			
			<?php
				while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
			?>
			
			<option value="<?php echo $line['name'];?>"> <?php echo $line['name'];?> </option>
				 
			<?php
				}
			?>			
			</select>
			<hr>
		<div class="row" style="margin-bottom: 20px;">
            <div class="col-xs-6 col-sm-6 col-md-6">
				<input type="button" value="Back"   onclick="window.history.back();"  class="btn btn-lg btn-success btn-block" >	
            </div>
			 <div class="col-xs-6 col-sm-6 col-md-6"> 
		<input type="submit" name="Submit" value="Approve" class="btn btn-lg btn-primary btn-block" >
	</div>  
	</div>
				</fieldset>
				</form>
			</div>
		</div>
	</div>
	</body>
	
</html>