<?php
/** menus.php
 *
 ***** THIS IS A CORE VOLATYL FILE AND SHOULD NOT BE EDITED!
 ***** ALL CUSTOM CODING SHOULD BE DONE IN A CHILD THEME.
 ***** MORE INFORMATION - http://volatylthemes.com/why-child-themes/
 *******************************************************************
 *
 * Volatyl supports multiple menus. If the additional menus are turned on, 
 * their structures are determined here and called from the structure.php file.
 * 
 * @package Volatyl
 * @since Volatyl 1.0
 */
 
// Standard Menu
function standard_menu_on() {
	$options_structure = get_option( 'vol_structure_options' );
	$options_content = get_option( 'vol_content_options' );
	
	// Wide Structure?
	( ( $options_structure[ 'wide' ] == 1 ) ?
		( ( $options_content[ 'standardmenu' ] == 1 ) ?
			printf( "<div id=\"menu-area-standard\" class=\"full\">
			<div class=\"main\">" ) .
			standard_menu() .
			printf( "</div></div>" ) : 
		'' ) :
		( ( $options_content[ 'standardmenu' ] == 1 ) ? 
			standard_menu() : 
		'' )
	);
}

// The standard menu itself... called above
function standard_menu() {
	$standard_menu_open = apply_filters( 'standard_menu_open', 'Navigation' );
	$standard_menu_close = apply_filters( 'standard_menu_close', 'Hide Navigation' );

	/**
	 * The header menu is replaced with a link beneath a certain screen
	 * width. At that point, the menu will show once the link is clicked.
	 *
	 * @since Volatyl 1.0
	 */
	echo "<div id=\"standard-menu-container\" class=\"standard-menu-wrap border-box\">
	<div class=\"standard-menu-toggle\">
	<a href=\"#standard-menu-container\" class=\"open-standard-menu menu-toggle\">" . __( $standard_menu_open, 'volatyl' ) . "</a>
	<a href=\"#standard-menu-collapse\" class=\"close-standard-menu menu-toggle\" id=\"standard-menu-collapse\">" . __( $standard_menu_close, 'volatyl' ) . "</a>
	</div>
	\t<nav id=\"standard-menu-wrap\" role=\"navigation\" class=\"site-navigation full-menu standard-navigation border-box\">\n",
	( ( has_nav_menu( 'standard' ) ) ? wp_nav_menu( array( 'theme_location' => 'standard' ) ) : '' ),
	"\t</nav>\n
	</div>";
}

// Footer Menu
function footer_menu_on() {
	$options_structure = get_option( 'vol_structure_options' );
	$options_content = get_option( 'vol_content_options' );
	
	// Wide Structure?
	( ( $options_structure[ 'wide' ] == 1 ) ?
		( ( $options_content[ 'footermenu' ] == 1 ) ?
			printf( "<div id=\"menu-area-footer\" class=\"full\">
			<div class=\"main\">" ) .
			footer_menu() .
			printf( "</div></div>" ) : 
		'' ) :
		( ( $options_content[ 'footermenu' ] == 1 ) ? 
			footer_menu() : 
		'' )
	);
}

// The footer menu itself... called above
function footer_menu() {
	$footer_menu_open = apply_filters( 'footer_menu_open', 'Navigation' );
	$footer_menu_close = apply_filters( 'footer_menu_close', 'Hide Navigation' );

	/**
	 * The header menu is replaced with a link beneath a certain screen
	 * width. At that point, the menu will show once the link is clicked.
	 *
	 * @since Volatyl 1.0
	 */
	echo "<div id=\"footer-menu-container\" class=\"footer-menu-wrap border-box\">
	<div class=\"footer-menu-toggle\">
	<a href=\"#footer-menu-container\" class=\"open-footer-menu menu-toggle \">" . __( $footer_menu_open, 'volatyl' ) . "</a>
	<a href=\"#footer-menu-collapse\" class=\"close-footer-menu menu-toggle\" id=\"footer-menu-collapse\">" . __( $footer_menu_close, 'volatyl' ) . "</a>
	</div>
	\t<nav id=\"footer-menu-wrap\" role=\"navigation\" class=\"site-navigation full-menu footer-navigation border-box\">\n",
	( ( has_nav_menu( 'footer' ) ) ? wp_nav_menu( array( 'theme_location' => 'footer' ) ) : '' ),
	"\t</nav>\n
	</div>";
}