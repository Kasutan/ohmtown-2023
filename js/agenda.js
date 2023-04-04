(function($) {

	$( document ).ready(function() {




		/*******************Toggle événements passés ********************/
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


		/*******************Filtre par date ********************/

		var input=$('#date-filter');
		var listes=$('ul.events');
		var bloc=$('.acf.agenda');


		//https://flatpickr.js.org/examples/
		flatpickr.localize(flatpickr.l10ns.fr);
		$('#date-filter').flatpickr({
			altInput: true,
			altFormat: "d.m.Y",
			dateFormat: "Y-m-d",
			disableMobile: true //utiliser flatpicker à la place du date picker natif en mobile aussi
		});
		
		$(input).change(function(e) {
			var val=$(this).val();
			setTimeout(function() {
				//Feedback visuel prise en compte du filtre
				$(bloc).css('opacity',0.2);

				//On cache tous les events
				$(listes).find('.event').hide();

				//On réaffiche tous les events pour la date demandée
				$(listes).find('.event.'+val).show();

				//On montre un bouton pour annuler le filtre
				$('#date-filter-clear').fadeIn();

				//On ouvre le volet des événements passés s'il n'est pas déjà ouvert
				if(!(wrap).hasClass('toggled')) {
					$(bouton).click();
				}

				//Fin de l'effet du filtre, on rétablit l'opacité
				setTimeout(function() {
					$(bloc).css('opacity',1);
				
				},800);
			},500);
		})

		$('#date-filter-clear').click(function(e) {
			e.preventDefault(); // Sinon la page recharge (button dans un form)

			setTimeout(function() {
				$(bloc).css('opacity',0.2);

				//On montre tous les évents
				$(listes).find('.event').show();

				//On vide l'input date
				$(input).val('');
				$('.acf.agenda .form-control').val('');

				//On ouvre le volet des événements passés s'il n'est pas déjà ouvert
				if(!(wrap).hasClass('toggled')) {
					$(bouton).click();
				}

				//On masque le bouton reset
				$('#date-filter-clear').fadeOut();

				setTimeout(function() {
					$(bloc).css('opacity',1);
				
				},800);
			},500);
		})

	}); //fin document ready
})( jQuery );

