$(".list-item").hover(
	function(){
		$(this).find('.tool-buttons').removeClass('hide');
	}, function() {
		$(this).find('.tool-buttons').addClass('hide');
	}
);