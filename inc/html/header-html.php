<?php
/** header-html.php
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
		if 	( ( is_home() && $options[ 'home_vol_header_top' ] == 0 ) ||
			( is_front_page() && $options[ 'front_vol_header_top' ] == 0 ) ||
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
	if ( $title == 1 ) {
		echo 	"\t\t<{$seotitle} class=\"site-title\">",
				"<a href=\"",
				home_url( '/' ), "\" title=\"",
				esc_attr( get_bloginfo( 'name', 'display' ) ), 
				"\" rel=\"home\">";
	
		// If a logo is uploaded, show it. If not, show the site title.
		if ( $logo != '' )
			echo "<img src=\"", $options_content[ 'logo' ], "\" alt=\"" . get_bloginfo( 'name', 'display' ) . "\" />";
			
		else		
			echo get_bloginfo( 'name' );
		
		echo "</a></{$seotitle}>\n";
	}

	// Show site tagline? Always hide on landing page		
	echo ( ( $tagline == 1 && ! is_page_template( 'custom-landing.php' ) ) ? "\t\t<{$seotagline} class=\"site-description\">" . get_bloginfo( 'description' ) . "</{$seotagline}>\n" : '' );

	// vol_header_bottom - Always hide on landing page
	if ( $options[ 'switch_vol_header_bottom' ] == 0 && ! is_page_template( 'custom-landing.php' ) ) {
		if 	( ( is_home() && $options[ 'home_vol_header_bottom' ] == 0 ) ||
			( is_front_page() && $options[ 'front_vol_header_bottom' ] == 0 ) ||
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
	if ( $options_content['headermenu'] == 1 && ! is_page_template( 'custom-landing.php' ) ) {
	
		echo	"<div id=\"short-menu-toggle-open\" class=\"short-menu-wrap\">",
				"<div class=\"short-menu-toggle\">",
				"<a href=\"#short-menu-toggle-open\" class=\"open-short-menu\">Menu</a>",
				"<a href=\"#\" class=\"close-short-menu\">Close Menu</a>",
				"</div>",
				"\t<nav role=\"navigation\" class=\"site-navigation short-menu header-navigation\">\n";
		
		if ( has_nav_menu( 'header' ) )
			wp_nav_menu( array( 'theme_location' => 'header' ) );
			
		echo 	"\t</nav>\n",
				"</div>";
	}
	
	echo "</header>";
}


// The above <header> will display based on HTML structure options
function header_frame() {
	$options_structure = get_option( 'vol_structure_options' );
	
	if ( $options_structure[ 'wide' ] == 1 ) { 
	
		echo 	"<div id=\"header\" class=\"full\">\n\t<div class=\"main\">\n",
				header_element(),
				"\t</div>\n</div>\n";
		
	} else {
	
		echo 	"<div id=\"container\">\n",
				header_element();
		
	}
}