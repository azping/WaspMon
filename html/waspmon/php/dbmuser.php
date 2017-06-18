<?php
include("config.php");
   $error="";
//TODO Confirmation password
$db = mysqli_connect($DB_SERVER,$DB_USERNAME,$DB_PASSWORD,$DB_DATABASE);
if (!$db) {
		
	}
	else {	
		$idusersm=intval(mysqli_real_escape_string($db,$_POST['idusersm']));
		$usernamem=(mysqli_real_escape_string($db,$_POST['usernamem']));
		$passwordm=(mysqli_real_escape_string($db,$_POST['passwordm']));
		$namem=(mysqli_real_escape_string($db,$_POST['namem']));
		$typem=(mysqli_real_escape_string($db,$_POST['typem']));
		$idgroupm=(mysqli_real_escape_string($db,$_POST['idgroupm']));
		if ($_POST["opusersm"]=="Update") {
			if ($_POST["passwordm"]=="") {
				$sql = "UPDATE users SET username='$usernamem', name='$namem', type='$typem', idgroup='$idgroupm' where idusers=$idusersm";
			} else {
				$sql = "UPDATE users SET username='$usernamem', password='$passwordm', name='$namem', type='$typem', idgroup='$idgroupm' where idusers='$idusersm'";
			}
		} else {
		if ($_POST["opusersm"]=="Delete") {
			$sql = "DELETE FROM users where idusers=$idusersm";
			}
		}
      		if (mysqli_query($db, $sql)) {
    			header("location: ./users.php");
		} else {
    			echo "Error: " . $sql . "<br>" . mysqli_error($db);
		}
	mysqli_close($db);
	}
			
?>
