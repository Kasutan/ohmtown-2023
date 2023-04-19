<?php 
/**
* Template pour le bloc home-logo
*
* @param   array $block The block settings and attributes.
* @param   string $content The block inner HTML (empty).
* @param   bool $is_preview True during AJAX preview.
* @param   (int|string) $post_id The post ID this block is saved to.
*/


if(array_key_exists('className',$block)) {
	$className=esc_attr($block["className"]);
} else $className='';


$logo=esc_attr( get_field('logo') );

if($logo) {
	printf('<section class="acf home-logo %s">', $className);
		if($logo) printf('<div class="image">%s</div>',wp_get_attachment_image( $logo, 'medium'),false,array('decoding'=>'async','loading'=>'eager'));
	echo '</section>';
}

	