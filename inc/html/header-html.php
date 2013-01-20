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
	
	echo "<header class=\"site-header inner\">\n",

	// vol_header_top
	( ( $options[ 'switch_vol_header_top' ] == 0 ) ? vol_header_top() : '' );
		
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
				echo bloginfo( 'name' );
			
			echo "</a></{$seotitle}>\n";
		}
	
		// Show site tagline? Always hide on landing page		
		echo ( ( $tagline == 1 && ! is_page_template( 'custom-landing.php' ) ) ? "\t\t<{$seotagline} class=\"site-description\">" . bloginfo( 'description' ) . "</{$seotagline}>\n" : '' ),

		// vol_header_bottom - Always hide on landing page	
		( ( $options[ 'switch_vol_header_bottom' ] == 0 && ! is_page_template( 'custom-landing.php' ) ) ? vol_header_bottom() : '' );

	// Show header menu? - Always hide on landing page	
	if ( $options_content['headermenu'] == 1 && ! is_page_template( 'custom-landing.php' ) ) {
	
		echo "\t<nav role=\"navigation\" class=\"site-navigation short-menu header-navigation\">\n";
		
		if ( has_nav_menu( 'header' ) )
			wp_nav_menu( array( 'theme_location' => 'header' ) );
			
		echo "\t</nav>\n";
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