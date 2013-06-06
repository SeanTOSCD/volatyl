<?php
/** structure.php
 *
 ***** THIS IS A CORE VOLATYL FILE AND SHOULD NOT BE EDITED!
 ***** ALL CUSTOM CODING SHOULD BE DONE IN A CHILD THEME.
 ***** MORE INFORMATION - http://volatylthemes.com/why-child-themes/
 *******************************************************************
 *
 * This is where things get complicated. Volatyl has many different
 * layout options. Therefore, the site structure has to be modularized
 * in order to have control access to various sections of the HTML
 * structure from different parts of the framework.
 *
 * Here, there's a simple call to the header.php and footer.php files.
 * in between those, vol_html_before_content() and vol_html_after_content() 
 * are called from the /inc/html/around-content.php file covering everything 
 * above and below the main site content.
 *
 * Between those functions is where the control is needed. do_action() is
 * used to render the site layout based on conditions. "main_content" is
 * the default layout while "main_content_singular" controls posts, pages,
 * and attachment files. "main_content_custom_layout" is a blank canvas
 * used for custom templates. More conditions can be added to accomodate more
 * layout options!
 * 
 * @package Volatyl
 * @since Volatyl 1.0
 */

function volatyl() {  
	global $post;
	
	get_header();
	vol_html_before_content();
	if (is_page_template('custom-layout.php'))
	
		// Activated when the "Custom Layout" Template is used on a Page
		do_action('main_content_custom_layout');
	elseif (is_singular())
		
		// Set by the post meta layout selector on Pages and Posts
		do_action('main_content_singular');
	else
		
		// Used as the site's default layout set in the Structure Options
		do_action('main_content');
	vol_html_after_content();
	get_footer();
}