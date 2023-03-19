<?php
add_action('tha_header_top','kasutan_header_top');
function kasutan_header_top() {
	echo '<div class="inner-header">';
	$logo=$resa_mobile=$resa_desktop='';
	if(function_exists('get_field')) {
		$logo=esc_attr(get_field('ohm_logo_header','option'));
		$resa_mobile=esc_attr(get_field('ohm_resa_label_mobile','option'));
		$resa_desktop=esc_attr(get_field('ohm_resa_label_desktop','option'));
		//TODO script ou cible du bouton de résa
	}

	if($logo) {
		printf('<div class="logo-header"><a href="/" class="logo-link">%s</a></div>', wp_get_attachment_image( $logo,'medium'));
	}

	if($resa_mobile) {
		kasutan_bouton_resa($resa_mobile,'mobile');
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

		if($resa_desktop) {
			kasutan_bouton_resa($resa_desktop,'sans-fleche');
		}

		if( has_nav_menu( 'social' ) ) {
			wp_nav_menu( array( 'theme_location' => 'social', 'menu_id' => 'social-header', 'container_class' => 'nav-social' ) );
		}

	echo '</div></div>'; //fin .volet navigation
	echo '</div>'; //fin inner-header;
}

function kasutan_bouton_resa($label,$classe='') {
	//TODO script ou cible du bouton de résa
	printf('<a href="https://www.overfull.fr/" class="resa bouton primaire %s" target="_blank" rel="noopener noreferrer">%s</a>',
		$classe,
		$label
	);

}