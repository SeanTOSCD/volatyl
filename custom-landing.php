<?php
/** Template Name: Landing Page
 *
 * This is a custom landing page template. In conjunction with
 * the code in the header-html.php file, the entire .site-header
 * is stripped of everything BUT the logo and the vol_header_top
 * hook. That content becomes centered.
 *
 * No sidebars are included in this template and the content column,
 * as it stands alone, has a defined width. The footer is stripped
 * much like the header. The only remaining items are the attribution
 * and the vol_site_info hook.
 *
 * @package Volatyl
 * @since Volatyl 1.0
 */

get_header();
header_frame();

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
	
footer_frame();
get_footer();