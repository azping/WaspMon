<?php
include("config.php");
   $error="";

$db = mysqli_connect($DB_SERVER,$DB_USERNAME,$DB_PASSWORD,$DB_DATABASE);
if (!$db) {
		
	}
	else {
		$sql = "SELECT * from wasp_data ORDER BY wd_id DESC";
      		$result = mysqli_query($db,$sql);
      		if (mysqli_num_rows($result) > 0) {
		    // output data of each row
		    while( $row = mysqli_fetch_assoc($result)) { echo "<tr><td>".$row["wd_id"]."</td><td>".$row["date"]."</td><td>".$row["wasp_id"]."</td><td>".$row["bat_level"]."</td><td>".$row["int_temp"]."</td><td>".$row["accx"]."</td><td>".$row["accy"]."</td><td>".$row["accz"]."</td></tr>";
			    }
		} else {
			echo 0;
		}
			    
	}
mysqli_close($db);
		
	
?>
