
<?php

	$host="localhost"; // Host name 
	$username="root"; // Mysql username 
	$password=""; // Mysql password 
	$db_name="project"; // Database name 
	$tbl_name="members"; // Table name 
	error_reporting(E_ALL ^ (E_NOTICE | E_WARNING | E_DEPRECATED));
	// Connect to server and select databse.
	mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
	mysql_select_db("$db_name")or die("cannot select DB");

	// username and password sent from form 
	$myusername=$_POST['myusername']; 
	$mypassword=$_POST['mypassword']; 

	// To protect MySQL injection (more detail about MySQL injection)
	$myusername = stripslashes($myusername);
	$mypassword = stripslashes($mypassword);
	$myusername = mysql_real_escape_string($myusername);
	$mypassword = mysql_real_escape_string($mypassword);
	$sql="SELECT * FROM $tbl_name WHERE username='$myusername' and password='$mypassword'";
	$result=mysql_query($sql);

	// Mysql_num_row is counting table row
	$count=mysql_num_rows($result);

	// If result matched $myusername and $mypassword, table row must be 1 row
	if($count==1){
		
		// Find the level of the user
		$sql="SELECT user_level FROM $tbl_name WHERE username='$myusername' and password='$mypassword'";
		$result=mysql_query($sql);
		$row = mysql_fetch_array($result, MYSQL_NUM);
		session_start();
		$_SESSION['userName'] = $myusername;
		
		// 1 = student
		// Serve the student page
		if ($row[0] == 1) {
			header("location:login_student.php");
		}
		// 2 = admin
		// Serve the admin page
		else if ($row[0] == 2) {
			header("location:login_admin.php");
		}
		// 3 = super admin
		// serve the super admin page
		else if ($row[0] == 3) {
			header("location:login_superadmin.php");
		}
	}
	else {
		$response="Wrong Username or Password";
	}
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
	<div class="panel panel-danger"  >
    <div class="panel-heading">
        <h1 class="panel-title">Error</h1>
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