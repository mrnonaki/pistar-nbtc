<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/config/config.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/mmdvmhost/tools.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/mmdvmhost/functions.php';

if (filesize(LINKLOGPATH."/Links.log") == 0) {
	$linkDest = "not linked";
}

if ($linkLog = fopen(LINKLOGPATH."/Links.log",'r')) {
	while ($linkLine = fgets($linkLog)) {
		if (preg_match_all('/^(.{19}).*(D[A-Za-z]*).*Type: ([A-Za-z]*).*Rptr: (.{8}).*Refl: (.{8}).*Dir: (.{8})/',$linkLine,$linx) > 0) {
			$linkDate	= $linx[1][0];
			$protocol	= $linx[2][0];
			$linkType	= $linx[3][0];
			$linkSource	= $linx[4][0];
			$linkDest	= $linx[5][0];
			$linkDir	= $linx[6][0];
		}
		$status = substr($linkDest,0,7);
	}
}
fclose($linkLog);

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
?>
<form method="post" action="proc.php">
	<br>
	<input type="hidden" name="module" value="<?php echo $configdstar['callsign'];?>">
	<table>
		<tr>
			<td><button name="unlink" type="submit" style="width:80px;" value="unlink">UnLink</button></td>
			<td colspan="3"><select name="linkto" style="width:240px;">
				<option selected <?php echo "value=\"".$status."\">".$linkDest;?></option>
				<option>====================</option>
				<option value="REF001 ">Reflector REF001</option>
				<option value="REF087 ">Reflector REF087</option>
				<option value="REF520 ">Reflector REF520</option>
				<option>====================</option>
				<option value="E24DA  ">E24DA Bangkok</option>
				<option value="E24DB  ">E24DB Pathum Thani</option>
				<option value="E24DC  ">E24DC Chonburi</option>
				<option value="E24DD  ">E24DD Surin</option>
				<option value="E24DE  ">E24DE Maha Sarakham</option>
				<option value="E24DF  ">E24DF Phitsanulok</option>
				<option value="E24DG  ">E24DG Chiang Mai</option>
				<option value="E24DH  ">E24DH Ranong</option>
				<option value="E24DI  ">E24DI Songkhla</option>
				<option value="E24DJ  ">E24DJ Phuket</option>
				<option value="E24DK  ">E24DK Surat Thani</option>
				<option>====================</option>
    			</select></td>
			<td><button name="room" type="submit" style="width:80px;" value="A">A</button></td>
			<td><button name="room" type="submit" style="width:80px;" value="B">B</button></td>
			<td><button name="room" type="submit" style="width:80px;" value="C">C</button></td>
			<td><button name="room" type="submit" style="width:80px;" value="D">D</button></td>
			<td><button name="room" type="submit" style="width:80px;" value="E">E</button></td>
		</tr><tr>
			<td>Restart:</td>
			<td><button name="service" type="submit" style="width:80px;" value="mmdvm">MMDVM</button></td>
			<td><button name="service" type="submit" style="width:80px;" value="ircddb">ircDDB</button></td>
			<td><button name="service" type="submit" style="width:80px;" value="dapnet">DAPNET</button></td>
			<td><button name="service" type="submit" style="width:80px;" value="ambe">AMBE</button></td>
			<td></td>
			<td>Hotspot:</td>
			<td><button name="power" type="submit" style="width:80px;" value="reboot">Reboot</button></td>
			<td><button name="power" type="submit" style="width:80px;" value="poweroff">Shutdown</button></td>
		</tr>
	</table>
</form>
