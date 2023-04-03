<?php 
/**
* Template pour le bloc home-carte
*
* @param   array $block The block settings and attributes.
* @param   string $content The block inner HTML (empty).
* @param   bool $is_preview True during AJAX preview.
* @param   (int|string) $post_id The post ID this block is saved to.
*/


if(array_key_exists('className',$block)) {
	$className=esc_attr($block["className"]);
} else $className='';

$keys=array('manger','boire');

$lien=get_field('lien');
$dots='';


printf('<section class="acf home-carte %s">', $className);
	foreach($keys as $index=>$key) {
		$options=get_field($key);
		if($options) {
			printf('<div class="slide slide-%s %s">',$index,$key);
				$image=esc_attr($options['image']);
				if($image) printf('<div class="image">%s</div>',wp_get_attachment_image( $image, 'medium_large'));
				printf('<h2 class="titre-slide">%s</h2>',wp_kses_post($options['titre']));
				printf('<p class="texte"><span class="highlight">%s</span></p>',wp_kses_post($options['texte']));
				if($lien) {
					printf('<a href="%s" class="bouton primaire vers-carte mobile">%s</a>',$lien['url'],$lien['title']);
				}
				$dots.=sprintf('<span class="dot dot-%s"></span>',$index);
			echo '</div>';

		}
	}
	if($dots) {
		printf('<div class="dots">%s</div>',$dots);
	}

	?>
	<div class="toggle-zones">
		<div class="zone-0"></div>
		<div class="zone-1"></div>
	</div>
	<?php
	if($lien) {
		printf('<a href="%s" class="bouton primaire vers-carte desktop">%s</a>',$lien['url'],$lien['title']);
	}
echo '</section>';
	