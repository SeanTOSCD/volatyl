<?php
/** header-html.php
 *
 ***** THIS IS A CORE VOLATYL FILE AND SHOULD NOT BE EDITED!
 ***** ALL CUSTOM CODING SHOULD BE DONE IN A CHILD THEME.
 ***** MORE INFORMATION - http://volatylthemes.com/why-child-themes/
 *******************************************************************
 *
 * This is the main <header> element of your site. 
 *
 * The header_element() function is the <header> itself while the
 * header_frame() displays the header based on the site structure.
 * 
 * @package Volatyl
 * @since Volatyl 1.0
 */

// The standard header element
function header_element() {
	global $options;
	$options = get_option( 'vol_hooks_options' );
	$options_content = get_option( 'vol_content_options' );
	$title = $options_content[ 'title' ];
	$logo = $options_content[ 'logo' ];
	$tagline = $options_content[ 'tagline' ];
	$header_menu_open = apply_filters( 'header_menu_open', 'Menu' );
	$header_menu_close = apply_filters( 'header_menu_close', 'Hide Menu' );
	
	if ( is_home() || is_front_page() ) {
		$seotitle = "h1";
		$seotagline = "h2";
	} else {
		$seotitle = "p";
		$seotagline = "p";
	}
	
	echo "<header class=\"site-header inner\">\n";

	// vol_header_top
	if ( $options[ 'switch_vol_header_top' ] == 0 ) {
		if 	( ( is_home() && is_front_page() && $options[ 'home_vol_header_top' ] == 0 && $options[ 'front_vol_header_top' ] == 0 ) ||
			( is_home() && ! is_front_page() && $options[ 'home_vol_header_top' ] == 0 ) ||
			( is_front_page() && ! is_home() && $options[ 'front_vol_header_top' ] == 0 ) ||
			( is_single() && $options[ 'posts_vol_header_top' ] == 0 ) ||
			( is_page() && ! is_front_page() && $options[ 'pages_vol_header_top' ] == 0 ) ||
			( is_archive() && $options[ 'archive_vol_header_top' ] == 0 ) ||
			( is_search() && $options[ 'search_vol_header_top' ] == 0 ) ||
			( is_404() && $options[ '404_vol_header_top' ] == 0 ) ) {
				vol_header_top();
		} else {
			do_action( 'vol_header_top' );
		}
	}
		
	// Show site title? This controls the text title AND logo			
	echo ( ( $title == 1 ) ? "\t\t<{$seotitle} class=\"site-title\"><a href=\"" . home_url( '/' ) . "\" title=\"" . esc_attr( get_bloginfo( 'name', 'display' ) ) . "\" rel=\"home\">" .
	
	// If a logo is uploaded, show it. If not, show the site title.
	( ( $logo != '' ) ? "<img src=\"" . $options_content[ 'logo' ] . "\" alt=\"" . get_bloginfo( 'name', 'display' ) . "\" />" : get_bloginfo( 'name' ) ) . "</a></{$seotitle}>\n" : '' ),

	// Show site tagline? Always hide on landing page		
	( ( $tagline == 1 && ! is_page_template( 'custom-landing.php' ) ) ? "\t\t<{$seotagline} class=\"site-description\">" . get_bloginfo( 'description' ) . "</{$seotagline}>\n" : '' );

	// vol_header_bottom - Always hide on landing page
	if ( $options[ 'switch_vol_header_bottom' ] == 0 && ! is_page_template( 'custom-landing.php' ) ) {
		if 	( ( is_home() && is_front_page() && $options[ 'home_vol_header_bottom' ] == 0 && $options[ 'front_vol_header_bottom' ] == 0 ) ||
			( is_home() && ! is_front_page() && $options[ 'home_vol_header_bottom' ] == 0 ) ||
			( is_front_page() && ! is_home() && $options[ 'front_vol_header_bottom' ] == 0 ) ||
			( is_single() && $options[ 'posts_vol_header_bottom' ] == 0 ) ||
			( is_page() && ! is_front_page() && $options[ 'pages_vol_header_bottom' ] == 0 ) ||
			( is_archive() && $options[ 'archive_vol_header_bottom' ] == 0 ) ||
			( is_search() && $options[ 'search_vol_header_bottom' ] == 0 ) ||
			( is_404() && $options[ '404_vol_header_bottom' ] == 0 ) ) {
				vol_header_bottom();
		} else {
			do_action( 'vol_header_bottom' );
		}
	}

	/** Show header menu? - Always hide on landing page	
	 * 
	 * The header menu is replaced with a link beneath a certain screen
	 * width. At that point, the menu will show once the link is clicked.
	 *
	 * @since Volatyl 1.0
	 */
	( ( $options_content['headermenu'] == 1 && ! is_page_template( 'custom-landing.php' ) ) ?
		printf( "<div id=\"header-menu-container\" class=\"header-menu-wrap\">
		<div class=\"header-menu-toggle\">
		<a href=\"#header-menu-container\" class=\"open-header-menu menu-toggle\">" ) . printf( __( $header_menu_open, 'volatyl' ) ) . printf( "</a>
		<a href=\"#\" class=\"close-header-menu menu-toggle\">" ) . printf( __( $header_menu_close, 'volatyl' ) ) . printf( "</a>
		</div>
		\t<nav role=\"navigation\" id=\"short-menu-wrap\" class=\"site-navigation short-menu header-navigation border-box\">\n" ) .
		( ( has_nav_menu( 'header' ) ) ? wp_nav_menu( array( 'theme_location' => 'header' ) ) : '' ) .
		printf( "\t</nav>\n
		</div>" ) : 
	'' );	
	echo "</header>";
}


// The above <header> will display based on HTML structure options
function header_frame() {
	$options_structure = get_option( 'vol_structure_options' );
	
	( ( $options_structure[ 'wide' ] == 1 ) ?
		printf( "<div id=\"header-area\" class=\"full\">\n\t<div class=\"main\">\n" ) .
		header_element() . 
		printf( "\t</div>\n</div>\n" ) :
		printf( "<div id=\"container\">\n" ) . 
		header_element() );
}