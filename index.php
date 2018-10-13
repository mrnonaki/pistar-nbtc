<html>
	<head>
		<title>pistar-nbtc by E24YUJ</title>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	</head>
	<body>
		<script type="text/javascript" src="/jquery.min.js"></script>
		<script type="text/javascript">$.ajaxSetup({ cache: true });</script>
		<script type="text/javascript">
			function reloadLastHerd(){
			  $("#lastHerd").load("lh.php",function(){ setTimeout(reloadLastHerd,1000) });
			}
			setTimeout(reloadLastHerd,1000);
			function reloaddapnet(){
				$("#dapnet").load("dapnet.php",function(){ setTimeout(reloaddapnet,10000) });
			}
			setTimeout(reloaddapnet,10000);
			function reloadstatus(){
			  $("#status").load("status.php",function(){ setTimeout(reloadstatus,3000) });
			}
			setTimeout(reloadstatus,3000);
			function reloadbtn(){
			  $("#btn").load("btn.php",function(){ setTimeout(reloadbtn,10000) });
			}
			setTimeout(reloadbtn,10000);
			$(window).trigger('resize');
		</script>
		<style>
			td {
				text-align:center;
				vertical-align:top;
			}
		</style>
		<div id="lastHerd">
<?php include_once 'lh.php';?>
		</div>
		<div id="dapnet">
<?php include_once 'dapnet.php';?>
		</div>
		<div id="status">
<?php include_once 'status.php';?>
		</div>
		<div id="btn">
<?php include_once 'btn.php';?>
		</div>
		Made with ❤ by E24YUJ<br>
	</body>
</html>
