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
	$array = (explode(' ',$file));
	if ($array[0] !== "error"){
		$fname = $array[0];
		$lname = $array[1];
		$type = substr($array[2], 24);
		$location = $array[3];
		$exp = $array[6];
		$expin = ($exp - time()) / 86400;
	}
	if ($array[7]){
		$srcpic = $array[7];
	} else {
		$srcpic = 'icons/dtdxa.png';
	}
} elseif (strlen($callsign) == 6) {
	include_once 'check.php';
}
?>
<table style="width:100%;height:150px;">
	<tr>
		<td><h1><?php echo $callsign." /".$device;?></h1></td>
		<td rowspan="5"><img style="max-width:150px;max-height:150px;" src="<?php echo $srcpic;?>"></td>
	</tr><tr>
		<td><?php echo $fname." ".$lname;?></td>
	</tr><tr>
		<td><?php echo $location;?></td>
	</tr><tr>
		<td><?php echo $type;?></td>
	</tr><tr>
		<td><?php if ($exp) echo date('d M Y', $exp)." | ".round($expin, 0, PHP_ROUND_HALF_DOWN)." days left"?></td>
	</tr>
</table>
	
<?php
echo "<table style=\"width:100%\"><tr>\n<td><table>\n";
for ($i = 0;  ($i < 9); $i++) {
	if (isset($lastHeard[$i])) {
		$listElem = $lastHeard[$i];
		if ($listElem[2]) {
			$utc_time = $listElem[0];
			$utc_tz =  new DateTimeZone('UTC');
			$local_tz = new DateTimeZone(date_default_timezone_get ());
			$dt = new DateTime($utc_time, $utc_tz);
			$dt->setTimeZone($local_tz);
			$local_time = $dt->format('H:i:s');

			echo"<tr><td>$local_time</td>";
			if (is_numeric($listElem[2]) || $listElem[2] == "DAPNET") {
				echo "<td>$listElem[2]</td>";
			} elseif (floatval($listElem[7]) <= 1) {
				echo "<td style=\"background:#1d1;\">$listElem[2] /$listElem[3]</td>";
			} elseif (floatval($listElem[7]) > 1 && floatval($listElem[7]) <= 3) {
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
		}
					if ($i % 3 == 2 && $i !== 8) {
				echo "</table></td>\n";
				echo "<td><table>\n";
			}
	}
}
echo "</table></td>\n</tr></table>\n";
?>