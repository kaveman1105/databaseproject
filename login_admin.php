<?php
	session_start();
	if(isset($_SESSION['userName'])) {
	  $greetUser="Welcome " . $_SESSION['userName'] . "!";
	}
	error_reporting(E_ALL ^ (E_NOTICE | E_WARNING | E_DEPRECATED));
?>

<html>
	<head>
		<!-- jQuery is required -->
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js" type="text/javascript"></script> <!-- Widget Includes -->
		<script src="http://events.ucf.edu/tools/script.js" type="text/javascript"></script>
		<link href="http://events.ucf.edu/tools/style.css" rel="stylesheet" type="text/css">
		<link href='fullcalendar-2.3.1/fullcalendar.css' rel='stylesheet' />
		<link href='fullcalendar-2.3.1/fullcalendar.print.css' rel='stylesheet' media='print' />
		<script src='fullcalendar-2.3.1/lib/moment.min.js'></script>
		<script src='fullcalendar-2.3.1/lib/jquery.min.js'></script>
		<script src='fullcalendar-2.3.1/fullcalendar.min.js'></script>
				<link rel="stylesheet" href="css/bootstrap.min.css">
		
		<?php
			$host="localhost"; // Host name 
			$username="root"; // Mysql username 
			$password=""; // Mysql password 
			$db_name="project"; // Database name 
			$user_logged_in = $_SESSION['userName'];
			error_reporting(E_ALL ^ (E_NOTICE | E_WARNING | E_DEPRECATED));
			// Connect to server and select databse.
			mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
			mysql_select_db("$db_name")or die("cannot select DB");
			
			$sql="SELECT * FROM publicevent WHERE approved='1'";
			$result = mysql_query($sql) or die( mysql_error() );
			
			while ($row = mysql_fetch_array($result)) {
				$title = $row['name'];
				//$d = dateFormat($row['date']);
				$time = $row['time'];
				$date = $d . "T" . $time .":00";
				$data[] = array('title' => $title, 'start' => $date, 'backgroundColor' => "blue");
			}
			
			// Finding the uid of the user logged in
			$sql_usercheck="SELECT u.uid FROM university u, members m WHERE m.username='$user_logged_in' AND m.university = u.name";
			$result_usercheck = mysql_query($sql_usercheck) or die( mysql_error() );
			$row_usercheck = mysql_fetch_array($result_usercheck, MYSQL_NUM);
			$uni_id = $row_usercheck[0];
			
			$sql="SELECT * FROM events WHERE uid='$uni_id'";
			$result = mysql_query($sql) or die( mysql_error() );
			
			// Finding the users RSO
			$sql_rsocheck="SELECT rso_name FROM members WHERE username='$user_logged_in'";
			$result_rsocheck = mysql_query($sql_rsocheck) or die( mysql_error() );
			$row_rsocheck = mysql_fetch_array($result_rsocheck, MYSQL_NUM);
			$rso_id = $row_rsocheck[0];
			
			// Finding the RSO events
			$sql="SELECT * FROM events WHERE rso_name='$rso_id'";
			$result = mysql_query($sql) or die( mysql_error() );
 
		?>

		<style>

			body {
				margin: 40px 10px;
				padding: 0;
				font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
				font-size: 14px;
			}

		</style>
	</head>
	<body>
	    <div class="container" style="text-align: center;">

	   <div class="masthead">    
	   <nav>
          <ul class="nav nav-justified">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="create_rso_page.php">Create RSO</a></li>
            <li><a href="join_rso_page.php">Join RSO</a></li>
            <li><a href="view_events_rso.php">View RSO Events</a></li>
            <li><a href="view_events_university_page.php">View University Events</a></li>
			<li><a href="create_event_page.php">Create Event</a></li>
            <li><a href="create_public_event_page.php">Create Public Event (Requires admin approval)</a></li>
			<li><a href="logout.php">Logout</a></li>

          </ul>
        </nav>
      </div>

      <!-- Jumbotron -->
     <div class="jumbotron" >
		<img src="images/test.jpg" alt="Smiley face"  height="60%" width="100%">
       <!--  <p><a class="btn btn-lg btn-success" href="#calendar" role="button">Get started today</a></p> -->
      </div>
	  	<form name="form4" method="post" action="view_single_event_public.php">
			<tr>
			<td> View public event: </td>
			<td>:</td>
			<td><?php			
				$servername = "localhost";
				$username = "root";
				$password = "";
				$dbname = "project";
				$student_name = $_SESSION['userName'];
				mysql_connect("$servername", "$username", "$password")or die("cannot connect"); 
				mysql_select_db("$dbname")or die("cannot select DB");
				$query = "SELECT * FROM publicevent WHERE approved='1'";
				$result = mysql_query($query);
			?>
			
			<select name="pub_name" id="pub_name">
			
			<?php
				while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
			?>
			
			<option value="<?php echo $line['name'];?>"> <?php echo $line['name'];?> </option>
				 
			<?php
				}
			?></td>
			</tr>
			
			</select>
		<input type="submit" name="Submit" value="View">
		</form>
	  
		<!-- <div id='calendar'></div> -->
		
	</body>
</html>