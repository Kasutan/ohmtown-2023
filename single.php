<?php
/**
 * Single Post
 *
 * @package      EAStarter
 * @author       Bill Erickson
 * @since        1.0.0
 * @license      GPL-2.0+
**/


// Image bannière 
add_action( 'tha_entry_top', 'kasutan_single_banniere', 5 );

//TODO : tous contenus dynamiques !

//Elements dans le header, sous la bannière
add_action( 'tha_entry_top', 'kasutan_single_top',10 );

function kasutan_single_top() {
	echo '<div class="single-top-wrap">';
		printf('<h1 class="single-title">%s</h1>',get_the_title());

		$post_type=get_post_type();
		$post_id=get_the_ID();

		if($post_type==="programmation") {
			if(function_exists('kasutan_event_affiche_meta_single')) {
				kasutan_event_affiche_meta_single($post_id);
			}
		} else if($post_type==="post") {
			printf('<p class="sous-titre">Sous-titre</p>');
			printf('<p class="extrait">Extrait</p>');
		} else if($post_type==="jobs") {
			//RAS
		} 
	echo '</div>';
}


add_action('tha_entry_content_after','kasutan_single_entry_content_after');
function kasutan_single_entry_content_after(){
	$post_type=get_post_type();

	
}

add_action('tha_entry_bottom','kasutan_single_entry_bottom');
function kasutan_single_entry_bottom(){
	$post_type=get_post_type();

	if($post_type==="post" || $post_type==="programmation") {
		echo '<div class="liens-single">Thanks for reading ! + boutons de partage</div>'; 

	} else if($post_type==="jobs") {
		echo '<div class="liens-single">Vous connaissez quelqu\'un fait pour ce poste ? + boutons de partage</div>';
	}

	if($post_type==="post") {
		echo '<div class="form">Vous avez trouvé cet article intéressant + formulaire newsletter</div>'; 

	} else if($post_type==="programmation") {
		echo '<div class="form">Notre programmation vous intéresse ? + formulaire newsletter</div>'; 
	} else if($post_type==="jobs") {
		echo '<div class="form">Formulaire de candidature avec titre pré-rempli</div>'; 
	}
}

// Build the page
require get_template_directory() . '/index.php';
