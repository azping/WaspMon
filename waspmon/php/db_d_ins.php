<?php
//include('php/config.php');
//session_start();
   $DB_SERVER="localhost";
   $DB_USERNAME="waspmon";
//User e Password needs to be in session sha256
   $DB_PASSWORD="waspmon";
   $DB_DATABASE="waspmon";
   $error="";
//TODO Confirmation password
$db = mysqli_connect($DB_SERVER,$DB_USERNAME,$DB_PASSWORD,$DB_DATABASE);
if (!$db) {
		
	}
	else {
		$waspid=$_GET['waspid'];
		$sql = "INSERT INTO devices (iddevices,name) values (NULL,'$waspid')";
		$result = mysqli_query($db,$sql);
    		echo $waspid;
		}
	mysqli_close($db);
	
			
?>
