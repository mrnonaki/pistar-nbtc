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
		$srcpic = '../icons/dtdxa.png';
	}
} elseif (strlen($callsign) == 6 && $callsign !== "DAPNET") {
	include_once '../check.php';
}
?>

<div class="table-responsive-md">
	<table class="table table-sm table-borderless text-center">
		<tr>
		<td colspan="2"><h3><?php echo $callsign." /".$device;?></h3></td>
		</tr><tr>
		<td><?php echo $fname." ".$lname;?></td>
		<td rowspan="4"><img style="max-width:120px;max-height:120px;" src="<?php echo $srcpic;?>"></td>
		</tr><tr>
		<td><?php echo $location;?></td>
		</tr><tr>
		<td><?php echo $type;?></td>
		</tr><tr>
		<td><?php if ($exp) echo date('d M Y', $exp)." | ".round($expin, 0, PHP_ROUND_HALF_DOWN)." days left"?></td>
		</tr>
	</table>
<?
echo "<table class=\"table table-sm table-borderless text-center\">\n";
for ($i = 0;  ($i < 5); $i++) {
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
	}
}
echo "</table>\n";
?>
</div>