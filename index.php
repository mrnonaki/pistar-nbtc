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
			  $("#lastHerd").load("check.php",function(){ setTimeout(reloadLastHerd,1000) });
			}
			setTimeout(reloadLastHerd,1000);
			$(window).trigger('resize');
		</script>
		<style>
			td {vertical-align: top;
			text-align: left;
			}
		</style>
		<div id="lastHerd">
<?php include 'check.php';?>
		</div>
		<iframe src="link.php"></iframe>
	</body>
</html>
