<?php
/**
 * Page
 *
 * @package      EAStarter
 * @author       Bill Erickson
 * @since        1.0.0
 * @license      GPL-2.0+
**/




// Image bannière au-dessus du titre de la page
add_action( 'tha_entry_top', 'kasutan_page_banniere', 7 );

// Breadcrumbs above page title
add_action( 'tha_entry_top', 'kasutan_fil_ariane', 8 );

// Page title
add_action( 'tha_entry_top', 'kasutan_page_titre', 10 );

// Build the page
require get_template_directory() . '/index.php';




