(function($) {

	$( document ).ready(function() {

		/*******************Toggle bloc privatiser ********************/
		var bouton = $('#toggle-priv');
		var cible=$('#privatisation');
		var wrap=$('#toggle-priv-wrap');
		$(bouton).click(function(){
			togglePriv(true);
		})

		function togglePriv(anim) {
			if((wrap).hasClass('toggled')) {
				$(bouton).attr('aria-expanded',"false"); 
			} else {
				$(bouton).attr('aria-expanded',"true");
			}
			if(anim) {
				$(cible).slideToggle();
			} else {
				$(cible).toggle();
			}
			$(wrap).toggleClass('toggled');
		}

		/*******************Ouvrir bloc privatiser si "privatisation" dans l'url ********************/

		const hash = window.location.hash;
		if(hash.indexOf('privatisation') >= 0) {
			togglePriv(false);
			$(document).scrollTop( $(cible).offset().top - 80); // sans animation
		}

		/**********Ouvrir bloc privatiser si on clique sur "privatisation" depuis la page le lieu ********/
		$('.current-menu-item a').click(function(e) {
			//Si le volet n'est pas déjà ouvert, on l'ouvre
			if(!(wrap).hasClass('toggled')) {
				$(bouton).attr('aria-expanded',"true");
				$(cible).show();
				$(wrap).addClass('toggled');
			}
			//On place la fenêtre au bon endroit, sans animation
			$(document).scrollTop( $(cible).offset().top - 80); 

		})


	}); //fin document ready
})( jQuery );

