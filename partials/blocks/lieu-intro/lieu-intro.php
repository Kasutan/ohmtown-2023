<?php 
/**
* Template pour le bloc lieu-intro
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
$texte=wp_kses_post( get_field('texte') );
$image_mobile=esc_attr(get_field('image_mobile'));
$image_desktop=esc_attr(get_field('image_desktop'));

printf('<section class="acf lieu-intro %s">', $className);
	echo '<div class="texte-wrap">';
		printf('<h2 class="titre-section">%s</h2>',$titre);
		printf('<p class="texte">%s</p>',$texte);
	echo '</div>';
	if($image_mobile) {
		printf('<div class="image mobile">%s</div>',wp_get_attachment_image( $image_mobile, 'large'));
	}
	if($image_desktop) {
		printf('<div class="image desktop">%s</div>',wp_get_attachment_image( $image_desktop, 'large'));
	}


echo '</section>';
	