<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/***************************************************************
	Custom Post Type : jobs
/***************************************************************/
function kasutan_jobs_post_type() {

	$labels = array(
		'name'                  => _x( 'Jobs', 'Post Type General Name', 'ohmtown' ),
		'singular_name'         => _x( 'Job', 'Post Type Singular Name', 'ohmtown' ),
		'menu_name'             => __( 'Jobs', 'ohmtown' ),
		'name_admin_bar'        => __( 'Job', 'ohmtown' ),
		'archives'              => __( 'Archives des jobs', 'ohmtown' ),
		'attributes'            => __( 'Item Attributes', 'ohmtown' ),
		'parent_item_colon'     => __( 'Parent Item:', 'ohmtown' ),
		'all_items'             => __( 'Tous les jobs', 'ohmtown' ),
		'add_new_item'          => __( 'Ajouter un job', 'ohmtown' ),
		'add_new'               => __( 'Ajouter', 'ohmtown' ),
		'new_item'              => __( 'Nouveau job', 'ohmtown' ),
		'edit_item'             => __( 'Modifier ce job', 'ohmtown' ),
		'update_item'           => __( 'Mettre à jour ce job', 'ohmtown' ),
		'view_item'             => __( 'Voir ce job', 'ohmtown' ),
		'view_items'            => __( 'Voir les jobs', 'ohmtown' ),
		'search_items'          => __( 'Rechercher un job', 'ohmtown' ),
		'not_found'             => __( 'Aucun job', 'ohmtown' ),
		'not_found_in_trash'    => __( 'Aucun job dans la corbeille', 'ohmtown' ),
		'featured_image'        => __( 'Vignette pour l\'affichage en grille'),
		'set_featured_image'    => __( 'Choisir une image vignette'),
		'remove_featured_image' => __( 'Enlever cette image'),
		'use_featured_image'    => __( 'Utiliser cette image')
	);
	$args = array(
		'label'                 => __( 'Jobs', 'ohmtown' ),
		'description'           => __( 'Jobs', 'ohmtown' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'revisions', 'custom-fields','thumbnail', 'editor' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 20,
		'menu_icon'             => 'dashicons-id-alt',
		//'taxonomies'            => array( 'types_jobs'),
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => false,
		'can_export'            => true,
		'has_archive'           => false,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
		'show_in_rest'          => true,
	);
	register_post_type( 'jobs', $args );

}
add_action( 'init', 'kasutan_jobs_post_type', 0 );