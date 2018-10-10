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

<form class="form-inline" method="post" action="../proc.php">
	<input type="hidden" name="module" value="<?php echo $configdstar['callsign'];?>"> 
	<select name="linkto" class="custom-select mt-2 mr-2">
		<option selected <?php echo "value=\"".$status."\">".$linkDest;?></option>
		<option>====================</option>
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
    </select>
	<div class="btn-group mt-2 mr-2">
		<button name="room" type="submit" value="A" class="btn btn-info">A</button>
		<button name="room" type="submit" value="B" class="btn btn-info">B</button>
		<button name="room" type="submit" value="C" class="btn btn-info">C</button>
		<button name="room" type="submit" value="D" class="btn btn-info">D</button>
		<button name="room" type="submit" value="E" class="btn btn-info">E</button>
	</div>
	<div class="btn-group mt-2 mr-2">
		<button name="unlink" type="submit" value="unlink" class="btn btn-warning">UnLink</button>
	</div>
</form>