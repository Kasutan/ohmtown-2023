<?php

/**
* Logo + Formulaire newsletter
*
*/
add_action( 'tha_footer_top', 'kasutan_footer_top' );
function kasutan_footer_top() {
	$logo='';
	if(function_exists('get_field')) {
		$logo=esc_attr(get_field('ohm_logo_footer','option'));
	}
	if(!$logo && !is_active_sidebar('newsletter-footer')) {
		return;
	}
	echo '<div class="footer-top">';
		if($logo) {
			printf('<div class="logo-footer"><a href="/" class="logo-link" title="Accueil">%s</a></div>', wp_get_attachment_image( $logo,'thumbnail'));
		}
		if(is_active_sidebar('newsletter-footer')) {
			dynamic_sidebar( 'newsletter-footer' );
		}
	echo '</div>';
}

/**
 * Grille horaires + coordonnées + liens
 *
 */
add_action( 'tha_footer_top', 'kasutan_main_footer' );
function kasutan_main_footer() {
	$coordonnees=$email=$mentions_legales=$label_horaires=$label_liens='';
	if(function_exists('get_field')) {
		$coordonnees=wp_kses_post(get_field('ohm_coordonnees','option'));
		$email=esc_attr(get_field('ohm_email','option'));
		$mentions_legales=esc_attr(get_field('ohm_mentions_legales','option')); //champ de type page_id
		$label_horaires=wp_kses_post(get_field('ohm_label_horaires','option'));
		$label_liens=wp_kses_post(get_field('ohm_label_liens','option'));
		


	}
	
	$jours_entiers=array("Lun."=>"Lundi","Mar."=>"Mardi","Mer."=>"Mercredi",'Jeu.' => "Jeudi","Ven."=>"Vendredi","Sam."=>"Samedi","Dim."=>"Dimanche");

	echo '<div class="main-footer">';
		//Horaires
		if(have_rows('ohm_horaires','option')) :
			echo '<div class="horaires-wrap" tabindex="0">';
			if($label_horaires) printf('<p><strong>%s</strong></p>',$label_horaires);
			echo '<ul class="horaires" >';
			while(have_rows('ohm_horaires','option')) : the_row();
				$jour=wp_kses_post(get_sub_field('jour'));
				if(isset($jours_entiers[$jour])) {
					$jour_entier=$jours_entiers[$jour];
				} else {
					$jour_entier=$jour;
				}
				$ouverture=wp_kses_post(get_sub_field('ouverture'));
				$fermeture=wp_kses_post(get_sub_field('fermeture'));
				$info_supplementaire=wp_kses_post(get_sub_field('info_supplementaire'));
				if(!$ouverture) $ouverture='-';
				if(!$fermeture) $fermeture='-';
				if(!$info_supplementaire) $info_supplementaire='&nbsp;';

				if(function_exists('kasutan_forme_heure_pour_sr')) {
					$ouverture_formatee=kasutan_formate_heure_pour_sr($ouverture);
					$fermeture_formatee=kasutan_formate_heure_pour_sr($fermeture);
				} else {
					$ouverture_formatee=$ouverture;
					$fermeture_formatee=$fermeture;
				}
				
				printf('<li class="horaire"><strong class="jour"><span aria-hidden="true">%s</span><span class="screen-reader-text">%s</span></strong>',$jour,$jour_entier);
				if($ouverture) printf('<span aria-hidden="true">%s</span><span class="screen-reader-text">%s</span>',$ouverture,$ouverture_formatee);
				if($fermeture) printf('<span aria-hidden="true">%s</span><span class="screen-reader-text">%s</span>',$fermeture,$fermeture_formatee);
				if($info_supplementaire) printf('<span class="info">%s</span>',$info_supplementaire);

				echo '</li>';
			endwhile;
			echo '</ul>';
			echo '</div>';
		endif;


		//Coordonnées
		if($coordonnees) {
			echo '<div class="coordonnees">';
				printf('<p class="adresse">%s</p>', $coordonnees);
				if($email) {
					$email=antispambot( $email);
					printf('<p><a href="mailto:%s">%s</a>',$email,$email);
				}
				if($mentions_legales) {
					printf('<p><a href="%s">%s</a></p>',
						get_the_permalink( $mentions_legales),
						get_the_title( $mentions_legales)
					);
				}

			echo '</div>';

		}


		//Liens
		if( has_nav_menu( 'footer-liens') || has_nav_menu('social')) {
			echo '<div class="liens">';
				if($label_liens) printf('<strong>%s</strong>',$label_liens);
				
				if(has_nav_menu( 'social')) {
					wp_nav_menu( array( 'theme_location' => 'social', 'menu_id' => 'footer-social', 'container_class' => 'nav-social' ) );
				}
				if( has_nav_menu( 'footer-liens') ) {
					wp_nav_menu( array( 'theme_location' => 'footer-liens', 'menu_id' => 'footer-liens', 'container_class' => 'nav-footer' ) );
				}
			echo '</div>';
		}

	echo '</div>';
}

function kasutan_formate_heure_pour_sr($heure) {
	$heure=str_replace('.00','h',$heure); //enlever deux derniers zéro
	$heure=str_replace('.','h',$heure); //remplacer . par h
	if(!strpos($heure,"00h")) {
		//Si l'heure n'est pas minuit, enlever le premier zéro
		$heure=ltrim($heure,"0");
	}

	return $heure;
}

/**
* Copyright
*
*/
add_action( 'tha_footer_bottom', 'kasutan_copyright' );
function kasutan_copyright() {
	$copyright='';
	if(function_exists('get_field')) {
		$copyright=wp_kses_post(get_field('ohm_copyright','option'));
	}
	if($copyright)
	printf('<div class="copyright">%s</div>',$copyright);
}