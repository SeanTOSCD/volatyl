<?php
/** menus.php
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
	if ( $options_structure[ 'wide' ] == 1 ) {
	
		if ( $options_content[ 'standardmenu' ] == 1 )
			echo 	"<div id=\"menu-area-header\" class=\"full\">",
					"<div class=\"main\">",
					standard_menu(),
					"</div></div>";
				
	} else {
	
		( ( $options_content[ 'standardmenu' ] == 1 ) ? standard_menu() : '' );
			
	}
}

// The standard menu itself... called above
function standard_menu() {

	/**
	 * The header menu is replaced with a link beneath a certain screen
	 * width. At that point, the menu will show once the link is clicked.
	 *
	 * @since Volatyl 1.0
	 */
	
	echo	"<div id=\"standard-menu-toggle-open\" class=\"standard-menu-wrap\">",
			"<div class=\"standard-menu-toggle\">",
			"<a href=\"#standard-menu-toggle-open\" class=\"open-standard-menu menu-toggle\">Navigation</a>",
			"<a href=\"#standard-menu-collapse\" class=\"close-standard-menu menu-toggle\" id=\"standard-menu-collapse\">Collapse</a>",
			"</div>",
			"\t<nav role=\"navigation\" class=\"site-navigation full-menu standard-navigation\">\n",
	
			( ( has_nav_menu( 'standard' ) ) ? wp_nav_menu( array( 'theme_location' => 'standard' ) ) : '' ),
		
			"\t</nav>\n",
			"</div>";
}


// Footer Menu
function footer_menu_on() {
	$options_structure = get_option( 'vol_structure_options' );
	$options_content = get_option( 'vol_content_options' );
	
	// Wide Structure?
	if ( $options_structure[ 'wide' ] == 1 ) {
	
		if ( $options_content[ 'footermenu' ] == 1 )
			echo 	"<div id=\"menu-area-footer\" class=\"full\">",
					"<div class=\"main\">",
					footer_menu(),
					"</div></div>";
				
	} else {
	
		( ( $options_content[ 'footermenu' ] == 1 ) ? footer_menu() : '' );
			
	}
}


// The footer menu itself... called above
function footer_menu() {

	/**
	 * The header menu is replaced with a link beneath a certain screen
	 * width. At that point, the menu will show once the link is clicked.
	 *
	 * @since Volatyl 1.0
	 */
	
	echo	"<div id=\"footer-menu-toggle-open\" class=\"footer-menu-wrap\">",
			"<div class=\"footer-menu-toggle\">",
			"<a href=\"#footer-menu-toggle-open\" class=\"open-footer-menu menu-toggle \">Navigation</a>",
			"<a href=\"#footer-menu-collapse\" class=\"close-footer-menu menu-toggle\" id=\"footer-menu-collapse\">Collapse</a>",
			"</div>",
			"\t<nav role=\"navigation\" class=\"site-navigation full-menu footer-navigation\">\n",
	
			( ( has_nav_menu( 'footer' ) ) ?
			wp_nav_menu( array( 'theme_location' => 'footer' ) ) : '' ),
		
			"\t</nav>\n",
			"</div>";
}