(function($) {

	$( document ).ready(function() {
		$('.acf.home-lieu .galerie').each(function(index) {
			var nb=$(this).attr("data-count");
			var tempo=parseInt($(this).attr("data-tempo"))*1000;
			var galerie=$(this);
			setInterval(function(){
				defile(galerie,nb);
			},tempo);
		});
		function defile(galerie,nb) {
			let next=parseInt($(galerie).attr('data-slide')) + 1;
			if(next > nb) {
				next=1;
			}
			$(galerie).find('.image').removeClass('visible');
			$(galerie).find('.image:nth-child('+next+')').addClass('visible');
			$(galerie).attr('data-slide',next);
		}
	}); //fin document ready
})( jQuery );

