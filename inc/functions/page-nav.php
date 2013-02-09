<?php
/** page-nav.php
 *
 ***** THIS IS A CORE VOLATYL FILE AND SHOULD NOT BE EDITED!
 ***** ALL CUSTOM CODING SHOULD BE DONE IN A CHILD THEME.
 ***** MORE INFORMATION - http://volatylthemes.com/why-child-themes/
 *******************************************************************
 *
 * Depending on selected options, numbered pagination can be used 
 * to navigate instead of standard page navigation. 
 *
 * @package Volatyl
 * @since Volatyl 1.0
 */

// Show standard page navigation - Prev/Next - or pagination?
if ( ! function_exists( 'volatyl_content_nav' ) ) {
	function volatyl_content_nav( $nav_id ) {
		global $wp_query, $post;
		$nav_class = 'site-navigation paging-navigation clearfix';
		
		// Custom filters
		$previous_post = apply_filters( 'previous_post', 'Previous Article:' );
		$next_post = apply_filters( 'next_post', 'Next Article:' );
		$older_posts = apply_filters( 'older_posts', '<span class="meta-nav">&larr;</span> Older posts' );
		$newer_posts = apply_filters( 'newer_posts', 'Newer posts <span class="meta-nav">&rarr;</span>' );

		// Don't print empty markup on single pages if there's nowhere to navigate.
		if ( is_single() ) {
			$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
			$next = get_adjacent_post( false, '', false );

			if ( ! $next && ! $previous )
				return;
		}

		// Don't print empty markup in archives if there's only one page.
		if ( $wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ) )
			return;
		
		if ( is_single() )
			$nav_class = 'site-navigation post-navigation clearfix';

			echo "<nav role=\"navigation\" id=\"", $nav_id, "\" class=\"", $nav_class, "\">";
		if ( is_single() ) {
			previous_post_link( '<div class="nav-previous post-nav">' . __( $previous_post . '<br>', 'volatyl' ) . '%link</div>', '<span class="meta-nav">' . _x( '', 'Previous post link', 'volatyl' ) . '</span> %title' );
			
			next_post_link( '<div class="nav-next post-nav">' . __( $next_post . '<br>', 'volatyl' ) . '%link</div>', '%title <span class="meta-nav">' . _x( '', 'Next post link', 'volatyl' ) . '</span>' );

		} elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) {
			( ( get_next_posts_link() ) ? printf( "<div class=\"nav-previous\">" ) . next_posts_link( __( $older_posts, 'volatyl' ) ) . printf( "</div>" ) : '' );
			( ( get_previous_posts_link() ) ? printf( "<div class=\"nav-next\">" ) . previous_posts_link( __( $newer_posts, 'volatyl' ) ) . printf( "</div>" ) : '' );
		}
		echo "</nav>";		
	}
}

// Pagination - only if standard page navigation is turned off
function vol_pagination( $pages = '', $range = 2 ) {  
	global $paged;
	$pagination_range = apply_filters( 'pagination_range', 2 );
	$showitems = ( $range * $pagination_range )+1;
	
	// Custom Filters
	$first_page = apply_filters( 'first_page', '&laquo;' );
	$previous_page = apply_filters( 'previous_page', '&lsaquo;' );
	$next_page = apply_filters( 'next_page', '&rsaquo;' );
	$last_page = apply_filters( 'last_page', '&raquo;' );
 
	if ( empty( $paged ) ) 
		$paged = 1;
	if ( $pages == '' ) {
		global $wp_query;
		$pages = $wp_query->max_num_pages;
		if ( !$pages )
	 	$pages = 1;
	}
	
	// Pagination text custom filter
	$pagination_text = apply_filters( 'pagination_text', __( '<span>' . __( 'Page ', 'volatyl' ) . $paged . __( ' of ', 'volatyl' ) . $pages . '</span>', 'volatyl' ) );

	if ( 1 != $pages ) {
		echo "<div class=\"pagination clearfix\">", $pagination_text,
		( ( $paged > 2 && $paged > $range+1 && $showitems < $pages ) ? sprintf( "<a href=\"" ) . get_pagenum_link( 1 ) .  sprintf( "\" title=\"" ) . __( $first_page, 'volatyl' ) .  sprintf( "\">" ) . __( $first_page, 'volatyl' ) .  sprintf( "</a>" ) : '' ),
		( ( $paged > 1 && $showitems < $pages ) ? sprintf( "<a href=\"" ) . get_pagenum_link( $paged - 1 ) .  sprintf( "\" title=\"" ) . __( $previous_page, 'volatyl' ) . sprintf( "\">" ) . __( $previous_page, 'volatyl' ) . sprintf( "</a>" ) : '' );
		for ( $i=1; $i <= $pages; $i++ ) {
	 		if ( 1 != $pages &&( ! ( $i >= $paged+$range+1 || $i <= $paged-$range-1 ) || $pages <= $showitems ) )
		 		echo ( $paged == $i ) ? "<span class=\"current\">" . $i . "</span>" : "<a href='" . get_pagenum_link( $i ) . "' class=\"inactive\">" . $i . "</a>";
 
		}
		echo ( ( $paged < $pages && $showitems < $pages ) ? sprintf( "<a href=\"" ) . get_pagenum_link( $paged + 1 ) .  sprintf( "\" title=\"" ) . __( $next_page, 'volatyl' ) . sprintf( "\">" ) . __( $next_page, 'volatyl' ) . sprintf( "</a>" ) : '' ),  
		( ( $paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages ) ?  sprintf( "<a href=\"" ) . get_pagenum_link( $pages ) . sprintf( "\" title=\"" ) . __( $last_page, 'volatyl' ) .  sprintf( "\">" ) . __( $last_page, 'volatyl' ) .  sprintf( "</a>" ) : '' ),
		"</div>\n";
	}
}

// Pagination options - Standard or Fancy?
function pagination_type() {
	$options_content = get_option( 'vol_content_options' );
	
	( ( $options_content[ 'pagination' ] == 1 && ( is_home() || is_archive() || is_search() ) ) ? vol_pagination() : volatyl_content_nav( 'nav-below' ) );
}