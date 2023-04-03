<?php 
/**
* Template pour le bloc home-lieu
*
* @param   array $block The block settings and attributes.
* @param   string $content The block inner HTML (empty).
* @param   bool $is_preview True during AJAX preview.
* @param   (int|string) $post_id The post ID this block is saved to.
*/


if(array_key_exists('className',$block)) {
	$className=esc_attr($block["className"]);
} else $className='';


$galeries=$tempo=array();
$galeries[1]=get_field('galerie_1');
$galeries[2]=get_field('galerie_2');
$tempo[1]=esc_attr(get_field('tempo_1'));
$tempo[2]=esc_attr(get_field('tempo_2'));

$titre=wp_kses_post( get_field('titre') );
$lien=get_field('lien');


printf('<section class="acf home-lieu %s">', $className);
	printf('<h2 class="titre-section screen-reader-text">%s</h2>',$titre);
	for($i=1;$i<=2;$i++) {
		if(!empty($galeries[$i])) {
			$j=0;
			$n=count($galeries[$i]);
			printf('<div class="galerie galerie-%s" data-tempo="%s" data-count="%s" data-slide="1">',$i,$tempo[$i],$n);
			foreach($galeries[$i] as $image) {
				$classe="";
				if($j==0) {
					$classe="visible";
				}
				printf('<div class="image %s">%s</div>',$classe,wp_get_attachment_image( $image, 'medium_large'));
				$j++;
			}
			echo '</div>';
		}
	}

	if($lien) {
		printf('<div class="plus-wrap"><a href="%s" class="bouton secondaire">%s</a></div>',$lien['url'],$lien['title']);
	}
	
echo '</section>';


	