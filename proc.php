<?php
$module = $_POST['module'];
$linkto = $_POST['linkto'];
$room = $_POST['room'];
if (isset($_POST['room'])) {
	exec ("sudo remotecontrold \"".$module."\" link never \"".$linkto.$room."\"");
}
if (isset($_POST['unlink'])) {
	exec ("sudo remotecontrold \"".$module."\" unlink");
}

$service = $_POST['service'];
$power = $_POST['power'];
if (isset($_POST['power'])) {
	if ($power == 'reboot' ) {
		exec ('sleep 5 && sudo shutdown -r now > /dev/null &');
	} elseif ($power == 'poweroff' ) {
		exec ('sleep 5 && sudo shutdown -h now > /dev/null &');
	}
}
if (isset($_POST['service'])) {
	if ($service == 'mmdvm') {
		exec ('sudo service mmdvmhost restart');
	} elseif ($service == 'ircddb') {
		exec ('sudo service ircddbgateway restart');
	} elseif ($service == 'dapnet') {
		exec ('sudo service dapnetgateway restart');
	} elseif ($service == 'ambe') {
		exec ('sudo service AMBEserver restart');
	}
}
if (isset($_SERVER["HTTP_REFERER"])) {
	header("Location: {$_SERVER["HTTP_REFERER"]}",TRUE,301);
}
?>