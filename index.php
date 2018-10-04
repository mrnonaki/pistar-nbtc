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
			  $("#lastHerd").load("check.php",function(){ setTimeout(reloadLastHerd,2000) });
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
<?php include 'check.php';?>
		</div>
		<div id="status">
<?php include 'status.php';?>
		</div>
		<iframe src="btn.php" style="width:800px;border:none;"></iframe>
		Made with LOVE by <a href="https://facebook.com/mrnonaki" target="_blank">E24YUJ</a>
	</body>
</html>
