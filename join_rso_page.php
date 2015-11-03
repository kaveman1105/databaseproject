<?php
	session_start();
	if(isset($_SESSION['userName'])) {
	  $response= "Select the RSO you'd like to join:  " . $_SESSION['userName'] ;
	}
	
	error_reporting(E_ALL ^ (E_NOTICE | E_WARNING | E_DEPRECATED));
?>

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
<div class="container">
	<div class="row" style="margin-top:20px">
		<div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
			<h1 style="text-align:center;"><?php echo $response ?> </h1>

		<form name="form1" method="post" action="join_rso.php" style="text-align:center;">
		<fieldset>
			<h2>Join RSO </h2>
			<hr >
			<div class="dropdown">
			<?php
			$servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "project";
			mysql_connect("$servername", "$username", "$password")or die("cannot connect"); 
			mysql_select_db("$dbname")or die("cannot select DB");
			$query = "SELECT * FROM rso";
			$result = mysql_query($query);
			?>
				<select class="form-control" name="myrsoid" id="myrsoid">
				<option value="" disabled selected>Select your RSO</option>			
			<?php
				while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
			?>
			<option value="<?php echo $line['name'];?>"> <?php echo $line['name'];?> </option>
			<?php
				}
			?>
			</select>
			</div>			
			<hr >
			<div class="row">
				<div class="col-xs-6 col-sm-6 col-md-6">
					<input type="buton" onclick="window.history.back();" value="Back" class="btn btn-lg btn-success btn-block">
				</div>
				<div class="col-xs-6 col-sm-6 col-md-6">		 
					<input type="submit" name="Submit" value="Join" class="btn btn-lg btn-primary btn-block">
				</div>
			</div>
			</fieldset>	
		</form>
		</div>
	</div>
</div>
	
</html>



