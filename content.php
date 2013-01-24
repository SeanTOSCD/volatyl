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
if ( is_home() || is_front_page() ) {
	$article_headline = "h3";
} else {
	$article_headline = "h1";
}

echo 	"<article id=\"post-", the_ID(), "\" ", post_class(), ">\n",
		"\t<header class=\"entry-header\">\n",
		"\t\t<{$article_headline} class=\"entry-title\"><a href=\"", the_permalink(), "\" title=\"",
		esc_attr( sprintf( __( 'Permalink to "%s"', 'volatyl' ), the_title_attribute( 'echo=0' ) ) ), "\" rel=\"bookmark\">", __( the_title(), 'volatyl' ), "</a></{$article_headline}>\n";

if ( 'post' == get_post_type() )
	echo 	"\t\t<div class=\"entry-meta\">\n", 
			volatyl_post_meta(),
			"\t\t</div>\n";

echo "\t</header>";

if ( is_search() || $options[ 'homeexcerpt' ] == 1 ) {

	// Only display Excerpts for Search or Home if options is selected
	echo 	"\t<div class=\"entry-summary\">\n", 
			the_excerpt(),
			"\t</div>";
	
} else { 

	// Otherwise, show full article
	echo "\t<div class=\"entry-content\">\n";
	
	// Activate Featured Images
	if ( $options[ 'featuredimage' ] == 1 ) {
	
		// If Featured Image is set for a post, show thumbnail.
		if ( has_post_thumbnail() )
			echo "<a href=\"", the_permalink(), "\" title=\"", the_title_attribute(), "\" >", the_post_thumbnail(), "</a>";
			
	}

	echo the_content( __( 'Read More &rarr;', 'volatyl' ) );
	
	// Show feed tags
	if ( $options[ 'feedtags' ] == 1 )
		echo 	"\t\t<div class=\"entry-meta tags\">\n",
				the_tags( 'Tags: ', ', ', '<br />' ),
				"\t\t</div>\n";
	
	// Navigate paginated posts
	wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'volatyl' ), 'after' => '</div>' ) );
	
	echo "\t</div>\n";
	
}

echo "</article>";