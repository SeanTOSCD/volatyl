<?php
/** main-content.php
 * 
 * I did this for YOU! So that you are not stuck with one site
 * layout all across your site, I modularized everything in order
 * to isolate the main content area.
 *
 * standard_content() is the default columns structure based on what
 * you've chosen in the Volatyl Options. 
 *
 * singular_content() is the columns structure for individual posts,
 * pages, and attachments. The structure can be set on each individual
 * page type. If no site structure is selected, standard_content() will
 * be used to match the site default. When site default is used, the 
 * layout of the individual pages will change when you changed the site
 * layout. In other words, it's awesome.
 *
 * These functions call to the inc/functions/columns.php file where a
 * switch statement controls which HTML elements are rendered for your
 * selected layout. Again, it's awesome.
 *
 * @package Volatyl
 * @since Volatyl 1.0
 */
 
function standard_content() {

	// Content
	$options_structure = get_option( 'vol_structure_options' );
	
	if ( $options_structure[ 'wide' ] == 1 ) {
	
		echo 	"<div id=\"main-content\" class=\"full clearfix\">",
				"<div class=\"main clearfix\">";
				vol_columns(); 
		echo 	"</div></div>"; 
		
	} else {
	
		echo 	"<div id=\"main-content\" class=\"clearfix\">";
				vol_columns();
		echo 	"</div>";
		
	}
}
add_action( 'main_content', 'standard_content' );

function singular_content() {

	// Content
	$options_structure = get_option( 'vol_structure_options' );
	
	if ( $options_structure[ 'wide' ] == 1 ) {
	
		echo 	"<div id=\"main-content\" class=\"full clearfix\">",
				"<div class=\"main clearfix\">";
				columns_singular(); 
		echo 	"</div></div>"; 
		
	} else {
	
		echo 	"\t<div id=\"main-content\" class=\"clearfix\">\n";
				columns_singular();
		echo 	"\t</div>\n";
		
	}
}
add_action( 'main_content_singular', 'singular_content' );

function custom_content() {

	// This is the blank canvas where developers can create their own layout
}
add_action( 'main_content_custom_layout', 'custom_content' );