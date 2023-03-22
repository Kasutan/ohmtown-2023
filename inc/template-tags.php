<?php
/**
 * Template Tags
 *
 * @package      EAStarter
 * @author       Bill Erickson
 * @since        1.0.0
 * @license      GPL-2.0+
**/



/**
 * Entry Category
 *
 */
function ea_entry_category($contexte='archive') {
	$post_type=get_post_type();
	$term=false;
	if($post_type==='post') {
		$term = ea_first_term();
	}
	if( !empty( $term ) && ! is_wp_error( $term ) )
		if($contexte==='archive') {
			$picto=kasutan_picto_categorie($term->term_id,'blanc');
			if($picto) {
				printf('<div class="picto-cat">%s</div>',wp_get_attachment_image( $picto,'thumbnail'));
			}
			//pour le filtre
			printf('<span class="categorie screen-reader-text">%s</span>',$term->slug);
		} else {
			//contexte single
			
				$name=$term->name;
			
			echo '<p class="entry-category h1 entry-title">' . $name . '</p>';
		}
		
}


/**
* Picto associé à une catégorie
*
*/
function kasutan_picto_categorie($term_id,$couleur="blanc") {
	if(!function_exists('get_field')) {
		return false;
	}
	if($couleur=='blanc') {
		$champ='ohmtown_picto';
	} else {
		$champ='ohmtown_picto_'.$couleur;
	}
	return esc_attr(get_field($champ,'category_'.$term_id));

}

/**
 * Post Summary Title
 *
 */
function ea_post_summary_title() {
	global $wp_query;
	$tag = ( is_singular() || -1 === $wp_query->current_post ) ? 'h3' : 'h2';
	echo '<' . $tag . ' class="post-summary__title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></' . $tag . '>';
}

/**
 * Post Summary Image
 *
 */
function ea_post_summary_image( $size = 'thumbnail' ) {
	/*On cherche une image à afficher*/ 
	$image_id=get_theme_mod( 'custom_logo' ); //défaut : le logo du site
	$classe='contain';
	if(has_post_thumbnail()) {
		$image_id=get_post_thumbnail_id();
		$classe='';
	} else if(function_exists('get_field')) {
		$banniere=get_field('ohmtown_page_banniere');
		if($banniere) {
			$image_id=$banniere;
			$classe='';
		} else {
			$logo_footer=get_field('ohmtown_logo_footer','option');
			if($logo_footer) {
				$image_id=$logo_footer;
				$classe='contain has-bleu-background-color';
			}
		}
	}

	printf('<a class="post-summary__image %s" href="%s" tabindex="-1" aria-hidden="true" >%s</a>',
		$classe,
		get_permalink(),
		wp_get_attachment_image( $image_id, $size )
	);
}



/**
* Affiche le titre des pages ordinaires
*
*/
function kasutan_page_titre() {
	$masquer=false;
	$classe="entry-title";
	$titre=get_the_title();
	if(function_exists('get_field') && esc_attr(get_field('ohmtown_masquer_titre'))==='oui') {
		$masquer=true;
	}
	if(is_front_page(  )) {
		$masquer=true;
	}
	if($masquer) {
		$classe.=" screen-reader-text";
	}
	printf('<h1 class="%s">%s</h1>',$classe,$titre);
}

/**
* Banniere contenant une image, le titre de la page et un lien retour vers la home
*
*/
function kasutan_page_banniere() {
	$titre=get_the_title();

	

	if(is_front_page(  )) {
		printf('<h1 class="screen-reader-text">%s</h1>',$titre);
		return;
	}

	if(!function_exists('get_field')) {
		echo '<a href="/" class="retour">< Retour</a>';
		printf('<h1>%s</h1>',$titre);
		return;
	}


	$image_id=esc_attr(get_field('banniere'));

	if(!$image_id) {
		$image_id=esc_attr(get_field('ohm_bg_image','option'));//image par défaut
	}

	if(!empty($image_id)) {
		printf('<div class="page-banniere">');
			echo wp_get_attachment_image( $image_id, 'banniere',false,array('decoding'=>'async','loading'=>'eager'));

			echo '<a href="/" class="retour">< Retour</a>';

			printf('<h1 class="titre-banniere">%s</h1>',$titre);

		echo '</div>';
	} else {
		echo '<a href="/" class="retour">< Retour</a>';
		printf('<h1>%s</h1>',$titre);
	}
}

/**
* Image banniere pour les posts singles
*
*/
function kasutan_single_banniere() {

	if(!function_exists('get_field')) {
		return;
	}

	$image_id=esc_attr(get_field('banniere'));

	if(!$image_id) {
		$image_id=esc_attr(get_field('ohm_bg_image','option'));//image par défaut
	}

	//Texte dans la banniere = nom de la page archive
	$post_type=get_post_type();

	if($post_type==="post") {
		$titre_banniere="Blog";
	} else if($post_type==="jobs") {
		$titre_banniere="Jobs";
	} else if($post_type==="programmation") {
		$titre_banniere="Agenda";
	}

	if(!empty($image_id)) {
		printf('<div class="page-banniere">');
			echo wp_get_attachment_image( $image_id, 'banniere',false,array('decoding'=>'async','loading'=>'eager'));

			echo '<a href="/" class="retour">< Retour</a>';

			printf('<span class="titre-banniere h1">%s</span>',$titre_banniere);

		echo '</div>';
	} else {
		echo '<a href="/" class="retour">< Retour</a>';
	}
	
}

/**
* Image mise en avant
*
*/
function kasutan_affiche_thumbnail_dans_contenu() {
	if(has_post_thumbnail()) {
		echo '<div class="thumbnail">';
			the_post_thumbnail( 'large');
		echo '</div>';
	}
}

/**
* Filtre par catégories pour les archives de blog
*
*/
function kasutan_affiche_filtre_articles() {
	$avec_pictos=function_exists('kasutan_picto_categorie');
	echo '<p class="screen-reader-text">Filtrer les actualités</p>';
	echo '<form class="filtre-archive" id="filtre-liste">';
		$terms=get_terms( array(
			'taxonomy' => 'category'
			) 
		);
		?>
		<input type="radio" id="toutes" name="filtre-categorie" value="toutes" checked>
		<label for="toutes" class="toutes">Toutes</label>
		<?php
		foreach($terms as $term) : 
			$pictos=$classe='';
			if($avec_pictos) {
				$picto_blanc=kasutan_picto_categorie($term->term_id,'blanc');
				$picto_bleu=kasutan_picto_categorie($term->term_id,'bleu');
				if($picto_blanc && $picto_bleu) {
					$pictos=sprintf('<span class="picto blanc">%s</span><span class="picto bleu">%s</span>',wp_get_attachment_image( $picto_blanc,'thumbnail'),wp_get_attachment_image( $picto_bleu,'thumbnail'));
					$classe="avec-pictos";
				}
			}
			

			printf('<input type="radio" id="%s" name="filtre-categorie" value="%s">',
				$term->slug,
				$term->slug
			);
			printf('<label for="%s" class="%s">%s %s</label>',
				$term->slug,
				$classe,
				$pictos,
				$term->name
			);
		endforeach;
		?>
		
	</form>
<?php
}