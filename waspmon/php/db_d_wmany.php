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
		// how many devices in devices table dont count duplicates if they exist
		$sql = "SELECT MAX(row) from (SELECT (@rowno:=@rowno+1) AS row,COUNT(*),name from devices, (SELECT @rowno:=0) AS t group by name) AS p";
      		$result = mysqli_query($db,$sql);
		$row = mysqli_fetch_array($result);
		echo intval($row["MAX(row)"]);	   
	}
mysqli_close($db);
		
	
?>
