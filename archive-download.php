<?php
/** archive-download.php
 *
 ***** THIS IS A CORE VOLATYL FILE AND SHOULD NOT BE EDITED!
 ***** ALL CUSTOM CODING SHOULD BE DONE IN A CHILD THEME.
 ***** MORE INFORMATION - http://volatylthemes.com/why-child-themes/
 *******************************************************************
 *
 * The purpose of this template is to display all downloads in a uniform
 * manner. This template displays exactly the same as the store front. 
 * You'd access this template using...
 *
 * http://{example.com}/downloads/
 *
 * ...where example.com is the full path to your site (no brackets).
 *
 * @package Volatyl
 * @since Volatyl 1.2.2.2
 */
$options_structure = get_option('vol_structure_options');
$store_page_setting = (is_front_page() && is_page_template('custom-store-front.php') ? 'page' : 'paged' );
$current_page = get_query_var($store_page_setting);
$store_items_per_page = apply_filters('store_items_per_page', 9); // custom filter - do not move
$offset = $current_page > 0 ? $store_items_per_page * ($current_page-1) : 0;
$product_args = array(
	'post_type'			=> 'download',
	'posts_per_page'	=> $store_items_per_page,
	'offset'			=> $offset
);
$products = new WP_Query($product_args);

// custom filters 
$item_info = apply_filters('item_info', array(
	'price'				=> __('Price:', 'volatyl'),
	'starting_price'	=> __('Starting at:', 'volatyl'),
	'free'				=> __('Free', 'volatyl')
	) 
);

get_header();
vol_html_before_content(); 

/**
* The actual HTML for the store front template is located in this file so it can 
* easily be overwritten in a child theme. Yes. That means the download archives
* simply use the store front template. Why not?
*/
include(locate_template('/templates/content-store-front.php'));

vol_html_after_content();
get_footer();