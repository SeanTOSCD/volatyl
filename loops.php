<?php
/** loops.php
 *
 ***** THIS IS A CORE VOLATYL FILE AND SHOULD NOT BE EDITED!
 ***** ALL CUSTOM CODING SHOULD BE DONE IN A CHILD THEME.
 ***** MORE INFORMATION - http://volatylthemes.com/why-child-themes/
 *******************************************************************
 *
 * Loops, and loops, and loops! This file is one big conditional that
 * handles the WordPress loop for:
 *
 * is_home()
 * is_single()
 * is_page()
 * is_search()
 * is_archive()
 * is_attachment()
 *
 * These loops call to respective template files for Volatyl. If no loop
 * is present in this file, the loops are located in the template files.
 * 
 * Certain templates can be overwritten by simply creating the actual
 * template file responsible for that particular template. For example,
 * creating a content-single.php file in a child theme (or in the core... 
 * but don't) will override the get_template_part('templates/content', 'single') 
 * function in the is_single() condition of this statement.
 *
 * @package Volatyl
 * @since Volatyl 1.0
 */

function vol_content() {
	global $options;
	
	echo "<div id=\"content\" class=\"site-content border-box clearfix\">";
	
	if (have_posts()) {

		// Blog home
		if (is_home()) {

			// vol_before_content_column
			(($options['switch_vol_before_content_column'] == 0) ?
				(($options['home_vol_before_content_column'] == 0) ?
					vol_before_content_column() : 
					do_action('vol_before_content_column')) : 
			'');
		
			// Da loop
			while (have_posts()) { 
				the_post();
				get_template_part('templates/content');
			}
			
			vol_pagination_type(); // /inc/functions/page-nav.php
			
			// vol_after_content_column
			(($options['switch_vol_after_content_column'] == 0) ?
				(($options['home_vol_after_content_column'] == 0) ?
					vol_after_content_column() :
					do_action('vol_after_content_column')) :
			'');
	
		// Single posts
		} elseif (is_single() && !is_attachment()) { 

			// vol_before_content_column
			(($options['switch_vol_before_content_column'] == 0) ?
				(($options['posts_vol_before_content_column'] == 0) ?
					vol_before_content_column() :
					do_action('vol_before_content_column')) :
			'');
			
			$postformat = (get_post_format() ? get_post_format() : 'single');
		
			// Da loop
			while (have_posts()) { 
				the_post();
				get_template_part('templates/content', $postformat);
			}

			// vol_after_content_column
			(($options['switch_vol_after_content_column'] == 0) ?
				(($options['posts_vol_after_content_column'] == 0) ?
					vol_after_content_column() :
					do_action('vol_after_content_column')) :
			'');
			
		// Pages
		} elseif (is_page()) {
	
			// Da loop
			while (have_posts()) {
				the_post();
				get_template_part('templates/content', 'page');
			}
	
		// Search results
		} elseif (is_search()) {
			
			get_template_part('templates/content', 'search');

		// Archives including categories, tags, authors, dates, and bears. Oh my!
		} elseif (is_archive()) {
			$options_hooks = get_option('vol_hooks_options');

			// vol_before_content_column
			(($options['switch_vol_before_content_column'] == 0) ?
				(($options['archive_vol_before_content_column'] == 0) ?
					vol_before_content_column() :
					do_action('vol_before_content_column')) :
			'');
				
			get_template_part('templates/content', 'archive');

			// vol_after_content_column
			(($options_hooks['switch_vol_after_content_column'] == 0) ?
				((is_archive() && $options_hooks['archive_vol_after_content_column'] == 0) ?
					vol_after_content_column() :
					do_action('vol_after_content_column')) :
			'');
	
		// Attachment pages
		} elseif (is_attachment()) {
		
			// Da loop
			while (have_posts()) {
				the_post();
				get_template_part('templates/content', 'attachment');
			}
	
		// 404 error page
		} elseif (is_404()) {
		
			// Da loop
			while (have_posts()) {
				the_post();
				get_template_part('templates/404', 'index');
			}
	
		// Stray template (can that even happen?) floating around? I got this.
		} else {
		
			// Da loop
			while (have_posts()) {
				the_post();
				get_template_part('templates/content', get_post_format());
			}
		}	
	} else {
		get_template_part('templates/no-results', 'index');
	}
	echo "</div>";
}