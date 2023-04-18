<?php
/**
 * Archive partial
 *
 * @package      EAStarter
 * @author       Bill Erickson
 * @since        1.0.0
 * @license      GPL-2.0+
**/

//On récupère une éventuelle info sur le tag html passée en $args de get_template_part
$tag='li';
$suite="Lire l'article";

if(!empty($args) && array_key_exists('tag',$args)) {
	$tag=$args['tag'];
}


if(!empty($args) && array_key_exists('suite',$args)) {
	$suite=$args['suite'];
}


printf('<%s class="post-summary">',$tag);

	ea_post_summary_image('medium');

	echo '<div class="post-summary__content">';
		ea_entry_category('archive');
		
		ea_post_summary_title();

		printf('<p class="entry-date">%s</p>', get_the_date('d.m.Y'));

		$extrait=wpautop(get_the_excerpt());
		printf('<div class="extrait">%s</div>',$extrait);

		printf('<a href="%s" class="suite">%s<span aria-hidden="true">&nbsp;></span><span class="screen-reader-text"> %s</span>
		</a>',esc_url( get_permalink( ) ),$suite,get_the_title( ));
		
	echo '</div>';

printf('</%s>',$tag);

