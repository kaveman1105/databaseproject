
<?php
	session_start();
	if(isset($_SESSION['userName'])) {
	  echo "Select the RSO you'd like to join,  " . $_SESSION['userName'] . "!";
	}
	
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "project";
	$member_name = $_SESSION['userName'];
	
	$rso=$_POST['myrsoid']; 
	error_reporting(E_ALL ^ (E_NOTICE | E_WARNING | E_DEPRECATED));
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
	
	$sql="UPDATE members SET rso_name='$rso' WHERE username='$member_name'";
	
	if ($conn->query($sql) === TRUE) {
		echo "Joined RSO successfully!";
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
	$conn->close();
	header("location:login_student.php");
?>
<html>
<br>
</html>