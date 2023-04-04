<?php 
/**
* Template pour le bloc agenda
*
* @param   array $block The block settings and attributes.
* @param   string $content The block inner HTML (empty).
* @param   bool $is_preview True during AJAX preview.
* @param   (int|string) $post_id The post ID this block is saved to.
*/


wp_enqueue_style( 'envia-flatpickr', get_template_directory_uri() . '/lib/flatpickr/flatpickr.min.css',array(),'4');

wp_enqueue_script( 'kasutan-flatpickr', get_template_directory_uri() . '/lib/flatpickr/flatpickr.js',array('jquery'),'4',true);
	
wp_enqueue_script( 'kasutan-flatpickr-fr', get_template_directory_uri() . '/lib/flatpickr/fr.js',array('jquery'),'4',true);

wp_enqueue_script( 'kasutan-agenda', get_template_directory_uri() . '/js/min/agenda.js', array('jquery','kasutan-flatpickr','kasutan-flatpickr-fr'), '', true );

if(array_key_exists('className',$block)) {
	$className=esc_attr($block["className"]);
} else $className='';


$titre=wp_kses_post( get_field('titre') );
$titre_passe=wp_kses_post( get_field('titre_passe') );
$label_afficher=wp_kses_post( get_field('label_afficher') );
$label_cacher=wp_kses_post( get_field('label_cacher') );


printf('<section class="acf agenda %s">', $className);
	if(!function_exists('kasutan_event_affiche_li')) {
		return;
	}

	echo '<div class="row">';
		printf('<h2 class="titre-section h3">%s</h2>',$titre);
		?>
			<form>
				<label class="screen-reader-text" for="date-filter">Filtrer les événements par date</label>
				<input type="text" id="date-filter" name="date-filter" placeholder="jj.mm.aaaa" />
				<button id="date-filter-clear" class="outline clear">Voir tous les événements</button>

			</form>
		<?php
	echo '</div>';

	$today=date('Ymd');

	$posts=new WP_Query(
		array( 
			'post_type'=>'programmation',
			'posts_per_page'=> -1,
			'meta_key'=>'date_event',
			'orderby'=>'meta_value',
			'order'=>'ASC',
			'meta_value'=>$today,
			'meta_compare' => '>='
		)
	);

	if($posts->have_posts()) {
		echo '<ul class="events futurs">';
		while($posts->have_posts(  )) {
			$posts->the_post();
			kasutan_event_affiche_li(get_the_ID());
		} 
		echo '</ul>';
	} else {
		echo '<p>Aucun événement programmé.</p>';
	}

	wp_reset_postdata(  );

	
	$posts_passes=new WP_Query(
		array( 
			'post_type'=>'programmation',
			'posts_per_page'=> -1,
			'meta_key'=>'date_event',
			'orderby'=>'meta_value',
			'order'=>'DESC',
			'meta_value'=>$today,
			'meta_compare' => '<'
		)
	);

	if($posts_passes->have_posts(  )) {
		echo '<div id="toggle-events-wrap"><button id="toggle-events" aria-controls="past-events" aria-expanded="false">';
			printf('<span class="afficher">%s</span>',$label_afficher);
			printf('<span class="cacher">%s</span>',$label_cacher);
			?>
			<span class="picto">
				<svg width="19" height="12" viewBox="0 0 19 12" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M1.5 1.42847L9.5 10.5713L17.5 1.42847" stroke="#BD4E00" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
				</svg>
			</span>
			<?php
		echo '</button></div>';

		echo '<div  id="past-events" aria-expanded="false">';
			echo '<div class="row">';
				printf('<h2 class="titre-section h3">%s</h2>',$titre_passe);
			echo '</div>';

			echo '<ul class="events passes">';
			while($posts_passes->have_posts(  )) {
				$posts_passes->the_post();
				kasutan_event_affiche_li(get_the_ID());
			} 
			echo '</ul>';

		echo '</div>';
	}
	wp_reset_postdata(  );


echo '</section>';
	