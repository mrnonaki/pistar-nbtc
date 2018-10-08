<?php
$strIPAddress = NULL;
$strNetMask = NULL;
$strRxPackets = NULL;
$strRxBytes = NULL;
$strTxPackets = NULL;
$strTxBytes = NULL;
$strSSID = NULL;
$strBSSID = NULL;
$strBitrate = NULL;
$strTxPower = NULL;
$strLinkQuality = NULL;
$strSignalLevel = NULL;

exec('ifconfig wlan0',$return);
exec('iwconfig wlan0',$return);
exec('iw dev wlan0 link',$return);

$strWlan0 = implode(" ",$return);
$strWlan0 = preg_replace('/\s\s+/', ' ', $strWlan0);
if (strpos($strWlan0,'HWaddr') !== false) {
	preg_match('/HWaddr ([0-9a-f:]+)/i',$strWlan0,$result);
	$strHWAddress = $result[1];
}
if (strpos($strWlan0,'ether') !== false) {
	preg_match('/ether ([0-9a-f:]+)/i',$strWlan0,$result);
	$strHWAddress = $result[1];
}
if(strpos($strWlan0, "UP") !== false && strpos($strWlan0, "RUNNING") !== false) {
	$strStatus = '<span style="color:green">Interface is up</span>';
	
	if (strpos($strWlan0,'inet addr:') !== false) {
		preg_match('/inet addr:([0-9.]+)/i',$strWlan0,$result);
		$strIPAddress = $result[1];
	} else {
		preg_match('/inet ([0-9.]+)/i',$strWlan0,$result);
		$strIPAddress = $result[1];
	}
	if (strpos($strWlan0,'Mask:') !== false) {
		preg_match('/Mask:([0-9.]+)/i',$strWlan0,$result);
		$strNetMask = $result[1];
	} else {
		preg_match('/netmask ([0-9.]+)/i',$strWlan0,$result);
		$strNetMask = $result[1];
	}
	
	preg_match('/RX packets.(\d+)/',$strWlan0,$result);
	$strRxPackets = $result[1];
	preg_match('/TX packets.(\d+)/',$strWlan0,$result);
	$strTxPackets = $result[1];
	
	if (strpos($strWlan0,'RX bytes') !== false) {
		preg_match('/RX [B|b]ytes:(\d+ \(\d+.\d+ [K|M|G]iB\))/i',$strWlan0,$result);
		$strRxBytes = $result[1];
	} else {
		preg_match('/RX packets \d+ bytes (\d+ \(\d+.\d+ [K|M|G]iB\))/i',$strWlan0,$result);
		$strRxBytes = $result[1];
	}
	if (strpos($strWlan0,'TX bytes') !== false) {
		preg_match('/TX [B|b]ytes:(\d+ \(\d+.\d+ [K|M|G]iB\))/i',$strWlan0,$result);
		$strTxBytes = $result[1];
	} else {
		preg_match('/TX packets \d+ bytes (\d+ \(\d+.\d+ [K|M|G]iB\))/i',$strWlan0,$result);
		$strTxBytes = $result[1];
	}
	if (preg_match('/Access Point: ([0-9a-f:]+)/i',$strWlan0,$result)) { 
		$strBSSID = $result[1];
	}
	if (preg_match('/Connected to\ ([0-9a-f:]+)/i',$strWlan0,$result)) { 
		$strBSSID = $result[1];
	}
	if (preg_match('/Bit Rate([=:0-9\.]+ Mb\/s)/i',$strWlan0,$result)) {
		$strBitrate = str_replace(':', '', str_replace('=', '', $result[1]));
	}
	if (preg_match('/tx bitrate:\ ([0-9\.]+ Mbit\/s)/i',$strWlan0,$result)) {
		$strBitrate = str_replace(':', '', str_replace('=', '', $result[1]));
	}
	if (preg_match('/Tx-Power=([0-9]+ dBm)/i',$strWlan0,$result)) {
		$strTxPower = $result[1];
	}
	if (preg_match('/ESSID:\"([a-zA-Z0-9-_\s]+)\"/i',$strWlan0,$result)) {
		$strSSID = str_replace('"','',$result[1]);
	}
	if (preg_match('/SSID:\ ([a-zA-Z0-9-_\s]+)/i',$strWlan0,$result)) {
		$strSSID = str_replace(' freq','',$result[1]);
	}
	if (preg_match('/Link Quality=([0-9]+\/[0-9]+)/i',$strWlan0,$result)) {
		$strLinkQuality = $result[1];
	}
	if (preg_match('/Signal Level=(-[0-9]+ dBm)/i',$strWlan0,$result)) {
		$strSignalLevel = $result[1];
	}
	if (preg_match('/Signal Level=([0-9]+\/[0-9]+)/i',$strWlan0,$result)) {
		$strSignalLevel = $result[1];
	}
	if (preg_match('/signal:\ (-[0-9]+ dBm)/i',$strWlan0,$result)) {
		$strSignalLevel = $result[1];
	}
} else {
	$strStatus = '<span style="color:red">Interface is down</span>';
}
?>