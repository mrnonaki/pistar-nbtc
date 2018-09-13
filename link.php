<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/config/config.php';          // MMDVMDash Config
include_once $_SERVER['DOCUMENT_ROOT'].'/mmdvmhost/tools.php';        // MMDVMDash Tools
include_once $_SERVER['DOCUMENT_ROOT'].'/mmdvmhost/functions.php';    // MMDVMDash Functions

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

if (isset($_POST['linkto'])) {
	$module = $configdstar['callsign'];
	$linkto = $_POST['linkto'];
	$linkCommand = "sudo remotecontrold \"".$module."\" link never \"".$linkto."\"";
	exec ($linkCommand);
}

echo "<table><td><table><tr>\n";
echo '<form method="post">' . "\n";
echo '<td><input name="linkto" type="submit" value="REF087 A"></td>' . "\n";
echo '<td><input name="linkto" type="submit" value="REF087 B"></td>' . "\n";
echo "</tr><tr>\n";
echo '<td><input name="linkto" type="submit" value="REF087 C"></td>' . "\n";
echo '<td><input name="linkto" type="submit" value="REF087 D"></td>' . "\n";
echo "</tr><tr>\n";
showMode("D-Star", $mmdvmconfigs);
showMode("D-Star Network", $mmdvmconfigs);
echo "</tr><tr>\n";
echo "<td colspan=\"2\">" . getActualLink($reverseLogLinesMMDVM, "D-Star") . "\n";
echo "</td></tr></table></td><td><table>\n";
echo '<tr><td><input name="linkto" type="submit" value="REF520 A"></td></tr>' . "\n";
echo '<tr><td><input name="linkto" type="submit" value="REF520 B"></td></tr>' . "\n";
echo '<tr><td><input name="linkto" type="submit" value="REF520 C"></td></tr>' . "\n";
echo '<tr><td><input name="linkto" type="submit" value="REF520 D"></td></tr>' . "\n";
echo "</form></table></td></table>\n";

?>