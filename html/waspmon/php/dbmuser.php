<?php
include("config.php");
   $error="";
//TODO Confirmation password
$db = mysqli_connect($DB_SERVER,$DB_USERNAME,$DB_PASSWORD,$DB_DATABASE);
if (!$db) {
		
	}
	else {	
		$idusersm=intval($_POST['idusersm']);
		$usernamem=($_POST['usernamem']);
		$passwordm=($_POST['passwordm']);
		$namem=($_POST['namem']);
		$typem=($_POST['typem']);
		$idgroupm=($_POST['idgroupm']);
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
