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
$texte_none=wp_kses_post( get_field('texte_none') );
if(!$texte_none) {
	$texte_none='Aucune offre actuellement.';
}

$titre_form=wp_kses_post( get_field('titre_form') );
$texte_form=wp_kses_post( get_field('texte_form') );
$form=wp_kses_post( get_field('form') );


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
		printf('<p class="none">%s</p>',$texte_none);
	}
				
	wp_reset_postdata(  );

	echo '</div>'; //fin .actus

	echo '<div class="form">';
		printf('<h2>%s</h2>',$titre_form);
		printf('<p>%s</p>',$texte_form);
		echo $form;
	echo '</div>';

echo '</section>';
	