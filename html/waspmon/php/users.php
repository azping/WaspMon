<?php
session_start();
if(!isset($_SESSION['username']) && $_SESSION['type']!='Admin'){
header("location: ../index.php");
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
    <link href="../css/bootstrap.css" rel="stylesheet">

    <!-- dataTable -->
    <link rel="stylesheet" type="text/css" href="../css/dataTables.bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../css/jquery.dataTables.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="../css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/dashboard.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="../js/ie-emulation-modes-warning.js"></script>

	<link href="../css/waspmon.css" rel="stylesheet">	
	<link href="../css/login.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media qu["g"+nVal] as variable nameeries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

	<script type="text/javascript" charset="utf8" src="../js/jquery-1.12.4.js"></script>
<!-- Charts API -->
	
	<script type="text/javascript" charset="utf8" src="../js/raphael-2.1.4.min.js"></script>
	<script type="text/javascript" charset="utf8" src="../js/justgage.js"></script>
	<script type="text/javascript" charset="utf8" src="../js/users.js"></script>
	<script type="text/javascript" charset="utf8" src="../js/dataTables.bootstrap.min.js"></script>
	<script type="text/javascript" charset="utf8" src="../js/jquery.dataTables.min.js"></script>
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
          <a class="navbar-brand" href="../index.php">Waspmon</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
        	<li><a href="../php/dashboard.php">Dashboard</a></li>
		<?php
		if($_SESSION['type']!='User'){?>
		<li class="dropdown">
			<a class="dropdown-toggle" data-toggle="dropdown" href="#">Settings
			<span class="caret"></span></a>
			<ul class="dropdown-menu">
				<?php if($_SESSION['type']=='Administrator'){?>
				<li><a href="../php/users.php">Users</a></li>
				<?php }?>
				<?php if($_SESSION['type']=='Administrator' || $_SESSION['type']=='Maintainer'){?>
				<li><a href="../php/devices.php">Devices</a></li>
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
			
						<li><a href="../php/logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a>
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
         <!--<div class="col-sm-3 col-md-2 sidebar">
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
-->
<div class="col-sm-offset-1 col-sm-10 col-sm-offset-1 col-md-offset-2 col-md-8 col-md-offset-2 main">
          <h3 class="sub-header">Users</h3>
		
			<div id="createU" class="modal fade" role="dialog">
			<div class="modal-dialog">

			<!-- Modal content: Create USER-->
			<div class="modal-content">
					<div class="modal-header alert-info" style="padding:35px 50px;  color:black !important; text-align: center; font-size: 30px;">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h2><span class="glyphicon glyphicon-user"></span> New user</h2>
					</div>
					<div class="modal-body">

					<form class="form-horizontal" action="./dbauser.php" method="POST">
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-log-in"></i></span>
							<input id="username" type="text" class="form-control" name="username" placeholder="Username" required>
						</div><p></p>
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
							<input id="password" type="password" class="form-control" name="password" placeholder="Password" required>
						</div><p></p>
						<!-- TODO Confirmation password -->
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
							<input id="name" type="text" class="form-control" name="name" placeholder="Name" required>
						</div><p></p>
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
							<input id="idgroup" type="text" class="form-control" name="idgroup" placeholder="Grupo">
						</div><p></p>
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
							<select class="form-control" id="type" name="type">
								<option value="Administrator">Admin</option>
								<option value="Maintainer">Maintainer</option>
								<option value="User" selected="selected">User</option>
							</select>
						</div>
						<div class="modal-footer">
						 <button type="submit" class="btn btn-default">Submit</button>
						<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
						</div>
					</form>
					</div>

			</div>
			</div>	
			</div>		
			
			<!-- Modal content: Modify USER-->
			<div class="modal fade" id="modifyU" role="dialog">
    			<div class="modal-dialog">
			<div class="modal-content">
					<div id="userheaderm" class="modal-header" style="padding:35px 50px;  background-color: orange; color:white !important; text-align: center; font-size: 30px;">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h2 id="delheader"></h2>
					</div>
					<div class="modal-body">
					<form class="form-horizontal" action="./dbmuser.php" method="POST">
						<div class="input-group">
							<input type="hidden" id="opusersm" type="text" class="form-control" name="opusersm" />
							<input type="hidden" id="idusersm" type="text" class="form-control" name="idusersm" />
						</div>
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-log-in"></i></span>
							<input id="usernamem" type="text" class="form-control" name="usernamem"/>
						</div><p></p>
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
							<input id="passwordm" type="password" class="form-control" name="passwordm"/>
						</div><p></p>
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
							<input id="namem" type="text" class="form-control" name="namem"/>
						</div><p></p>
						<!--- TODO implement select in modal-->
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
							<select class="form-control" id="typem" name="typem">
								<option value="Administrator">Administrator</option>
								<option value="Maintainer">Maintainer</option>
								<option value="User">User</option>
							</select>
						</div><p></p>
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
							<input id="idgroupm" type="text" class="form-control" name="idgroupm" placeholder="Grupo">
						</div><p></p>
						
						<div class="modal-footer">
						<button id="uokm" type="submit" class="btn btn-default" name="uokm"></button>
						<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
						</div>
					</form>
					</div>

			</div>
			</div>
			</div>


    		<div class="col-xs-12 col-sm-12 col-md-12 placeholder">


		<table id="users" class="table table-striped table-bordered" cellspacing="0" width="100%">
		<thead>
              	<tr>
			<th id="id" hidden></th>
			<th id="Username">Username</th>
                	<th id="Name">Name</th>
                	<th id="Type">Type</th>
			<th id="id">Group</th>
			<th id="Action">Action</th>
                </tr>
		</thead>
		<tfoot>
              	<tr>
			<th id="id" hidden></th>
			<th>Username</th>
                	<th>Name</th>
                	<th>Type</th>
			<th id="id">Group</th>
			<th id="Action">Action</th>
                </tr>
              </tfoot>
              <tbody>
		<?php
		include('db_wusers.php');
		?>
              </tbody>
            </table>
		</div>
<!--		<div class="btn-group btn-group-lg">
   			<button type="button" id="Update" class="btn btn-primary disabled">Update</button>
			<button type="button" id="Delete" class="open-deletedial btn btn-primary disabled" data-toggle="modal" data-target="#deleteU" data-field1="teste">Delete</button>
		</div>    -->
		
		<div class="col-xs-12 col-sm-8 col-md-10 placeholder">
		</div>
		<div class="col-xs-0 col-sm-4 col-md-2 placeholder">
      		<button class="btn btn-lg btn-primary btn-block" data-toggle="modal" data-target="#createU">New</button>
    		</div> 
  </div>
</div>
		

<!--        </div>-->
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster 
    <script src="./js/jquery-3.2.1.min.js"></script>
    <script>window.jQuery || document.write('<script src="./js/jquery-3.2.1.min.js"><\/script>')</script>-->
    <script src="../js/bootstrap.js"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="../js/vendor/holder.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../js/ie10-viewport-bug-workaround.js"></script>


</body>
</html>
