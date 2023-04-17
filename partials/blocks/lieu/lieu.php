<?php 
/**
* Template pour le bloc lieu
*
* @param   array $block The block settings and attributes.
* @param   string $content The block inner HTML (empty).
* @param   bool $is_preview True during AJAX preview.
* @param   (int|string) $post_id The post ID this block is saved to.
*/


if(array_key_exists('className',$block)) {
	$className=esc_attr($block["className"]);
} else $className='';

$titre=array();
$texte=array();
$titre[1]=wp_kses_post( get_field('titre_1') );
$titre[2]=wp_kses_post( get_field('titre_2') );
$titre_priv=wp_kses_post( get_field('titre_priv') );
$titre_form=wp_kses_post( get_field('titre_form') );
$titre_pdf=wp_kses_post( get_field('titre_pdf') );
$texte[1]=wp_kses_post( get_field('texte_1') );
$texte[2]=wp_kses_post( get_field('texte_2') );
$texte_form=wp_kses_post( get_field('texte_form') );
$texte_pdf=wp_kses_post( get_field('texte_pdf') );
$form=wp_kses_post( get_field('form') );
$image_mobile=esc_attr(get_field('image_mobile'));
$image_desktop=esc_attr(get_field('image_desktop'));
$label_pdf=wp_kses_post( get_field('label_pdf') );
$label_priv=wp_kses_post( get_field('label_priv') );
$url_pdf=esc_url( get_field('url_pdf') );

printf('<section class="acf lieu %s">', $className);
	for($i=1;$i<=2;$i++) {
		printf('<div class="col col-%s">',$i);
			printf('<h3 class="titre-col">%s</h3>',$titre[$i]);
			printf('<p class="texte">%s</p>',$texte[$i]);
			if($i===2) {
				echo '<div id="toggle-priv-wrap"><button id="toggle-priv" aria-expanded="false" class="secondaire">';
					echo $label_priv;
					?>
					<span class="picto">
						<svg width="19" height="12" viewBox="0 0 19 12" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false">
						<path d="M1.5 1.42847L9.5 10.5713L17.5 1.42847" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
						</svg>
					</span>
					<?php
				echo '</button></div>';
			}
		echo '</div>';
	}

	echo '<div id="privatisation" class="priv-panel" >';
		printf('<h3 class="titre-col">%s</h3>',$titre_priv);
		echo '<div class="fond-blanc">';
			echo '<div class="pdf">';
				printf('<h4>%s</h4>',$titre_pdf);
				if($image_mobile) {
					printf('<div class="image mobile">%s</div>',wp_get_attachment_image( $image_mobile, 'large'));
				}
				if($image_desktop) {
					printf('<div class="image desktop">%s</div>',wp_get_attachment_image( $image_desktop, 'large'));
				}
				printf('<p>%s</p>',$texte_pdf);
				if($url_pdf && $label_pdf) :
				printf('<a href="%s" class="bouton secondaire sans-fleche" target="_blank" rel="noopener noreferrer">',$url_pdf);
				?>
					<span class="picto">
					<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path fill-rule="evenodd" clip-rule="evenodd" d="M2.66634 2C2.66634 1.63486 2.96786 1.33333 3.33301 1.33333H9.72353L13.333 4.94281V14C13.333 14.3651 13.0315 14.6667 12.6664 14.6667H11.333C10.9648 14.6667 10.6664 14.9651 10.6664 15.3333C10.6664 15.7015 10.9648 16 11.333 16H12.6664C13.7679 16 14.6664 15.1015 14.6664 14V4.66667C14.6664 4.48986 14.5961 4.32029 14.4711 4.19526L10.4711 0.195262C10.3461 0.0702379 10.1765 0 9.99967 0H3.33301C2.23148 0 1.33301 0.898477 1.33301 2V14C1.33301 15.1015 2.23148 16 3.33301 16H4.66634C5.03453 16 5.33301 15.7015 5.33301 15.3333C5.33301 14.9651 5.03453 14.6667 4.66634 14.6667H3.33301C2.96786 14.6667 2.66634 14.3651 2.66634 14V2ZM11.1378 13.1381C11.3981 12.8777 11.3981 12.4556 11.1378 12.1953C10.8774 11.9349 10.4553 11.9349 10.195 12.1953L8.66634 13.7239V8.66667C8.66634 8.29848 8.36786 8 7.99967 8C7.63148 8 7.33301 8.29848 7.33301 8.66667V13.7239L5.80441 12.1953C5.54406 11.9349 5.12195 11.9349 4.8616 12.1953C4.60125 12.4556 4.60125 12.8777 4.8616 13.1381L7.52778 15.8043C7.52777 15.8043 7.52779 15.8043 7.52778 15.8043M8.00784 16C8.09504 15.9989 8.17821 15.9811 8.25428 15.9497C8.33255 15.9174 8.40592 15.8695 8.46966 15.8061M8.47108 15.8047L11.1378 13.1381L8.47108 15.8047Z" fill="black"/>
						</svg>
					</span>
				<?php
				printf('%s</a>',$label_pdf);
				endif;
			echo '</div>';

			echo '<div class="form">';
				printf('<h4>%s</h4>',$titre_form);
				printf('<p>%s</p>',$texte_form);
				echo $form;
			echo '</div>';

		echo '</div>';
	echo '</div>';

echo '</section>';
	