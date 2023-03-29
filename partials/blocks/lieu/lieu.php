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
				echo '<div id="toggle-priv-wrap"><button id="toggle-priv" aria-controls="priv-panel" aria-expanded="false" class="secondaire">';
					echo $label_priv;
					?>
					<span class="picto">
						<svg width="19" height="12" viewBox="0 0 19 12" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M1.5 1.42847L9.5 10.5713L17.5 1.42847" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
						</svg>
					</span>
					<?php
				echo '</button></div>';
			}
		echo '</div>';
	}

	echo '<div id="privatisation" class="priv-panel" aria-expanded="false">';
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
				printf('<a href="%s" class="bouton secondaire sans-fleche">',$url_pdf);
				?>
					<span class="picto">
						<svg width="10" height="10" fill="none" xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#prefix__clip0_630_1730)"><path fill-rule="evenodd" clip-rule="evenodd" d="M1.667 1.25a.42.42 0 01.416-.417h3.994L8.333 3.09V8.75a.42.42 0 01-.416.417h-.834a.417.417 0 100 .833h.834c.688 0 1.25-.562 1.25-1.25V2.917a.417.417 0 00-.122-.295l-2.5-2.5A.417.417 0 006.25 0H2.083C1.395 0 .833.562.833 1.25v7.5c0 .688.562 1.25 1.25 1.25h.834a.417.417 0 000-.833h-.834a.42.42 0 01-.416-.417v-7.5zM6.96 8.211a.417.417 0 00-.589-.589l-.955.955v-3.16a.417.417 0 00-.834 0v3.16l-.955-.955a.417.417 0 10-.59.59l1.667 1.666m.3.122a.417.417 0 00.289-.121m0-.001L6.962 8.21 5.295 9.878z" fill="#2E2A30"/></g><defs><clipPath id="prefix__clip0_630_1730"><path fill="#fff" d="M0 0h10v10H0z"/></clipPath></defs></svg>
					</span>
				<?php
				printf('%s</a>',$label_pdf);
			echo '</div>';

			echo '<div class="form">';
				printf('<h4>%s</h4>',$titre_form);
				printf('<p>%s</p>',$texte_form);
				echo $form;
			echo '</div>';

		echo '</div>';
	echo '</div>';

echo '</section>';
	