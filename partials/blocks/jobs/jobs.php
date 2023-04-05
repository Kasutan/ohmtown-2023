<?php 
/**
* Template pour le bloc jobs
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
//TODO champs pour la partie candidature

$args_template=array('suite'=>"en savoir plus"); // Si besoin : dynamique

printf('<section class="acf jobs %s">', $className);
	printf('<h2 class="titre-section screen-reader-text">%s</h2>',$titre);

	$posts=new WP_Query(
		array( 
			'post_type'=>'jobs',
			'posts_per_page'=> -1,
			'order' => 'DESC'
		)
	);
	echo '<div class="actus">';
	if($posts->have_posts()) {
		echo '<div class="loop-slider"><ul class="loop list">';

		while($posts->have_posts(  )) {
			$posts->the_post();
			get_template_part( 'partials/archive',null,$args_template);
		} 

		echo '</ul></div>'; //fin .slider


	} else {
		echo '<p>Aucun job actuellement.</p>'; //TODO dynamique
	}
				
	wp_reset_postdata(  );

	echo '</div>'; //fin .actus

	echo '<p style="font-size:3rem;padding:4rem 0">TODO formulaire de candidature ici</p>';
echo '</section>';
	