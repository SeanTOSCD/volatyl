<?php 
/** option-defaults.php
 *
 ***** THIS IS A CORE VOLATYL FILE AND SHOULD NOT BE EDITED!
 ***** ALL CUSTOM CODING SHOULD BE DONE IN A CHILD THEME.
 ***** MORE INFORMATION - http://volatylthemes.com/why-child-themes/
 *******************************************************************
 *
 * This chunk of awesome code sets the default Volatyl Options.
 * It checks to see if the database field for each particular
 * option is empty and if it is, it calls to the corresponding
 * default settings function and pulls the settings from the
 * array.
 *
 * @package Volatyl
 * @since Volatyl 1.0
 */

// Structure settings
function vol_structure_default_settings() {
	global $structure_options;
	$structure_options = array(
		'wide'					=> 1,
		'column'				=> 'sc'
	);
	return $structure_options;
}
 
// Initialize Structure Default Options
function vol_structure_settings_init() {

     // set structure options equal to defaults
	global $structure_options;
	$structure_options = get_option('vol_structure_options');
	
	if (false === $structure_options)
		$structure_options = vol_structure_default_settings();
	  
	update_option('vol_structure_options', $structure_options);
}
add_action('after_setup_theme','vol_structure_settings_init');


// General settings
function vol_general_default_settings() {
	global $general_options;
	$general_options = array(
		'updates'				=> 1,
		'responsive'			=> 1,
		'adminmenu'				=> 1,
		'attribution'			=> 1
	);
	return $general_options;
}

// Initialize General Default Options
function vol_general_settings_init() {

	// set general options equal to defaults
	global $general_options;
	$general_options = get_option('vol_general_options');
	
	if (false === $general_options)
		$general_options = vol_general_default_settings();
	  
	update_option('vol_general_options', $general_options);
}
add_action('after_setup_theme','vol_general_settings_init');

// Content settings
function vol_content_default_settings() {
	global $content_options;
	$content_options = array(
		'logo'					=> "",
		'title'					=> 1,
		'tagline'				=> 1,
		'headermenu'			=> 1,
		'standardmenu'			=> 0,
		'footermenu'			=> 0,
		'fatfooter'				=> 0,
		'widgets'				=> 1,
		'pagination'			=> 0,
		'by-post-format'		=> 1,
		'by-date-post'			=> 1,
		'by-author-post'		=> 1,
		'by-comments-post'		=> 1,
		'by-edit-post'			=> 1,
		'by-cats'				=> 1,
		'homeexcerpt'			=> 0,
		'excerptlink'			=> 0,
		'featuredimage'			=> 0,
		'feedtags'				=> 1,
		'singletags'			=> 1,
		'postpings'				=> 1,
		'searchpages'			=> 0,
		'pagecomments'			=> 0
	);
	return $content_options;
}
	
// Initialize Content Default Options
function vol_content_settings_init() {

	// set content options equal to defaults
	global $content_options;
	$content_options = get_option('vol_content_options');
	
	if (false === $content_options)
		$content_options = vol_content_default_settings();
	  
	update_option('vol_content_options', $content_options);
}
add_action('after_setup_theme','vol_content_settings_init');