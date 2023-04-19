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
			
			//pour le filtre
			printf('<span class="categorie screen-reader-text">%s</span>',$term->slug);
		} else {
			//contexte single
			
				$name=$term->name;
			
			echo '<p class="entry-category h1 entry-title">' . $name . '</p>';
		}
		
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
* Banniere contenant une image, le titre de la page et un lien retour vers la home
*
*/
function kasutan_page_banniere() {

	if( is_home() ) {
		$titre = get_the_title( get_option( 'page_for_posts' ) );

	} elseif( is_search() ) {
		$titre = 'Résultats de recherche';

	} elseif( is_archive() ) {
		$titre = get_the_archive_title();
	} else {
		//Single
		$titre=get_the_title();

	}

	if(is_front_page(  )) {
		printf('<h1 class="screen-reader-text">%s</h1>',$titre);
		return;
	}

	if(!function_exists('get_field')) {
		echo '<a href="/" class="retour"><span aria-hidden="true">&lt;</span> Retour</a>';
		printf('<h1>%s</h1>',$titre);
		return;
	}


	$image_id=esc_attr(get_field('banniere'));
	$opacity=intval(esc_attr(get_field('banniere_opacite')));
	if(!$opacity) {
		$opacity='60'; //defaut
	}
	$opacity=$opacity / 100;
	$style_filtre=sprintf('style="opacity:%s"',$opacity);
	

	if(!$image_id) {
		$image_id=esc_attr(get_field('ohm_bg_image','option'));//image par défaut
	}

	if(!empty($image_id)) {
		printf('<div class="page-banniere">');
			echo wp_get_attachment_image( $image_id, 'banniere',false,array('decoding'=>'async','loading'=>'eager'));

			//Filtre dont l'opacité vient d'une option de la publication
			printf('<div class="filtre" %s></div>',$style_filtre);

			echo '<a href="/" class="retour"><span aria-hidden="true">&lt;</span> Retour</a>';

			printf('<h1 class="titre-banniere">%s</h1>',$titre);

		echo '</div>';
	} else {
		echo '<a href="/" class="retour"><span aria-hidden="true">&lt;</span> Retour</a>';
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

			echo '<a href="/" class="retour"><span aria-hidden="true">&lt;</span> Retour</a>';

			printf('<span class="titre-banniere h1">%s</span>',$titre_banniere);

		echo '</div>';
	} else {
		echo '<a href="/" class="retour"><span aria-hidden="true">&lt;</span> Retour</a>';
	}
	
}

/**
* Boutons de partage pour un single
* simplesharingbuttons.com
*/
function kasutan_boutons_partage() {
	$lien=get_the_permalink();
	$titre=get_the_title();
	$url_fb='https://www.facebook.com/sharer/sharer.php?u='.urlencode($lien).'&quote='.urlencode($titre);
	$label_copier='';
	if(function_exists("get_field")) {
		$label_copier=wp_kses_post(get_field('ohm_partage_copier','options'));
	}

	echo '<ul class="partage">';
		printf('<li><button class="bouton secondaire copier" id="copier-url" data-url="%s">',$lien);
		?>
			<span class="picto">
				<svg width="10" height="10" fill="none" xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#prefix__clip0_619_1744)"><path fill-rule="evenodd" clip-rule="evenodd" d="M8.5 1.498a2.264 2.264 0 00-3.205 0l-1.309 1.31a.417.417 0 11-.589-.59L4.705.91a3.097 3.097 0 014.386 0 3.098 3.098 0 010 4.385L7.781 6.603a.417.417 0 11-.59-.59l1.31-1.308a2.264 2.264 0 000-3.206H8.5zM2.808 3.397a.417.417 0 010 .59L1.498 5.294a2.264 2.264 0 000 3.206H1.5a2.264 2.264 0 003.206 0l1.309-1.308a.417.417 0 11.589.59L5.295 9.09a3.098 3.098 0 01-4.386 0 3.097 3.097 0 010-4.385l1.309-1.308a.417.417 0 01.59 0zm4.154.231a.417.417 0 00-.589-.59L3.04 6.373a.417.417 0 10.589.59l3.333-3.334z" fill="#2E2A30"/></g><defs><clipPath id="prefix__clip0_619_1744"><path fill="#fff" d="M0 0h10v10H0z"/></clipPath></defs></svg>
			</span>
		<?php
			if(!$label_copier) {
				$label_copier="copier le lien";
			}
			printf('<span class="avant">%s</span><span class="apres">lien copié&nbsp;!</span>',$label_copier);
		echo '</button></li>';
		printf('<li><a href="%s" class="bouton secondaire sans-fleche facebook" title="Partager sur Facebook" target="_blank" rel="noopener noreferrer">',$url_fb);
		?>
			<span class="picto" aria-hidden="true">
				<svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M7.68329 5.00021H5.33329V3.66687C5.33329 2.97887 5.38929 2.54554 6.37529 2.54554H7.62063V0.425538C7.01463 0.362871 6.40529 0.332204 5.79529 0.333538C3.98663 0.333538 2.66663 1.4382 2.66663 3.46621V5.00021H0.666626V7.66687L2.66663 7.66621V13.6669H5.33329V7.66487L7.37729 7.66421L7.68329 5.00021Z" fill="#F2C94C"/>
				</svg>
			</span>
		</a></li>
	</ul>
	<?php
}


/**
* Filtre par catégories pour les archives de blog
*
*/
function kasutan_affiche_filtre_articles() {
	echo '<p class="screen-reader-text">Filtrer les actualités</p>';
	echo '<form class="filtre-archive" id="filtre-liste">';
		$terms=get_terms( array(
			'taxonomy' => 'category'
			) 
		);
		?>
		<input type="radio" id="toutes" name="filtre-categorie" value="toutes" checked>
		<label for="toutes" class="toutes">Tous les articles</label>
		<?php
		foreach($terms as $term) : 
			printf('<input type="radio" id="%s" name="filtre-categorie" value="%s">',
				$term->slug,
				$term->slug
			);
			printf('<label for="%s" >%s</label>',
				$term->slug,
				$term->name
			);
		endforeach;
		?>
		
	</form>
<?php
}