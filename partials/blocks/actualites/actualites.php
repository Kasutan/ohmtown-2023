<?php 
/**
* Template pour le bloc actualites
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
$sous_titre=wp_kses_post( get_field('sous-titre') );
$texte=wp_kses_post( get_field('texte') );
$cat=esc_attr(get_field('cat'));
$layout=esc_attr(get_field('layout'));
$lien=get_field('lien');

printf('<section class="acf actualites layout-%s %s">', $layout, $className);
	echo '<div class="intro">';
		printf('<h2 class="titre-section">%s</h2>',$titre);
		if($sous_titre) printf('<p class="sous-titre">%s</p>',$sous_titre);
		if($texte) printf('<p class="texte">%s</p>',$texte);
	echo '</div>';

	$posts=new WP_Query(
		array( 
			'post_type'=>'post',
			'posts_per_page'=> intval($layout) + 1,
			'order' => 'DESC',
			'cat' => $cat,
		)
	);
	echo '<div class="actus">';
	if($posts->have_posts()) {
		echo '<div class="loop-slider"><ul class="loop list">';

		while($posts->have_posts(  )) {
			$posts->the_post();
			get_template_part( 'partials/archive');
		} 

		echo '</ul></div>'; //fin .slider

		
		if($lien) {
			printf('<div class="plus-wrap"><a href="%s" class="bouton secondaire">%s</a></div>',$lien['url'],$lien['title']);
		}

	} else {
		echo '<p>Aucune actualité dans cette catégorie.</p>';
	}
				
	wp_reset_postdata(  );

	echo '</div>'; //fin .actus

echo '</section>';
	