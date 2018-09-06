<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/config/config.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/mmdvmhost/tools.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/mmdvmhost/functions.php';

$listElem = $lastHeard[0];
$callsign = $listElem[2];

if (file_exists('db/'.$callsign)){
	include 'lh.php';
} else {
	exec('sudo mount -o remount,rw /');
	$file = fopen('db/'.$callsign, 'w');
	$txt = file_get_contents("http://apps.nbtc.go.th/callsign/result.php?search=$callsign&ยืนยัน=ยืนยัน");
	if (strpos($txt, "ไม่พบข้อมูลที่ต้องการค้นหา") !== false) {
		fwrite($file, "error");
	} else {
		$pos = strpos($txt, '<td><div align="center">1</div></td>');
		$txt = substr($txt, $pos);
		$pos = strpos($txt, '</div></td></tr>');
		$txt = substr($txt, 0, $pos);
		$array = (explode(' ',$txt));
		$ltxt = $array[97]." ".$array[98]." ".$array[112]." ".$array[182]." ".$array[20]." ".strtotime($array[124] . $array[125] . $array[126])." ".strtotime($array[141] . $array[142] . $array[143]);
		fwrite($file, $ltxt);
	}
	fclose($file);
	exec('sudo mount -o remount,ro /');
	include 'lh.php';
}
?>