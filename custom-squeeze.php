<?php
/** Template Name: Squeeze Page
 *
 * @package Volatyl
 * @since Volatyl 1.0
 */

get_header();

// Content
$options_structure = get_option( 'vol_structure_options' );

if ( $options_structure[ 'wide' ] == 1 ) {

	echo 	"<div id=\"main-content\" class=\"full clearfix\">",
			"<div class=\"main clearfix\">",
			vol_content(),
			"</div></div>"; 
	
} else {

	echo 	"<div id=\"main-content\" class=\"clearfix\">",
			vol_content(),
			"</div>";
	
}

get_footer();