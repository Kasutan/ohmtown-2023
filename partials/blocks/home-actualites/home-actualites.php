<?php 
/**
* Template pour le bloc home-actualites
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
$lien=get_field('lien');


printf('<section class="acf home-actualites %s">', $className);
	printf('<h2 class="titre-section screen-reader-text">%s</h2>',$titre);

	$posts=new WP_Query(
		array( 
			'post_type'=>'post',
			'posts_per_page'=> 3,
			'order' => 'DESC'
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
	