<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/***************************************************************
	Custom Post Type : programmation
/***************************************************************/
function kasutan_programmation_post_type() {

	$labels = array(
		'name'                  => _x( 'Events', 'Post Type General Name', 'ohmtown' ),
		'singular_name'         => _x( 'Event', 'Post Type Singular Name', 'ohmtown' ),
		'menu_name'             => __( 'Programmation', 'ohmtown' ),
		'name_admin_bar'        => __( 'Programmation', 'ohmtown' ),
		'archives'              => __( 'Archives des events', 'ohmtown' ),
		'attributes'            => __( 'Item Attributes', 'ohmtown' ),
		'parent_item_colon'     => __( 'Parent Item:', 'ohmtown' ),
		'all_items'             => __( 'Tous les events', 'ohmtown' ),
		'add_new_item'          => __( 'Ajouter un event', 'ohmtown' ),
		'add_new'               => __( 'Ajouter', 'ohmtown' ),
		'new_item'              => __( 'Nouvel event', 'ohmtown' ),
		'edit_item'             => __( 'Modifier cet event', 'ohmtown' ),
		'update_item'           => __( 'Mettre à jour cet event', 'ohmtown' ),
		'view_item'             => __( 'Voir cet event', 'ohmtown' ),
		'view_items'            => __( 'Voir les events', 'ohmtown' ),
		'search_items'          => __( 'Rechercher un event', 'ohmtown' ),
		'not_found'             => __( 'Aucun event', 'ohmtown' ),
		'not_found_in_trash'    => __( 'Aucun event dans la corbeille', 'ohmtown' ),
	);
	$args = array(
		'label'                 => __( 'Events', 'ohmtown' ),
		'description'           => __( 'Programmation', 'ohmtown' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'revisions', 'custom-fields','thumbnail' ),
		'hierarchical'          => false,
		'public'                => false,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 20,
		'menu_icon'             => 'dashicons-calendar-alt',
		//'taxonomies'            => array( 'types_events'),
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => false,
		'can_export'            => true,
		'has_archive'           => false,
		'exclude_from_search'   => true,
		'publicly_queryable'    => false,
		'capability_type'       => 'page',
		'show_in_rest'          => false,
	);
	register_post_type( 'programmation', $args );

}
add_action( 'init', 'kasutan_programmation_post_type', 0 );