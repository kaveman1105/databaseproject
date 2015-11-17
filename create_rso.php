<?php
	session_start();
	if(isset($_SESSION['userName'])) {
	  echo "Please create your RSO, " . $_SESSION['userName'] . "!";
	}
	$admin_name = $_SESSION['userName'];
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "project";
	
	$rso_name=$_POST['rso_name']; 
	error_reporting(E_ALL ^ (E_NOTICE | E_WARNING | E_DEPRECATED));
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
	
	// Insert the new RSO, set the user as admin
	$sql="INSERT INTO rso (rid, name, admin) VALUES (NULL, '$rso_name', '$admin_name')";
	
	if ($conn->query($sql) === TRUE) {
		echo "RSO created successfully";
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
	
	// Update the users rso to the new RSO
	$sql="UPDATE members SET rso_name='$rso_name' WHERE username='$admin_name'";
	
	if ($conn->query($sql) === TRUE) {
		echo "RSO created successfully";
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
	
	// Turn the user into an admin
	$sql="UPDATE members SET user_level='2' WHERE username='$admin_name'";
	
	if ($conn->query($sql) === TRUE) {
		echo "RSO created successfully";
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
	
	$conn->close();
	header("location:login_admin.php");
?>