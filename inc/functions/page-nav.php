<?php
/** page-nav.php
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

		$nav_class = 'site-navigation paging-navigation';
		
		if ( is_single() )
			$nav_class = 'site-navigation post-navigation';

			echo 	"<nav role=\"navigation\" id=\"", 
					$nav_id, "\" class=\"", 
					$nav_class, "\">";
				
		if ( is_single() ) {
		
			previous_post_link( __( 'Previous Article:', 'volatyl' ) . '<div class="nav-previous post-nav">%link</div>', '<span class="meta-nav">' . _x( '', 'Previous post link', 'volatyl' ) . '</span> %title' );
			
			next_post_link( '<br>' . __( 'Next article:', 'volatyl' ) . '<div class="nav-next post-nav">%link</div>', '%title <span class="meta-nav">' . _x( '', 'Next post link', 'volatyl' ) . '</span>' );

		} elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) {

			if ( get_next_posts_link() ) {
			
				echo "<div class=\"nav-previous\">";
				next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'volatyl' ) );
				echo "</div>";
				
			}

			if ( get_previous_posts_link() ) {
			
				echo "<div class=\"nav-next\">";
				previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'volatyl' ) );
				echo "</div>";
				
			}
		}
		echo "</nav>";		
	}
}


// Pagination - only if standard page navigation is turned off
function vol_pagination( $pages = '', $range = 2 ) {  
     global $paged;
     $showitems = ( $range * 2 )+1;  
 
     if ( empty( $paged ) ) $paged = 1;
 
     if ( $pages == '' ) {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         
         if ( !$pages )
             $pages = 1;
             
     }   
     
     if ( 1 != $pages ) {
     
         echo "<div class=\"pagination\"><span>" . __( 'Page ', 'volatyl' ) . $paged . __( ' of ', 'volatyl' ) . $pages ."</span>";
         
         if ( $paged > 2 && $paged > $range+1 && $showitems < $pages ) 
         	echo "<a href=\"" . get_pagenum_link( 1 ) . "\" title=\"" . __( 'First Page', 'volatyl' ) . "\">&laquo;</a>";
         	
         if ( $paged > 1 && $showitems < $pages ) 
         	echo "<a href=\"" . get_pagenum_link( $paged - 1 ) . "\" title=\"" . __( 'Previous Page', 'volatyl' ) . "\">&lsaquo;</a>";
 
         for ( $i=1; $i <= $pages; $i++ ) {
         
             if ( 1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
                 echo ( $paged == $i ) ? "<span class=\"current\">" . $i . "</span>" : "<a href='" . get_pagenum_link( $i ) . "' class=\"inactive\">" . $i . "</a>";
             
         }
 
         if ( $paged < $pages && $showitems < $pages ) 
         	echo "<a href=\"" . get_pagenum_link( $paged + 1 ) . "\" title=\"" . __( 'Next Page', 'volatyl' ) . "\">&rsaquo;</a>";  
         	
         if ( $paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages ) 
         	echo "<a href=\"" . get_pagenum_link( $pages ) . "\" title=\"" . __( 'Last Page', 'volatyl' ) . "\">&raquo;</a>";
         	
         echo "</div>\n";
         
     }
}


// Pagination options - Standard or Fancy?
function pagination_type() {
	$options_content = get_option( 'vol_content_options' );
	
	if ( $options_content[ 'pagination' ] == 1 && ( is_home() || is_archive() || is_search() ) )
		echo vol_pagination();
		
	else
		echo volatyl_content_nav( 'nav-below' );
}