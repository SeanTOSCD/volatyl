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
		$byline_text = apply_filters('byline_text', array(
			'publish_date'		=> __('Published on', 'volatyl'),	
			'author_text'		=> __('by', 'volatyl'),		
			'comments_dash'		=> '&ndash;',	
			'comments_off'		=> __('Comments off', 'volatyl'),	
			'category_text'		=> __('Filed under:', 'volatyl')
			) 
		);
		
		$byline_top_items	=	$options_content['by-date-post']		== 1 ||
								$options_content['by-author-post']		== 1 ||
								$options_content['by-comments-post']	== 1 ||
								$options_content['by-edit-post']		== 1;
		$byline_categories	=	$options_content['by-cats'] == 1;
		
		if ($byline_top_items) echo '<div class="meta-top">';	

		// Show post date
		if ($options_content['by-date-post'] == 1) { ?>
			<span class="posted-on">
				<?php echo $byline_text['publish_date']; ?>
			</span>
			<span class="meta-date">
				<a href="<?php echo esc_url(the_permalink()); ?>" title="<?php esc_attr_e(__('Permalink - ', 'volatyl')); _e(the_title_attribute('echo=0')); ?>" rel="bookmark"><?php the_time(get_option('date_format')); ?></a>
			</span>
			<?php
		}
	
		// Show post author
		if ($options_content['by-author-post'] == 1) { ?>
			<span class="post-by">
				<?php echo $byline_text['author_text']; ?>
			</span>
			<span class="meta-author">
				<a class="fn" href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" title="<?php esc_attr_e(get_the_author()); ?>"><?php echo the_author_meta('display_name'); ?></a>
			</span>
			<?php
		}
	
		// Show post comment count
		if ($options_content['by-comments-post'] == 1) {
	
			// Only show dash before comments if byline items are in front of it
			if ($options_content['by-date-post'] == 0 && $options_content['by-author-post'] == 0) { ?>
				<span class="meta-comments">
				<?php
			} else { ?>
				<span class="comments-dash">
					<?php echo $byline_text['comments_dash']; ?>
				</span> <span class="meta-comments">
				<?php
			}
			
			// Only mark comments as closed in byline of comment count is 0	
			$response_count = get_comments_number();
			$comment_count = vol_comments_only_count($count);
			
			if (!comments_open() && $response_count == 0) {
		
				// No need to show a count if comments are off and there are none!
				$comments = $byline_text['comments_off'] . ' ';
			} else {
			
				/** Return "response" count with or without pings! ;)
				 *
				 * If pings are disabled, only "comments" will show
				 * See the functions/content.php file for more information
				 */
				if ($options_content['postpings'] == 1) { 
		
					// Get the total number of comments and pings
					$num_comments = get_comments_number();
					if ($num_comments == 0) {
						$comments = __('0 Responses ', 'volatyl');
					} elseif ($num_comments > 1) {
						$comments = $num_comments . __(' Responses ', 'volatyl');
					} else {
						$comments = __('1 Response ', 'volatyl');
					}
				} else {
		
					// Only get the comments... no pings
					$num_comments = vol_comments_only_count($count);
					if ($num_comments == 0) {
						$comments = __('0 Comments ', 'volatyl');
					} elseif ($num_comments > 1) {
						$comments = $num_comments . __(' Comments ', 'volatyl');
					} else {
						$comments = __('1 Comment ', 'volatyl');
					}
				}
			} 
			echo $comments . '</span>';
		}

		// vol_last_byline_item hook
		vol_last_byline_item_output();
	
		// Show post edit link
		if ($options_content['by-edit-post'] == 1) {
			edit_post_link(__('Edit', 'volatyl'), '<span class="edit-link"> ', '</span> ');
		}
		
		if ($byline_top_items) echo '</div>'; // end .meta-top		
		
		if ($byline_categories) echo '<div class="meta-bottom">';
	
			// Show post categories
			if ($options_content['by-cats'] == 1) { ?>
				<span class="cat-title"><?php echo $byline_text['category_text']; ?></span>
				 <span class="meta-category">
				 	<?php the_category(', '); ?>
				</span>
				<?php
			}
		
		if ($byline_categories) echo '</div>'; // end .meta-bottom
	}
}