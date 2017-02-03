$(document).ready(function () {
	$('[data-toggle="popover"]').popover();

	var count = 0;
	var text = $('#text');

	window.setInterval(function(){
	  if(count == 0) {
	  	text.fadeOut().hide().fadeIn().html('beautiful');
	  } else if(count == 1) {
	  	text.fadeOut().hide().fadeIn().html('amazing');
	  } else if(count == 2) {
	  	text.fadeOut().hide().fadeIn().html('stellar');
	  } else if(count == 3) {
	  	text.fadeOut().hide().fadeIn().html('infinite');
	  } else if(count == 4) {
	  	text.fadeOut().hide().fadeIn().html('unknown');
	  	count = -1;
	  }
	  count++;
	}, 1500);

	$('#form-4').on('click', function(e) {
		e.preventDefault();
		$.ajax({
			url: "/Gallery/contactCheck",
			method: "POST",
			data: {name: $('#form-1').val(), email: $('#form-2').val(), message: $('#form-3').val(), captcha: $('#form-cap').val()}
		}).success(function(msg){
	        //alert("Save Complete: cap = " + msg["captcha"] + " name = " + msg['name'] + " email = " + msg['email'] + " message = " + msg['message']);
	        alert(msg);
	    }).error(function(msg){
	    	alert("Error: " + msg);
	    });
	    $('#contactModal').modal('toggle');
	});
});