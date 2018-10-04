<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/config/config.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/mmdvmhost/tools.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/mmdvmhost/functions.php';

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

if (isset($_POST['power'])) {
	if (($_POST['power']) == "Reboot" ) {
	exec ('sleep 5 && sudo shutdown -r now > /dev/null &');
	} else if (($_POST['power']) == "Power" ) {
		exec ('sleep 5 && sudo shutdown -h now > /dev/null &');
	}
}

if (isset($_POST['linkto'])) {
	$module = $configdstar['callsign'];
	$linkto = $_POST['linkto'];
	$linkCommand = "sudo remotecontrold \"".$module."\" link never \"".$linkto."\"";
	exec ($linkCommand);
}

echo "<form method=\"post\"><table><tr>\n";
echo "\t<td><input name=\"linkto\" type=\"submit\" value=\"REF087 A\"></td>\n";
echo "\t<td><input name=\"linkto\" type=\"submit\" value=\"REF087 B\"></td>\n";
echo "\t<td><input name=\"linkto\" type=\"submit\" value=\"REF087 C\"></td>\n";
echo "\t<td><input name=\"linkto\" type=\"submit\" value=\"REF087 D\"></td>\n";
echo "\t<td><input name=\"linkto\" type=\"submit\" value=\"REF087 E\"></td>\n";
echo "\t<td><input name=\"linkto\" type=\"submit\" value=\"DCS001 U\"></td>\n";
echo "</tr></table><table><tr>\n";
echo "\t<td><input name=\"linkto\" type=\"submit\" value=\"E24DA  C\"></td>\n";
echo "\t<td><input name=\"linkto\" type=\"submit\" value=\"E24DB  C\"></td>\n";
echo "\t<td><input name=\"linkto\" type=\"submit\" value=\"E24DC  C\"></td>\n";
echo "\t<td><input name=\"linkto\" type=\"submit\" value=\"E24DD  C\"></td>\n";
echo "\t<td><input name=\"linkto\" type=\"submit\" value=\"E24DE  C\"></td>\n";
echo "\t<td><input name=\"linkto\" type=\"submit\" value=\"E24DF  C\"></td>\n";
#echo "</tr><tr>\n";
echo "\t<td><input name=\"linkto\" type=\"submit\" value=\"E24DG  C\"></td>\n";
echo "\t<td><input name=\"linkto\" type=\"submit\" value=\"E24DH  C\"></td>\n";
echo "\t<td><input name=\"linkto\" type=\"submit\" value=\"E24DI  C\"></td>\n";
echo "\t<td><input name=\"linkto\" type=\"submit\" value=\"E24DJ  C\"></td>\n";
echo "\t<td><input name=\"linkto\" type=\"submit\" value=\"E24DK  C\"></td>\n";
echo "</tr></table><table><tr>\n";
echo "\t<td style=\"text-align:right\"><input name=\"power\" type=\"submit\" value=\"Reboot\"></td>\n";
echo "\t<td><input name=\"power\" type=\"submit\" value=\"Power\"></td>\n";
echo "</tr></table></form>\n";
?>