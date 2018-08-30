<?php

/*
Pi-Star LastHerd Callsign Check for Thailand
Written for Pi-Star (http://www.pistar.uk/)
By Napont Kitiwiriyakul (E24YUJ)
*/

include_once $_SERVER['DOCUMENT_ROOT'].'/config/config.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/mmdvmhost/tools.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/mmdvmhost/functions.php';
date_default_timezone_set('Asia/Bangkok');
header("Refresh:3");

$listElem = $lastHeard[0];
$callsign = $listElem[2];
$file = file_get_contents("http://apps.nbtc.go.th/callsign/result.php?search=$callsign&ยืนยัน=ยืนยัน");

if (strpos($file, "ไม่พบข้อมูลที่ต้องการค้นหา") !== false) {
	echo "Can't find";
} else {
	$pos = strpos($file, '<td><div align="center">1</div></td>');
	$file = substr($file, $pos);
	$pos = strpos($file, '</div></td></tr>');
	$file = substr($file, 0, $pos);
	$array = (explode(' ',$file));
	
	$lic = $array[20];
	$fname = $array[97];
	$lname = $array[98];
	$type = $array[112];
	$exp = strtotime($array[141] . $array[142] . $array[143]);
	$location = $array[182];
	$expin = ($exp - time()) / 86400;
	
	echo "Callsign: " . $callsign . "<br>";
	echo "License: " . $lic . "<br>";
	echo "Name: " . $fname . " " . $lname . "<br>";
	echo "Type: " . $type . "<br>";
	echo "Expires: " . date('d M Y', $exp) . " (" . round($expin, 0, PHP_ROUND_HALF_DOWN) . " days left)<br>";
	echo "Location: " . $location . "<br>";
}

?>
