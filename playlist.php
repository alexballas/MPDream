<?php
require("./include/mpd.class.php");
$config = parse_ini_file("./include/config.ini");

function is_odd( $int )
{
  return( $int % 2 );
}

$Mpd = new mpd($config["server"], $config["port"], $config["password"] == "" ? null : $config["password"]);
if (!$Mpd->connected) {
	die("Could not connect to MPD server.");
}
$currenttrackid = $Mpd->current_track_id;
$m_currenttrackid = $Mpd->current_track_id;

$memcache = new Memcache;
$memcache->connect('localhost', 11211) or die ("Could not connect");

if ($m_currenttrackid < 0) {
		$m_currenttrackid = 0;
		$memcache->delete('mpdplaylist');
}
$playlist_results1 = $memcache->get('mpdplaylist');
if (is_null($playlist_results1[$currenttrackid]["Title"])) {
	$memcache->delete('mpdplaylist');
}

if (!$memcache->get('mpdplaylist')) {
	$Mpd->RefreshPlaylist();
	
	
$m_uplist = 200;
$m_downlist = $m_uplist * 2;

//temp Hack To load all songs and not just batches of 400s
$m_downlist = count($Mpd->playlist);

if (count($Mpd->playlist) < $m_downlist) { 
	$m_downlist = count($Mpd->playlist) - 1;
}
if ($m_currenttrackid < 0) {
	$pollapanw = 0;
	$pollakatw = 0;
}
else {
	$pollapanw = $m_currenttrackid;
	$pollakatw = $m_currenttrackid;
}

for( $i=0; $i<$m_uplist; $i++ )
{	

 if ($pollapanw > 0) { $pollapanw -= 1; $newpollapanw[$i] = $pollapanw; }
    
}

$m_magicnumber = $m_downlist - count($newpollapanw);
for( $i=0; $i<$m_magicnumber; $i++ )
{
    $pollakatw	+= 1;
	 $newpollakatw[$i] = $pollakatw;
}

if (count($newpollapanw) > 0) {
$newpollapanw = array_reverse($newpollapanw);
	foreach($newpollapanw as $varrr) {		
	if (is_null($Mpd->playlist[$varrr]["Title"])) {
		$Mpd->playlist[$varrr]["Title"] = "<i>NO TITLE</i>";
	}
	if (is_null($Mpd->playlist[$varrr]["Artist"])) {
		$Mpd->playlist[$varrr]["Artist"] = "<i>NO ARTIST</i>";
	}
		$memarray[$varrr]["Title"] = $Mpd->playlist[$varrr]["Title"];
		$memarray[$varrr]["Artist"] = $Mpd->playlist[$varrr]["Artist"];
	}
}
if (is_null($Mpd->playlist[$m_currenttrackid]["Title"])) {
		$Mpd->playlist[$m_currenttrackid]["Title"] = "<i>NO TITLE</i>";
	}
	if (is_null($Mpd->playlist[$m_currenttrackid]["Artist"])) {
		$Mpd->playlist[$m_currenttrackid]["Artist"] = "<i>NO ARTIST</i>";
}
$memarray[$m_currenttrackid]["Title"] = $Mpd->playlist[$m_currenttrackid]["Title"];
$memarray[$m_currenttrackid]["Artist"] = $Mpd->playlist[$m_currenttrackid]["Artist"];

for( $i=0; $i<$m_magicnumber; $i++ )
{
	$qq = $newpollakatw[$i];
	if (!$Mpd->playlist[$qq]["file"]) { break; }
	if ($qq) {
	if (is_null($Mpd->playlist[$qq]["Title"])) {
		$Mpd->playlist[$qq]["Title"] = "<i>NO TITLE</i>";
	}
	if (is_null($Mpd->playlist[$qq]["Artist"])) {
		$Mpd->playlist[$qq]["Artist"] = "<i>NO ARTIST</i>";
	}
	}
	 $memarray[$qq]["Title"] = $Mpd->playlist[$qq]["Title"];
	 $memarray[$qq]["Artist"] = $Mpd->playlist[$qq]["Artist"];
}
$mpdlistcount = count($Mpd->playlist);
$memcache->set('mpdplaylist',$memarray, false, 40) or die ("Failed to save data at the server");
$memcache->set('mpdplaylistcount',$mpdlistcount, false, 40) or die ("Failed to save data at the server");
}

$playlist_results = $memcache->get('mpdplaylist');


$uplist = 2;
$downlist = 8;
//temp Hack To load all songs and not just batches of 400s
$uplist = count($playlist_results);
$downlist = count($playlist_results);

if (count($playlist_results) < $downlist) { 
	$downlist = count($playlist_results) - 1;
}
if ($currenttrackid < 0) {
	$dekapanw = 0;
	$dekakatw = 0;
}
else {
	$dekapanw = $currenttrackid;
	$dekakatw = $currenttrackid;
}

for( $i=0; $i<$uplist; $i++ )
{
    if ($dekapanw > 0) { $dekapanw -= 1; $newdekapanw[$i] = $dekapanw; }
}
$magicnumber = $downlist - count($newdekapanw);

for( $i=0; $i<$magicnumber; $i++ )
{
    $dekakatw	+= 1;
	 $newdekakatw[$i] = $dekakatw;
}

if (count($newdekapanw) > 0) {
$newdekapanw = array_reverse($newdekapanw);

foreach($newdekapanw as $varr) {
	echo "<a onclick='clickplaylist(this.id);' id='$varr'>";
	 if (is_odd($varr)) {
   			echo "<div class='songlist songodd'>"; 	
   	}
   	else {
   			echo "<div class='songlist songeven'>"; 	
    }
	 echo $varr . ". " . $playlist_results[$varr]["Title"];
	 echo "<br />";
	 echo "<b>from</b> " . $playlist_results[$varr]["Artist"];
	 echo "<br />";
	 echo "</div>";
	 echo "</a>";

}
}
if ($currenttrackid >= 0) {
	echo "<a onclick='clickplaylist(this.id);' id='$currenttrackid'>";
	if (is_odd($currenttrackid)) {
		echo "<div class='songlist thesong'>"; 	
   	}
	else {
		echo "<div class='songlist thesong'>"; 	
	}
	echo $currenttrackid . ". " . $playlist_results[$currenttrackid]["Title"];
	echo "<br />";
	echo "<b>from</b> " . $playlist_results[$currenttrackid]["Artist"];
	echo "<br />";
	echo "</div>";
		echo "</a>";
}
else {
	$currenttrackid = 0;
	echo "<a onclick='clickplaylist(this.id);' id='$currenttrackid'>";
	if (is_odd($currenttrackid)) {
   			echo "<div class='songlist'>"; 	
   }
	else {
   			echo "<div class='songlist'>"; 	
	}
	echo $currenttrackid . ". " . $playlist_results[$currenttrackid]["Title"];
	echo "<br />";
	echo "<b>from</b> " . $playlist_results[$currenttrackid]["Artist"];
	echo "<br />";
	echo "</div>";
	echo "</a>";
}

for( $i=0; $i<$magicnumber; $i++ )
{
	if ((is_null($playlist_results[$newdekakatw[$i]]["Title"])) || (is_null($playlist_results[$newdekakatw[$i]]["Artist"]))) {
	break;
	}
	echo "<a onclick='clickplaylist(this.id);' id='$newdekakatw[$i]'>";
	if (is_odd($newdekakatw[$i])) {
		echo "<div class='songlist songodd'>"; 	
   	}
   	else {
		echo "<div class='songlist songeven'>"; 	
    }
	 echo $newdekakatw[$i] . ". " . $playlist_results[$newdekakatw[$i]]["Title"];  
	 echo "<br />";
	 echo "<b>from</b> " . $playlist_results[$newdekakatw[$i]]["Artist"];
	 echo "<br />";  
	 echo "</div>";
	 echo "</a>";

 
	
}
?>	
