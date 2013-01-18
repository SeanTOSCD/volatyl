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
	
		if ( $options_content[ 'standardmenu' ] == 1 ) {
			echo "<div id=\"menu-area-header\" class=\"full\"><div class=\"main\">";
			standard_menu();
			echo "</div></div>";
		}
				
	} else { // Narrow Structure
		if ( $options_content[ 'standardmenu' ] == 1 ) {
			standard_menu();
		}
	}
			
}

// The standard menu itself... called above
function standard_menu() {
	echo "<nav role=\"navigation\" class=\"site-navigation full-menu standard-navigation\">";
	
	if ( has_nav_menu( 'standard' ) )
		wp_nav_menu( array( 'theme_location' => 'standard' ) );
		
	echo "</nav>";
}


// Footer Menu
function footer_menu_on() {
	$options_structure = get_option( 'vol_structure_options' );
	$options_content = get_option( 'vol_content_options' );
	
	// Wide Structure?
	if ( $options_structure[ 'wide' ] == 1 ) {
	
		if ( $options_content[ 'footermenu' ] == 1 ) {
			echo "<div id=\"menu-area-footer\" class=\"full\"><div class=\"main\">";
			footer_menu();
			echo "</div></div>";
		}
				
	} else { // Narrow Structure
		if ( $options_content[ 'footermenu' ] == 1 ) {
			footer_menu();
		}
	}
			
}

// The footer menu itself... called above
function footer_menu() {
	echo "<nav role=\"navigation\" class=\"site-navigation full-menu footer-navigation\">";
		if ( has_nav_menu( 'footer' ) )
			wp_nav_menu( array( 'theme_location' => 'footer' ) );
			
	echo "</nav>";
}