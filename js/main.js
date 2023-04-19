(function($) {

	$( document ).ready(function() {
		var width=$(window).width();

		
		

		/********* Ouvrir popup de réservation **********/
		$('.iframe').modaal({
			type:'iframe',
			width:400,
			height:800
		});
		

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

		//Supprimer les attributs aria-describedby qui pointent vers des éléments inexistants
		var inputsAvecAria=$('[aria-describedby]');
		if(inputsAvecAria.length > 0) {
			$(inputsAvecAria).each(function() {
				var cible=$(this).attr('aria-describedby');
				if($('#'+cible).length === 0) {
					$(this).removeAttr('aria-describedby');
				}
			});
		}

		//Corriger la valeur de l'attribut for du label select
		var labelToFix=$('label[for*="select"]');
		console.log(labelToFix);
		if(labelToFix.length > 0) {
			$(labelToFix).each(function() {
				var f=$(this).attr("for");
				console.log('f',f);
				f=f.replace('-label','');
				console.log('f',f);

				$(this).attr('for',f);

			})
		}

	}); //fin document ready
})( jQuery );
