<?php
if ( ! defined( 'ABSPATH' ) ) exit;


/***************************************************************
	Custom Taxonomy Types de plats
/***************************************************************/

add_action( 'init', 'kasutan_plats_tag', 0 );
function kasutan_plats_tag() {
	// Labels part for the GUI
	$labels = array(
		'name' => _x( 'Type de plat/boisson', 'taxonomy general name' ),
		'singular_name' => _x( 'Type de plat/boisson', 'taxonomy singular name' ),
		'menu_name' => __( 'Types de plat/boisson' ),
	); 
	register_taxonomy('ohm_types_plats','ohm_carte',array(
		'hierarchical' => true,
		'labels' => $labels,
		'show_ui' => true, 
		'show_admin_column' => true,
		'query_var' => true,
		'public' => false, 
		'show_in_rest' => false
	));
}
