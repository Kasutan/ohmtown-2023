<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/***************************************************************
	Custom Post Type : programmation
/***************************************************************/
function kasutan_programmation_post_type() {

	$labels = array(
		'name'                  => _x( 'Evénements', 'Post Type General Name', 'ohmtown' ),
		'singular_name'         => _x( 'Evénement', 'Post Type Singular Name', 'ohmtown' ),
		'menu_name'             => __( 'Agenda', 'ohmtown' ),
		'name_admin_bar'        => __( 'Evénement', 'ohmtown' ),
		'archives'              => __( 'Archives des événements', 'ohmtown' ),
		'attributes'            => __( 'Item Attributes', 'ohmtown' ),
		'parent_item_colon'     => __( 'Parent Item:', 'ohmtown' ),
		'all_items'             => __( 'Tous les événements', 'ohmtown' ),
		'add_new_item'          => __( 'Ajouter un événement', 'ohmtown' ),
		'add_new'               => __( 'Ajouter', 'ohmtown' ),
		'new_item'              => __( 'Nouvel événement', 'ohmtown' ),
		'edit_item'             => __( 'Modifier cet événement', 'ohmtown' ),
		'update_item'           => __( 'Mettre à jour cet événement', 'ohmtown' ),
		'view_item'             => __( 'Voir cet événement', 'ohmtown' ),
		'view_items'            => __( 'Voir les événements', 'ohmtown' ),
		'search_items'          => __( 'Rechercher un événement', 'ohmtown' ),
		'not_found'             => __( 'Aucun événement', 'ohmtown' ),
		'not_found_in_trash'    => __( 'Aucun événement dans la corbeille', 'ohmtown' ),
	);
	$args = array(
		'label'                 => __( 'Evénements', 'ohmtown' ),
		'description'           => __( 'Programmation', 'ohmtown' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'revisions', 'custom-fields','thumbnail' ),
		'hierarchical'          => false,
		'public'                => false,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 20,
		'menu_icon'             => 'dashicons-calendar-alt',
		//'taxonomies'            => array( 'types_événements'),
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => false,
		'can_export'            => true,
		'has_archive'           => false,
		'exclude_from_search'   => true,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
		'show_in_rest'          => false,
	);
	register_post_type( 'programmation', $args );

}
add_action( 'init', 'kasutan_programmation_post_type', 0 );