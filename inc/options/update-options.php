<?php
/** update-options.php
 *
 ***** THIS IS A CORE VOLATYL FILE AND SHOULD NOT BE EDITED!
 ***** ALL CUSTOM CODING SHOULD BE DONE IN A CHILD THEME.
 ***** MORE INFORMATION - http://volatylthemes.com/why-child-themes/
 *******************************************************************
 *
 * Move theme option values from old location to new location for
 * Volatyl 2.0. Only runs if the current theme version is older than
 * version 2.0.
 *
 * @package Volatyl
 * @since Volatyl 2.0
 */

function vol_update_options_script() {

	/**
	 * Move global settings to new locations
	 */
	$vol_structure = get_option( 'vol_structure_options' );
	set_theme_mod( 'volatyl_html_structure', $vol_structure['wide'] );
	set_theme_mod( 'volatyl_content_layout', $vol_structure['column'] );

	/**
	 * Move general settings to new locations
	 */
	$vol_general = get_option( 'vol_general_options' );
	set_theme_mod( 'volatyl_framework_updates', $vol_general['updates'] );
	set_theme_mod( 'volatyl_responsive_css', $vol_general['responsive'] );
	set_theme_mod( 'volatyl_toolbar', $vol_general['adminmenu'] );
	set_theme_mod( 'volatyl_attribution', $vol_general['attribution'] );

	/**
	 * Move content settings to new locations
	 */
	$vol_content = get_option( 'vol_content_options' );
	set_theme_mod( 'volatyl_logo', $vol_content['logo'] );
	set_theme_mod( 'volatyl_site_title', $vol_content['title'] );
	set_theme_mod( 'volatyl_site_tagline', $vol_content['tagline'] );
	set_theme_mod( 'volatyl_header_menu', $vol_content['headermenu'] );
	set_theme_mod( 'volatyl_standard_menu', $vol_content['standardmenu'] );
	set_theme_mod( 'volatyl_footer_menu', $vol_content['footermenu'] );
	set_theme_mod( 'volatyl_default_widgets', $vol_content['widgets'] );
	set_theme_mod( 'volatyl_enhanced_pagination', $vol_content['pagination'] );
	set_theme_mod( 'volatyl_byline_date', $vol_content['by-date-post'] );
	set_theme_mod( 'volatyl_byline_author', $vol_content['by-author-post'] );
	set_theme_mod( 'volatyl_byline_responses_comments', $vol_content['by-comments-post'] );
	set_theme_mod( 'volatyl_byline_edit_link', $vol_content['by-edit-post'] );
	set_theme_mod( 'volatyl_byline_categories', $vol_content['by-cats'] );
	set_theme_mod( 'volatyl_post_excerpts', $vol_content['homeexcerpt'] );
	set_theme_mod( 'volatyl_post_excerpt_link', $vol_content['excerptlink'] );
	set_theme_mod( 'volatyl_feed_featured_images', $vol_content['feedfeaturedimage'] );
	set_theme_mod( 'volatyl_post_featured_image', $vol_content['singlefeaturedimage'] );
	set_theme_mod( 'volatyl_feed_tags', $vol_content['feedtags'] );
	set_theme_mod( 'volatyl_post_tags', $vol_content['singletags'] );
	set_theme_mod( 'volatyl_pings', $vol_content['postpings'] );
	set_theme_mod( 'volatyl_page_comments', $vol_content['pagecomments'] );

	/**
	 * Delete the old options
	 */
	delete_option( 'vol_structure_options' );
	delete_option( 'vol_general_options' );
	delete_option( 'vol_content_options' );
}
add_action( 'after_setup_theme', 'vol_update_options_script' );