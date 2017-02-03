$(function () {
	$('#top').hide().fadeIn(3000);

	$('li:nth-of-type(1) a').hover(function () {
		$(this).animate({'backgroundColor': "#333"}, '1000');
		$(this).css('color', "#EEE");
	}, function () {
		$(this).animate({'backgroundColor': "rgba(255,255,255,0.0)"}, '1000');
		$(this).css('color', "#333");
	})

	$('li:nth-of-type(2) a, li:nth-of-type(3) a, li:nth-of-type(4) a').hover(function () {
		$(this).animate({'backgroundColor': "rgba(255,255,255,0.4);"}, '1000');
		$(this).css('border-top', 'solid 1px #333');
		$(this).css('border-bottom', 'solid 1px #333');
	}, function () {
		$(this).animate({'backgroundColor': "rgba(255,255,255,0.0)"}, '1000');
		$(this).css('border-top', 'solid 0px #333');
		$(this).css('border-bottom', 'solid 0px #333');
	})
});