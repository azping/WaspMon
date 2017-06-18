<?php
include("config.php");
   $error="";
//TODO Confirmation password
$db = mysqli_connect($DB_SERVER,$DB_USERNAME,$DB_PASSWORD,$DB_DATABASE);
if (!$db) {
		
	}
	else {
		$waspid=mysqli_real_escape_string($db,$_GET['waspid']);
		$sql = "INSERT INTO devices (iddevices,name) values (NULL,'$waspid')";
		$result = mysqli_query($db,$sql);
    		echo $waspid;
		}
	mysqli_close($db);
	
			
?>
