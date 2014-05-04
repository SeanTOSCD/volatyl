<?php
/** hook-output.php
 *
 ***** THIS IS A CORE VOLATYL FILE AND SHOULD NOT BE EDITED!
 ***** ALL CUSTOM CODING SHOULD BE DONE IN A CHILD THEME.
 ***** MORE INFORMATION - http://volatylthemes.com/why-child-themes/
 *******************************************************************
 *
 * Because of the built-in hooks interface, the hook conditionals can
 * get pretty complicated. There's no reason all of that needs to be
 * seen in template files and other highly visible core files. Let's
 * put all of that in here and just use a function call to output
 * the hook content on the front-end.
 *
 * @package Volatyl
 * @since Volatyl 1.4
 */
function vol_before_html_output() { 
	global $options; 
	if ($options['switch_vol_before_html'] == 0) {
		if 	((is_home() && is_front_page() && $options['home_vol_before_html'] == 0 && $options['front_vol_before_html'] == 0) ||
			(is_home() && ! is_front_page() && $options['home_vol_before_html'] == 0) ||
			(is_front_page() && ! is_home() && $options['front_vol_before_html'] == 0) ||
			(is_single() && $options['posts_vol_before_html'] == 0) ||
			(is_page() && ! is_front_page() && $options['pages_vol_before_html'] == 0) ||
			(is_archive() && $options['archive_vol_before_html'] == 0) ||
			(is_search() && $options['search_vol_before_html'] == 0) ||
			(is_404() && $options['404_vol_before_html'] == 0)) {
				vol_before_html();
		}
		do_action('vol_before_html');
	}
}
function vol_after_html_output() { 
	global $options; 
	if ($options['switch_vol_after_html'] == 0) {
		if 	((is_home() && is_front_page() && $options['home_vol_after_html'] == 0 && $options['front_vol_after_html'] == 0) ||
			(is_home() && ! is_front_page() && $options['home_vol_after_html'] == 0) ||
			(is_front_page() && ! is_home() && $options['front_vol_after_html'] == 0) ||
			(is_single() && $options['posts_vol_after_html'] == 0) ||
			(is_page() && ! is_front_page() && $options['pages_vol_after_html'] == 0) ||
			(is_archive() && $options['archive_vol_after_html'] == 0) ||
			(is_search() && $options['search_vol_after_html'] == 0) ||
			(is_404() && $options['404_vol_after_html'] == 0)) {
				vol_after_html();
		}
		do_action('vol_after_html');
	}
}
function vol_header_top_output() { 
	global $options; 
	if ($options['switch_vol_header_top'] == 0) {
		if 	((is_home() && is_front_page() && $options['home_vol_header_top'] == 0 && $options['front_vol_header_top'] == 0) ||
			(is_home() && ! is_front_page() && $options['home_vol_header_top'] == 0) ||
			(is_front_page() && ! is_home() && $options['front_vol_header_top'] == 0) ||
			(is_single() && $options['posts_vol_header_top'] == 0) ||
			(is_page() && ! is_front_page() && $options['pages_vol_header_top'] == 0) ||
			(is_archive() && $options['archive_vol_header_top'] == 0) ||
			(is_search() && $options['search_vol_header_top'] == 0) ||
			(is_404() && $options['404_vol_header_top'] == 0)) {
				vol_header_top();
		}
		do_action('vol_header_top');
	}
}
function vol_header_bottom_output() { 
	global $options; 
	if ($options['switch_vol_header_bottom'] == 0 && ! is_page_template('custom-landing.php')) {
		if 	((is_home() && is_front_page() && $options['home_vol_header_bottom'] == 0 && $options['front_vol_header_bottom'] == 0) ||
			(is_home() && ! is_front_page() && $options['home_vol_header_bottom'] == 0) ||
			(is_front_page() && ! is_home() && $options['front_vol_header_bottom'] == 0) ||
			(is_single() && $options['posts_vol_header_bottom'] == 0) ||
			(is_page() && ! is_front_page() && $options['pages_vol_header_bottom'] == 0) ||
			(is_archive() && $options['archive_vol_header_bottom'] == 0) ||
			(is_search() && $options['search_vol_header_bottom'] == 0) ||
			(is_404() && $options['404_vol_header_bottom'] == 0)) {
				vol_header_bottom();
		}
		do_action('vol_header_bottom');
	}
}
function vol_header_after_title_tagline_output() {
	global $options; 
	if ($options['switch_vol_header_after_title_tagline'] == 0 && ! is_page_template('custom-landing.php')) {
		if 	((is_home() && is_front_page() && $options['home_vol_header_after_title_tagline'] == 0 && $options['front_vol_header_after_title_tagline'] == 0) ||
			(is_home() && ! is_front_page() && $options['home_vol_header_after_title_tagline'] == 0) ||
			(is_front_page() && ! is_home() && $options['front_vol_header_after_title_tagline'] == 0) ||
			(is_single() && $options['posts_vol_header_after_title_tagline'] == 0) ||
			(is_page() && ! is_front_page() && $options['pages_vol_header_after_title_tagline'] == 0) ||
			(is_archive() && $options['archive_vol_header_after_title_tagline'] == 0) ||
			(is_search() && $options['search_vol_header_after_title_tagline'] == 0) ||
			(is_404() && $options['404_vol_header_after_title_tagline'] == 0)) {
				vol_header_after_title_tagline();
		}
		do_action('vol_header_after_title_tagline');
	}
}
function vol_footer_top_output() { 
	global $options;
	if ($options['switch_vol_footer_top'] == 0 && ! is_page_template('custom-landing.php')) {
		if 	((is_home() && is_front_page() && $options['home_vol_footer_top'] == 0 && $options['front_vol_footer_top'] == 0) ||
			(is_home() && ! is_front_page() && $options['home_vol_footer_top'] == 0) ||
			(is_front_page() && ! is_home() && $options['front_vol_footer_top'] == 0) ||
			(is_single() && $options['posts_vol_footer_top'] == 0) ||
			(is_page() && ! is_front_page() && $options['pages_vol_footer_top'] == 0) ||
			(is_archive() && $options['archive_vol_footer_top'] == 0) ||
			(is_search() && $options['search_vol_footer_top'] == 0) ||
			(is_404() && $options['404_vol_footer_top'] == 0)) {
				vol_footer_top();
		}
		do_action('vol_footer_top');
	}
}
function vol_footer_bottom_output() { 
	global $options;
	if ($options['switch_vol_footer_bottom'] == 0 && ! is_page_template('custom-landing.php')) {
		if 	((is_home() && is_front_page() && $options['home_vol_footer_bottom'] == 0 && $options['front_vol_footer_bottom'] == 0) ||
			(is_home() && ! is_front_page() && $options['home_vol_footer_bottom'] == 0) ||
			(is_front_page() && ! is_home() && $options['front_vol_footer_bottom'] == 0) ||
			(is_single() && $options['posts_vol_footer_bottom'] == 0) ||
			(is_page() && ! is_front_page() && $options['pages_vol_footer_bottom'] == 0) ||
			(is_archive() && $options['archive_vol_footer_bottom'] == 0) ||
			(is_search() && $options['search_vol_footer_bottom'] == 0) ||
			(is_404() && $options['404_vol_footer_bottom'] == 0)) {
				vol_footer_bottom();
		}
		do_action('vol_footer_bottom');
	}
}
function vol_site_info_output() { 
	global $options;
	if ($options['switch_vol_site_info'] == 0) {
		if 	((is_home() && is_front_page() && $options['home_vol_site_info'] == 0 && $options['front_vol_site_info'] == 0) ||
			(is_home() && ! is_front_page() && $options['home_vol_site_info'] == 0) ||
			(is_front_page() && ! is_home() && $options['front_vol_site_info'] == 0) ||
			(is_single() && $options['posts_vol_site_info'] == 0) ||
			(is_page() && ! is_front_page() && $options['pages_vol_site_info'] == 0) ||
			(is_archive() && $options['archive_vol_site_info'] == 0) ||
			(is_search() && $options['search_vol_site_info'] == 0) ||
			(is_404() && $options['404_vol_site_info'] == 0)) {
				vol_site_info();
		}
		do_action('vol_site_info');
	}
}
function vol_headliner_output() { 
	global $options;
	if ($options['switch_vol_headliner'] == 0 && ! is_page_template('custom-landing.php') && ! is_page_template('custom-layout.php')) {
		if 	((is_home() && is_front_page() && $options['home_vol_headliner'] == 0 && $options['front_vol_headliner'] == 0) ||
			(is_home() && ! is_front_page() && $options['home_vol_headliner'] == 0) ||
			(is_front_page() && ! is_home() && $options['front_vol_headliner'] == 0) ||
			(is_single() && $options['posts_vol_headliner'] == 0) ||
			(is_page() && ! is_front_page() && $options['pages_vol_headliner'] == 0) ||
			(is_archive() && $options['archive_vol_headliner'] == 0) ||
			(is_search() && $options['search_vol_headliner'] == 0) ||
			(is_404() && $options['404_vol_headliner'] == 0)) {
				vol_headliner();
		}
		do_action('vol_headliner');
	}
}
function vol_footliner_output() {
	global $options;
	if ($options['switch_vol_footliner'] == 0 && ! is_page_template('custom-landing.php') && ! is_page_template('custom-layout.php')) {
		if 	((is_home() && is_front_page() && $options['home_vol_footliner'] == 0 && $options['front_vol_footliner'] == 0) ||
			(is_home() && ! is_front_page() && $options['home_vol_footliner'] == 0) ||
			(is_front_page() && ! is_home() && $options['front_vol_footliner'] == 0) ||
			(is_single() && $options['posts_vol_footliner'] == 0) ||
			(is_page() && ! is_front_page() && $options['pages_vol_footliner'] == 0) ||
			(is_archive() && $options['archive_vol_footliner'] == 0) ||
			(is_search() && $options['search_vol_footliner'] == 0) ||
			(is_404() && $options['404_vol_footliner'] == 0)) {
				vol_footliner();
		}
		do_action('vol_footliner');
	}
}
function vol_before_content_area_output() {
	$options = get_option('vol_hooks_options');
	$options_structure = get_option('vol_structure_options');
	if ($options['switch_vol_before_content_area'] == 0 && ! is_page_template('custom-landing.php') && $options_structure['wide'] == 1) {
		if 	((is_home() && is_front_page() && $options['home_vol_before_content_area'] == 0 && $options['front_vol_before_content_area'] == 0) ||
			(is_home() && ! is_front_page() && $options['home_vol_before_content_area'] == 0) ||
			(is_front_page() && ! is_home() && $options['front_vol_before_content_area'] == 0) ||
			(is_single() && $options['posts_vol_before_content_area'] == 0) ||
			(is_page() && ! is_front_page() && $options['pages_vol_before_content_area'] == 0) ||
			(is_archive() && $options['archive_vol_before_content_area'] == 0) ||
			(is_search() && $options['search_vol_before_content_area'] == 0) ||
			(is_404() && $options['404_vol_before_content_area'] == 0)) {
				vol_before_content_area();
		}
		do_action('vol_before_content_area');
	}
}
function vol_after_content_area_output() { 
	$options = get_option('vol_hooks_options');
	$options_structure = get_option('vol_structure_options');
	if ($options['switch_vol_after_content_area'] == 0 && ! is_page_template('custom-landing.php') && $options_structure['wide'] == 1) {
		if 	((is_home() && is_front_page() && $options['home_vol_after_content_area'] == 0 && $options['front_vol_after_content_area'] == 0) ||
			(is_home() && ! is_front_page() && $options['home_vol_after_content_area'] == 0) ||
			(is_front_page() && ! is_home() && $options['front_vol_after_content_area'] == 0) ||
			(is_single() && $options['posts_vol_after_content_area'] == 0) ||
			(is_page() && ! is_front_page() && $options['pages_vol_after_content_area'] == 0) ||
			(is_archive() && $options['archive_vol_after_content_area'] == 0) ||
			(is_search() && $options['search_vol_after_content_area'] == 0) ||
			(is_404() && $options['404_vol_after_content_area'] == 0)) {
				vol_after_content_area();
		}
		do_action('vol_after_content_area');
	}
}
function vol_before_content_output() { 
	$options = get_option('vol_hooks_options');
	$options_structure = get_option('vol_structure_options');
	if ($options['switch_vol_before_content'] == 0 && ! is_page_template('custom-landing.php') && $options_structure['wide'] == 0) {
		if 	((is_home() && is_front_page() && $options['home_vol_before_content'] == 0 && $options['front_vol_before_content'] == 0) ||
			(is_home() && ! is_front_page() && $options['home_vol_before_content'] == 0) ||
			(is_front_page() && ! is_home() && $options['front_vol_before_content'] == 0) ||
			(is_single() && $options['posts_vol_before_content'] == 0) ||
			(is_page() && ! is_front_page() && $options['pages_vol_before_content'] == 0) ||
			(is_archive() && $options['archive_vol_before_content'] == 0) ||
			(is_search() && $options['search_vol_before_content'] == 0) ||
			(is_404() && $options['404_vol_before_content'] == 0)) {
				vol_before_content();
		}
		do_action('vol_before_content');
	}
}
function vol_after_content_output() { 
	$options = get_option('vol_hooks_options');
	$options_structure = get_option('vol_structure_options');
	if ($options['switch_vol_after_content'] == 0 && ! is_page_template('custom-landing.php') && $options_structure['wide'] == 0) {
		if 	((is_home() && is_front_page() && $options['home_vol_after_content'] == 0 && $options['front_vol_after_content'] == 0) ||
			(is_home() && ! is_front_page() && $options['home_vol_after_content'] == 0) ||
			(is_front_page() && ! is_home() && $options['front_vol_after_content'] == 0) ||
			(is_single() && $options['posts_vol_after_content'] == 0) ||
			(is_page() && ! is_front_page() && $options['pages_vol_after_content'] == 0) ||
			(is_archive() && $options['archive_vol_after_content'] == 0) ||
			(is_search() && $options['search_vol_after_content'] == 0) ||
			(is_404() && $options['404_vol_after_content'] == 0)) {
				vol_after_content();
		}
		do_action('vol_after_content');
	}
}
function vol_before_content_column_home_output() { 
	global $options;
	if ($options['switch_vol_before_content_column'] == 0) {
		if ($options['home_vol_before_content_column'] == 0) {
			vol_before_content_column();
		}
		do_action('vol_before_content_column');
	}
}
function vol_before_content_column_posts_output() { 
	global $options;
	if ($options['switch_vol_before_content_column'] == 0) {
		if ($options['posts_vol_before_content_column'] == 0) {
			vol_before_content_column();
		}
		do_action('vol_before_content_column');
	}
}
function vol_before_content_column_archive_output() { 
	global $options;
	if ($options['switch_vol_before_content_column'] == 0) {
		if ($options['archive_vol_before_content_column'] == 0) {
			vol_before_content_column();
		}
		do_action('vol_before_content_column');
	}
}
function vol_after_content_column_home_output() { 
	global $options;
	if ($options['switch_vol_after_content_column'] == 0) {
		if ($options['home_vol_after_content_column'] == 0) {
			vol_after_content_column();
		}
		do_action('vol_after_content_column');
	}
}
function vol_after_content_column_post_output() { 
	global $options;
	if ($options['switch_vol_after_content_column'] == 0) {
		if ($options['posts_vol_after_content_column'] == 0) {
			vol_after_content_column();
		}
		do_action('vol_after_content_column');
	}
}
function vol_after_content_column_archive_output() { 
	global $options;
	if ($options['switch_vol_after_content_column'] == 0) {
		if ($options['archive_vol_after_content_column'] == 0) {
			vol_after_content_column();
		}
		do_action('vol_after_content_column');
	}
}
function vol_before_article_header_main_output() {
	$options_hooks = get_option('vol_hooks_options');
	if ($options_hooks['switch_vol_before_article_header'] == 0) {
		if ((is_home() && is_front_page() && $options_hooks['home_vol_before_article_header'] == 0 && $options_hooks['front_vol_before_article_header'] == 0) || (is_home() && ! is_front_page() && $options_hooks['home_vol_before_article_header'] == 0) || (is_front_page() && ! is_home() && $options_hooks['front_vol_before_article_header'] == 0)) {
			vol_before_article_header();
		}
		do_action('vol_before_article_header');
	}
}
function vol_before_article_header_posts_output() {
	global $options;
	$options = get_option('vol_hooks_options');
	if ($options['switch_vol_before_article_header'] == 0) {
		if ($options['posts_vol_before_article_header'] == 0) {
			vol_before_article_header();
		}
		do_action('vol_before_article_header');
	}
}
function vol_after_article_header_main_output() {
	$options_hooks = get_option('vol_hooks_options');
	if ($options_hooks['switch_vol_after_article_header'] == 0) {
		if ((is_home() && is_front_page() && $options_hooks['home_vol_after_article_header'] == 0 && $options_hooks['front_vol_after_article_header'] == 0) || (is_home() && ! is_front_page() && $options_hooks['home_vol_after_article_header'] == 0) || (is_front_page() && ! is_home() && $options_hooks['front_vol_after_article_header'] == 0)) {
			vol_after_article_header();
		}
		do_action('vol_after_article_header');
	}
}
function vol_after_article_header_posts_output() {
	global $options;
	$options = get_option('vol_hooks_options');
	if ($options['switch_vol_after_article_header'] == 0) {
		if ($options['posts_vol_after_article_header'] == 0) {
			vol_after_article_header();
		}
		do_action('vol_after_article_header');
	}
}
function vol_last_byline_item_output() {
	global $options_hooks;
	if ($options_hooks['switch_vol_last_byline_item'] == 0) {
		if	((is_single() && $options_hooks['posts_vol_last_byline_item'] == 0) ||
			(is_home() && $options_hooks['home_vol_last_byline_item'] == 0) ||
			(is_archive() && $options_hooks['archive_vol_last_byline_item'] == 0) ||
			(is_search() && $options_hooks['search_vol_last_byline_item'] == 0)) {
				vol_last_byline_item();
		}
		do_action('vol_last_byline_item');
	}
}
function vol_post_footer_output() { 
	global $options;
	if ($options['switch_vol_post_footer'] == 0) {
		if ($options['posts_vol_post_footer'] == 0) {
			vol_post_footer();
		}
		do_action('vol_post_footer');
	}
}
function vol_before_sidebar_1_output() { 
	global $options_hooks;
	if ($options_hooks['switch_vol_before_sidebar_1'] == 0) {
		if 	((is_home() && is_front_page() && $options_hooks['home_vol_before_sidebar_1'] == 0 && $options_hooks['front_vol_before_sidebar_1'] == 0) ||
			(is_home() && ! is_front_page() && $options_hooks['home_vol_before_sidebar_1'] == 0) ||
			(is_front_page() && ! is_home() && $options_hooks['front_vol_before_sidebar_1'] == 0) ||
			(is_single() && $options_hooks['posts_vol_before_sidebar_1'] == 0) ||
			(is_page() && ! is_front_page() && $options_hooks['pages_vol_before_sidebar_1'] == 0) ||
			(is_archive() && $options_hooks['archive_vol_before_sidebar_1'] == 0) ||
			(is_search() && $options_hooks['search_vol_before_sidebar_1'] == 0) ||
			(is_404() && $options_hooks['404_vol_before_sidebar_1'] == 0)) {
				vol_before_sidebar_1();
		}
		do_action('vol_before_sidebar_1');
	}
}
function vol_after_sidebar_1_output() { 
	global $options_hooks;
	if ($options_hooks['switch_vol_after_sidebar_1'] == 0) {
		if 	((is_home() && is_front_page() && $options_hooks['home_vol_after_sidebar_1'] == 0 && $options_hooks['front_vol_after_sidebar_1'] == 0) ||
			(is_home() && ! is_front_page() && $options_hooks['home_vol_after_sidebar_1'] == 0) ||
			(is_front_page() && ! is_home() && $options_hooks['front_vol_after_sidebar_1'] == 0) ||
			(is_single() && $options_hooks['posts_vol_after_sidebar_1'] == 0) ||
			(is_page() && ! is_front_page() && $options_hooks['pages_vol_after_sidebar_1'] == 0) ||
			(is_archive() && $options_hooks['archive_vol_after_sidebar_1'] == 0) ||
			(is_search() && $options_hooks['search_vol_after_sidebar_1'] == 0) ||
			(is_404() && $options_hooks['404_vol_after_sidebar_1'] == 0)) {
				vol_after_sidebar_1();
		}
		do_action('vol_after_sidebar_1');
	}
}
function vol_before_sidebar_2_output() { 
	global $options_hooks;
	if ($options_hooks['switch_vol_before_sidebar_2'] == 0) {
		if 	((is_home() && is_front_page() && $options_hooks['home_vol_before_sidebar_2'] == 0 && $options_hooks['front_vol_before_sidebar_2'] == 0) ||
			(is_home() && ! is_front_page() && $options_hooks['home_vol_before_sidebar_2'] == 0) ||
			(is_front_page() && ! is_home() && $options_hooks['front_vol_before_sidebar_2'] == 0) ||
			(is_single() && $options_hooks['posts_vol_before_sidebar_2'] == 0) ||
			(is_page() && ! is_front_page() && $options_hooks['pages_vol_before_sidebar_2'] == 0) ||
			(is_archive() && $options_hooks['archive_vol_before_sidebar_2'] == 0) ||
			(is_search() && $options_hooks['search_vol_before_sidebar_2'] == 0) ||
			(is_404() && $options_hooks['404_vol_before_sidebar_2'] == 0)) {
				vol_before_sidebar_2();
		}
		do_action('vol_before_sidebar_2');
	}
}
function vol_after_sidebar_2_output() { 
	global $options_hooks;
	if ($options_hooks['switch_vol_after_sidebar_2'] == 0) {
		if 	((is_home() && is_front_page() && $options_hooks['home_vol_after_sidebar_2'] == 0 && $options_hooks['front_vol_after_sidebar_2'] == 0) ||
			(is_home() && ! is_front_page() && $options_hooks['home_vol_after_sidebar_2'] == 0) ||
			(is_front_page() && ! is_home() && $options_hooks['front_vol_after_sidebar_2'] == 0) ||
			(is_single() && $options_hooks['posts_vol_after_sidebar_2'] == 0) ||
			(is_page() && ! is_front_page() && $options_hooks['pages_vol_after_sidebar_2'] == 0) ||
			(is_archive() && $options_hooks['archive_vol_after_sidebar_2'] == 0) ||
			(is_search() && $options_hooks['search_vol_after_sidebar_2'] == 0) ||
			(is_404() && $options_hooks['404_vol_after_sidebar_2'] == 0)) {
				vol_after_sidebar_2();
		}
		do_action('vol_after_sidebar_2');
	}
}