<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<head>
<meta http-equiv="Content-Type" content="text/html" Charset="UTF-8"  /> 
<meta name="viewport" content="width=device-width, user-scalable=yes, initial-scale=0.72, maximum-scale=0.72, minimum-scale=0.72">

<title>MPDream Web Client</title>

<link rel="stylesheet" type="text/css" href="css/styles.css" />
<link href='http://fonts.googleapis.com/css?family=Days+One' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>

</head>
<body>
<div class="controls">
	<div class="ctitle">
	MPDream Web Client
	</div>
	<a id="playpause">
	<div class="play">
	Play
	</div>
	</a>
	<a id="stop">
	<div class="stop">
	Stop
	</div>
	</a>
	<a id="previous">
	<div class="rewindskip3">
	Rewind
	</div>
	<div class="rewindskip1">
	Rewind
	</div>
	<div class="rewindskip2">
	Rewind
	</div>
	</a>
	<a id="next">
	<div class="forwardskip1">
	Forward
	</div>
	<div class="forwardskip2">
	Forward
	</div>
	<div class="forwardskip3">
	Forward
	</div>
	</a>
</div>

<div class="vtitle">
Volume
</div>

<div class="volume">
	<a id="volume_up">
		<div class="volume_up">
			<div class="volume_up1">
			</div>
			<div class="volume_up2">
			</div>
			<div class="volume_up3">
			</div>
		</div>
	</a>
	<div class="volume_text">
	</div>
	<a id="volume_down">
		<div class="volume_down">
			<div class="volume_down1">
			</div>
			<div class="volume_down2">
			</div>
		</div>
	</a>
</div>

<div class="stitle">
	Now Playing
</div>

<div class="current_song">
</div>

<div class="playlist">
</div>

<div class="ptitle">
	Playlist
</div>

<div id="scroll-up-queue">
</div>
<div id="scroll-focus-queue">
</div>
<div id="scroll-down-queue">
</div>

</body>

<script src="include/jquery.js"></script>
<script src="include/css.js"></script>
<script src="include/actions.js"></script>

<script>
function checkIfInView(element){
	$.get( "current_song.php?track_id=true", function( data ) {
		var total_scroll_pixels = parseInt(data) * 44;
		$('.playlist').animate({scrollTop: total_scroll_pixels}, 1000);
    });
}
</script>

</html>
