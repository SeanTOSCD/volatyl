<?php
/** main-content.php
 *
 ***** THIS IS A CORE VOLATYL FILE AND SHOULD NOT BE EDITED!
 ***** ALL CUSTOM CODING SHOULD BE DONE IN A CHILD THEME.
 ***** MORE INFORMATION - http://volatylthemes.com/why-child-themes/
 *******************************************************************
 * 
 * I did this for YOU! So that you are not stuck with one site
 * layout all across your site, I modularized everything in order
 * to isolate the main content area.
 *
 * vol_standard_content() is the default columns structure based on what
 * you've chosen in the Volatyl Options. 
 *
 * vol_singular_content() is the columns structure for individual posts,
 * pages, and attachments. The structure can be set on each individual
 * page type. If no site structure is selected, vol_standard_content() will
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

// Full site content structure
function vol_standard_content() {
	$options_structure = get_option('vol_structure_options');
	
	(($options_structure['wide'] == 1) ? 
		printf("<div id=\"main-content\" class=\"full clearfix\">
		<div class=\"main clearfix\">") .
		vol_columns() .
		printf("</div></div>") :
		printf("<div id=\"main-content\" class=\"clearfix\">") .
		vol_columns() .
		printf("</div>"));
}
add_action('main_content', 'vol_standard_content');


// Singular option content structure
function vol_singular_content() {
	$options_structure = get_option('vol_structure_options');
	
	(($options_structure['wide'] == 1) ?
		printf("<div id=\"main-content\" class=\"full clearfix\">
		<div class=\"main clearfix\">") .
		vol_columns_singular() .
		printf("</div></div>") :
		printf("\t<div id=\"main-content\" class=\"clearfix\">\n") .
		vol_columns_singular() .
		printf("\t</div>\n"));
}
add_action('main_content_singular', 'vol_singular_content');


// Custom layout clean slate
function vol_custom_content() {
	// This is the blank canvas where developers can create their own layout
}
add_action('main_content_custom_layout', 'vol_custom_content');