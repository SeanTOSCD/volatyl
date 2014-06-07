<?php 
/** content.php
 *
 ***** THIS IS A CORE VOLATYL FILE AND SHOULD NOT BE EDITED!
 ***** ALL CUSTOM CODING SHOULD BE DONE IN A CHILD THEME.
 ***** MORE INFORMATION - http://volatylthemes.com/why-child-themes/
 *******************************************************************
 *
 * Various functions pertaining to site content and its options.
 *
 * @package Volatyl
 * @since Volatyl 1.0
 */

// Add .top class to the first post in a loop
function vol_first_post_class($classes) {
	global $wp_query;
	if (0 == $wp_query->current_post) {
		$classes[] = 'top';
	}
	return $classes;
}
add_filter('post_class', 'vol_first_post_class');


/** Separate comments and pings
 *
 * Comments are a collection of comments and pings (pingbacks and
 * trackbacks). When the number of comments is displayed, the sum
 * total includes all three types of comments.
 * 
 * In the comments.php file, the regular comments have been
 * separated from the pings for organizational purposes and to
 * allow users to hide pings while still displaying comments. So,
 * when pings are hidden, the comment count needs to reflect that.
 *
 * In the byline.php file, the vol_post_meta() function displays
 * the "response" count totaling all comments and pings. If pings are
 * turned off, "response" is replaced with "comment" and only comments
 * are shown. Below is the count of comments only.
 *
 * @since Volatyl 1.0
 */
function vol_comments_only_count($count) {

    // Filter the comments count in the front-end only
    if (!is_admin()) {
        global $id;
        $comments_by_type = &separate_comments(get_comments('status=approve&post_id=' . $id));
        return count($comments_by_type['comment']);
    }
    
    // When in the WP-admin back end, do NOT filter comments (and pings) count.
    else {
        return $count;
    }
}

// Show 'Pages' in search results? 
if (!vol_search_pages_on()) { 
	function vol_search_filter($query) {
		if ($query->is_search && !is_admin()) {
			$query->set('post_type', 'post');
		}
		return $query;
	}
	add_filter('pre_get_posts','vol_search_filter');
}

// Show excerpt/post link instead of [...]
if (vol_excerpt_link_on()) {

	// create a permalink after the excerpt
	function vol_replace_excerpt($content) {
		global $excerpt_link;
		$excerpt_link = apply_filters('excerpt_link', __('Read More', 'volatyl') . ' &rarr;');
		return str_replace('[&hellip;]',
			'<p class="excerpt-link"><a class="read-more" href="' . get_permalink() . '">' . $excerpt_link . '</a></p>',
			$content
		);
	}
	add_filter('get_the_excerpt', 'vol_replace_excerpt');
}

// Filters wp_title to print a neat <title> tag based on what is being viewed.
function vol_wp_title( $title, $sep ) {
	if (is_feed()) {
		return $title;
	}

	global $page, $paged;

	// Add the blog name
	$title .= get_bloginfo('name', 'display');

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo('description', 'display');
	if ($site_description && (is_home() || is_front_page())) {
		$title .= " $sep $site_description";
	}

	// Add a page number if necessary:
	if (($paged >= 2 || $page >= 2 ) && ! is_404()) {
		$title .= " $sep " . sprintf(__('Page %s', '_s'), max($paged, $page));
	}

	return $title;
}
add_filter('wp_title', 'vol_wp_title', 10, 2);