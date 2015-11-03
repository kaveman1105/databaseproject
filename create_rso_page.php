<?php
	session_start();
	if(isset($_SESSION['userName'])) {
	  $response= "Please create your RSO: " . $_SESSION['userName'] ;
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

	<form name="form1" method="post" action="create_rso.php" style="text-align:center;">
	<fieldset>
	<h2>RSO Name:</h2>
          <hr >
          <div class="form-group">

			<input name="rso_name" type="text" id="rso_name" placeholder="RSO Name" class="form-control input-lg" >
          </div>
          <p><span class="form-group">
            <input name="rso_member" type="text" id="rso_name2" placeholder="member 1" class="form-control input-lg" >
            </span><span class="form-group">
            <input name="rso_member" type="text" id="rso_name3" placeholder="member 2" class="form-control input-lg" >
            </span><span class="form-group">
            <input name="rso_member" type="text" id="rso_name4" placeholder="member 3" class="form-control input-lg" >
            </span><span class="form-group">
            <input name="rso_member" type="text" id="rso_name5" placeholder="member 4" class="form-control input-lg" >
          </span></p>
          <p>&nbsp; </p>
          <div class="row"><span class="col-xs-6 col-sm-6 col-md-6">
            <input type="submit" name="Submit" value="Create" class="btn btn-lg btn-primary btn-block">
          </span>
            <div class="col-xs-6 col-sm-6 col-md-6">
              <p>
                <input type="buton" onClick="window.history.back();" value="Back" class="btn btn-lg btn-success btn-block">
              </p>
              <p>&nbsp; </p>
            </div>
			 <div class="col-xs-6 col-sm-6 col-md-6"></div>
	</div>
	</fieldset>
	</form>
	</div>
	</div>
	</div>
	
</html>