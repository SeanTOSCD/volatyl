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

$options_structure = get_option( 'vol_structure_options' );
$options_hooks = get_option( 'vol_hooks_options' );

// Headliner Hook - vol_headliner
function show_vol_headliner() {
	global $options_structure, $options_hooks;
	
	if ( has_action( 'vol_headliner' ) || ! empty ( $options_hooks[ 'vol_headliner' ] ) )
	
	echo 	( ( $options_structure[ 'wide' ] == 1 ) ? 
	
			"<div id=\"headliner-area\" class=\"full liner\">" .
			"<div class=\"main\">" .
			"<div id=\"headliner\">" .
			vol_headliner() . 
			"</div></div></div>\n" :
			
			"<div id=\"headliner\">" .
			vol_headliner() .
			"</div>" );
}

function test() {
	echo "test";
}
add_action('vol_headliner','test');


// Footliner Hook - vol_footliner
function show_vol_footliner() {
	global $options_structure, $options_hooks;
	
	if ( has_action( 'vol_footliner' ) || ! empty ( $options_hooks[ 'vol_footliner' ] ) )
	
	echo 	( $options_structure[ 'wide' ] == 1 ) ?
	
			"<div id=\"footliner-area\" class=\"full liner\">" .
			"<div class=\"main\">" .
			"<div id=\"footliner\">" .
			vol_footliner() .
			"</div></div></div>" :
			
			"<div id=\"footliner\">" .
			vol_footliner() .
			"</div>";
}