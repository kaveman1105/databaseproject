<?php
	session_start();
	if(isset($_SESSION['userName'])) {
	  $response= "Welcome " . $_SESSION['userName'] . "!";
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


</head>
<body>
<div class="container" style="text-align:center;">
  <div class="row" style="margin-top:20px" >
    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">

	<h2><?php echo $response ?></h2>
	<fieldset>
		<hr class="colorgraph">
        <div class="form-group">
		<form name="form1" method="post" action="create_university_page.php">
			<input type="submit" name="Submit" value="Create University" class="btn btn-lg btn-warning btn-block" >
		</form>
		</div>
		<hr>
        <div class="form-group">
		    <form name="form2" method="post" action="approve_events_page.php">
			<input type="submit" name="Submit" value="Approve Events" class="btn btn-lg btn-info btn-block">
		</form>
		</div>
		<hr>
		<div class="form-group">
		<form name="form3" method="post" action="logout.php">
				<input type="submit" value="Logout" class="btn btn-lg btn-danger btn-block" >	

				</div>
		<hr class="colorgraph">
  
	</div>
	</div>
	</fieldset>
	</div>
	</div>
	</div>

	</body>
</html>
