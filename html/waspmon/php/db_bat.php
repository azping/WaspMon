<?php
include("config.php");
   $error="";

$db = mysqli_connect($DB_SERVER,$DB_USERNAME,$DB_PASSWORD,$DB_DATABASE);
if (!$db) {
		
	}
	else {
		// cant mysqli_real_escape_string or echo wont echo 
		$wasp_id = $_GET['wasp_id'];
		$sql = "SELECT bat_level,(SELECT TIMESTAMPDIFF(day, date, NOW())) FROM wasp_data WHERE wasp_id='$wasp_id' ORDER BY wd_id DESC LIMIT 1";
      		//$sql = "SELECT bat_level,date FROM wasp_data WHERE wasp_id='$wasp_id' ORDER BY wd_id DESC LIMIT 1";
      		$result = mysqli_query($db,$sql);
      		$row = mysqli_fetch_array($result);
		echo json_encode( array( "batlevel"=>$row[0],"lastdate"=>$row[1] ) );
      		
		
		}
mysqli_close($db);
		
	
?>
