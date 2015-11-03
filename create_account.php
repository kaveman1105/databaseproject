
<?php

	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "project";
	
	$myusername=$_POST['myusername']; 
	$mypassword=$_POST['mypassword']; 
	$myemail=$_POST['myemail'];
	$myuni=$_POST['myuniversity'];
	error_reporting(E_ALL ^ (E_NOTICE | E_WARNING | E_DEPRECATED));
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
	
	$sql="INSERT INTO members (username, password, email, user_level, university) VALUES ('$myusername', '$mypassword', '$myemail', '1', '$myuni')";
	
	if ($conn->query($sql) === TRUE) {
		$response="Account created successfully";
	} else {
		$response= "Error: " . $sql . "<br>" . $conn->error;
	}
	$conn->close();
?>
<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>COP4710</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/main.css">
<body >
	<div class="container">
	<div style="padding: 15% 10%; text-align: center;">
	<div class="panel panel-primary"  >
    <div class="panel-heading">
        <h1 class="panel-title">Account Creation</h1>
    </div>
    <div class="panel-body">
		<h3><?php echo $response ?></h3>

	</div>
	</div>
	<a class="btn btn-primary"  style="width:70%; padding: 1.5% 0%;" role="button" href="main_login.php"> Back to login page </a>
	</div>
	</div>
</body>
</html>