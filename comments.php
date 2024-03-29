<?php
/** comments.php
 *
 ***** THIS IS A CORE VOLATYL FILE AND SHOULD NOT BE EDITED!
 ***** ALL CUSTOM CODING SHOULD BE DONE IN A CHILD THEME.
 ***** MORE INFORMATION - http://volatylthemes.com/why-child-themes/
 *******************************************************************
 *
 * The template for displaying Comments.
 *
 * @package Volatyl
 * @since Volatyl 1.0
 */
global $count;
$commenter = wp_get_current_commenter();
$req = get_option('require_name_email');
$aria_req = ($req ? " aria-required='true'" : '');

// Custom filters
$comments_title = apply_filters(
	'comments_title', 
	__(_n('1 Comment:', '%1$s Comments:', vol_comments_only_count($count), 'volatyl'), 'volatyl')
);
$pings_title = apply_filters(
	'pings_title',
	__(_n('1 Ping:', '%1$s Pings:', get_comments_number() - vol_comments_only_count($count), 'volatyl'), 'volatyl')
);
$comments_text = apply_filters('comments_text', array(  
	'comments_closed'		=> __('Comments are closed.', 'volatyl'),
	'older_comments'		=> '&larr; ' . __('Older comments', 'volatyl'),
	'newer_comments'		=> __('Newer comments', 'volatyl') . ' &rarr;',
	'comment_reply_title'	=> __('Leave a Reply', 'volatyl'),
	'comment_submit'		=> __('Submit Comment', 'volatyl')
	) 
);


/* If the current post is protected by a password and
 * the visitor has not yet entered the password, we will
 * return early without loading the comments. 
 */
if (post_password_required()) return; ?>
	
<div id="comments">
	<div class="comments-wrap">
		<div class="comments-content">
			
			<?php if (have_comments()) { ?>
				<?php if ('0' != vol_comments_only_count($count)) { // display comments count title if there are comments (no pings) ?>
					<span class="comments-title">
						<?php printf($comments_title, number_format_i18n(vol_comments_only_count($count))); ?>
					</span>
				<?php } ?>
				
				<?php if (get_comment_pages_count() > 1 && get_option('page_comments')) { // Are there comments? ?> 
					<nav role="navigation" id="comment-nav-above" class="site-navigation comment-navigation clearfix">
						<div class="nav-previous comment-nav border-box">
							<?php previous_comments_link($comments_text['older_comments']); ?>
						</div>
						<div class="nav-next comment-nav border-box">
							<?php next_comments_link($comments_text['newer_comments']); ?>
						</div>
					</nav>
				<?php } // end comments nav above ?>
				
				<ol class="commentlist">
					<?php
						/* Loop through and list the comments. Tell wp_list_comments()
						 * to use vol_comment() to format the comments.
						 * If you want to overload this in a child theme then you can
						 * define vol_comment() and that will be used instead.
						 *
						 * Only comments will be displayed here. No pings!!!!
						 */
						wp_list_comments(array('callback' => 'vol_comment', 'type' => 'comment')); 
					
						if (vol_pings_on()) { // Only show pings if selected in the Volatyl options ?>
							<?php if ((get_comments_number() - vol_comments_only_count($count)) > 0) { // are there pings? ?>
								<span class="comments-title">
									<?php printf($pings_title, number_format_i18n(get_comments_number() - vol_comments_only_count($count))); ?>
								</span>
							<?php }
							
							// Here are the trackbacks and pingbacks
							wp_list_comments(array('callback' => 'vol_comment', 'type' => 'pings'));
						} // end postpings check 
					?>
				</ol><!-- .commentlist -->
				
				<?php if (get_comment_pages_count() > 1 && get_option('page_comments')) { // Are there comments? ?> 
					<nav role="navigation" id="comment-nav-below" class="site-navigation comment-navigation clearfix">
						<div class="nav-previous comment-nav border-box">
							<?php previous_comments_link($comments_text['older_comments']); ?>
						</div>
						<div class="nav-next comment-nav border-box">
							<?php next_comments_link($comments_text['newer_comments']); ?>
						</div>
					</nav>
				<?php } // end comments nav below
			} // end have_comments()


			// If comments are closed and there are comments, let's leave a little note.
			if (!comments_open() && '0' != get_comments_number() && post_type_supports(get_post_type(), 'comments')) { ?>
				<p class="nocomments">
					<?php $comments_text['comments_closed']; ?>
				</p>
				<?php
			}


			/** Comment Form
			 *
			 * The comment form is implemented using WordPress' comment_form()
			 * function. Arguments can be passed to this function to set certain
			 * defaults like the <textarea> label or the "cancel reply" link when
			 * replying to another person's comment.
			 *
			 * All of these have a default value, however, they can be changed. 
			 * Below are the changes implemented by Volatyl.
			 *
			 * If you want to overload this in a child theme then you can
			 * define comment_form() and that will be used instead.
			 *
			 * @since Volatyl 1.0
			 */
			comment_form( 
				array( 
					'comment_field'			=> '<p class="comment-form-comment"><textarea id="comment" name="comment" rows="8" aria-required="true"></textarea></p>',
					'comment_notes_after'	=> '',
					'title_reply'			=> $comments_text['comment_reply_title'] . ' ',
					'cancel_reply_link'		=> '<span class="cancel-reply">' . __('Cancel Reply', 'volatyl') . '</span>',
					'label_submit'			=> $comments_text['comment_submit'],
					'fields'				=> apply_filters('comment_form_default_fields', array(
						'author'		=> '<p class="comment-form-author">' . '<input id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" size="20"' . $aria_req . ' /><label for="author">' . __('Name', 'volatyl') . '</label> ' . ($req ? '<span class="required">*</span>' : '') . '</p>',
						
						'email'			=> '<p class="comment-form-email">' . '<input id="email" name="email" type="text" value="' . esc_attr($commenter['comment_author_email']) . '" size="20"' . $aria_req . ' /><label for="email">' . __('Email', 'volatyl') . '</label> ' . ($req ? '<span class="required">*</span>' : '') . '</p>',
						
						'url'			=> '<p class="comment-form-url"><input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url']) . '" size="20" /><label for="url">' . __('Website', 'volatyl') . '</label></p>'
					))
				) 
			);
			?>
		</div><!-- #comments -->
	</div><!--  .comments-wrap -->
</div><!--  .comments-content -->