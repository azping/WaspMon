<?php
include("config.php");
   $error="";

$db = mysqli_connect($DB_SERVER,$DB_USERNAME,$DB_PASSWORD,$DB_DATABASE);
if (!$db) {
		
	}
	else {
		$sql = "SELECT MAX(row) from (SELECT (@rowno:=@rowno+1) AS row,COUNT(*),wasp_id from wasp_data, (SELECT @rowno:=0) AS t group by wasp_id) AS p;";
      		$result = mysqli_query($db,$sql);
		$row = mysqli_fetch_array($result);
		echo intval($row["MAX(row)"]);	   
	}
mysqli_close($db);
		
	
?>
