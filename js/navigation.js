/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */
( function() {
	var volet, button, menu, links, i, len;


	button = document.getElementById( 'menu-toggle' );
	if ( 'undefined' === typeof button ) {
		return;
	}

	volet = document.getElementById( 'volet-navigation' );
	var header = document.getElementById( 'site-header' );

	// Hide menu toggle button if volet is empty and return early.
	if ( 'undefined' === typeof volet ) {
		button.style.display = 'none';
		return;
	}

	menu = volet.getElementsByTagName( 'ul' )[0];
	if ( -1 === menu.className.indexOf( 'nav-menu' ) ) {
		menu.className += ' nav-menu';
	}


	button.setAttribute( 'aria-expanded', 'false' );


	button.onclick = function() {
		if ( -1 !== volet.className.indexOf( 'toggled' ) ) {
			volet.className = volet.className.replace( ' toggled', '' );
			header.className = header.className.replace( ' volet-ouvert', '' );
			button.setAttribute( 'aria-expanded', 'false' );
		} else {
			volet.className += ' toggled';
			header.className += ' volet-ouvert';
			button.setAttribute( 'aria-expanded', 'true' );
		}
	};

	// Get all the link elements within the menu.
	links    = menu.getElementsByTagName( 'a' );

	// Each time a menu link is focused or blurred, toggle focus.
	for ( i = 0, len = links.length; i < len; i++ ) {
		links[i].addEventListener( 'focus', toggleFocus, true );
		links[i].addEventListener( 'blur', toggleFocus, true );
	}

	/**
	 * Sets or removes .focus class on an element.
	 */
	function toggleFocus() {
		var self = this;

		// Move up through the ancestors of the current link until we hit .nav-menu.
		while ( -1 === self.className.indexOf( 'nav-menu' ) ) {

			// On li elements toggle the class .focus.
			if ( 'li' === self.tagName.toLowerCase() ) {
				if ( -1 !== self.className.indexOf( 'focus' ) ) {
					self.className = self.className.replace( ' focus', '' );
				} else {
					self.className += ' focus';
				}
			}

			self = self.parentElement;
		}
	}

	
} )();
