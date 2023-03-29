(function($) {

	$( document ).ready(function() {

		/*******************Toggle bloc privatiser ********************/
		var bouton = $('#toggle-priv');
		var cible=$('#privatisation');
		var wrap=$('#toggle-priv-wrap');
		$(bouton).click(function(){
			togglePriv();
		})

		function togglePriv() {
			if((wrap).hasClass('toggled')) {
				$(bouton).attr('aria-expanded',"false");
				$(cible).attr('aria-expanded',"false");
			} else {
				$(bouton).attr('aria-expanded',"true");
				$(cible).attr('aria-expanded',"true");
			}
			$(cible).slideToggle();
			$(wrap).toggleClass('toggled');
		}

		/*******************Ouvrir bloc privatiser si "privatisation" dans l'url ********************/

		const hash = window.location.hash;
		if(hash.indexOf('privatisation') >= 0) {
			togglePriv();
			$('html, body').animate({
				scrollTop: $(cible).offset().top - 80
				}, 1000);
		}


	}); //fin document ready
})( jQuery );

