<html>
	<head>
		<title>THAI Pi-Star Dashboard by E24YUJ</title>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	</head>
	<body>
		<script type="text/javascript" src="/jquery.min.js"></script>
		<script type="text/javascript">$.ajaxSetup({ cache: true });</script>
		<script type="text/javascript">
			function reloadLastHerd(){
			  $("#lastHerd").load("lh.php",function(){ setTimeout(reloadLastHerd,2000) });
			}
			setTimeout(reloadLastHerd,2000);
			function reloadstatus(){
			  $("#status").load("status.php",function(){ setTimeout(reloadstatus,3000) });
			}
			setTimeout(reloadstatus,3000);
			$(window).trigger('resize');
		</script>
		<style>
			td {
				text-align:center;
				vertical-align:top;
			}
		</style>
		<div id="lastHerd">
<?php include 'lh.php';?>
		</div>
		<div id="status">
<?php include 'status.php';?>
		</div>
		Made with LOVE by E24YUJ<br>
		<iframe src="btn.php" style="width:780px;height:60px;border:none;"></iframe><br>
		
	</body>
</html>
