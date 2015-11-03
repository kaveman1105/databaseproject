<?php

	session_start();

	//error_reporting(E_ALL ^ (E_NOTICE | E_WARNING | E_DEPRECATED));

		$rating=$_POST['rating'];
		$event_name = $_SESSION['public_event_name'];
		
		$host="localhost"; // Host name 
		$username="root"; // Mysql username 
		$password=""; // Mysql password 
		$db_name="project"; // Database name 
		$user_logged_in = $_SESSION['userName'];
		error_reporting(E_ALL ^ (E_NOTICE | E_WARNING | E_DEPRECATED));
		// Connect to server and select databse.
		mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
		mysql_select_db("$db_name")or die("cannot select DB");
		
		// Inserting new rating
		$sql="INSERT INTO event_ratings (rating_id, name, rating, username) VALUES (NULL, '$event_name', '$rating', '$user_logged_in')";
		$result=mysql_query($sql);
		if(!$result) {
		echo "Error";
		} else {
		echo "Event created successfully";
		}
		// Finding the average rating for this event from all users
		$sql ="SELECT AVG(rating) AS RatingAverage FROM event_ratings WHERE name='$event_name'";
		$result=mysql_query($sql);
		$row = mysql_fetch_array($result, MYSQL_NUM);
		$avg = $row[0];
		// Updating the events rating to reflect this value
		$sql ="UPDATE publicevent SET rating='$avg' WHERE name='$event_name'";
		$result=mysql_query($sql);
		if(!$result) {
		echo "Error";
		} else {
		echo "rating updated successfully.";
		}
?>