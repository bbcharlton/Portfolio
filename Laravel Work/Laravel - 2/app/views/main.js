$('.view-more').on('click', function(e) {
	e.preventDefault();
	$(this).parent().find('.body').show();
	$(this).parent().find('.summary').hide();
	$(this).hide();
});