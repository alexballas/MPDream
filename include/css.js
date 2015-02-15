$(document).ready(function() {
	$('#volume_up').hover(function(){
     $('.volume_up1').css('background-color', '#E5E5A8');
	},
	function(){
     $('.volume_up1').css('background-color', '#F1F1D4');
	});
	
	$('#volume_down').hover(function(){
     $('.volume_down1').css('background-color', '#E5E5A8');
	},
	function(){
     $('.volume_down1').css('background-color', '#F1F1D4');
	});
	
	$('#next').hover(function(){
     $('.forwardskip1').css('border-color', 'transparent transparent transparent #C68060');
     $('.forwardskip2').css('border-color', 'transparent transparent transparent #C68060');
     $('.forwardskip3').css('border', '5px solid #C68060');
	},
	function(){
     $('.forwardskip1').css('border-color', 'transparent transparent transparent #DE9D7F');
     $('.forwardskip2').css('border-color', 'transparent transparent transparent #DE9D7F');
     $('.forwardskip3').css('border', '5px solid #DE9D7F');
	});
	$('#previous').hover(function(){
     $('.rewindskip1').css('border-color', 'transparent #C68060 transparent transparent');
     $('.rewindskip2').css('border-color', 'transparent #C68060 transparent transparent');
     $('.rewindskip3').css('border', '5px solid #C68060');
	},
	function(){
     $('.rewindskip1').css('border-color', 'transparent #DE9D7F transparent transparent');
     $('.rewindskip2').css('border-color', 'transparent #DE9D7F transparent transparent');
     $('.rewindskip3').css('border', '5px solid #DE9D7F');
	});
	$('#playpause').hover(function(){
     $('.play').css('border-color', 'transparent transparent transparent #C68060');
	},
	function(){
     $('.play').css('border-color', 'transparent transparent transparent #DE9D7F');
	});
	$('#stop').hover(function(){
     $('.stop').css('border', '30px solid #C68060');
	},
	function(){
     $('.stop').css('border', '30px solid #DE9D7F');
	});
	$(function() {
            $('.playlist').find('.songeven').live('mouseover', function() {
            $(this).css('background-color','#FFC491');  
				});
				$('.playlist').find('.songeven').live('mouseout', function() {
            $(this).css('background-color','#F1F1D4');  
				});
				$('.playlist').find('.songodd').live('mouseover', function() {
            $(this).css('background-color','#FFC491');  
				});
				$('.playlist').find('.songodd').live('mouseout', function() {
            $(this).css('background-color','#E5E5A8');  
				});
				$('.playlist').find('.thesong').live('mouseover', function() {
            $(this).css('background-color','#FFC491');  
				});
				$('.playlist').find('.thesong').live('mouseout', function() {
            $(this).css('background-color','#DE9D7F');  
				});
 });    
});