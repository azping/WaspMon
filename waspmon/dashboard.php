<?php
session_start();
if(!isset($_SESSION['username'])){
header("location: index.php");
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
    <link href="./css/bootstrap.css" rel="stylesheet">

    <!-- dataTable -->
    <link rel="stylesheet" type="text/css" href="css/dataTables.bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/jquery.dataTables.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="./css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="./css/dashboard.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="./js/ie-emulation-modes-warning.js"></script>

	<link href="./css/waspmon.css" rel="stylesheet">	
	<link href="./css/login.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media qu["g"+nVal] as variable nameeries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

	<script type="text/javascript" charset="utf8" src="./js/jquery-1.12.4.js"></script>
<!-- Charts API -->
	
	<script type="text/javascript" charset="utf8" type="text/javascript" charset="utf8" src="./js/raphael-2.1.4.min.js"></script>
	<script type="text/javascript" charset="utf8" src="./js/justgage.js"></script>
	<script type="text/javascript" charset="utf8" src="./js/db_overview.2.js"></script>
	<script type="text/javascript" charset="utf8" src="./js/dataTables.bootstrap.min.js"></script>
	<script type="text/javascript" charset="utf8" src="./js/jquery.dataTables.min.js"></script>
  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">Waspmon</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
        	<li><a href="dashboard.php">Dashboard</a></li>
		<?php
		if($_SESSION['type']!='User'){?>
		<li class="dropdown">
			<a class="dropdown-toggle" data-toggle="dropdown" href="#">Settings
			<span class="caret"></span></a>
			<ul class="dropdown-menu">
				<?php if($_SESSION['type']=='Administrator'){?>
				<li><a href="./php/users.php">Users</a></li>
				<?php }?>
				<?php if($_SESSION['type']=='Administrator' || $_SESSION['type']=='Maintainer'){?>
				<li><a href="./php/devices.php">Devices</a></li>
				<?php }?>
			</ul>
		</li>
		<?php }?>
         	<li><a href="#">Help</a></li>
          </ul>
		  <ul class="nav navbar-nav navbar-right">
					<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user">
					</span> Hi, <?php echo $_SESSION['name']; ?><span class="caret"></span></a>
						<ul class="dropdown-menu">
			
						<li><a href="php/logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a>
						</li>
						</ul>
					</li>
		</ul>
        <!--  <form class="navbar-form navbar-right">
            <input type="text" class="form-control" placeholder="Search...">
          </form> -->
        </div>
      </div>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li class="active"><a href="#">Overview <span class="sr-only">(current)</span></a></li>
            <li><a href="#">Reports</a></li>
            <li><a href="#">Analytics</a></li>
            <li><a href="#">Export</a></li>
          </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Dashboard</h1>
	<h3 class="sub-header">Battery Status</h3>
          <div class="row placeholders">
		
           <div class="col-xs-6 col-sm-3 placeholder">
		<div id="g1" class="gauge"></div>
<!--              <img src="./images/waspmote_mote_runner_24.png" width="200" height="200" class="img-responsive" alt="Generic placeholder thumbnail">-->
              
          </div>
            <div class="col-xs-6 col-sm-3 placeholder">
              <div id="g2" class="gauge"></div>
            </div>
            <div class="col-xs-6 col-sm-3 placeholder">
              <div id="g3" class="gauge"></div>
            </div>
            <div class="col-xs-6 col-sm-3 placeholder">
              <div id="g4" class="gauge"></div>
            </div>
          </div>

          <h3 class="sub-header">History</h3>

		<table id="hist" class="table table-striped table-bordered" cellspacing="0" width="100%">
		<thead>
              	<tr>
                	<th>#</th>
                	<th>Date</th>
                	<th>WaspID</th>
                	<th>Battery</th>
			<th>Int. Temp</th>
                	<th>Acc X</th>
			<th>Acc Y</th>
			<th>Acc Z</th>
                </tr>
		</thead>
		<tfoot>
              	<tr>
                	<th>#</th>
                	<th>Date</th>
                	<th>WaspID</th>
                	<th>Battery</th>
			<th>Int. Temp</th>
                	<th>Acc X</th>
			<th>Acc Y</th>
			<th>Acc Z</th>
                </tr>
              </tfoot>
              <tbody>
		<?php
		include('php/db_whist.php');
		?>
              </tbody>
            </table>

        </div>
      </div>
    </div>
<p id="debug"></p>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster 
    <script src="./js/jquery-3.2.1.min.js"></script>
    <script>window.jQuery || document.write('<script src="./js/jquery-3.2.1.min.js"><\/script>')</script>-->
    <script src="./js/bootstrap.js"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="./js/vendor/holder.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="./js/ie10-viewport-bug-workaround.js"></script>


</body>
</html>
