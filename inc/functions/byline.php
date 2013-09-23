<?php
/** byline.php
 *
 ***** THIS IS A CORE VOLATYL FILE AND SHOULD NOT BE EDITED!
 ***** ALL CUSTOM CODING SHOULD BE DONE IN A CHILD THEME.
 ***** MORE INFORMATION - http://volatylthemes.com/why-child-themes/
 *******************************************************************
 *
 * So many byline (meta data) options! 
 *
 * @package Volatyl
 * @since Volatyl 1.0
 */

/** Single Post Byline
 *
 * Each element in a post byline can be controlled in the Volatyl
 * Options. Each of them has a switch to display or hide them.
 *
 * @since Volatyl 1.0
 */
if (!function_exists('volatyl_post_meta')) {
	function volatyl_post_meta() {
		global $count, $options_hooks;
		$options_content = get_option('vol_content_options');
		$options_hooks = get_option('vol_hooks_options');
		$post_format_type = ucfirst(get_post_format());
		$byline_text = apply_filters('byline_text', array(
			'post_format_type'	=> $post_format_type . '&#58;',	
			'publish_date'		=> 'Published on',	
			'author_text'		=> 'by',		
			'comments_dash'		=> '&ndash;',	
			'comments_off'		=> 'Comments off',	
			'category_text'		=> 'Filed under:'
			) 
		);
		
		$byline_top_items = $options_content['by-date-post'] == 1 || $options_content['by-author-post'] == 1 || $options_content['by-comments-post'] == 1 || $options_content['by-edit-post'] == 1;
		
		$byline_categories = $options_content['by-cats'] == 1;
		
		if ($byline_top_items) echo "<div class=\"meta-top\">";			

		// Show post format title
		(($options_content['by-post-format'] == 1) ?
			((get_post_format() != false) ?
				printf('<span class="post-format">' . __($byline_text['post_format_type'], 'volatyl') . '</span> ') : 
			'') : 
		'');

		// Show post date
		(($options_content['by-date-post'] == 1) ?
			printf('<span class="posted-on">' . __($byline_text['publish_date'], 'volatyl') . '</span> ' . 
			"<span class=\"meta-date\"><a href=\"") . the_permalink() . printf("\" title=\"") . esc_attr(printf(__('Permalink - ', 'volatyl'))) . _e(the_title_attribute('echo=0')) . printf("\" rel=\"bookmark\">") . 
			the_time(get_option('date_format')) .
			printf("</a></span> \n") :
		'');
	
		// Show post author
		(($options_content['by-author-post'] == 1) ? 
			printf('<span class="post-by">' . __($byline_text['author_text'], 'volatyl') . '</span> ' . 
			"<span class=\"meta-author\"><a class=\"fn\" href=\"" . get_author_posts_url(get_the_author_meta('ID')) . "\" title=\"") . esc_attr(get_the_author()) . printf('">') . the_author_meta('display_name') . printf("</a></span>") : 
		'');
	
		// Show post comment count
		if ($options_content['by-comments-post'] == 1) {
	
			// Only show dash before comments if byline items are in front of it
			(($options_content['by-date-post'] == 0 && $options_content['by-author-post'] == 0) ? "<span class=\"meta-comments\">" : printf(" <span class=\"comments-dash\">" . $byline_text['comments_dash'] . "</span> <span class=\"meta-comments\">"));
			
			// Only mark comments as closed in byline of comment count is 0	
			$response_count = get_comments_number();
			$comment_count = vol_comments_only_count($count);
			if (!comments_open() && $response_count == 0) {
		
				// No need to show a count if comments are off and there are none!
				$comments = __($byline_text['comments_off'] . ' ', 'volatyl');
			} else {
			
				/** Return "response" count with or without pings! ;)
				 *
				 * If pings are disabled, only "comments" will show
				 * See the functions/content.php file for more information
				 */
				if ($options_content['postpings'] == 1) { 
		
					// Get the total number of comments and pings
					$num_comments = get_comments_number();
					if ($num_comments == 0)
						$comments = __('0 Responses ', 'volatyl');
					elseif ($num_comments > 1)
						$comments = $num_comments . __(' Responses ', 'volatyl');
					else
						$comments = __('1 Response ', 'volatyl');
				} else {
		
					// Only get the comments... no pings
					$num_comments = vol_comments_only_count($count);
					if ($num_comments == 0)
						$comments = __('0 Comments ', 'volatyl');
					elseif ($num_comments > 1)
						$comments = $num_comments . __(' Comments ', 'volatyl');
					else
						$comments = __('1 Comment ', 'volatyl');
				}
			} 
			echo $comments . '</span>';
		}

		// vol_last_byline_item
		(($options_hooks['switch_vol_last_byline_item'] == 0) ?
			((is_single() && $options_hooks['posts_vol_last_byline_item'] == 0) ||
			(is_home() && $options_hooks['home_vol_last_byline_item'] == 0) ||
			(is_archive() && $options_hooks['archive_vol_last_byline_item'] == 0) ||
			(is_search() && $options_hooks['search_vol_last_byline_item'] == 0)) ?
				vol_last_byline_item() :
				do_action('vol_last_byline_item') :
		'');
	
		// Show post edit link
		(($options_content['by-edit-post'] == 1) ? edit_post_link(__('Edit', 'volatyl'), '<span class="edit-link"> ', '</span> ') : '');
		
		if ($byline_top_items) echo "</div>";			
		
		if ($byline_categories) echo "<div class=\"meta-bottom\">";
	
		// Show post categories
		if ($options_content['by-cats'] == 1) {
	
			// Only place cats on new line if other byline items are removed
			echo '<span class="cat-title">' . __($byline_text['category_text'], 'volatyl') . '</span> <span class="meta-category">';
			the_category(', ');
			echo '</span>';
		}
		
		//
		if ($byline_categories) echo "</div>";	
	}
}