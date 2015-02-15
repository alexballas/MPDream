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


if (($Mpd->state == MPD_STATE_PLAYING) || ($Mpd->state == MPD_STATE_PAUSED)) {
	$playlist = $memcache->get('mpdplaylist');
	echo $playlist[$Mpd->current_track_id]["Title"] . " <b>from</b> " . $playlist[$Mpd->current_track_id]["Artist"];
}
else {
	echo "- - - - - - -";
}
?>