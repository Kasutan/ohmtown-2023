(function($) {

	$( document ).ready(function() {
		var width=$(window).width();

		
		/********* Ouvrir-fermer les sous-menus mobile **********/
		var ouvrirSousMenu=$('.volet-navigation .ouvrir-sous-menu');
		if(ouvrirSousMenu.length>0) {
			ouvrirSousMenu.click(function(e) {
				var sousMenu=$(this).siblings('.sub-menu');

				if($(this).hasClass('js-ouvert')) {
					//le sous-menu était ouvert, on le referme
					$(this).removeClass('js-ouvert');
					$(sousMenu).slideUp();
				} else {
					//on referme tous les sous-menus
					ouvrirSousMenu.removeClass('js-ouvert');
					$('.volet-navigation .sub-menu').slideUp();

					//on ouvre celui demandé
					$(this).addClass('js-ouvert');
					$(sousMenu).slideDown();
				}
			});
		}
		

		/****************** Copier le lien single au clic sur un bouton *************************/	
		//https://developer.mozilla.org/en-US/docs/Web/API/Clipboard/writeText
		//Attention fonctionnalité désactivée pour localhost sur Chrome et probablement sur Firefox et/ou uniquement autorisée en httpS

		var boutonCopier=$('#copier-url');
		if(boutonCopier.length > 0) {
			boutonCopier.click(function(){
				let text=$(this).attr('data-url');
				if(navigator && navigator.clipboard && navigator.clipboard.writeText) {
					navigator.clipboard.writeText(text).then( () => {
						/* success */
						//TODO tester avec site en ligne
						console.log('Lien copié dans le presse-papier :',text);
						$(this).find('.avant').hide();
						$(this).find('.apres').show();
						},
						() => {
						/* failure */
						alert('Le presse-papier n\'est pas accessible sur ce navigateur. Vous pouvez copier le lien directement ici : '+ text);

						}
					);
				} else {
					alert('Le presse-papier n\'est pas accessible sur ce navigateur. Vous pouvez copier le lien directement ici : '+ text);
				}

				
				
			})
		}



		/****************** Sticky header *************************/
		
		var siteHeader=$('.site-header');
		var siteContent=$('.site-main');
		
		if(width < 960) {
			$(siteHeader).addClass('js-fixed');
			siteContent.css('margin-top',siteHeader.outerHeight());
		} else {
			$("#volet-navigation").removeAttr('aria-expanded');
		}
		
		
		/************ Single Job : copier nom du job dans input intitulé du poste **************/
		if($('body').hasClass('single-jobs')) {
			var titre=$('.single-title').html();
			var inputTitre=$('.id-poste input');
			if(inputTitre.length > 0) {
				$(inputTitre).val(titre);
			}
		}


	}); //fin document ready
})( jQuery );

/*=================================================
Animations
=================================================*/
//Only Use the IntersectionObserver if it is supported
/*
if ('IntersectionObserver' in window) {
	const config = {
		//rootMargin: '50px 20px 75px 30px',
		//threshold: [0, 0.25, 0.75, 1]
		};

		
	observer = new IntersectionObserver((entries) => {
		entries.forEach(entry => {
			if (entry.intersectionRatio > 0) {
			entry.target.classList.add('fade-in');
			observer.unobserve(entry.target);
			} else {
			entry.target.classList.remove('fade-in');
			}
		}, config);
	});

	const fadeInElements=document.querySelectorAll('.js-fade-in-on-visible');
	fadeInElements.forEach(elem => {
		observer.observe(elem);
	});


	observer2 = new IntersectionObserver((entries) => {
		entries.forEach(entry => {
			if (entry.intersectionRatio > 0) {
			jQuery(entry.target).children().addClass('cascade');
			observer.unobserve(entry.target);
			} 
		}, config);
	});

	const cascadeElements=document.querySelectorAll('.js-cascade-on-visible');
	cascadeElements.forEach(item => {
		observer2.observe(item);
	});

} else {
	//if Intersection Observer is not supported, add classes right away
	jQuery('.js-animate-on-visible-cascade').addClass('cascade'); 
	jQuery('.js-animate-on-visible').addClass('fade-in');
}*/
