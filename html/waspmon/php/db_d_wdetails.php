<?php
include("config.php");
   $error="";

$db = mysqli_connect($DB_SERVER,$DB_USERNAME,$DB_PASSWORD,$DB_DATABASE);
if (!$db) {
		
	}
	else {
		// how many devices in devices table dont count duplicates if they exist
		$kVal=$_GET['kVal'];
		$sql = "SELECT * from (SELECT (@rowno:=@rowno+1) AS row,COUNT(*),name from devices, (SELECT @rowno:=0) AS t group by name) AS p where row='$kVal'";
      		$result = mysqli_query($db,$sql);
      		$row = mysqli_fetch_array($result); 
		echo $row['name'];
			    
	}
mysqli_close($db);
		
	
?>
