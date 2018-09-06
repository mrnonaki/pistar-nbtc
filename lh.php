<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/config/config.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/mmdvmhost/tools.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/mmdvmhost/functions.php';
date_default_timezone_set('Asia/Bangkok');
$file = file_get_contents('db/'.$callsign);

$listElem = $lastHeard[0];
$callsign = $listElem[2];
$device = $listElem[3];

if (strpos($file, "error") !== false) {
	echo "ไม่พบข้อมูลที่ต้องการค้นหา";
} else {
	$array = (explode(' ',$file));
	$fname = $array[0];
	$lname = $array[1];
	$type = $array[2];
	$location = $array[3];
	$exp = $array[6];
	$expin = ($exp - time()) / 86400;
	
	echo "Callsign: " . $callsign . " /" . $device . "<br>";
	echo "Name: " . $fname . " " . $lname . "<br>";
	echo "Type: " . $type . "<br>";
	echo "Location: " . $location . "<br>";
	echo "Expires: " . date('d M Y', $exp) . " (" . round($expin, 0, PHP_ROUND_HALF_DOWN) . " days left)<br>";
}
?>