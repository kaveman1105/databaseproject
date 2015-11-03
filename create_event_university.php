
<?php

	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "project";
	
	$event_name=$_POST['event_name'];
	$event_description=$_POST['event_description']; 
	$event_time=$_POST['event_time'];
	$event_date=$_POST['event_date'];
	$event_phone=$_POST['event_phone'];
	$event_email=$_POST['event_email'];
	$event_university=$_POST['event_university'];
	$event_lat=$_POST['us2-lat'];
	$event_long=$_POST['us2-long'];

	// Create connection
	//$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	//if ($conn->connect_error) {
	//	die("Connection failed: " . $conn->connect_error);
	//} 
	$host="localhost"; // Host name 
	$username="root"; // Mysql username 
	$password=""; // Mysql password 
	$db_name="project"; // Database name 
	error_reporting(E_ALL ^ (E_NOTICE | E_WARNING | E_DEPRECATED));
	// Connect to server and select databse.
	mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
	mysql_select_db("$db_name")or die("cannot select DB");
	
	$sql="SELECT uid FROM university WHERE name='$event_university'";
	$result=mysql_query($sql);
	$row = mysql_fetch_array($result, MYSQL_NUM);
	
	$sql="INSERT INTO events (eid, uid, name, category, description, time, date, phone, email, lat, longitude) VALUES (NULL, '$row[0]', '$event_name', '1', '$event_description', '$event_time', '$event_date', '$event_phone', '$event_email', '$event_lat', '$event_long')";
	$result=mysql_query($sql);
	
	if(!$result) {
		echo "Error";
	} else {
		echo "Event created successfully";
	}
	
	header("location:login_admin.php");
?>