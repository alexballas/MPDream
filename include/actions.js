$(document).ready(function() {
	$("#volume_up").click(function(){
   	$.get("control.php?action=volume&set=up",function(){ 
   	$('.volume_text').load('control.php?action=volume');});
   });
   $("#volume_down").click(function(){
   	$.get("control.php?action=volume&set=down",function(){ 
   	$('.volume_text').load('control.php?action=volume');});
   });
   
	$("#next").click(function(){
   	$.get("control.php?action=next",function(){ 
   	$('.playlist').load('playlist.php');
		$('.current_song').load('current_song.php');   	
   	});

   });
	$("#playpause").click(function(){
   	$.get("control.php?action=playpause",function(){ 
   	$('.playlist').load('playlist.php');});

   });
  	$("#stop").click(function(){
   	$.get("control.php?action=stop",function(){ 
   	$('.playlist').load('playlist.php');});

   });
	$("#previous").click(function(){
   	$.get("control.php?action=previous",function(){ 
   	$('.playlist').load('playlist.php');
   	$('.current_song').load('current_song.php');	
   });
   });
	$('.volume_text').load('control.php?action=volume');
	$('.playlist').load('playlist.php',function(){ 
			$('.ptitle').load('control.php?action=totalqueue',function(){ 
			$('.current_song').fadeIn("slow").load('current_song.php');
			
   });		
   });
	var refreshId = setInterval(
	function()
		{
			$('.volume_text').load('control.php?action=volume');
			$('.playlist').load('playlist.php',function(){ 
			$('.ptitle').load('control.php?action=totalqueue',function(){ 
			$('.current_song').load('current_song.php');
		
   });		
   });
		}, 10000);
	//$('.playlist').find('.songlist').live('click', function() {
		//$.get("control.php?action=play&num=" + this.id,function(){
		//	   $('.playlist').load('playlist.php');		  
  		//});
	//});
		
});

function clickplaylist(clicked_id) {
		$.get("control.php?action=play&num=" + clicked_id,function(){
			   $('.playlist').load('playlist.php');	
			   $('.current_song').load('current_song.php');	  
	  });
}
