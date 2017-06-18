<?php
include("config.php");
   $error="";
//TODO Confirmation password
$db = mysqli_connect($DB_SERVER,$DB_USERNAME,$DB_PASSWORD,$DB_DATABASE);
if (!$db) {
		
	}
	else {	
		$iddevm=intval(mysqli_real_escape_string($db,$_POST['iddevm']));
		$dnamem=(mysqli_real_escape_string($db,$_POST['dnamem']));
		$ddescm=(mysqli_real_escape_string($db,$_POST['ddescm']));
		$dimgm=(mysqli_real_escape_string($db,$_POST['dimgm']));
		$dstatusm=(mysqli_real_escape_string($db,$_POST['dstatusm']));
		$dt_regm=(mysqli_real_escape_string($db,$_POST['dt_regm']));
		if ($_POST["opdevm"]=="Update") {
			$sql = "UPDATE devices SET name='$dnamem', description='$ddescm', image='$dimgm', status='$dstatusm', t_reg=$dt_regm where iddevices='$iddevm'";
		} else {
		if ($_POST["opdevm"]=="Delete") {
			$sql = "DELETE FROM devices where iddevices='$iddevm'";
			}
		}
      		if (mysqli_query($db, $sql)) {
    			header("location: ./devices.php");
		} else {
    			echo "Error: " . $sql . "<br>" . mysqli_error($db);
		}
	mysqli_close($db);
	}
			
?>
