<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/config/config.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/mmdvmhost/tools.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/mmdvmhost/functions.php';
include_once '../wifi.php';

$cpuTempCRaw = exec('cat /sys/class/thermal/thermal_zone0/temp');
if ($cpuTempCRaw > 1000) {
	$cpuTempC = round($cpuTempCRaw / 1000, 1);
} else {
	$cpuTempC = round($cpuTempCRaw, 1);
}
if ($cpuTempC < 50) {
	$cpuTempHTML = "<td style=\"background: #1d1\">".$cpuTempC."&deg;C</td>\n";
} elseif ($cpuTempC >= 50) {
	$cpuTempHTML = "<td style=\"background: #fa0\">".$cpuTempC."&deg;C</td>\n";
} elseif ($cpuTempC > 60) {
	$cpuTempHTML = "<td style=\"background: #f00\">".$cpuTempC."&deg;C</td>\n";
}

$cpuLoad = sys_getloadavg();
if ($cpuLoad[0] <= 1.00) {
	$cpuLoadHTML = "<td style=\"background: #1d1\">".$cpuLoad[0]." | ".$cpuLoad[1]." | ".$cpuLoad[2]."</td>\n";
} elseif ($cpuLoad[0] <= 1.50) {
	$cpuLoadHTML = "<td style=\"background: #fa0\">".$cpuLoad[0]." | ".$cpuLoad[1]." | ".$cpuLoad[2]."</td>\n";
} else {
	$cpuLoadHTML = "<td style=\"background: #f00\">".$cpuLoad[0]." | ".$cpuLoad[1]." | ".$cpuLoad[2]."</td>\n";
}

$WiFiSignal = substr($strSignalLevel,0,3);
if ($WiFiSignal > -50) {
	$WiFiHTML = "<td style=\"background: #0b0\">".exec('hostname -I')." | ".$strSignalLevel."</td>\n";
} elseif ($WiFiSignal > -70) {
	$WiFiHTML = "<td style=\"background: #4aa361\">".exec('hostname -I')." | ".$strSignalLevel."</td>\n";
} else {
	$WiFiHTML = "<td style=\"background: #f33\">".exec('hostname -I')." | ".$strSignalLevel."</td>\n";
}
?>
<div class="table-responsive-md">
	<table class="table table-sm table-borderless text-center"><tr>
<?php
if (isset($lastHeard[0])) {
	$listElem = $lastHeard[0];
	if ( $listElem[2] && $listElem[6] == null && $listElem[5] !== 'RF') {
		echo "<td style=\"background:#f33;\">TX $listElem[1]</td>";
	} else {
		if (getActualMode($lastHeard, $mmdvmconfigs) === 'idle') {
			echo "<td style=\"background:#0b0; color:#030;\">Listening</td>";
		} elseif (getActualMode($lastHeard, $mmdvmconfigs) === NULL) {
			if (isProcessRunning("MMDVMHost")) {
				echo "<td style=\"background:#0b0; color:#030;\">Listening</td>";
			} else {
				echo "<td style=\"background:#606060; color:#b0b0b0;\">OFFLINE</td>";
			}
		} elseif ($listElem[2] && $listElem[6] == null && getActualMode($lastHeard, $mmdvmconfigs) === 'D-Star') {
			echo "<td style=\"background:#4aa361;\">RX D-Star</td>";
		} elseif (getActualMode($lastHeard, $mmdvmconfigs) === 'D-Star') {
			echo "<td style=\"background:#ade;\">Listening D-Star</td>";
		} elseif (getActualMode($lastHeard, $mmdvmconfigs) === 'POCSAG') {
			echo "<td style=\"background:#4aa361;\">POCSAG</td>";
		} else {
			echo "<td>".getActualMode($lastHeard, $mmdvmconfigs)."</td>";
		}
	}
} else {
	echo "<td></td>";
}
?>
		<?php echo $WiFiHTML;?>
		</tr><tr>
		<?php echo $cpuTempHTML;?>
		<?php echo $cpuLoadHTML;?>
		</tr><tr>
		<?php showMode("D-Star", $mmdvmconfigs);?>
		<?php showMode("D-Star Network", $mmdvmconfigs);?>
		</tr><tr>
		<td style="background:#<?php if (isProcessRunning('MMDVMHost')) echo "1d1"; else echo "b55";?>">MMDVMHost</td>
		<td style="background:#<?php if (isProcessRunning('ircddbgatewayd')) echo "1d1"; else echo "b55";?>">ircDDBGateway</td>
		</tr>
	</table>
</div>