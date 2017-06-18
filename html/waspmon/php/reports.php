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

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="../css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/dashboard.css" rel="stylesheet">
    <!--<link href="../css/chartist.min.css" rel="stylesheet">
    <link href="../css/chartist-plugin-legends.css" rel="stylesheet"> -->
    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <script src="../js/ie-emulation-modes-warning.js"></script>

	<link href="../css/waspmon.css" rel="stylesheet">	

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media qu["g"+nVal] as variable nameeries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

	<script type="text/javascript" charset="utf8" src="../js/jquery-1.12.4.js"></script>


<!--	<script type="text/javascript" charset="utf8" src="../js/db_overview.2.js"></script>-->


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
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li><a href="../php/dashboard.php">Overview </a></li>
            <li class="active"><a href="#">Reports <span class="sr-only">(current)</span></a></li>
            <li><a href="#">Analytics</a></li>
            <li><a href="#">Export</a></li>
          </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Reports</h1>
	 <div class="row placeholders">
		
           <div class="col-xs-12 col-sm-6 placeholder">
	   <h3 class="sub-header">Activity</h3>
	  <canvas id="ct-chart-activ" ></canvas>
          </div>
            <div class="col-xs-12 col-sm-6 placeholder">
          <h3 class="sub-header">TOP</h3>
	<canvas id="ct-chart-top" height=90% valign=middle></canvas>
            </div>
          </div>
          <div class="row placeholders">           
	<div class="col-xs-12 col-sm-12 placeholder">
        <h3 class="sub-header">Battery</h3>
	<canvas id="ct-chart-bat" ></canvas>

	</div>






	<div class="col-xs-12 col-sm-12 placeholder">
		<h3 class="sub-header">Temperature</h3>
		<canvas id="ct-chart-temp" ></canvas>
	</div>


        </div>
      </div>
    </div>
<p id="debug"></p>
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

	<script type="text/javascript" charset="utf8" src="../js/Chart.js"></script>
	
<script type="text/javascript">
<?php
include("config.php");

$db = mysqli_connect($DB_SERVER,$DB_USERNAME,$DB_PASSWORD,$DB_DATABASE);
if (!$db) {
		
	}
	else { ?>
		new Chart (document.getElementById("ct-chart-activ"),{
		type: 'bar',
		data: {
			<?php
			$sql = "select distinct wasp_id from wasp_data;";
      			$result = mysqli_query($db,$sql); ?>
			labels: [ <?php while( $row = mysqli_fetch_assoc($result)) echo '"'.$row['wasp_id'].'",';?> ],

			datasets: [
				{
				label: "",
				backgroundColor:[ "#3e95cd", "#8e5ea2", "#3cba9f", "#e8c3b9", "#c45850"],
  				data:[
				<?php
				$sql1 = "select distinct wasp_id from wasp_data;";
      				$result1 = mysqli_query($db,$sql1);
				while( $row1 = mysqli_fetch_assoc($result1)) { 
					$sql2 = "select count(*) AS tick,wasp_id from wasp_data where wasp_id='$row1[wasp_id]'";
      					$result2 = mysqli_query($db,$sql2);
					while( $row2 = mysqli_fetch_assoc($result2)) echo $row2['tick'].",";}?>]
				
  				}
		
			] //end of datasets
	    	},//end of data
		options: {
			legend: {
				display: false
			},
			tooltips: {
				callbacks: {
					label: function(tooltipItem) {
						console.log(tooltipItem)
						return tooltipItem.yLabel;
					}
				}
			}
		}
		});


		new Chart (document.getElementById("ct-chart-top"),{
		type: 'pie',
		data: {
			<?php
			$sql = "select distinct wasp_id from wasp_data;";
      			$result = mysqli_query($db,$sql); ?>
			labels: [ <?php while( $row = mysqli_fetch_assoc($result)) echo '"'.$row['wasp_id'].'",';?> ],

			datasets: [
				{
				label: "",
				backgroundColor:[ "#3e95cd", "#8e5ea2", "#3cba9f", "#e8c3b9", "#c45850"],
  				data:[
				<?php
				$sql1 = "select distinct wasp_id from wasp_data;";
      				$result1 = mysqli_query($db,$sql1);
				while( $row1 = mysqli_fetch_assoc($result1)) { 
					$sql2 = "select count(*) AS tick,wasp_id from wasp_data where wasp_id='$row1[wasp_id]'";
      					$result2 = mysqli_query($db,$sql2);
					while( $row2 = mysqli_fetch_assoc($result2)) echo $row2['tick'].",";}?>]
				
  				}
		
			] //end of datasets
	    	},//end of data
		
		options: {
			legend: {
				display: true,
				position: 'bottom'
			},
			tooltips: {
				callbacks: {
                			label: function(tooltipItem, data) {
						var allData = data.datasets[tooltipItem.datasetIndex].data;
						var tooltipLabel = data.labels[tooltipItem.index];
						var tooltipData = allData[tooltipItem.index];
						var total = 0;
						for (var i in allData) {
							total += allData[i];
						}
						var tooltipPercentage = Math.round((tooltipData / total) * 100);
						return tooltipLabel + ': ' + tooltipData + ' (' + tooltipPercentage + '%)';
					}
				}
			}
		}
		});


new Chart (document.getElementById("ct-chart-bat"),{
		type: 'line',
		data: {
			<?php
			$i=0;
			$colorsc=array( "#3e95cd", "#8e5ea2", "#3cba9f", "#e8c3b9", "#c45850");
			$sql = "select DATE_FORMAT(date, '%d/%m %H:%i') AS date from wasp_data;";
      			$result = mysqli_query($db,$sql); ?>
			labels: [ <?php while( $row = mysqli_fetch_assoc($result)) echo '"'.$row['date'].'",';?> ],
			datasets: [
			
			<?php
			$sql1 = "select distinct wasp_id from wasp_data;";
      			$result1 = mysqli_query($db,$sql1);
			while( $row1 = mysqli_fetch_assoc($result1)) {
				
				$sql2 = "select DATE_FORMAT(date, '%d/%m %H:%i') AS date, if (wasp_id='$row1[wasp_id]',bat_level,null) as waspinf from wasp_data group by date;";
      				$result2 = mysqli_query($db,$sql2);?>
				{
				label: "<?php echo $row1['wasp_id'] ?>",
				backgroundColor:[ "<?php echo $colorsc[$i];?>"],
				borderColor:[ "<?php echo $colorsc[$i];$i++;?>"],
  				data:[
				<?php while( $row2 = mysqli_fetch_assoc($result2)) echo $row2['waspinf'].",";?>
				],
				fill: false,
				spanGaps: true,
				showLine: true
  				},<?php } ?>
		
			] //end of datasets
	    	},//end of data
		options: {
			legend: {
				display: true,
				position: 'bottom'
				}
		}
		});

new Chart (document.getElementById("ct-chart-temp"),{
		type: 'line',
		data: {
			
			<?php
			$i=0;
			$colorsc=array( "#3e95cd", "#8e5ea2", "#3cba9f", "#e8c3b9", "#c45850");
			$sql = "select DATE_FORMAT(date, '%d/%m %H:%i') AS date from wasp_data;";
      			$result = mysqli_query($db,$sql); ?>
			labels: [ <?php while( $row = mysqli_fetch_assoc($result)) echo '"'.$row['date'].'",';?> ],
			//backgroundColor:[ "#3e95cd", "#8e5ea2", "#3cba9f", "#e8c3b9", "#c45850"],

			datasets: [

			<?php
			$sql1 = "select distinct wasp_id from wasp_data;";
      			$result1 = mysqli_query($db,$sql1);
			while( $row1 = mysqli_fetch_assoc($result1)) {
				
				$sql2 = "select DATE_FORMAT(date, '%d/%m %H:%i') AS date, if (wasp_id='$row1[wasp_id]',int_temp,null) as waspinf from wasp_data group by date;";
      				$result2 = mysqli_query($db,$sql2);?>
				{
				label: "<?php echo $row1['wasp_id'] ?>",
				backgroundColor:[ "<?php echo $colorsc[$i];?>"],
				borderColor:[ "<?php echo $colorsc[$i];$i++;?>"],
  				data:[
				<?php while( $row2 = mysqli_fetch_assoc($result2)) echo $row2['waspinf'].",";?>
				],
				fill: false,
				spanGaps: true,
				showLine: true
  				},<?php } ?>
		
			] //end of datasets
	    	},//end of data
		options: {
			legend: {
				display: true,
				position: 'bottom'
				}
		}
		});

<?php } ?>
	
</script>



</body>
</html>
