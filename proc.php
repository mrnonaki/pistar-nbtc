<?php
if (isset($_GET['ambeserver'])) {
	$ambeserver = $_GET['ambeserver'];
	if ($ambeserver == 'start') {
		exec ('sudo service AMBEserver start');
	} elseif ($ambeserver == 'stop') {
		exec ('sudo service AMBEserver stop');
	} elseif ($ambeserver == 'restart') {
		exec ('sudo service AMBEserver restart');
	}
}

if (isset($_GET['ambeserver1'])) {
	$ambeserver1 = $_GET['ambeserver1'];
	if ($ambeserver1 == 'start') {
		exec ('sudo service AMBEserver1 start');
	} elseif ($ambeserver1 == 'stop') {
		exec ('sudo service AMBEserver1 stop');
	} elseif ($ambeserver1 == 'restart') {
		exec ('sudo service AMBEserver1 restart');
	}
}

if (isset($_POST['room'])) {
	$module = $_POST['module'];
	$linkto = $_POST['linkto'];
	$room = $_POST['room'];
	exec ("sudo remotecontrold \"".$module."\" link never \"".$linkto.$room."\"");
}

if (isset($_POST['unlink'])) {
	$module = $_POST['module'];
	exec ("sudo remotecontrold \"".$module."\" unlink");
}

if (isset($_POST['power'])) {
	$power = $_POST['power'];
	if ($power == 'reboot' ) {
		exec ('sleep 5 && sudo shutdown -r now > /dev/null &');
	} elseif ($power == 'poweroff' ) {
		exec ('sleep 5 && sudo shutdown -h now > /dev/null &');
	}
}

if (isset($_POST['service'])) {
	$service = $_POST['service'];
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