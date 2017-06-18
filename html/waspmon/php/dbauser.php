<?php
include("config.php");

   $error="";
//TODO Confirmation password
$db = mysqli_connect($DB_SERVER,$DB_USERNAME,$DB_PASSWORD,$DB_DATABASE);
if (!$db) {
		
	}
	else {
		$sql = "INSERT INTO users values (NULL,'".mysqli_real_escape_string($db,$_POST["username"])."','".mysqli_real_escape_string($db,$_POST["password"])."','".mysqli_real_escape_string($db,$_POST["name"])."','".mysqli_real_escape_string($db,$_POST["type"])."','".mysqli_real_escape_string($db,$_POST["idgroup"])."')";
      		if (mysqli_query($db, $sql)) {
    		header("location: ./users.php");
		} else {
    		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
	mysqli_close($db);
	}
			
?>
