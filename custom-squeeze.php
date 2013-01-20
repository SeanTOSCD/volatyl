<?php
/** Template Name: Squeeze Page
 *
 * This template is almost pointless... except that it's not.
 * A squeeze page typically serves ONE purpose. That purpose
 * is whatever you want it to be. Most people collect email
 * addresses or show a video. Something simple.
 *
 * There are no exit links form this page. Header, footer, 
 * sidebars, etc... they're all gone. Set your title and your
 * content. That's all you've got to work with. 
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