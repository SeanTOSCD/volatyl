<?php
/** around-content.php
 *
 ***** THIS IS A CORE VOLATYL FILE AND SHOULD NOT BE EDITED!
 ***** ALL CUSTOM CODING SHOULD BE DONE IN A CHILD THEME.
 ***** MORE INFORMATION - http://volatylthemes.com/why-child-themes/
 *******************************************************************
 *
 * Dumb filename, huh? The two functions here, vol_html_before_content() and
 * vol_html_after_content(), cover everything from the bottom of the <head> to
 * the top of the main content... and the bottom of the main content
 * to the top of the site footer. They actually are "around the content."
 *
 * @package Volatyl
 * @since Volatyl 1.0
 */

function vol_html_before_content() {
	global $options;
	$options = get_option('vol_hooks_options');
	$options_content = get_option('vol_content_options');
	$options_structure = get_option('vol_structure_options');

	// vol_before_html hook
	vol_before_html_output();

	vol_header_frame();
	vol_standard_menu_on();

	// vol_headliner hook
	vol_headliner_output();

	// vol_before_content hook
	vol_before_content_output();

	// vol_before_content_area hook
	vol_before_content_area_output();	
}

function vol_html_after_content() {
	global $options;
	$options = get_option('vol_hooks_options');
	$options_content = get_option('vol_content_options');
	$options_structure = get_option('vol_structure_options');

	// vol_after_content_area hook
	vol_after_content_area_output();

	// vol_after_content hook
	vol_after_content_output();

	// vol_footliner hook
	vol_footliner_output();
	
	vol_footer_menu_on();
	vol_footer_frame();

	// vol_after_html hook
	vol_after_html_output();
}