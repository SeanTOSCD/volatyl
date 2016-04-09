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
function vol_first_post_class( $classes ) {
	global $wp_query;
	if ( 0 == $wp_query->current_post ) {
		$classes[] = 'top';
	}
	return $classes;
}
add_filter( 'post_class', 'vol_first_post_class' );


/**
 * Separate comments and pings
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
function vol_comments_only_count( $count ) {

	// Filter the comments count in the front-end only
	if ( !is_admin() ) {
		global $id;
		$status = get_comments('status=approve&post_id=' . $id );
		$comments_by_type = separate_comments( $status );
		return count( $comments_by_type['comment'] );
	}

	// When in the WP-admin back end, do NOT filter comments (and pings) count.
	else {
		return $count;
	}
}

// Show excerpt/post link instead of [...]
function vol_replace_excerpt( $content ) {
	global $excerpt_link;

	if ( vol_excerpt_link_on() ) {
		$excerpt_link = apply_filters( 'excerpt_link', __( 'Read More', 'volatyl' ) . ' &rarr;' );
		return str_replace( '[&hellip;]',
			'<p class="excerpt-link"><a class="read-more" href="' . get_permalink() . '">' . $excerpt_link . '</a></p>',
			$content
		);
	}
	return $content;
}
add_filter( 'get_the_excerpt', 'vol_replace_excerpt' );

/**
 * Title tag support with backwards compatibility
 */
if ( ! function_exists( '_wp_render_title_tag' ) ) {
	function vol_render_title() {
		?>
		<title><?php wp_title( '|', true, 'right' ); ?></title>
		<?php
	}
	add_action( 'wp_head', 'vol_render_title' );
}
