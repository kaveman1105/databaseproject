<?php

	session_start();

	//error_reporting(E_ALL ^ (E_NOTICE | E_WARNING | E_DEPRECATED));

		$comment=$_POST['comment'];
		$event_name = $_SESSION['event_name'];
		$user_logged_in = $_SESSION['userName'];
		
		$host="localhost"; // Host name 
		$username="root"; // Mysql username 
		$password=""; // Mysql password 
		$db_name="project"; // Database name 
		
		error_reporting(E_ALL ^ (E_NOTICE | E_WARNING | E_DEPRECATED));
		// Connect to server and select databse.
		mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
		mysql_select_db("$db_name")or die("cannot select DB");
		
		// Inserting new rating
		$sql="INSERT INTO comments (comment_id, event_name, comment, username, date) VALUES (NULL, '$event_name', '$comment', '$user_logged_in', CURRENT_TIMESTAMP)";
		$result=mysql_query($sql);
		if(!$result) {
		echo "Error";
		} else {
		echo "Comment posted successfully.";
		}
?>