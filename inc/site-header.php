<?php
add_filter( 'body_class', function( $classes ) {
	if (!function_exists('get_field')) {
		return $classes;
	}
	if (esc_attr(get_field('couleur_footer'))==='Blanc') {
		$classes = array_merge( $classes, array( 'footer-blanc' ) );
	}

	if(is_single() || esc_attr(get_field('hauteur_banniere'))==='reduite') {
		$classes = array_merge( $classes, array( 'banniere-reduite' ) );
	}

	return $classes;

} );


add_action('tha_header_top','kasutan_header_top');
function kasutan_header_top() {
	echo '<div class="inner-header">';
	$logo=$resa_mobile=$resa_desktop=$resa_url='';
	if(function_exists('get_field')) {
		$logo=esc_attr(get_field('ohm_logo_header','option'));
		$resa_mobile=esc_attr(get_field('ohm_resa_label_mobile','option'));
		$resa_desktop=esc_attr(get_field('ohm_resa_label_desktop','option'));
		$resa_url=esc_url(get_field('ohm_resa_cible','option'));
	}

	if($logo) {
		printf('<div class="logo-header"><a href="/" class="logo-link" title="Accueil">%s</a></div>', wp_get_attachment_image( $logo,'thumbnail',array('decoding'=>'async','loading'=>'eager')));
	}

	if($resa_mobile && $resa_url) {
		kasutan_bouton_resa($resa_mobile,$resa_url,'mobile');
	}

	?>

	<button class="menu-toggle picto" id="menu-toggle" aria-controls="volet-navigation"  aria-label="Menu">
		<?php echo kasutan_picto(array('icon'=>'menu', 'class'=>'menu', 'size'=>'32'));?>
		<?php echo kasutan_picto(array('icon'=>'close', 'class' => 'fermer-menu','size'=>'16'));?>
	</button>
	
	<div class="volet-navigation"  id="volet-navigation"><div class="inner-volet">

		<nav id="site-navigation" class="nav-main" aria-label="menu principal">
		<?php
		if( has_nav_menu( 'primary' ) ) {
			wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu', 'container_class' => 'nav-primary' ) );
		}
		?>
		
		</nav>
		<?php

		if($resa_desktop && $resa_url) {
			kasutan_bouton_resa($resa_desktop, $resa_url, 'sans-fleche');
		}

		if( has_nav_menu( 'social' ) ) {
			wp_nav_menu( array( 'theme_location' => 'social', 'menu_id' => 'social-header', 'container_class' => 'nav-social' ) );
		}

	echo '</div></div>'; //fin .volet navigation
	echo '</div>'; //fin inner-header;
}

function kasutan_bouton_resa($label,$url,$classe='') {
	printf('<a href="%s" class="iframe resa bouton primaire %s" target="_blank" rel="noopener noreferrer">%s</a>',
		$url,
		$classe,
		$label
	);

}