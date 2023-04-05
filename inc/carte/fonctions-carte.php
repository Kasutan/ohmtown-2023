<?php
if ( ! defined( 'ABSPATH' ) ) exit;

function kasutan_carte_affiche_li($post_id) {
	$nom=get_the_title($post_id);
	$desc=get_the_content($post_id);
	$prix=false;

	if(function_exists('get_field')) {
		$prix=wp_kses_post(get_field('prix',$post_id));
	}
	echo '<li class="elem-carte">';
			printf('<h3 class="nom">%s</h3>',$nom);
			printf('<div class="desc">%s</div>',$desc);
			if ($prix) printf('<div class="prix">%s€</div>',$prix);
	echo '</li>';
}


/******************Colonnes dans l'admin *****************/
add_filter( 'manage_ohm_carte_posts_columns', 'kasutan_set_custom_edit_carte_columns' );

function kasutan_set_custom_edit_carte_columns( $columns ) {


$columns['prix'] = 'Prix';


return $columns;
}

add_action( 'manage_ohm_carte_posts_custom_column' , 'kasutan_custom_carte_column', 10, 2 );

function kasutan_custom_carte_column( $column, $post_id ) {
	if(!function_exists('get_field')) {
		echo '';
	}
switch ( $column ) {

	// display the value of an ACF (Advanced Custom Fields) field
	
	case 'prix' :
		echo esc_html(get_field( 'prix', $post_id )).'€';
		break;

	default:
		break;
}
}