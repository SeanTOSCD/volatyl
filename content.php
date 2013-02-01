<?php
/** content.php
 *
 ***** THIS IS A CORE VOLATYL FILE AND SHOULD NOT BE EDITED!
 ***** ALL CUSTOM CODING SHOULD BE DONE IN A CHILD THEME.
 ***** MORE INFORMATION - http://volatylthemes.com/why-child-themes/
 *******************************************************************
 * 
 * Most of the templates for the various WordPress webpages are located
 * in the templates.php file. A few of the generic webpages call to this
 * file to format the content for that particular template.
 *
 * @package Volatyl
 * @since Volatyl 1.0
 */

$options = get_option( 'vol_content_options' );	
$options_hooks = get_option( 'vol_hooks_options' );

// Custom filters
$feed_tags_text = apply_filters( 'feed_tags_text', 'Tags: ' );
$more_link_text = apply_filters( 'more_link_text', 'Read More &rarr;' );
$feed_post_page_nav = apply_filters( 'feed_post_page_nav', 'Pages: ' );

echo "<article id=\"post-", the_ID(), "\" ", post_class(), ">\n",
"\t<header class=\"entry-header\">\n",
"\t\t<h1 class=\"entry-title\"><a href=\"", the_permalink(), "\" title=\"", esc_attr( sprintf( __( '%s', 'volatyl' ), the_title_attribute( 'echo=0' ) ) ), "\" rel=\"bookmark\">", __( the_title(), 'volatyl' ), "</a></h1>\n";
( ( 'post' == get_post_type() ) ? 
	printf( "\t\t<div class=\"entry-meta\">\n" ) . 
	volatyl_post_meta() . 
	printf( "\t\t</div>\n" ) : 
'' );
echo "\t</header>";
	
// Activate Featured Images
if ( $options[ 'featuredimage' ] == 1 ) {

	// If Featured Image is set for a post, show thumbnail.
	( ( has_post_thumbnail() ) ? 
		printf( "<a href=\"" ) . the_permalink() . printf( "\" title=\"" ) . the_title_attribute() . printf( "\" >" ) . the_post_thumbnail( 'post-thumbnail', array( 
			'class'	=> 'featured-img', 
			'alt'	=> the_title_attribute( 'echo=0' ) 
		) ) . 
		printf( "</a>" ) : 
	'' );
}

// Only display Excerpts for Search or Home if options is selected
( ( is_search() || $options[ 'homeexcerpt' ] == 1 ) ?
	printf( "\t<section class=\"entry-summary\">\n" ) . 
	the_excerpt() . 
	printf( "\t</section>" ) :
	
	// Otherwise, show full article
	printf( "\t<section class=\"entry-content\">\n" ) . 
	the_content( __( $more_link_text, 'volatyl' ) ) .
	
	// Show feed tags
	( ( $options[ 'feedtags' ] == 1 ) ?	the_tags( '<div class="entry-meta tags">' . __( $feed_tags_text, 'volatyl' ), ', ', '<br /></div>' ) : '' ) .
	
	// Navigate paginated posts
	wp_link_pages( array( 'before' => '<nav class="page-links">' . __( $feed_post_page_nav, 'volatyl' ), 'after' => '</nav>' ) ) .
	printf( "\t</section>\n" )
);
echo "</article>";