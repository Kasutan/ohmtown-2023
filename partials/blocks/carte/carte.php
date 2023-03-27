<?php 
/**
* Template pour le bloc carte
*
* @param   array $block The block settings and attributes.
* @param   string $content The block inner HTML (empty).
* @param   bool $is_preview True during AJAX preview.
* @param   (int|string) $post_id The post ID this block is saved to.
*/




if(array_key_exists('className',$block)) {
	$className=esc_attr($block["className"]);
} else $className='';



$titre=wp_kses_post( get_field('titre') );
$intro=wp_kses_post( get_field('intro') );

printf('<section class="acf carte %s">', $className);
	if(!function_exists('kasutan_event_affiche_li')) {
		return;
	}

	echo '<div class="row">';
		if ($titre) printf('<h2 class="titre-section">%s</h2>',$titre);
		if ($intro) printf('<p class="intro-section">%s</p>',$intro);
	echo '</div>';

	if(have_rows('categories_carte') && function_exists('kasutan_carte_affiche_li')) {
		
		//On parcours les rows du répéteur et on stocke en parallèle le contenu des boutons et celui des onglets
		//De cette façon on les a dans le même ordre = celui choisi dans les options du bloc

		$boutons='';
		$onglets='';

		while(have_rows('categories_carte')) : the_row();
			$cat_id=esc_attr(get_sub_field('cat'));
			$cat=get_term($cat_id,'ohm_types_plats');

			$image=esc_attr(get_sub_field('image'));
			$texte=wp_kses_post(get_sub_field('texte'));

			$boutons.=sprintf('<a class="bouton-onglet" href="#contenu-%s">%s</a>',$cat_id,$cat->name);

			ob_start();

			//TODO vérif accessibilité
			printf('<div class="contenu-onglet" id="contenu-%s">',$cat_id);
				printf('<div class="image">%s</div>',wp_get_attachment_image( $image, 'medium_large'));

				echo '<ul class="plats">';
					$posts=new WP_Query(
						array( 
							'post_type'=>'ohm_carte',
							'posts_per_page'=> -1,
							'tax_query' => array(
								array(
									'taxonomy' => 'ohm_types_plats',
									'field'    => 'term_id',
									'terms'    => $cat_id,
								),
							),
						)
					);

					if($posts->have_posts()) {
						while($posts->have_posts(  )) {
							$posts->the_post();
							kasutan_carte_affiche_li(get_the_ID());
						} 
					} else {
						echo '<p>Aucun plat dans cette partie de la carte.</p>';
					}
			
					wp_reset_postdata(  );
				echo '</ul>';

				if($texte) printf('<div class="texte">%s</div>',$texte);
			
			echo '</div>'; //fin .contenu-onglet

			$onglets.=ob_get_clean();

		endwhile;
	
	}

	if(!empty($boutons)) {
		printf('<div class="boutons-onglets">%s</div>',$boutons);
		echo $onglets;
	}

echo '</section>';
	