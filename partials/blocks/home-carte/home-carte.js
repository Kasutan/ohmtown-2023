(function($) {

	$( document ).ready(function() {

		var width=$(window).width();
		var bloc=$('.acf.home-carte');
		if(width<960) {
			setInterval(function() {
				$(bloc).toggleClass('js-toggle-slide');
			},8000);
		} else {
			console.log('desktop');
			$('.toggle-zones div').hover(function () { 
				if($(this).hasClass('zone-0') && $(bloc).hasClass('js-toggle-slide')) {
					$(bloc).toggleClass('js-toggle-slide');
				} else if($(this).hasClass('zone-1') && !$(bloc).hasClass('js-toggle-slide')) {
					$(bloc).toggleClass('js-toggle-slide');
				} 

			},
			function () { 
				//aucune action quand on sort de la zone

			});
		}

		
	}); //fin document ready
})( jQuery );

