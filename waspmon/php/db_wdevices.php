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
		$sql = "SELECT iddevices,name,description,image,status,t_reg from devices";
      		$result = mysqli_query($db,$sql);
      		if (mysqli_num_rows($result) > 0) {
		    // output data of each row
		    while( $row = mysqli_fetch_assoc($result)) { echo "<tr><td hidden>".$row["iddevices"]."</td><td>".$row["name"]."</td><td>".$row["description"]."</td><td>".$row["image"]."</td><td>".$row["status"]."</td><td>".$row["t_reg"]."</td><td></td></tr>";
			    }
		} else {
			echo '<div class="alert alert-warning alert-dismissable fade in">';
			echo '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
			echo '<strong>No devices found!</strong> Try scanning for new devices.</div>';
		}
			    
	}
mysqli_close($db);
		
	
?>
