(function($) {

	$( document ).ready(function() {

		var width=$(window).width();
		var slider=$('.acf.home-actualites .loop-slider');
		if(width<768) {
			$(slider).scrollLeft('100');
		} 
		
	}); //fin document ready
})( jQuery );

