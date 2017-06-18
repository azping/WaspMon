<?php
include("config.php");

   $error="";
//TODO Confirmation password
$db = mysqli_connect($DB_SERVER,$DB_USERNAME,$DB_PASSWORD,$DB_DATABASE);
if (!$db) {
		
	}
	else {
		$sql = "INSERT INTO users values (NULL,'".$_POST["username"]."','".$_POST["password"]."','".$_POST["name"]."','".$_POST["type"]."','".$_POST["idgroup"]."')";
      		if (mysqli_query($db, $sql)) {
    		header("location: ./users.php");
		} else {
    		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
	mysqli_close($db);
	}
			
?>
