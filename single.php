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
		} else if($post_type==="post" && function_exists('get_field')) {
			$sous_titre=wp_kses_post( get_field('sous-titre') );
			$intro=wp_kses_post( get_field('introduction') );
			if($sous_titre) printf('<p class="sous-titre">%s</p>',$sous_titre);
			if($intro) printf('<p class="intro">%s</p>',$intro);
		} else if($post_type==="jobs") {
			//RAS
		} 
	echo '</div>';
}


//add_action('tha_entry_content_after','kasutan_single_entry_content_after');
function kasutan_single_entry_content_after(){
	$post_type=get_post_type();

	
}

add_action('tha_entry_bottom','kasutan_single_entry_bottom');
function kasutan_single_entry_bottom(){
	$post_type=get_post_type();
	
	$labels=$blocs=$form=false;
	if(function_exists('get_field')) {
		$labels=get_field('ohm_label_partage','option');
		$blocs=get_field('ohm_bloc_newsletter','option');
		$form=get_field('ohm_job_form','option');
	}

	if($labels && function_exists('kasutan_espaces_inseccables') && function_exists('kasutan_boutons_partage')) {
		if(isset($labels[$post_type])) {
			echo '<div class="liens-single">';
				printf('<div class="label">%s</div>',kasutan_espaces_inseccables(wp_kses_post($labels[$post_type])));
				kasutan_boutons_partage();
			echo '</div>';
		}
	}


	if($post_type==="jobs") {
		if($form && isset($form['form'])) {
			echo '<div class="form">';
				if(isset($form['titre'])) printf('<h2>%s</h2>',$form['titre']);
				if(isset($form['texte'])) printf('<p>%s</p>',$form['texte']);
				echo do_shortcode($form['form']);
			echo '</div>'; 

		}
	} else {
		//Event ou article de blog, on affiche un bloc réutilisable et un formulaire d'inscription à la newsletter

		if($blocs && function_exists('kasutan_retourne_bloc_reutilisable')) {
			if(isset($blocs[$post_type])) {
				$contenu=kasutan_retourne_bloc_reutilisable(esc_attr($blocs[$post_type]));
				if($contenu) {
					echo '<div class="form">';
						echo $contenu;
					echo '</div>';
				}
			}
			
		}
	}
	
}

// Build the page
require get_template_directory() . '/index.php';
