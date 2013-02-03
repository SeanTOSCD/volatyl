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
$options = get_option( 'vol_content_options' );
$commenter = wp_get_current_commenter();
$req = get_option( 'require_name_email' );
$aria_req = ( $req ? " aria-required='true'" : '' );

// Custom filters
$comments_title = apply_filters( 'comments_title', __( _n( '1 Comment:', '%1$s Comments:', comments_only_count( $count ), 'volatyl' ), 'volatyl' ) );
$pings_title = apply_filters( 'pings_title', __( _n( '1 Ping:', '%1$s Pings:', get_comments_number() - comments_only_count( $count ), 'volatyl' ), 'volatyl' ) );
$comments_closed = apply_filters( 'comments_closed', 'Comments are closed.' );
$older_comments = apply_filters( 'older_comments', '&larr; Older Comments' );
$newer_comments = apply_filters( 'newer_comments', 'Newer Comments &rarr;' );
$comment_reply_title = apply_filters( 'comment_reply_title', 'Leave a Reply ' );
$comment_submit = apply_filters( 'comment_submit', 'Submit Comment' );


/* If the current post is protected by a password and
 * the visitor has not yet entered the password, we will
 * return early without loading the comments. 
 */
if ( post_password_required() )
	return;
	
	// Otherwise...
	echo "<div id=\"comments\">\n";
	if ( have_comments() ) {
		echo "\t<span class=\"comments-title\">\n", 
		sprintf( $comments_title, number_format_i18n( comments_only_count( $count ) ) ), 
		"</span>\n";
		
		// Are there comments to navigate through?
		( ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) ? 
			printf( "\t<nav role=\"navigation\" id=\"comment-nav-above\" class=\"site-navigation comment-navigation clearfix\">\n
			\t\t<div class=\"nav-previous comment-nav\">\n" ) . 
			previous_comments_link( __( $older_comments, 'volatyl' ) ) .
			printf( "\t\t</div>\n
			\t\t<div class=\"nav-next comment-nav\">\n" ) . 
			next_comments_link( __( $newer_comments, 'volatyl' ) ) .
			printf( "\t\t</div>\n
			\t</nav>" ) : 
		'' );
		echo "\t<ol class=\"commentlist\">\n";
		

		/* Loop through and list the comments. Tell wp_list_comments()
		 * to use volatyl_comment() to format the comments.
		 * If you want to overload this in a child theme then you can
		 * define volatyl_comment() and that will be used instead.
		 *
		 * Only comments will be displayed here. No pings!!!!
		 */
		wp_list_comments( 
			array( 
				'callback'	=> 'volatyl_comment',
				'type'		=> 'comment', 
			) 
		);
		
		// Only show pings if selected in the Volatyl options
		if ( $options[ 'postpings' ] == 1 ) { 
		
			// Are there comments to navigate through?
			( ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) ? 
				printf( "\t<nav role=\"navigation\" id=\"comment-nav-below\" class=\"site-navigation comment-navigation clearfix\">\n
				\t\t<div class=\"nav-previous comment-nav\">\n" ) . 
				previous_comments_link( __( $older_comments, 'volatyl' ) ) .
				printf( "\t\t</div>\n
				\t\t<div class=\"nav-next comment-nav\">\n" ) . 
				next_comments_link( __( $newer_comments, 'volatyl' ) ) .
				printf( "\t\t</div>\n
				\t</nav>" ) : 
			'' );
		
			// Only show pings header if there are pings to show
			( ( ( get_comments_number() - comments_only_count( $count ) ) > 0 ) ?
			
				// Pings! Trackbacks and Pingbacks...
				printf( "\t<span class=\"comments-title\">\n" ) .
				printf( $pings_title, number_format_i18n( get_comments_number() - comments_only_count( $count ) ) ) . printf( "</span>\n" ) : 
			'' );
			
			// Here are the trackbacks and pingbacks
			wp_list_comments( 
				array( 
					'callback'	=> 'volatyl_comment',
					'type'		=> 'pings', 
				) 
			);
		}
		echo "\t</ol>\n";
	}

// If comments are closed and there are comments, let's leave a little note.
echo ( ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) ? 
	sprintf( "\t\t<p class=\"nocomments\">" ) . 
	__( $comments_closed, 'volatyl' ) . 
	sprintf( "</p>\n" ) : 
'' );


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
 * @since Volatyl 1.0
 */
comment_form( 
	array( 
		'comment_field'			=> '<p class="comment-form-comment"><textarea id="comment" name="comment" rows="8" aria-required="true"></textarea></p>',
		'title_reply'			=> '<h3 id="reply-title">' . __( $comment_reply_title, 'volatyl' ) . '</h3>',
		'cancel_reply_link'		=> '<span class="cancel-reply">' . __( 'Cancel Reply', 'volatyl' ) . '</span>',
		'label_submit'			=> __( $comment_submit, 'volatyl' ),
		'fields'				=> apply_filters( 'comment_form_default_fields', 
		
			array(
				'author'	=> '<p class="comment-form-author">' . '<input id="author" name="author" type="text" value="' . esc_attr( $commenter[ 'comment_author' ] ) . '" size="20"' . $aria_req . ' /><label for="author">' . __( 'Name', 'volatyl' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) . '</p>',
				
				'email'		=> '<p class="comment-form-email">' . '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter[ 'comment_author_email' ] ) . '" size="20"' . $aria_req . ' /><label for="email">' . __( 'Email', 'volatyl' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) . '</p>',
				
				'url'		=> '<p class="comment-form-url"><input id="url" name="url" type="text" value="' . esc_attr( $commenter[ 'comment_author_url' ] ) . '" size="20" /><label for="url">' . __( 'Website', 'volatyl' ) . '</label></p>'
			)
		)
	) 
);
echo "</div>";