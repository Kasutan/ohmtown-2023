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
			if ($prix) printf('<div class="prix">%s€</prix>',$prix);
	echo '</li>';
}