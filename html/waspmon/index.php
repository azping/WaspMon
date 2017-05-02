<?php
//include('php/login.php'); // Include Login Script
//include('php/config.php');
session_start();
if ((isset($_SESSION['username']) != '')) 
{
header('Location: dashboard.php');
}
if(!empty($_POST["username"]) || !empty($_POST["password"])) {

   $DB_SERVER="localhost";
// TODO Merge users with mysql
//   $DB_USERNAME=$_POST['username'];
//   $DB_PASSWORD=$_POST['password'];
   $DB_USERNAME="waspmon";
   $DB_PASSWORD="waspmon";
   $DB_DATABASE="waspmon";
   $error="";

$db = mysqli_connect($DB_SERVER,$DB_USERNAME,$DB_PASSWORD,$DB_DATABASE);
if (!$db) {
		$error="DB connection failed: " . mysqli_connect_error();
	}
	else {
	
	if(empty($_POST["username"]) || empty($_POST["password"])) {
		$error = "Both fields are required.";
		} else {
   		if($_SERVER["REQUEST_METHOD"] == "POST") {
      		// username and password sent from form 
      
      		$username = mysqli_real_escape_string($db,$_POST['username']);
      		$password = mysqli_real_escape_string($db,$_POST['password']); 
      
      		$sql = "SELECT idusers,name,type FROM users WHERE username = '$username' and password = '$password'";
      		$result = mysqli_query($db,$sql);
      		$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      		$active = $row['active'];
      
      		$count = mysqli_num_rows($result);
      
      		// If result matched $username and $password, table row must be 1 row
		
      		if($count == 1) {
         		
         		$_SESSION['username'] = $username;
			$_SESSION['password'] = $password;
			$_SESSION['name'] = $row['name'];
			$_SESSION['type'] = $row['type'];
         		header("location: dashboard.php");
      			}else {
         		$error = "Your Login Name or Password is invalid";
			}
		}
		}
		mysqli_close($db);
		}
}	
?>


<!DOCTYPE html>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">

    <title>Waspmon</title>

    <!-- Bootstrap core CSS -->
    <link href="./css/bootstrap.min.css" rel="stylesheet">
	<!-- Font Awesome CSS 
    <link href="css/font-awesome.css" rel="stylesheet">-->

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="./css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="./css/dashboard.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="./js/ie-emulation-modes-warning.js"></script>
	
    <link href="./css/login.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
      <!--    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button> -->
          <a class="navbar-brand" href="#">Waspmon</a>
        </div>
<!--        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a href="#">Dashboard</a></li>
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#">Settings
				<span class="caret"></span></a>
				<ul class="dropdown-menu">
					<li><a href="#">Users</a></li>
					<li><a href="#">Devices</a></li>
				</ul>
			</li>
            <li><a href="#">Help</a></li>
          </ul>
		  <ul class="nav navbar-nav navbar-right">
					<li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
			</ul>		-->
        <!--  <form class="navbar-form navbar-right">
            <input type="text" class="form-control" placeholder="Search...">
          </form> -->
        </div>
      </div>
    </nav>

<br /><br />
	<div class="container">
    

    <div class="l_login">
    	<h3 class="l_authTitle">Sign in</h3>


		<div class="row l_row-sm-offset-3">
			<div class="col-xs-12 col-sm-6">	
			    <form class="l_loginForm" action="" autocomplete="off" method="POST">
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
						<input type="text" class="form-control" name="username" placeholder="Username">
					</div>
					<span class="help-block"></span>
										
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
						<input  type="password" class="form-control" name="password" placeholder="Password">
					</div>
                    <span class="help-block"><p><?php echo $error;?></p></span>

					<button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
				</form>
			</div>
    	</div>
		
	</div>



    </div>
	
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery-3.2.1.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="js/bootstrap.min.js"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="js/vendor/holder.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
  
</body>
</html>
