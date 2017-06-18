<?php
include("config.php");
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
