<?php
//include('php/config.php');
//session_start();
   $DB_SERVER="localhost";
   $DB_USERNAME="waspmon";
//User e Password needs to be in session sha256
   $DB_PASSWORD="waspmon";
   $DB_DATABASE="waspmon";
   $error="";

$db = mysqli_connect($DB_SERVER,$DB_USERNAME,$DB_PASSWORD,$DB_DATABASE);
if (!$db) {
		
	}
	else {
		$sql = "SELECT idusers,name,username,password,type from users";
      		$result = mysqli_query($db,$sql);
      		if (mysqli_num_rows($result) > 0) {
		    // output data of each row
		    while( $row = mysqli_fetch_assoc($result)) { echo "<tr><td hidden>".$row["idusers"]."</td><td>".$row["username"]."</td><td>".$row["name"]."</td><td>".$row["type"]."</td><td></td></tr>";
			    }
		} else {
			echo 0;
		}
			    
	}
mysqli_close($db);
		
	
?>
