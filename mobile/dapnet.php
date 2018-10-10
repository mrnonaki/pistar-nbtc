<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/config/config.php';
date_default_timezone_set('UTC');
if ($dapnetLog = fopen(MMDVMLOGPATH.'/DAPNETGateway-'.date('Y-m-d').'.log','r')) {
	date_default_timezone_set('Asia/Bangkok');
	while ($dapnetLine = fgets($dapnetLog)) {
		if (preg_match_all('/D.*?((?:2|1)\\d{3}(?:-|\\/)(?:(?:0[1-9])|(?:1[0-2]))(?:-|\\/)(?:(?:0[1-9])|(?:[1-2][0-9])|(?:3[0-1]))(?:T|\\s)(?:(?:[0-1][0-9])|(?:2[0-3])):(?:[0-5][0-9]):(?:[0-5][0-9])).*?"(.*?)"/is',$dapnetLine,$linx) > 0) {
			$utc_time = $linx[1][0];
			$utc_tz =  new DateTimeZone('UTC');
			$local_tz = new DateTimeZone('Asia/Bangkok');
			$dt = new DateTime($utc_time, $utc_tz);
			$dt->setTimeZone($local_tz);
			$local_time = $dt->format('H:i:s');
			$dapnetMSG	= $linx[2][0];
			if ( time() - strtotime($local_time) < 3600) {
				echo "<div class=\"alert alert-success alert-dismissible text-left\">";
				echo "($local_time) ... $dapnetMSG";
				echo "</div>";
			}
		}
	}
}
fclose($dapnetLog);
?>
