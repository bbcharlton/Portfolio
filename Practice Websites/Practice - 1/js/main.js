$(function() {
	$('#js').click(function() {
		$('#features-content').html($('#hidden-1').html());
		$('#features-content').css('visibility', 'visible');

	});

	$('#jq').click(function() {
		$('#features-content').html($('#hidden-2').html());
		$('#features-content').css('visibility', 'visible');
	});

	$('#html').click(function() {
		$('#features-content').html($('#hidden-3').html());
		$('#features-content').css('visibility', 'visible');
	});

	$('#css').click(function() {
		$('#features-content').html($('#hidden-4').html());
		$('#features-content').css('visibility', 'visible');
	});

	$('#slide-in').click(function() {
		$('#slideout').animate({width:'toggle'},350);
		$('#slide-out').show();
		$('nav').css('display', 'none');
	});

	$('#slide-out').click(function() {
		$('#slide-out').hide();
		$('#slideout').animate({width:'toggle'},350);
		$('nav').css('display', 'block');
	});

	$('#slideout-click').click(function() {
		$('#slide-out').hide();
		$('#slideout').animate({width:'toggle'},350);
		$('nav').css('display', 'block');
	});
});