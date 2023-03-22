<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/***************************************************************
	Custom Post Type : carte
/***************************************************************/
function kasutan_carte_post_type() {

	$labels = array(
		'name'                  => _x( 'Plats & Boissons', 'Post Type General Name', 'ohmtown' ),
		'singular_name'         => _x( 'Plat ou Boisson', 'Post Type Singular Name', 'ohmtown' ),
		'menu_name'             => __( 'Plats & Boissons', 'ohmtown' ),
		'name_admin_bar'        => __( 'Plat ou Boisson', 'ohmtown' ),
		'archives'              => __( 'Archives de la carte', 'ohmtown' ),
		'attributes'            => __( 'Item Attributes', 'ohmtown' ),
		'parent_item_colon'     => __( 'Parent Item:', 'ohmtown' ),
		'all_items'             => __( 'Tous les éléments', 'ohmtown' ),
		'add_new_item'          => __( 'Ajouter un élément', 'ohmtown' ),
		'add_new'               => __( 'Ajouter', 'ohmtown' ),
		'new_item'              => __( 'Nouvel élément', 'ohmtown' ),
		'edit_item'             => __( 'Modifier cet élément', 'ohmtown' ),
		'update_item'           => __( 'Mettre à jour cet élément', 'ohmtown' ),
		'view_item'             => __( 'Voir cet élément', 'ohmtown' ),
		'view_items'            => __( 'Voir les éléments', 'ohmtown' ),
		'search_items'          => __( 'Rechercher un élément', 'ohmtown' ),
		'not_found'             => __( 'Aucun élément', 'ohmtown' ),
		'not_found_in_trash'    => __( 'Aucun élément dans la corbeille', 'ohmtown' ),
	);
	$args = array(
		'label'                 => __( 'Plats & Boissons', 'ohmtown' ),
		'description'           => __( 'Plats & Boissons de la carte', 'ohmtown' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'revisions', 'custom-fields' ),
		'hierarchical'          => false,
		'public'                => false,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 20,
		'menu_icon'             => 'dashicons-food',
		'taxonomies'            => array( 'ohm_types_plats'),
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => false,
		'can_export'            => true,
		'has_archive'           => false,
		'exclude_from_search'   => true,
		'publicly_queryable'    => false,
		'capability_type'       => 'page',
		'show_in_rest'          => false,
	);
	register_post_type( 'ohm_carte', $args );

}
add_action( 'init', 'kasutan_carte_post_type', 0 );