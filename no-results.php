<?php
/** no-results.php
 *
 * The template part for displaying a message that posts cannot be found
 *
 * @package Volatyl
 * @since Volatyl 1.0
 */

echo 	"<article id=\"post-0\" class=\"post no-results not-found\">\n",
		"\t<header class=\"entry-header\">\n",
		"\t\t<h1 class=\"entry-title\">", 
		__( 'Nothing Found', 'volatyl' ), "</h1>\n",
		"\t</header>\n",
		"\t<div class=\"entry-content\">\n";

// Zero posts the viewer can create posts
if ( is_home() && current_user_can( 'publish_posts' ) ) {

	echo "\t\t<p>";
	printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'volatyl' ), admin_url( 'post-new.php' ) );
	echo "</p>\n";
	
// Zero search results
} elseif ( is_search() ) {

	echo "\t\t<p>", __( 'Sorry, but nothing matched your search terms. Please try again with different keywords.', 'volatyl' ), "</p>\n";
	
	get_search_form();
	
// Zero posts in the loop
} else {

	echo "\t\t<p>", __( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'volatyl' ), "</p>\n";
	
	get_search_form();
	
}

echo 	"\t</div>\n",
		"</article>";