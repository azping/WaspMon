<?php
include("config.php");

   $error="";
//TODO Confirmation password
$db = mysqli_connect($DB_SERVER,$DB_USERNAME,$DB_PASSWORD,$DB_DATABASE);
if (!$db) {
		
	}
	else {
		$sql = "INSERT INTO devices values (NULL,'".mysqli_real_escape_string($db,$_POST["dname"])."','".mysqli_real_escape_string($db,$_POST["ddesc"])."','".mysqli_real_escape_string($db,$_POST["dimg"])."','".mysqli_real_escape_string($db,$_POST["dstatus"])."','".mysqli_real_escape_string($db,$_POST[dt_reg])."')";
      		if (mysqli_query($db, $sql)) {
    		header("location: ./devices.php");
		} else {
    		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
	mysqli_close($db);
	}
			
?>
