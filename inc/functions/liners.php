<?php 
/** liners.php
 *
 * Some hooks are bigger than themselves! If they alter the main site
 * structure, they have their own function to first utilize the chosen
 * HTML structure selected in the theme options. Once structured
 * properly, they are called from their hook locations.
 *
 * @package Volatyl
 * @since Volatyl 1.0
 */

// Headliner Hook - vol_headliner
function show_vol_headliner() {
	$options_structure = get_option( 'vol_structure_options' );
	
	if ( $options_structure[ 'wide' ] == 1 )
		echo 	"<div id=\"headliner-area\" class=\"full liner\"><div class=\"main\">",
				"<div id=\"headliner\">",
				vol_headliner(),
				"</div></div></div>\n";
				
	else
		echo 	"<div id=\"headliner\">",
				vol_headliner(),
				"</div>";
}


// Footliner Hook - vol_footliner
function show_vol_footliner() {
	$options_structure = get_option( 'vol_structure_options' );
	
	if ( $options_structure[ 'wide' ] == 1 )
		echo 	"<div id=\"footliner-area\" class=\"full liner\"><div class=\"main\">",
				"<div id=\"footliner\">",
				vol_footliner(),
				"</div></div></div>";
				
	else
		echo 	"<div id=\"footliner\">",
				vol_footliner(),
				"</div>";
}