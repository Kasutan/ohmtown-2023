<?php
/**
 * Base template
 *
 * @package      EAStarter
 * @author       Bill Erickson
 * @since        1.0.0
 * @license      GPL-2.0+
**/


//Redirection du single vers l'archive pour certains événements
//Rediriger avant l'envoi des headers
if(function_exists('kasutan_event_maybe_redirect')) {
	kasutan_event_maybe_redirect();
}

get_header();

tha_content_before();

	echo '<div class="' . ea_class( 'content-area', 'wrap', apply_filters( 'ea_content_area_wrap', true ) ) . '">';
	tha_content_wrap_before();
	echo '<main class="site-main">';
	tha_content_top();
	tha_content_loop();
	tha_content_bottom();
	echo '</main>';
	get_sidebar();
	tha_content_wrap_after();
	echo '</div>';
tha_content_after();

get_footer();
