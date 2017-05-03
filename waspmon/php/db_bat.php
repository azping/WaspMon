<?php
//include('php/login.php'); // Include Login Script
//include('php/config.php');
//session_start();
   $DB_SERVER="localhost";
   $DB_USERNAME="waspmon";
//User e Password needs to be in session sha256
   $DB_PASSWORD="waspmon";
   $DB_DATABASE="waspmon";
   $error="";

$db = mysqli_connect($DB_SERVER,$DB_USERNAME,$DB_PASSWORD,$DB_DATABASE);
if (!$db) {
		
	}
	else {
		// cant mysqli_real_escape_string or echo wont echo 
		$wasp_id = $_GET['wasp_id'];
      		$sql = "SELECT bat_level FROM wasp_data WHERE wasp_id='$wasp_id' ORDER BY wd_id DESC LIMIT 1";
      		$result = mysqli_query($db,$sql);
      		$row = mysqli_fetch_array($result); 
      		echo intval($row[0]);
		}
mysqli_close($db);
		
	
?>
