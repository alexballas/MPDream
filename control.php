<?php
require("./include/mpd.class.php");
$config = parse_ini_file("./include/config.ini");

// try to connect to MPD server
$Mpd = new mpd($config["server"], $config["port"], $config["password"] == "" ? null : $config["password"]);
if (!$Mpd->connected) {
 die("Could not connect to MPD server.");
}

$memcache = new Memcache;
$memcache->connect('localhost', 11211) or die ("Could not connect");
$playlistcount = $memcache->get('mpdplaylistcount');

if ($Mpd->state == MPD_STATE_PLAYING) {
	if ($_GET["action"] == "playpause") {
		$Mpd->Pause();	
	}
  } 
elseif (($Mpd->state == MPD_STATE_PAUSED) || ($Mpd->state == MPD_STATE_STOPPED)){
	if ($_GET["action"] == "playpause") {
		$Mpd->Play();	
	}
}

else {
	if ($_GET["action"] == "playpause") {
			
	}
}

if ($_GET["action"] == "stop") {
		$Mpd->Stop();	
}
if ($_GET["action"] == "next") {
		$Mpd->Next();	
}
if ($_GET["action"] == "previous") {
		$Mpd->Previous();	
}
if ($_GET["action"] == "totalqueue") {
	echo "Playlist ";
	echo "<br />"; 
	echo $playlistcount . " songs";
}
if ($_GET["action"] == "play") {
	if (preg_match('/^\d+$/', $_GET["num"]))  {
	$Mpd->SkipTo($_GET["num"]);
	}
}
if ($_GET["action"] == "volume") {
	if (!$_GET["set"]) {
	if ($Mpd->volume != -1) {
	echo $Mpd->volume;
	}
	else {
	echo "N/A";
	}
	}
	elseif($_GET["set"] == "up") {
		$Mpd->AdjustVolume(+5);
	}
	elseif($_GET["set"] == "down") {
		$Mpd->AdjustVolume(-5);
	}
}
?>
