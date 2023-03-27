<?php 
/**
* Template pour le bloc carte
*
* @param   array $block The block settings and attributes.
* @param   string $content The block inner HTML (empty).
* @param   bool $is_preview True during AJAX preview.
* @param   (int|string) $post_id The post ID this block is saved to.
*/


//Réf onglets accessibles
//https://codepen.io/smashingmag/pen/YzvVXWw
//https://www.smashingmagazine.com/2022/11/guide-keyboard-accessibility-javascript-part2/?utm_source=pocket_reader


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
		$i=0;

		while(have_rows('categories_carte')) : the_row();
			/*HTML différent pour le premier onglet, qui est affiché au début*/
			$i++;
			$attr_bouton = ($i===1) ? ' aria-selected="true"' : '';
			$attr_panel = ($i===1) ? '' : 'hidden';


			$cat_id=esc_attr(get_sub_field('cat'));
			$cat=get_term($cat_id,'ohm_types_plats');

			$image_mobile=esc_attr(get_sub_field('image_mobile'));
			$image_desktop=esc_attr(get_sub_field('image_desktop'));
			$texte=wp_kses_post(get_sub_field('texte'));
			
			$boutons.=sprintf('<li role="presentation"><button id="tab-%s" role="tab" tabindex="-1" class="bouton-onglet" %s>%s</button></li>',$cat_id,$attr_bouton,$cat->name);
			

			ob_start();

			//TODO vérif accessibilité
			printf('<section class="contenu-onglet" role="tabpanel" aria-labelledby="tab-%s" tabindex="0" %s>',$cat_id,$attr_panel);
				printf('<div class="image mobile">%s</div>',wp_get_attachment_image( $image_mobile, 'medium_large'));
				printf('<div class="image desktop">%s</div>',wp_get_attachment_image( $image_desktop, 'medium_large'));

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
			
			echo '</section>'; //fin .contenu-onglet

			$onglets.=ob_get_clean();

		endwhile;
	
	}

	if(!empty($boutons)) {
		printf('<ul role="tablist" class="boutons-onglets">%s</ul>',$boutons);
		echo '<div class="tablist-container">';
			echo $onglets;
		echo '</div>';
	}

echo '</section>';
	