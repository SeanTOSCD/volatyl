<?php
/** no-results.php
 *
 * The template part for displaying a message that posts cannot be found
 *
 * @package Volatyl
 * @since Volatyl 1.0
 */

global $options, $tab3, $tab6;
	
// 404 error page
if ( is_404() ) {
	echo "\t<article id=\"post-0\" class=\"post error404 not-found\">",
	"\t\t<header class=\"entry-header\">\n",
	"{$tab3}<h1 class=\"entry-title\">", __( '404, eh? Well that\'s no good.', 'volatyl' ), "</h1>",
	"\t\t</header>\n",
	"\t\t<div class=\"entry-content\">\n",
	"{$tab3}<p>". __( 'We can\'t change the past but let\'s try to make things right for the future. Use the search form and other tools below to find what you were looking for.', 'volatyl' ), "</p>\n";
	get_search_form();
	the_widget( 'WP_Widget_Recent_Posts' );
	echo "{$tab3}<div class=\"widget\">\n",
	"{$tab3}\t<h2 class=\"widgettitle\">", __( 'Most Used Categories', 'volatyl' ), "</h2>\n",
	"{$tab3}\t<ul>\n";
	wp_list_categories( array( 
		'orderby' => 'count', 
		'order' => 'DESC', 
		'title_li' => '', 
		'number' => 10, 
		'depth' => -1, 
	) );
	echo "{$tab3}\t</ul>\n",
	"</div>";

	// translators: %1$s: smilie
	$archive_content = '<p>' . sprintf( __( 'Try looking in the monthly archives. %1$s', 'volatyl' ), convert_smilies( ':)' ) ) . '</p>';
	the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$archive_content" );
	the_widget( 'WP_Widget_Tag_Cloud' );
	echo "\t\t</div>\n",
	"\t</article>\n";
} else {
	echo "<article id=\"post-0\" class=\"post no-results not-found\">\n",
	"\t<header class=\"entry-header\">\n",
	"\t\t<h1 class=\"entry-title\">", __( 'Nothing Found', 'volatyl' ), "</h1>\n",
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
	echo "\t</div>\n",
	"</article>";
}