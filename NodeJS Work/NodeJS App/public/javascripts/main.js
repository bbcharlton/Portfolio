$(document).ready(function(){
	$(".info-parent").hover(function(){
	    $('.info-child').show();
	}, function(){
	    $('.info-child').hide();
	});
});