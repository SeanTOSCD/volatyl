<?php
/** loops.php
 *
 ***** THIS IS A CORE VOLATYL FILE AND SHOULD NOT BE EDITED!
 ***** ALL CUSTOM CODING SHOULD BE DONE IN A CHILD THEME.
 ***** MORE INFORMATION - http://volatylthemes.com/why-child-themes/
 *******************************************************************
 *
 * Loops, and loops, and loops! This file is one big conditional that
 * handles the WordPress loop for:
 *
 * is_home()
 * is_single()
 * is_page()
 * is_archive()
 * is_attachment()
 *
 * These loops call to respective template files for Volatyl.
 * 
 * Certain templates can be overwritten by simply creating the actual
 * template file responsible for that particular template. For example,
 * creating a content-single.php file in a child theme (or in the core... 
 * but don't) will override the get_template_part( 'content', 'single' ) 
 * function in the is_single() condition of this statement.
 *
 * @package Volatyl
 * @since Volatyl 1.0
 */

function vol_content() {
	global $options, $tab3, $tab6;
	
	echo "<div id=\"content\" class=\"site-content border-box clearfix\">";
	
	if ( have_posts() ) {

		// Blog home
		if ( is_home() ) {

			// vol_before_content_column
			( ( $options[ 'switch_vol_before_content_column' ] == 0 ) ?
				( ( $options[ 'home_vol_before_content_column' ] == 0 ) ?
					vol_before_content_column() : 
					do_action( 'vol_before_content_column' ) ) : 
			'' );
		
			// Da loop
			while ( have_posts() ) { 
				the_post();
				get_template_part( 'content', get_post_format() );
			}
			
			// vol_after_content_column
			( ( $options[ 'switch_vol_after_content_column' ] == 0 ) ?
				( ( $options[ 'home_vol_after_content_column' ] == 0 ) ?
					vol_after_content_column() :
					do_action( 'vol_after_content_column' ) ) :
			'' );
			
			pagination_type(); // /inc/functions/page-nav.php
	
		// Single posts
		} elseif ( is_single() && ! is_attachment() ) { 

			// vol_before_content_column
			( ( $options[ 'switch_vol_before_content_column' ] == 0 ) ?
				( ( $options[ 'posts_vol_before_content_column' ] == 0 ) ?
					vol_before_content_column() :
					do_action( 'vol_before_content_column' ) ) :
			'' );
		
			// Da loop
			while ( have_posts() ) { 
				the_post();
				get_template_part( 'content', 'single' );
			}

			// vol_after_content_column
			( ( $options[ 'switch_vol_after_content_column' ] == 0 ) ?
				( ( $options[ 'posts_vol_after_content_column' ] == 0 ) ?
					vol_after_content_column() :
					do_action( 'vol_after_content_column' ) ) :
			'' );
			
		// Pages
		} elseif ( is_page() ) {
	
			// Da loop
			while ( have_posts() ) {
				the_post();
				get_template_part( 'content', 'page' );
			}
	
		// Search results
		} elseif ( is_search() ) {
			global $post;
			$search_title = apply_filters( 'search_title', 'Search Results for:' );
			
			echo "\t<header class=\"page-header\">\n
			\t\t<h1 class=\"page-title\">",
			sprintf( __( $search_title . ' %s', 'volatyl' ), '<span>' . get_search_query() . '</span>' ),
			"</h1>\n
			\t</header>";
		
			// Da loop		
			while ( have_posts() ) { 
				the_post();
				if ( is_search() && ( $post->post_type=='page' ) ) 
					continue;
				get_template_part( 'content', 'search' );
			}
			pagination_type();

		// Archives including categories, tags, authors, dates, and bears. Oh my!
		} elseif ( is_archive() ) {
			$options_hooks = get_option( 'vol_hooks_options' );
			$archive_title = apply_filters( 'archive_title', array(
				'cat_title'			=> 'Category Archives:',
				'tag_title'			=> 'Tag Archives:',
				'author_title'		=> 'Author Archives:',
				'daily_title'		=> 'Daily Archives:',
				'monthly_title'		=> 'Monthly Archives:',
				'yearly_title'		=> 'Yearly Archives:'
				)
			);

			// vol_before_content_column
			( ( $options[ 'switch_vol_before_content_column' ] == 0 ) ?
				( ( $options[ 'archive_vol_before_content_column' ] == 0 ) ?
					vol_before_content_column() :
					do_action( 'vol_before_content_column' ) ) :
			'' );
			echo "\t<header class=\"page-header\">\n
			\t\t<h1 class=\"page-title\">";
			if ( is_category() ) {
				printf( __( $archive_title[ 'cat_title' ] . ' %s', 'volatyl' ), '<span>' . single_cat_title( '', false ) . '</span>' );
			} elseif ( is_tag() ) {
				printf( __( $archive_title[ 'tag_title' ] . ' %s', 'volatyl' ), '<span>' . single_tag_title( '', false ) . '</span>' );
			} elseif ( is_author() ) {
	
				// Queue the first post, that way we know
				// what author we're dealing with (if that is the case)
				the_post();
				printf( __( $archive_title[ 'author_title' ] . ' %s', 'volatyl' ), '<span class="vcard"><a class="fn" href="' . get_author_posts_url( get_the_author_meta( "ID" ) ) . '" title="' . esc_attr( get_the_author() ) . '">' . get_the_author() . '</a></span>' );
			
				// Since we called the_post() above, we need to
				// rewind the loop back to the beginning that way
				// we can run the loop properly, in full.
				rewind_posts();
			} elseif ( is_day() ) {
				printf( __( $archive_title[ 'daily_title' ] . ' %s', 'volatyl' ), '<span>' . get_the_date() . '</span>' );
			} elseif ( is_month() ) {
				printf( __( $archive_title[ 'monthly_title' ] . ' %s', 'volatyl' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );
			} elseif ( is_year() ) {
				printf( __( $archive_title[ 'yearly_title' ] . ' %s', 'volatyl' ), '<span>' . get_the_date( 'Y' ) . '</span>' );
			} else {
				_e( 'Archives', 'volatyl' );
			}
			echo "\t\t</h1>\n";
			if ( is_category() ) {
		
				// show an optional category description
				$category_description = category_description();
				if ( ! empty( $category_description ) )
					echo apply_filters( 'category_archive_meta', '<div class="taxonomy-description">' . $category_description . '</div>' );
			} elseif ( is_tag() ) {
	
				// show an optional tag description
				$tag_description = tag_description(); 
				if ( ! empty( $tag_description ) )
					echo apply_filters( 'tag_archive_meta', '<div class="taxonomy-description">' . $tag_description . '</div>' );
			}
			echo "\t</header>";
			
			// Da loop
			while ( have_posts() ) {
				the_post();
				get_template_part( 'content', get_post_format() );
			}

			// vol_after_content_column
			( ( $options_hooks[ 'switch_vol_after_content_column' ] == 0 ) ?
				( ( is_archive() && $options_hooks[ 'archive_vol_after_content_column' ] == 0 ) ?
					vol_after_content_column() :
					do_action( 'vol_after_content_column' ) ) :
			'' );
			pagination_type();
	
		// Attachment pages
		} elseif ( is_attachment() ) {
		
			// Da loop
			while ( have_posts() ) {
				the_post();
				get_template_part( 'content', 'attachment' );
			}
	
		// Stray template (can that even happen?) floating around? I got this.
		} else {
		
			// Da loop
			while ( have_posts() ) {
				the_post();
				get_template_part( 'content', get_post_format() );
			}
		}	
	} else {
		get_template_part( 'no-results', 'index' );
	}
	echo "</div>";
}