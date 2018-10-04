<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/config/config.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/mmdvmhost/tools.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/mmdvmhost/functions.php';
include_once 'wifi.php';

$configdstar = array();
if ($configdstarfile = fopen('/etc/dstarrepeater','r')) {
	while ($line1 = fgets($configdstarfile)) {
		if (strpos($line1, '=') !== false) {
			list($key1,$value1) = split("=",$line1);
			$value1 = trim(str_replace('"','',$value1));
			if (strlen($value1) > 0) {
				$configdstar[$key1] = $value1;
			}
		}
	}
}

$cpuLoad = sys_getloadavg();
if ($cpuLoad[0] <= 1.00) {
	$cpuLoadHTML = "<td style=\"background: #1d1\">".$cpuLoad[0]." / ".$cpuLoad[1]." / ".$cpuLoad[2]."</td>\n";
} else if ($cpuLoad[0] <= 1.50) {
	$cpuLoadHTML = "<td style=\"background: #fa0\">".$cpuLoad[0]." / ".$cpuLoad[1]." / ".$cpuLoad[2]."</td>\n";
} else {
	$cpuLoadHTML = "<td style=\"background: #f00\">".$cpuLoad[0]." / ".$cpuLoad[1]." / ".$cpuLoad[2]."</td>\n";
}

$cpuTempCRaw = exec('cat /sys/class/thermal/thermal_zone0/temp');
if ($cpuTempCRaw > 1000) {
	$cpuTempC = round($cpuTempCRaw / 1000, 1);
} else {
	$cpuTempC = round($cpuTempCRaw, 1);
}
if ($cpuTempC < 50) {
	$cpuTempHTML = "<td style=\"background: #1d1\">".$cpuTempC."&deg;C</td>\n";
}
if ($cpuTempC >= 50) {
	$cpuTempHTML = "<td style=\"background: #fa0\">".$cpuTempC."&deg;C</td>\n";
}
if ($cpuTempC >= 69) {
	$cpuTempHTML = "<td style=\"background: #f00\">".$cpuTempC."&deg;C</td>\n";
}

echo "<table style=\"width:800px\"><tr>\n\t";

if (isset($lastHeard[0])) {
	$listElem = $lastHeard[0];
	if ( $listElem[2] && $listElem[6] == null && $listElem[5] !== 'RF') {
	        echo "<td style=\"background:#f33;\">TX $listElem[1]</td>";
	        }
	        else {
	        if (getActualMode($lastHeard, $mmdvmconfigs) === 'idle') {
	                echo "<td style=\"background:#0b0; color:#030;\">Listening</td>";
	                }
	        elseif (getActualMode($lastHeard, $mmdvmconfigs) === NULL) {
	                if (isProcessRunning("MMDVMHost")) { echo "<td style=\"background:#0b0; color:#030;\">Listening</td>"; } else { echo "<td style=\"background:#606060; color:#b0b0b0;\">OFFLINE</td>"; }
	                }
	        elseif ($listElem[2] && $listElem[6] == null && getActualMode($lastHeard, $mmdvmconfigs) === 'D-Star') {
	                echo "<td style=\"background:#4aa361;\">RX D-Star</td>";
	                }
	        elseif (getActualMode($lastHeard, $mmdvmconfigs) === 'D-Star') {
	                echo "<td style=\"background:#ade;\">Listening D-Star</td>";
	                }
	        elseif ($listElem[2] && $listElem[6] == null && getActualMode($lastHeard, $mmdvmconfigs) === 'DMR') {
	                echo "<td style=\"background:#4aa361;\">RX DMR</td>";
	                }
	        elseif (getActualMode($lastHeard, $mmdvmconfigs) === 'DMR') {
	                echo "<td style=\"background:#f93;\">Listening DMR</td>";
	                }
	        elseif ($listElem[2] && $listElem[6] == null && getActualMode($lastHeard, $mmdvmconfigs) === 'YSF') {
	                echo "<td style=\"background:#4aa361;\">RX YSF</td>";
	                }
	        elseif (getActualMode($lastHeard, $mmdvmconfigs) === 'YSF') {
	                echo "<td style=\"background:#ff9;\">Listening YSF</td>";
	                }
	        elseif ($listElem[2] && $listElem[6] == null && getActualMode($lastHeard, $mmdvmconfigs) === 'P25') {
        	        echo "<td style=\"background:#4aa361;\">RX P25</td>";
        	        }
        	elseif (getActualMode($lastHeard, $mmdvmconfigs) === 'P25') {
        	        echo "<td style=\"background:#f9f;\">Listening P25</td>";
        	        }
		elseif ($listElem[2] && $listElem[6] == null && getActualMode($lastHeard, $mmdvmconfigs) === 'NXDN') {
        	        echo "<td style=\"background:#4aa361;\">RX NXDN</td>";
        	        }
        	elseif (getActualMode($lastHeard, $mmdvmconfigs) === 'NXDN') {
        	        echo "<td style=\"background:#c9f;\">Listening NXDN</td>";
        	        }
		elseif (getActualMode($lastHeard, $mmdvmconfigs) === 'POCSAG') {
        	        echo "<td style=\"background:#4aa361;\">POCSAG</td>";
        	        }
        	else {
        	        echo "<td>".getActualMode($lastHeard, $mmdvmconfigs)."</td>";
        	        }
		}
	}
else {
	echo "<td></td>";
}
echo "\n";
echo "\t<td style=\"background:#0b0; color:#030;\">$strSSID / $strIPAddress / $strSignalLevel</td>\n";
echo "</tr><tr>\n\t";
echo $cpuTempHTML;
echo "\t";
echo $cpuLoadHTML;
echo "</tr><tr>\n\t";
showMode("D-Star", $mmdvmconfigs);
echo "\t";
showMode("D-Star Network", $mmdvmconfigs);
echo "</tr><tr>\n";
echo "\t<td style=\"background: #";
if (isProcessRunning('MMDVMHost')) {
	echo "1d1";
} else {
	echo "b55";
}
echo "\">MMDVMHost</td>\n";
echo "\t<td style=\"background: #";
if (isProcessRunning('ircddbgatewayd')) {
	echo "1d1";
} else {
	echo "b55";
}
echo "\">ircDDBGateway</td>\n";
echo "</tr><tr>\n";
echo "\t<td colspan=\"2\">" . getActualLink($reverseLogLinesMMDVM, "D-Star") . "\n";
echo "</tr></table>\n";

?>