<!DOCTYPE html>
<html lang="th">
<head>
	<title>pistar-nbtc by E24YUJ</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
	<script type="text/javascript">$.ajaxSetup({ cache: true });</script>
	<script type="text/javascript">
		function reloaddapnet(){
			$("#dapnet").load("dapnet.php",function(){ setTimeout(reloaddapnet,10000) });
		}
		setTimeout(reloaddapnet,10000);
		function reloadlh(){
			$("#lh").load("lh.php",function(){ setTimeout(reloadlh,1000) });
		}
		setTimeout(reloadlh,1000);
		function reloadstatus(){
			$("#status").load("status.php",function(){ setTimeout(reloadstatus,3000) });
		}
		setTimeout(reloadstatus,3000);
		function reloadlinkto(){
			$("#linkto").load("linkto.php",function(){ setTimeout(reloadlinkto,10000) });
		}
		setTimeout(reloadlinkto,10000);
		$(window).trigger('resize');
	</script>
</head>
<body>
	<div class="container text-center">
		<div id="dapnet"><?php include_once 'dapnet.php'?></div>
		<div id="lh"><?php include_once 'lh.php'?></div>
		<div id="status" class="collapse"><?php include_once 'status.php'?></div>
		<div id="linkto" class="collapse"><?php include_once 'linkto.php'?></div>
		<div id="power" class="collapse"><?php include_once 'power.php'?></div>
		<nav class="navbar fixed-bottom navbar-light bg-faded">
			<a class="navbar-brand mx-auto" href="#">
				<div class="btn-group mt-2 mr-2">
					<button type="button" class="btn btn-success" data-toggle="collapse" data-target="#status">Status</button>
					<button type="button" class="btn btn-success" data-toggle="collapse" data-target="#linkto">Link to</button>
					<button type="button" class="btn btn-success" data-toggle="collapse" data-target="#power">Power</button>
				</div>
			</a>
		</nav>
	</div>
	<footer class="text-center">
		<div class="text-center">
			Made with ❤ by E24YUJ
		</div>
	</footer>
</body>
</html>