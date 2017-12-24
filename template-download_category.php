<?php
/** taxonomy-download_category.php
 *
 ***** THIS IS A CORE VOLATYL FILE AND SHOULD NOT BE EDITED!
 ***** ALL CUSTOM CODING SHOULD BE DONE IN A CHILD THEME.
 ***** MORE INFORMATION - http://volatylthemes.com/why-child-themes/
 *******************************************************************
 *
 * The purpose of this template is to display download categories.
 *
 * @package Volatyl
 * @since Volatyl 1.2.2.2
 */
$options_structure = get_option('vol_structure_options');
$store_page_setting = (is_tax() ? 'paged' : 'page');
$current_page = get_query_var($store_page_setting);

// custom filters 
$item_info = apply_filters('item_info', array(
	'price' 			=> __('Price:', 'volatyl'),
	'starting_price' 	=> __('Starting at:', 'volatyl'),
	'free' 				=> __('Free', 'volatyl')
));

get_header();
vol_html_before_content(); 

/**
* The actual HTML for the download category template is located in this file so it can 
* easily be overwritten in a child theme.
*/
include(locate_template('/templates/content-download-taxonomy.php'));

vol_html_after_content();
get_footer();