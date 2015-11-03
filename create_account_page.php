<?php
	error_reporting(E_ALL ^ (E_NOTICE | E_WARNING | E_DEPRECATED));
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
	</head>
	<div class="container">
		<div class="row" style="margin-top:20px">
			<div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
				<form name="form1" method="post" action="create_account.php" style="text-align:center;" >
					<fieldset>
						<h2>Create Account</h2>
						<hr class="colorgraph">
						<div class="form-group">
							<input name="myusername" type="text" id="myusername" placeholder="Username" class="form-control input-lg" >
						</div>
						<div class="form-group">
							<input name="mypassword" type="password" id="mypassword" placeholder="Password"  class="form-control input-lg">
						</div>
						<div class="form-group">
						<input name="myemail" type="text" id="myemail" placeholder="Email Address"  class="form-control input-lg">
						</div>
						<div class="dropdown">
							<?php
								$servername = "localhost";
								$username = "root";
								$password = "";
								$dbname = "project";
								mysql_connect("$servername", "$username", "$password")or die("cannot connect"); 
								mysql_select_db("$dbname")or die("cannot select DB");
								$query = "SELECT * FROM university";
								$result = mysql_query($query);
							?>
							<select  class="form-control" name="myuniversity" id="myuniversity">
							<option value="" disabled selected>Select your University</option>

							<?php
								while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
							?>
						
								<option value="<?php echo $line['name'];?>"> <?php echo $line['name'];?> </option>
							<?php
							}
							?>
							</select>
						</div>
						<hr class="colorgraph">
						<div class="form-group">
							<input type="submit" name="Submit" value="Create"  class="btn btn-lg btn-Warning btn-block">			
						</div>
					</fieldset>
				</form>
			<div>
		</div>
	</div>
</html>