/**
 * responsive navigation menus
 */
( function() {
	var container, button, menu;

	container = document.getElementById( 'header-menu-wrap' );
	if ( ! container ) return;
	

	button = container.getElementsByTagName( 'span' )[0];
	if ( 'undefined' === typeof button ) return;

	menu = container.getElementsByTagName( 'ul' )[0];

	// Hide menu toggle button if menu is empty and return early.
	if ( 'undefined' === typeof menu ) {
		button.style.display = 'none';
		return;
	}

	if ( -1 === menu.className.indexOf( 'nav-menu' ) ) menu.className += ' nav-menu';
	
	button.onclick = function() {
		if ( -1 !== container.className.indexOf( 'toggled' ) )
			container.className = container.className.replace( ' toggled', '' );
		else
			container.className += ' toggled';
	};
} )();

( function() {
	var s_container, s_button, s_menu;

	s_container = document.getElementById( 'standard-menu-wrap' );
	if ( ! s_container ) return;
	

	s_button = s_container.getElementsByTagName( 'span' )[0];
	if ( 'undefined' === typeof s_button ) return;

	s_menu = s_container.getElementsByTagName( 'ul' )[0];

	// Hide menu toggle button if menu is empty and return early.
	if ( 'undefined' === typeof s_menu ) {
		s_button.style.display = 'none';
		return;
	}

	if ( -1 === s_menu.className.indexOf( 'nav-menu' ) ) s_menu.className += ' nav-menu';
	
	s_button.onclick = function() {
		if ( -1 !== s_container.className.indexOf( 'toggled' ) )
			s_container.className = s_container.className.replace( ' toggled', '' );
		else
			s_container.className += ' toggled';
	};
} )();

( function() {
	var f_container, f_button, f_menu;

	f_container = document.getElementById( 'footer-menu-wrap' );
	if ( ! f_container ) return;
	
	f_button = f_container.getElementsByTagName( 'span' )[0];
	if ( 'undefined' === typeof f_button ) return;

	f_menu = f_container.getElementsByTagName( 'ul' )[0];

	// Hide menu toggle button if menu is empty and return early.
	if ( 'undefined' === typeof f_menu ) {
		f_button.style.display = 'none';
		return;
	}	

	if ( -1 === f_menu.className.indexOf( 'nav-menu' ) ) f_menu.className += ' nav-menu';
	
	f_button.onclick = function() {
		if ( -1 !== f_container.className.indexOf( 'toggled' ) )
			f_container.className = f_container.className.replace( ' toggled', '' );
		else
			f_container.className += ' toggled';
	};
} )();