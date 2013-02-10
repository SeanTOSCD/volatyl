<?php
/** functions.php
 *
 ***** THIS IS A CORE VOLATYL FILE AND SHOULD NOT BE EDITED!
 ***** ALL CUSTOM CODING SHOULD BE DONE IN A CHILD THEME.
 ***** MORE INFORMATION - http://volatylthemes.com/why-child-themes/
 *******************************************************************
 *
 * This file calls directly to another file that has what you're 
 * used to seeing in a functions.php file. Based on the way a child 
 * theme's functions.php file is ran BEFORE the parent theme's
 * functions.php file, we'll place everything in a separate file
 * so that the child theme's functions.php has the opportunity to
 * "require_once" that file directly before this file can.
 *
 * That simplifies the process for using custom functions in the
 * child theme's functions.php to overwrite parent theme functions. 
 *
 * Child themes MUST write the following line first in order for 
 * this system to work properly:
 *
 ***** require_once( get_template_directory() . '/inc/init-functions.php' );
 *
 * When that line is called in the child theme's functions.php file,
 * it will grab those initial theme functions itself and totally ignore
 * the call to the same file you see below. Outstanding.
 *
 * @package Volatyl
 * @since Volatyl 1.0
 */

// We need this! Only if a child theme hasn't gotten to it first
require_once( dirname( __FILE__ ) . '/inc/init-functions.php' );

// License key setup and Volatyl automatic updater
require_once( dirname( __FILE__ ) . '/inc/updater.php' );

function change_pagination_text( $content ) {
	$search = array( 
		'Page', 
		'of', 
		'&laquo;', 
		'&lsaquo;', 
		'&rsaquo;', 
		'&raquo;' );
	$replace = array( 
		'Article', 
		'out of', 
		'First', 
		'Previous', 
		'Next', 
		'Last' 
	);
	$content = str_replace( $search, $replace, $content );
	return $content;
}
add_filter( 'pagination_text', 'change_pagination_text' );

function change_post_navigation_text( $content ) {
	$search = array( 
		'Previous Article:', 
		'Next Article:', 
		'&larr; Older posts', 
		'Newer posts &rarr;' 
	);
	$replace = array( 
		'Last Post', 
		'Next Post', 
		'&larr; Older articles', 
		'Newer articles &rarr;' 
	);
	$content = str_replace( $search, $replace, $content );
	return $content;
}
add_filter( 'post_navigation', 'change_post_navigation_text' );

function attachment_navigation_text( $content ) {
	$search = array( 
		'&larr; Previous', 
		'Next &rarr;' 
	);
	$replace = array( 
		'Previous attachment', 
		'Next attachment' 
	);
	$content = str_replace( $search, $replace, $content );
	return $content;
}
add_filter( 'attachment_navigation', 'attachment_navigation_text' );

function custom_byline_text( $content ) {
	$search = array( 
		'on ', 
		'by ', 
		'Comments off ', 
		'Filed under: ', 
		'&nbsp;' 
	);
	$replace = array( 
		'published ', 
		'author ', 
		'Comments disabled ', 
		'Categories: ', 
		'- Custom byline item' 
	);
	$content = str_replace( $search, $replace, $content );
	return $content;
}
add_filter( 'byline_text', 'custom_byline_text' );

function custom_comments_text( $content ) {
	$search = array( 
		'Comments are closed.', 
		'&larr; Older Comments', 
		'Newer Comments &rarr;', 
		'Leave a Reply', 
		'Submit Comment' 
	);
	$replace = array( 
		'Sorry. Comments are disabled for this post.', 
		'Old Comments', 
		'New comments', 
		'Reply', 
		'Submit' 
	);
	$content = str_replace( $search, $replace, $content );
	return $content;
}
add_filter( 'comments_text', 'custom_comments_text' );

function custom_search_form( $content ) {
	$search = array( 
		'Enter Keyword(s)&hellip;', 
		'Search' 
	);
	$replace = array( 
		'Ex. basket weaving', 
		'Submit Query' 
	);
	$content = str_replace( $search, $replace, $content );
	return $content;
}
add_filter( 'search_text', 'custom_search_form' );

function custom_archive_title( $content ) {
	$search = array( 
		'Category Archives:',
		'Tag Archives:',
		'Author Archives:',
		'Daily Archives:',
		'Monthly Archives:',
		'Yearly Archives:'
	);
	$replace = array( 
		'Category:',
		'Tag:',
		'Author:',
		'Daily:',
		'Monthly:',
		'Yearly:'
	);
	$content = str_replace( $search, $replace, $content );
	return $content;
}
add_filter( 'archive_title', 'custom_archive_title' );

function custom_menu_toggle( $content ) {
	$search = array( 
		'<span class="header-open">Menu</span>',
		'<span class="header-close">Hide Menu</span>',
		'<span class="standard-open">Navigation</span>',
		'<span class="standard-close">Hide Navigation</span>',
		'<span class="footer-open">Navigation</span>',
		'<span class="footer-close">Hide Navigation</span>'
	);
	$replace = array( 
		'Menu',
		'Hide Menu',
		'Navigation',
		'Hide Navigation',
		'Navigation',
		'Hide Navigation'
	);
	$content = str_replace( $search, $replace, $content );
	return $content;
}
add_filter( 'menu_toggle', 'custom_menu_toggle' );