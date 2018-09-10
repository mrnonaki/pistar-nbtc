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
	$pic = file_get_contents("https://www.qrz.com/db/$callsign");
	
	if (strpos($txt, "ไม่พบข้อมูลที่ต้องการค้นหา") !== false) {
		fwrite($file, "error");
	} else {
		
		$postxt = strpos($txt, '<td><div align="center">1</div></td>');
		$txt = substr($txt, $postxt);
		$postxt = strpos($txt, '</div></td></tr>');
		$txt = substr($txt, 0, $postxt);
		$arraytxt = (explode(' ',$txt));
		
		$pospic = strpos($pic, 'ppic');
		$pic = substr($pic, $pospic);
		$pospic = strpos($pic, 'mypic');
		$pic = substr($pic, 0, $pospic);
		$arraypic = (explode(' ',$pic));
		$pic = substr($arraypic[10], 5, -1);
		
		$ltxt = $arraytxt[97] . " " . $arraytxt[98] . " " . $arraytxt[112] ." " . $arraytxt[182] . " " . $arraytxt[20] . " " . strtotime($arraytxt[124] . $arraytxt[125] . $arraytxt[126]) . " " . strtotime($arraytxt[141] . $arraytxt[142] . $arraytxt[143]) . " " . $pic;
		fwrite($file, $ltxt);
	}
	fclose($file);
	exec('sudo mount -o remount,ro /');
	include 'lh.php';
}
?>