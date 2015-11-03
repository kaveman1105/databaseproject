	<?php
	session_start();
	if(isset($_SESSION['userName'])) {
	  $response = "Please create a university: " . $_SESSION['userName'];
	}
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
	<form name="form1" method="post" action="create_university.php">

	<h2><?php echo $response ?></h2>
	<fieldset>
          <hr>
          <div class="form-group">
		<input name="university_name" type="text" id="university_name" placeholder="University Name" class="form-control input-lg">
		</div>
        <div class="form-group">
		<input name="university_description" type="text" id="university_description" placeholder="University Description" class="form-control input-lg" >	
		</div>
		
		<div class="form-group">
		<input name="university_nostudents" type="text" id="university_nostudents" placeholder="No. of Students" class="form-control input-lg" >	
		</div>		
		<hr>
		<div class="row" style="margin-bottom: 20px;">
            <div class="col-xs-6 col-sm-6 col-md-6">
				<input type="button" value="Back"   onclick="window.history.back();"  class="btn btn-lg btn-success btn-block" >	
            </div>
			 <div class="col-xs-6 col-sm-6 col-md-6"> 
		<input type="submit" name="Submit" value="Create University" class="btn btn-lg btn-primary btn-block" >
	</div>  
	</div>
	</fieldset>
	</form>
	</div>
	</div>
	</div>

	</body>
</html>



