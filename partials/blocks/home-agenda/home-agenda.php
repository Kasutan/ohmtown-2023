<?php 
/**
* Template pour le bloc home-agenda
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


printf('<section class="acf home-agenda %s">', $className);
	if(!function_exists('kasutan_event_affiche_li_home')) {
		return;
	}

	printf('<h2 class="titre-section h3">%s</h2>',$titre);
	
	$today=date('Ymd');

	$posts=new WP_Query(
		array( 
			'post_type'=>'programmation',
			'posts_per_page'=> 3,
			'meta_key'=>'date_event',
			'orderby'=>'meta_value',
			'order'=>'ASC',
			'meta_value'=>$today,
			'meta_compare' => '>='
		)
	);

	if($posts->have_posts()) {
		echo '<ul class="events">';
		while($posts->have_posts(  )) {
			$posts->the_post();
			kasutan_event_affiche_li_home(get_the_ID());
		} 
		echo '</ul>';
		if($lien) {
			printf('<a href="%s" class="bouton secondaire vers-agenda">%s</a>',$lien['url'],$lien['title']);
		}
	} else {
		echo '<p>Aucun événement programmé.</p>';
	}

	wp_reset_postdata(  );

echo '</section>';
	