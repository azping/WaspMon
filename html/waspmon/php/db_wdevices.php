<?php
include("config.php");
$error="";

$db = mysqli_connect($DB_SERVER,$DB_USERNAME,$DB_PASSWORD,$DB_DATABASE);
if (!$db) {
		
	}
	else {
		if($_SESSION['type']=='Administrator'){
		$sql = "SELECT iddevices,name,description,image,status,t_reg from devices where t_reg='".$_POST['groupdid']."'";
		}
		else {
		$sql = "SELECT iddevices,name,description,image,status,t_reg from devices where t_reg='".$_POST['groupdid']."'";
		}
      		$result = mysqli_query($db,$sql);
      		if (mysqli_num_rows($result) > 0) {
		    // output data of each row
		    while( $row = mysqli_fetch_assoc($result)) {
echo "<tr><td hidden>".$row["iddevices"]."</td><td>".$row["name"]."</td><td>".$row["description"]."</td><td align=center><img height=\"42\" width=\"42\" src=\"../images/img1.png".$row["image"]."\"></td><td align=center>".$row["status"]."</td><td align=center>".$row["t_reg"]."</td><td align=center></td></tr>";
			    }

		} else {
			if($_SESSION['type']=='Administrator'){
			echo '<div class="alert alert-warning alert-dismissable fade in">';
			echo '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
			echo '<strong>No devices found!</strong> Try scanning for new devices.</div>';
			} else {
			echo '<div class="alert alert-warning alert-dismissable fade in">';
			echo '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
			echo '<strong>No devices found!</strong> Contact your administrator.</div>';
			}
		}
			    
	}
mysqli_close($db);
		
	
?>
