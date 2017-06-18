<?php
include("config.php");
   $error="";

$db = mysqli_connect($DB_SERVER,$DB_USERNAME,$DB_PASSWORD,$DB_DATABASE);
if (!$db) {
		
	}
	else {
		$iVal=$_GET['iVal'];
		$sql = "SELECT * from (SELECT (@rowno:=@rowno+1) AS row,COUNT(*),wasp_id from wasp_data, (SELECT @rowno:=0) AS t group by wasp_id) AS p where row='$iVal'";
      		$result = mysqli_query($db,$sql);
      		$row = mysqli_fetch_array($result); 
		echo $row['wasp_id'];
			    
	}
mysqli_close($db);
		
	
?>
