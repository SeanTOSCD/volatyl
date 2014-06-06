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
		$GLOBALS['comment'] = $comment;
		$avatar_size = apply_filters( 'avatar_size', 50 );
		
		switch ($comment->comment_type) {
	
			// Pings format
			case 'pingback' :
			case 'trackback' : ?>
				<li class="post pingback">
					<p><?php echo __('Pingback: ', 'volatyl'), comment_author_link(), edit_comment_link(__('(Edit)', 'volatyl'), ' '); ?></p>
					<?php 
					break;
		
			// Comments format	
			default : ?>
				<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
					<article id="comment-<?php comment_ID(); ?>" class="comment">
						<footer>
							<div class="comment-author vcard">
								<div class="comment-avatar">
									<?php echo get_avatar($comment, $avatar_size); ?>
								</div>
							</div>
							<?php
								if ($comment->comment_approved == '0') { ?>
									<em><?php _e('Your comment is awaiting moderation.', 'volatyl'); ?></em><br /> 
									<?php
								}
							?>
							<div class="comment-meta commentmetadata">
								<cite class="fn"><?php echo get_comment_author_link(); ?></cite>
								<div class="comment-date">
									<a href="<?php echo esc_url(get_comment_link($comment->comment_ID)); ?>">
										<time pubdate datetime="<?php comment_time('c'); ?>">
											<?php
												// translators: 1: date, 2: time
												echo get_comment_date();
											?>
										</time>
									</a>
									<?php edit_comment_link(__('(Edit)', 'volatyl'), ' '); ?>
								</div>
							</div>
						</footer>
						<div class="comment-content"> 
							<?php comment_text(); ?>
						</div>
						<div class="reply">
							<?php 
								comment_reply_link(
									array_merge($args, array(
										'depth' => $depth, 
										'max_depth' => $args['max_depth']
									))
								);
							?>
						</div>
					</article>
				<?php
				break;
		}
	} // end vol_comment()
} // end vol_comment() check


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

	if ('1' != $all_the_cool_cats) {
	
		// This blog has more than 1 category 
		// So vol_categorized_blog should return true
		return true;
	} else {
	
		// This blog has only 1 category
		// So vol_categorized_blog should return false
		return false;
	}
}


/**
 * Flush out the transients used in vol_categorized_blog
 *
 * @since Volatyl 1.0
 */
function vol_category_transient_flusher() {

	// GTFO
	delete_transient('all_the_cool_cats');
}
add_action('edit_category', 'vol_category_transient_flusher');
add_action('save_post', 'vol_category_transient_flusher');