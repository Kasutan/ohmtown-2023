(function($) {

	$( document ).ready(function() {
		console.log('js block agenda');
		var bouton = $('#toggle-events');
		var wrap = $('#toggle-events-wrap');
		var cible=$('#past-events')
		$(bouton).click(function(){
			if((wrap).hasClass('toggled')) {
				$(bouton).attr('aria-expanded',"false");
				$(cible).attr('aria-expanded',"false");
			} else {
				$(bouton).attr('aria-expanded',"true");
				$(cible).attr('aria-expanded',"true");
			}
			$(cible).slideToggle();
			$(wrap).toggleClass('toggled');
		})
	}); //fin document ready
})( jQuery );

