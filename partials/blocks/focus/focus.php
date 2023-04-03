<?php 
/**
* Template pour le bloc focus
*
* @param   array $block The block settings and attributes.
* @param   string $content The block inner HTML (empty).
* @param   bool $is_preview True during AJAX preview.
* @param   (int|string) $post_id The post ID this block is saved to.
*/


if(array_key_exists('className',$block)) {
	$className=esc_attr($block["className"]);
} else $className='';





$post_id=esc_attr( get_field('post_focus') );
$sous_titre=wp_kses_post( get_field('sous-titre',$post_id) );
$intro=wp_kses_post( get_field('introduction',$post_id ));

$titre=get_the_title($post_id);


printf('<section class="acf bloc-focus %s">', $className);
	printf('<div class="image desktop">%s</div>',get_the_post_thumbnail( $post_id, 'large'));
	echo '<div class="wrap">';
		printf('<h2 class="titre-section">%s</h2>',$titre);
		if($sous_titre) printf('<p class="sous-titre">%s</p>',$sous_titre);
		printf('<div class="image mobile">%s</div>',get_the_post_thumbnail( $post_id, 'medium_large'));
		printf('<div class="texte">%s</div>',$intro);
		printf('<div class="suite-wrap"><a href="%s" class="suite">Lire l\'article ><span class="screen-reader-text"> %s</span>
		</a></div>',esc_url( get_permalink($post_id) ),$titre);	 
	echo '</div>';
echo '</section>';
	