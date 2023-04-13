<?php
if ( ! defined( 'ABSPATH' ) ) exit;

function kasutan_carte_affiche_li($post_id) {
	$nom=get_the_title($post_id);
	$desc=get_the_content($post_id);
	$prix=$en_avant=false;

	if(function_exists('get_field')) {
		$prix=wp_kses_post(get_field('prix',$post_id));
		$en_avant=esc_html(get_field( 'mise_en_avant', $post_id ));
	}
	$classe=$en_avant ? ' en-avant':'';

	printf('<li class="elem-carte%s">',$classe);
			printf('<h3 class="nom">%s</h3>',$nom);
			printf('<div class="desc">%s</div>',$desc);
			if ($prix) printf('<div class="prix">%s€</div>',$prix);
	echo '</li>';
}


/******************Colonnes dans l'admin *****************/
add_filter( 'manage_ohm_carte_posts_columns', 'kasutan_set_custom_edit_carte_columns' );

function kasutan_set_custom_edit_carte_columns( $columns ) {


$columns['prix'] = 'Prix';
$columns['en_avant'] = 'Mis en avant ?';


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

	case 'en_avant' :
		$en_avant=esc_html(get_field( 'mise_en_avant', $post_id ));
		echo $en_avant ? 'oui' : '-';
		break;

	default:
		break;
}
}