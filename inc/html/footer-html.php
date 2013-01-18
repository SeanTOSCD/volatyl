<?php
/** footer-html.php
 *
 * This is the main <footer> element of your site. 
 *
 * The footer_element() function is the <footer> itself while the
 * footer_frame() displays the footer based on the site structure.
 * 
 * @package Volatyl
 * @since Volatyl 1.0
 */

function footer_element() {
	global $tab3, $tab6;
	$options_hooks = get_option( 'vol_hooks_options' );
	$options_content = get_option( 'vol_content_options' );
	$options_general = get_option( 'vol_general_options' );

	echo "<footer class=\"site-footer\">\n";

	// vol_footer_top
	if ( $options_hooks[ 'switch_vol_footer_top' ] == 0 )
		vol_footer_top();
		
	/** Fat footer (widgetized)
	 *
	 * If the fat footer option is selected, three widgetized columns
	 * will display.
	 *
	 * @since Volatyl 1.0
	 */
	if ( $options_content[ 'fatfooter' ] == 1 ) {
			
		echo 	"\t\t<div id=\"fat-footer\" class=\"clearfix\">\n",
				"{$tab3}<div class=\"footer-widget border-box\">\n";
				
		if ( ! dynamic_sidebar( 'footer-left' ) )
			default_widget();
		
		echo 	"{$tab3}</div>\n",
				"{$tab3}<div class=\"footer-widget border-box\">\n";
				
		if ( ! dynamic_sidebar( 'footer-middle' ) )
			default_widget();
		
		echo 	"{$tab3}</div>\n",
				"{$tab3}<div class=\"footer-widget border-box\">\n";
				
		if ( ! dynamic_sidebar( 'footer-right' ) )
			default_widget();
		
		echo 	"{$tab3}</div>\n",
				"\t\t</div>\n";
	}

	// vol_footer_bottom
	if ( $options_hooks[ 'switch_vol_footer_bottom' ] == 0 )
		vol_footer_bottom();
	
	echo "\t<div class=\"site-info\">";

	// Footer attribution
	if ( $options_general[ 'attribution' ] == 1 )

		// DO NOT CHANGE text IF displayed
		echo 	__( 'Built with ', 'volatyl' ) . 
				"<a href=\"" . THEME_URI . "\">Volatyl</a>" . 
				__( ' for WordPress', 'volatyl' );
		// DO NOT CHANGE text IF displayed
				
		// vol_site_info
		if ( $options_hooks[ 'switch_vol_site_info' ] == 0 )
			vol_site_info();
	
	echo "</div>\n";
	
	echo "</footer>";
}

// The above <footer> will display based on HTML structure options
function footer_frame() {
	$options_structure = get_option( 'vol_structure_options' );
	
	if ( $options_structure[ 'wide' ] == 1 ) { 
	
		echo "<div id=\"footer\" class=\"full\">\n\t<div class=\"main\">\n";
		footer_element();
		echo "\t</div>\n</div>\n"; 
		
	} else {
	
		footer_element();
		echo "</div>\n";
		
	}
}