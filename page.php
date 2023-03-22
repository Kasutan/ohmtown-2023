<?php
/**
 * Page
 *
 * @package      EAStarter
 * @author       Bill Erickson
 * @since        1.0.0
 * @license      GPL-2.0+
**/




// Bannière contenant le titre de la page et un lien retour vers la home
add_action( 'tha_entry_top', 'kasutan_page_banniere', 7 );


// Build the page
require get_template_directory() . '/index.php';




