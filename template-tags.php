<?php
/** template-tags.php
 *
 ***** THIS IS A CORE VOLATYL FILE AND SHOULD NOT BE EDITED!
 ***** ALL CUSTOM CODING SHOULD BE DONE IN A CHILD THEME.
 ***** MORE INFORMATION - http://volatylthemes.com/why-child-themes/
 *******************************************************************
 *
 * Custom template tags
 *
 * @package Volatyl
 * @since Volatyl 1.0
 */

if (!function_exists('vol_comment')) {
	/**
	 * Template for comments and pingbacks.
	 *
	 * Used as a callback by wp_list_comments() for displaying the
	 * comments and pings.
	 *
	 * @since Volatyl 1.0
	 */
	function vol_comment($comment, $args, $depth) {
		global $tab3;
		$GLOBALS['comment'] = $comment;
		
		switch ($comment->comment_type) {
	
			// Pings format
			case 'pingback' :
			case 'trackback' :
				echo "<li class=\"post pingback\">",
				"\t<p>", __('Pingback: ', 'volatyl'), comment_author_link(), edit_comment_link(__('(Edit)', 'volatyl'), ' '), "</p>\n";
				break;
		
			// Comments format	
			default :
				echo "<li ", comment_class(), " id=\"li-comment-", comment_ID(), "\">\n
				\t<article id=\"comment-", comment_ID(), "\" class=\"comment\">\n
				\t\t<footer>\n
				{$tab3}<div class=\"comment-author vcard\">\n
				{$tab3}\t<div class=\"comment-avatar\">\n",
				get_avatar($comment, 50),
				"{$tab3}\t</div>\n
				{$tab3}</div>\n" .
				(($comment->comment_approved == '0') ? 
					sprintf("{$tab3}<em>") . __('Your comment is awaiting moderation.', 'volatyl') . sprintf("</em><br />\n") : 
				'') .
				"{$tab3}<div class=\"comment-meta commentmetadata\">\n{$tab3}\t" .
				sprintf('<cite class="fn">%s</cite>', get_comment_author_link()) .
				"\n{$tab3}\t<div class=\"comment-date\">\n
				{$tab3}\t\t<a href=\"", esc_url(get_comment_link($comment->comment_ID)), "\"><time pubdate datetime=\"", comment_time('c'), "\">";
			
				// translators: 1: date, 2: time
				printf(__('%1$s', 'volatyl'), get_comment_date());
				echo "</time></a>\n";
				edit_comment_link(__('(Edit)', 'volatyl'), ' ');
				echo "{$tab3}\t</div>",
				"{$tab3}</div>",
				"\t\t</footer>",
				"\t\t<div class=\"comment-content\">\n{$tab3}", 
				comment_text(),
				"\n\t\t</div>\n",
				"\t\t<div class=\"reply\">";
				comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth'])));
				echo "\t\t</div>",
				"\t</article>";
				break;
		}
	}
}


/**
 * Returns true if a blog has more than 1 category
 *
 * @since Volatyl 1.0
 */
function vol_categorized_blog() {
	if (false === ($all_the_cool_cats = get_transient('all_the_cool_cats'))) {
	
		// Create an array of all the categories that are attached to posts
		$all_the_cool_cats = get_categories(array(
			'hide_empty' => 1,
		));

		// Count the number of categories that are attached to the posts
		$all_the_cool_cats = count($all_the_cool_cats);
		set_transient('all_the_cool_cats', $all_the_cool_cats);
	}

	if ('1' != $all_the_cool_cats)
	
		// This blog has more than 1 category 
		// So vol_categorized_blog should return true
		return true;
	else
	
		// This blog has only 1 category
		// So vol_categorized_blog should return false
		return false;
}


/**
 * Flush out the transients used in vol_categorized_blog
 *
 * @since Volatyl 1.0
 */
function vol_category_transient_flusher() {

	// Like, beat it. Dig?
	delete_transient('all_the_cool_cats');
}
add_action('edit_category', 'vol_category_transient_flusher');
add_action('save_post', 'vol_category_transient_flusher');