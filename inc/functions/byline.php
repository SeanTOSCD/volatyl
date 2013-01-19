<?php
/** byline.php
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
if ( ! function_exists( 'volatyl_post_meta' ) ) {
 
	function volatyl_post_meta() {
		global $count;
		$options_content = get_option( 'vol_content_options' );

		// Show post date
		if ( $options_content[ 'by-date-post' ] == 1 ) {
	
			echo 	__( 'on ', 'volatyl' ),
					"<a href=\"", the_permalink(), "\" title=\"",
					esc_attr( sprintf( __( 'Link to Article', 'volatyl' ), the_title_attribute( 'echo=0' ) ) ), 
					"\" rel=\"bookmark\">";
			the_time( get_option( 'date_format' ) );
			echo "</a> \n";
		
		}
	
		// Show post author
		( ( $options_content[ 'by-author-post' ] == 1 ) ? _e( 'by ', 'volatyl' ) . the_author() : '' );
	
		// Show post comment count
		if ( $options_content[ 'by-comments-post' ] == 1 ) {
	
			// Only show dash before comments if byline items are in front of it
			echo ( ( $options_content[ 'by-date-post' ] == 0 && $options_content[ 'by-author-post' ] == 0 ) ? "" : " - " );
				
			
			// Only mark comments as closed in byline of comment count is 0	
			$response_count = get_comments_number();
			$comment_count = comments_only_count( $count );
		
			if ( ! comments_open() && $response_count == 0 ) {
		
				// No need to show a count if comments are off and there are none!
				$comments = "Comments off";
				
			} else {
			
				/** Return "response" count with or without pings! ;)
				 *
				 * If pings are disabled, only "comments" will show
				 * See the functions/content.php file for more information
				 */
				if ( $options_content[ 'postpings' ] == 1 ) { 
		
					// Get the total number of comments and pings
					$num_comments = get_comments_number();
			
					if ( $num_comments == 0 )
						$comments = __( '0 Responses', 'volatyl' );
					elseif ( $num_comments > 1 )
						$comments = $num_comments . __( ' Responses', 'volatyl' );
					else
						$comments = __( '1 Response', 'volatyl' );
			
				} else {
		
					// Only get the comments... no pings
					$num_comments = comments_only_count( $count );
			
					if ( $num_comments == 0 )
						$comments = __( '0 Comments', 'volatyl' );
					elseif ( $num_comments > 1 )
						$comments = $num_comments . __( ' Comments', 'volatyl' );
					else
						$comments = __( '1 Comment', 'volatyl' );
			
				}
				
			} 
			echo $comments;
		}
	
		// Show post edit link
		if ( $options_content[ 'by-edit-post' ] == 1 )
			edit_post_link( __( 'Edit', '_s' ), '<span class="edit-link"> ', '</span> ' );
	
		// Show post categories
		if ( $options_content[ 'by-cats' ] == 1 ) {
	
			// Only place cats on new line if other byline items are removed
			if ( $options_content[ 'by-date-post' ] == 1 || $options_content[ 'by-author-post' ] == 1 || $options_content[ 'by-comments-post' ] == 1 )
				echo "<br>";
		
			_e( 'Filed under: ', 'volatyl' );
			the_category( ', ' );
		}
	}
}