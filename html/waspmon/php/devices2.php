<?php
session_start();
if(!isset($_SESSION['username'])){
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
    
	<link rel="stylesheet" type="text/css" href="../css/jquery.dataTables.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../css/dataTables.bootstrap.min.css" rel="stylesheet">

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
	<script type="text/javascript" charset="utf8" src="../js/devices.js"></script>
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
          <h3 class="sub-header">Devices</h3>
		
			<!--<div class="col-xs-0 col-sm-0 col-md-0 placeholder">
			
			</div>-->

			<div id="createD" class="modal fade" role="dialog">
			<div class="modal-dialog">

			<!-- Modal content: Create Device-->
			<div class="modal-content">
					<div class="modal-header alert-info" style="padding:35px 50px; color:black !important; text-align: center; font-size: 30px;">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h2><span class="glyphicon glyphicon-cog"></span> New device</h2>
					</div>
					<div class="modal-body">

					<form class="form-horizontal" action="./dbadev.php" method="POST">
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-edit"></i></span>
							<input id="dname" type="text" class="form-control" name="dname" placeholder="Device name" required>
						</div><p></p>
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-comment"></i></span>
							<input id="ddesc" type="text" class="form-control" name="ddesc" placeholder="Description">
						</div><p></p>
						<!-- TODO Image on file or in DB -->
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-picture"></i></span>
							<input id="dimg" type="text" class="form-control" name="dimg" placeholder="Image NOT Implemented">
						</div><p></p>
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-off"></i></span>
							<select class="form-control" id="dstatus" name="dstatus">
								<option value="On" selected="selected">On</option>
								<option value="Off">Off</option>
							</select>
						</div><p></p>
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
							<input type="text" class="form-control" id="dt_reg" name="dt_reg">
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
			
<!-- Modal: Modify device-->
			<div class="modal fade" id="modifyD" role="dialog">
    			<div class="modal-dialog">
			<div class="modal-content">
					<div id="devheaderm" class="modal-header" style="padding:35px 50px;  background-color: orange; color:white !important; text-align: center; font-size: 30px;">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h2 id="delheader"></h2>
					</div>
					<div class="modal-body">
					<form class="form-horizontal" action="./dbmdev.php" method="POST">
						<div class="input-group">
							<input type="hidden" id="opdevm" type="text" class="form-control" name="opdevm" />
							<input type="hidden" id="iddevm" type="text" class="form-control" name="iddevm" />
						</div>
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-edit"></i></span>
							<input id="dnamem" type="text" class="form-control" name="dnamem" placeholder="Device name" required>
						</div><p></p>
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-comment"></i></span>
							<input id="ddescm" type="text" class="form-control" name="ddescm" placeholder="Description">
						</div><p></p>
						<!-- TODO Image on file or in DB -->
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-picture"></i></span>
							<input id="dimgm" type="text" class="form-control" name="dimgm" placeholder="Image NOT Implemented">
						</div><p></p>
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-off"></i></span>
							<select class="form-control" id="dstatusm" name="dstatusm">
								<option value="On" selected="selected">On</option>
								<option value="Off">Off</option>
							</select>
						</div><p></p>
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
							<input type="text" class="form-control" id="dt_regm" name="dt_regm">
						</div>
						
						<div class="modal-footer">
						<button id="dokm" type="submit" class="btn btn-default" name="dokm"></button>
						<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
						</div>
					</form>
					</div>

			</div>
			</div>
			</div>

<!-- Modal: Scan Device-->
			<div id="scanD" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header alert-info" style="padding:35px 50px; color:black !important; text-align: center; font-size: 30px;">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h2><span class="glyphicon glyphicon-search"></span> Scan for devices</h2>
					</div>
					<p> </p>
					<label>Total Wasps</label>
					<div class="form-group">
						<label for="sfw">Found:</label>
						<input id="sfw" type="text" class="form-control" name="sfw" placeholder="Number of Wasps found">
					</div><p></p>
					<div class="form-group">
						<label for="skw">Known:</label>
						<input id="skw" type="text" class="form-control" name="skw" placeholder="Number of Wasps known">
					</div><p></p>
					<div class="form-group">
						<label for="snw">New:</label>
						<input id="snw" type="text" class="form-control" name="snw" placeholder="New Wasps discovered">
					</div><p></p>

					<div class="form-group">
						<ul class="list-group" id="slist"></ul>
					<p></p>
					</div>
					<div class="progress">
						<div id="sprobar" class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
					</div>
					<div id="scomp" class="alert alert-success" role="alert" style="display:none;">Scanning complete!</div>
					<div class="modal-footer">
						<button id="sok" type="button" class="btn btn-default" data-dismiss="modal">Ok</button>
					</div>
				</div>
			</div>	
			</div>		



<div class="col-xs-12 col-sm-12 col-md-12 placeholder">


		<table id="devices" class="table table-striped table-bordered" cellspacing="0" width="100%">
		<thead>
              	<tr>	<th id="id" hidden></th>
			<th id="dname">Name</th>
                	<th id="ddesc">Description</th>
                	<th id="dimg">Image</th>
			<th id="dstatus">Status</th>
			<th id="dt_reg">Group</th>
			<th>Action</th>
                </tr>
		</thead>
		<tbody>
		<?php
		include("config.php");
		$error="";

		$db = mysqli_connect($DB_SERVER,$DB_USERNAME,$DB_PASSWORD,$DB_DATABASE);
		if (!$db) {
		
		} else {
			if($_SESSION['type']=='Administrator'){
				$sql = "SELECT iddevices,name,description,image,status,t_reg from devices";
				$result = mysqli_query($db,$sql);
				if (mysqli_num_rows($result) > 0) {
					    // output data of each row
						while( $row = mysqli_fetch_assoc($result)) {
						echo "<tr><td hidden>".$row["iddevices"]."</td><td>".$row["name"]."</td><td>".$row["description"]."</td><td align=center><img height=\"42\"width=\"42\" src=\"../images/img1.png\"></td><td align=center>".$row["status"]."</td><td align=center>".$row["t_reg"]."</td><td align=center></td></tr>";
						}
				} else {
						if($_SESSION['type']=='Administrator'){
							echo '<div class="alert alert-warning alert-dismissable fade in">';
							echo '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
							echo '<strong>No devices found!</strong> Try scanning for new devices.</div>';
						} else {
							echo '<div class="alert alert-warning alert-dismissable fade in">';
							echo '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
							echo '<strong>Not a group member!</strong> Contact your administrator.</div>';
						}
				}


			} else {
				$sql1="SELECT users.idusers from users INNER JOIN devices on users.idgroup=devices.t_reg where t_reg=".mysqli_real_escape_string($db,$_POST['groupdid'])." AND idgroup=".$_SESSION['idgroup'];
				$result1 = mysqli_query($db,$sql1);
	      			if (mysqli_num_rows($result1) == 0) {
					echo '<div class="alert alert-warning alert-dismissable fade in">';
					echo '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
					echo '<strong>Not a group member!</strong> Contact your administrator.</div>';
				} else {
					$sql2 = "SELECT iddevices,name,description,image,status,t_reg from devices where t_reg=".mysqli_real_escape_string($db,$_POST['groupdid']);
		      			$result2 = mysqli_query($db,$sql2);
		      				if (mysqli_num_rows($result2) > 0) {
						// output data of each row
							while( $row = mysqli_fetch_assoc($result2)) {
							echo "<tr><td hidden>".$row["iddevices"]."</td><td>".$row["name"]."</td><td>".$row["description"]."</td><td align=center><img height=\"42\"width=\"42\" src=\"../images/img1.png\"></td><td align=center>".$row["status"]."</td><td align=center>".$row["t_reg"]."</td><td align=center></td></tr>";
							}
						} else {
							echo '<div class="alert alert-warning alert-dismissable fade in">';
							echo '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
							echo '<strong>No devices found!</strong> Contact your administrator.</div>';
						}
					}    
			}
		}
		mysqli_close($db);
		?>
		</tbody>
		<tfoot>
              	<tr>
			<th id="id" hidden></th>
			<th id="dname">Name</th>
                	<th id="ddesc">Description</th>
                	<th id="dimg">Image</th>
			<th id="dstatus">Status</th>
			<th id="dt_reg">Group</th>
			<th>Action</th>
                </tr>
              </tfoot>
              
            </table>
</div>





    		
<!--		<div class="btn-group btn-group-lg">
   			<button type="button" id="Update" class="btn btn-primary disabled">Update</button>
			<button type="button" id="Delete" class="open-deletedial btn btn-primary disabled" data-toggle="modal" data-target="#deleteU" data-field1="teste">Delete</button>
		</div>    -->
<?php if($_SESSION['type']=='Administrator'){?>
		<div class="col-xs-12 col-sm-4 col-md-2 placeholder">
		<button class="alert-warning btn btn-lg btn-primary btn-block" data-toggle="modal" data-target="#scanD">Scan</button>
		</div>
		<div class="col-xs-0 col-sm-4 col-md-8 placeholder">
		
		</div>
		
		<div class="col-xs-0 col-sm-4 col-md-2 placeholder">
		<button class="btn btn-lg btn-primary btn-block" data-toggle="modal" data-target="#createD">New</button>
		</div>
<?php }?>
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
