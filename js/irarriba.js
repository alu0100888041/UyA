$(document).ready(function(){
 
	$('.volverarriba').click(function(){
		$('body, html').animate({
			scrollTop: '0px'
		}, 700);
	});
});