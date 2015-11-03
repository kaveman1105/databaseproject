
<?php

	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "project";
	
	$university_name=$_POST['university_name']; 
	$university_description=$_POST['university_description']; 
	$university_nostudents=$_POST['university_nostudents']; 
	error_reporting(E_ALL ^ (E_NOTICE | E_WARNING | E_DEPRECATED));
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
	
	$sql="INSERT INTO university (uid, name, description, number_students) VALUES (NULL, '$university_name', '$university_description', '$university_nostudents')";
	
	if ($conn->query($sql) === TRUE) {
		echo "University created successfully";
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
	$conn->close();
	header("location:login_superadmin.php");
?>