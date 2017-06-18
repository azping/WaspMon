<?php
include("config.php");
   $error="";

$db = mysqli_connect($DB_SERVER,$DB_USERNAME,$DB_PASSWORD,$DB_DATABASE);
if (!$db) {
		
	}
	else {
		$sql = "SELECT (@rowno:=@rowno+1) AS row,COUNT(*),wasp_id from wasp_data, (SELECT @rowno:=0) AS t group by wasp_id";
      		$result = mysqli_query($db,$sql);

      		if (mysqli_num_rows($result) > 0) {
		    // output data of each row
		    while($row = mysqli_fetch_assoc($result)) {
			echo intval($row["row"]);
			    }
		} else {
			echo 0;
		}		
	}
mysqli_close($db);
		
	
?>
