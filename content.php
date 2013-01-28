<?php
/** content.php
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
$more_link_text = apply_filters( 'more_link_text', 'Read More &rarr;' );

// Custom filters
$feed_tags_text = apply_filters( 'feed_tags_text', 'Tags: ' );

if ( is_home() || is_front_page() ) {
	$article_headline = "h3";
} else {
	$article_headline = "h1";
}

echo "<article id=\"post-", the_ID(), "\" ", post_class(), ">\n";

echo 	"\t<header class=\"entry-header\">\n",
		"\t\t<{$article_headline} class=\"entry-title\"><a href=\"", the_permalink(), "\" title=\"",
		esc_attr( sprintf( __( '%s', 'volatyl' ), the_title_attribute( 'echo=0' ) ) ), "\" rel=\"bookmark\">", __( the_title(), 'volatyl' ), "</a></{$article_headline}>\n";

if ( 'post' == get_post_type() )
	echo 	"\t\t<div class=\"entry-meta\">\n", 
			volatyl_post_meta(),
			"\t\t</div>\n";

echo "\t</header>";
	
// Activate Featured Images
if ( $options[ 'featuredimage' ] == 1 ) {

	// If Featured Image is set for a post, show thumbnail.
	if ( has_post_thumbnail() )
		echo "<a href=\"", the_permalink(), "\" title=\"", the_title_attribute(), "\" >", the_post_thumbnail( 'homepage-thumb', array( 
			'class'		=> 'featured-img', 
			'alt'		=> the_title_attribute( 'echo=0' ) 
			) ), "</a>";
		
}

// vol_after_article_header
if ( $options_hooks[ 'switch_vol_after_article_header' ] == 0 ) {
	if 	( ( is_home() && is_front_page() && $options_hooks[ 'home_vol_after_article_header' ] == 0 && $options_hooks[ 'front_vol_after_article_header' ] == 0 ) ||
		( is_home() && ! is_front_page() && $options_hooks[ 'home_vol_after_article_header' ] == 0 ) ||
		( is_front_page() && ! is_home() && $options_hooks[ 'front_vol_after_article_header' ] == 0 ) ||
		( is_archive() && $options_hooks[ 'archive_vol_after_article_header' ] == 0 ) ||
		( is_search() && $options_hooks[ 'search_vol_after_article_header' ] == 0 ) ||
		( is_404() && $options_hooks[ '404_vol_after_article_header' ] == 0 ) ) {
			vol_after_article_header();
	} else {
		do_action( 'vol_after_article_header' );
	}
}

if ( is_search() || $options[ 'homeexcerpt' ] == 1 ) {

	// Only display Excerpts for Search or Home if options is selected
	echo 	"\t<div class=\"entry-summary\">\n",
			"<p>", get_the_excerpt(), "</p>",
			"\t</div>";
	
} else { 

	// Otherwise, show full article
	echo 	"\t<div class=\"entry-content\">\n",
			the_content( __( $more_link_text, 'volatyl' ) );
	
	// Show feed tags
	if ( $options[ 'feedtags' ] == 1 )
		the_tags( __( '<div class="entry-meta tags">' . $feed_tags_text, 'volatyl' ), ', ', '<br /></div>' );
	
	// Navigate paginated posts
	wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'volatyl' ), 'after' => '</div>' ) );
	
	echo "\t</div>\n";
	
}

echo "</article>";

// vol_post_footer
if ( $options[ 'switch_vol_post_footer' ] == 0 ) {
	if 	( ( is_home() && is_front_page() && $options_hooks[ 'home_vol_post_footer' ] == 0 && $options_hooks[ 'front_vol_post_footer' ] == 0 ) ||
		( is_home() && ! is_front_page() && $options_hooks[ 'home_vol_post_footer' ] == 0 ) ||
		( is_front_page() && ! is_home() && $options_hooks[ 'front_vol_post_footer' ] == 0 ) ||
		( is_archive() && $options_hooks[ 'archive_vol_post_footer' ] == 0 ) ||
		( is_search() && $options_hooks[ 'search_vol_post_footer' ] == 0 ) ) {
			vol_post_footer();
	} else {
		do_action( 'vol_post_footer' );
	}
}