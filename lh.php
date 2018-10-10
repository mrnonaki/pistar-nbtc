<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/config/config.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/mmdvmhost/tools.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/mmdvmhost/functions.php';
date_default_timezone_set('Asia/Bangkok');

$db = $_SERVER['DOCUMENT_ROOT'].'/pistar-nbtc/db/';

$listElem = $lastHeard[0];
$callsign = $listElem[2];
$device = $listElem[3];

if (file_exists($db.$callsign) && (time() - filemtime($db.$callsign)) / 86400 < 7) {
	$file = file_get_contents($db.$callsign);
}else if (strlen($callsign) == 6) {
	include_once 'check.php';
}

if ($callsign === "DAPNET") {
	echo "DAPNET Pager System";
} else if (strpos($file, "error") !== false) {
	echo "ไม่พบข้อมูลที่ต้องการค้นหา";
} else {
	
	$array = (explode(' ',$file));
	$fname = $array[0];
	$lname = $array[1];
	$type = $array[2];
	$location = $array[3];
	$exp = $array[6];
	$expin = ($exp - time()) / 86400;
	$srcpic = $array[7];
	
	echo "<table><tr><td><table style=\"width:390px;height:150px;\">\n";
	echo "\t<tr><td><font size=\"6\">" . $callsign . " /" . $device . "</font></td></tr>\n";
	echo "\t<tr><td>" . $fname . " " . $lname . "</td></tr>\n";
	echo "\t<tr><td>" . $location . "</td></tr>\n";
	echo "\t<tr><td>" . $type . "</td></tr>\n";
	echo "\t<tr><td>" . date('d M Y', $exp) . " (" . round($expin, 0, PHP_ROUND_HALF_DOWN) . " days left)</td></tr>\n";
	echo "</table></td>\n";
	
	if (strlen($srcpic) !== 0) {
		echo "<td width=\"390px\"><img height=150px src=" . $srcpic . "></td></tr>\n";
	}
	
	echo "<tr><td><table style=\"width:390px;\">\n";
	for ($i = 0;  ($i <= 5); $i++) {
		if (isset($lastHeard[$i])) {
			$listElem = $lastHeard[$i];
			if ($listElem[2]) {
				$utc_time = $listElem[0];
				$utc_tz =  new DateTimeZone('UTC');
				$local_tz = new DateTimeZone(date_default_timezone_get ());
				$dt = new DateTime($utc_time, $utc_tz);
				$dt->setTimeZone($local_tz);
				$local_time = $dt->format('H:i:s');
				
				echo"\t<tr>";
				echo"<td>$local_time</td>";
				if (is_numeric($listElem[2]) || $listElem[2] == "DAPNET") {
					echo "<td>$listElem[2]</td>";
				} else if (floatval($listElem[7]) <= 1) {
					echo "<td style=\"background:#1d1;\">$listElem[2] /$listElem[3]</td>";
				} else if (floatval($listElem[7]) > 1 && floatval($listElem[7]) <= 3) {
					echo "<td style=\"background:#fa0;\">$listElem[2] /$listElem[3]</td>";
				} else {
					echo "<td style=\"background:#f33;\">$listElem[2] /$listElem[3]</td>";
				}
				if ($listElem[6] == null) {
					echo "<td style=\"background:#f33;\">TX</td>";
				} else {
					echo "<td>$listElem[6]sec</td>";
				}
				echo"</tr>\n";
				if ($i == 2) {
					echo "</table></td>\n";
					echo "<td><table style=\"width:390px;\">\n";
				}
			}
		}
	}
	echo "</td></table></tr></table>\n";
}
?>