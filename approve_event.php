<?php

	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "project";
	
	$event_approval=$_POST['event_approval'];

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
	
	$sql="UPDATE publicevent SET approved='1' WHERE name='$event_approval'";
	$result=mysql_query($sql);
	
	if(!$result) {
		echo "Error";
	} else {
		echo "Event approved successfully";
	}
	
	header("location:login_admin.php");
?>