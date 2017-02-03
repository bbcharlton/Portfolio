$(function() {

	$('input').keyup(function(e) {
	    if (e.keyCode == 13) {
	        var address = $(this).val();
	        address = address.replace(/\s+/g, '+');
	        $('#map').find('iframe').attr('src', 'https://www.google.com/maps/embed/v1/place?q=' + address + '&key=AIzaSyDx4HUPbPetn6o91y2F2w3qxc3IlWQraJ0');
	        $(this).val('');
	    }
	});
})