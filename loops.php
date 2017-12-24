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
 * is_single() & EDD Downloads - 'download' == get_post_type()
 * is_page()
 * is_search()
 * is_archive()
 * is_attachment()
 *
 * These loops call to respective template files for Volatyl. If no loop
 * is present in this file, the loops are located in the template files.
 *
 * Instructions for overwriting template files can be found in the template
 * files themselves.
 *
 * @package Volatyl
 * @since Volatyl 1.0
 */

function vol_content() {
	global $options;
	?>
	<div id="content" class="site-content clearfix">
		<?php
			if ( have_posts() ) { // start the loop for ALL THE THINGS

				// blog home
				if ( is_home() ) {

					// vol_before_content_column hook
					vol_before_content_column_home_output();

					// da loop
					while ( have_posts() ) {
						the_post();
						get_template_part( 'templates/content' );
					}

					vol_pagination_type(); // /inc/functions/page-nav.php

					// vol_after_content_column hook
					vol_after_content_column_home_output();

				// Single posts
				} elseif ( is_single() && !is_attachment() && ( 'download' != get_post_type() ) ) {

					// vol_before_content_column hook
					vol_before_content_column_posts_output();

					$postformat = ( get_post_format() ? get_post_format() : 'single' );

					// da loop
					while (have_posts()) {
						the_post();
						get_template_part( 'templates/content', $postformat );
					}

					// vol_after_content_column hook
					vol_after_content_column_post_output();

				// EDD Download
				} elseif (!is_search() && 'download' == get_post_type()) {

					// da loop
					while (have_posts()) {
						the_post();
						get_template_part('templates/content', 'download');
					}

				// Pages
				} elseif ( is_page() ) {

					// da loop
					while ( have_posts() ) {
						the_post();
						get_template_part( 'templates/content', 'page' );
					}

				// Search results
				} elseif ( is_search() ) {

					get_template_part( 'templates/content', 'search' );

				// Archives including categories, tags, authors, dates, and bears. Oh my!
				} elseif (is_archive()) {

					// vol_before_content_column hook
					vol_before_content_column_archive_output();

					get_template_part( 'templates/content', 'archive' );

					// vol_after_content_column hook
					vol_after_content_column_archive_output();

				// Attachment pages
				} elseif ( is_attachment() ) {

					// da loop
					while ( have_posts() ) {
						the_post();
						get_template_part( 'templates/content', 'attachment' );
					}

				// 404 error page
				} elseif ( is_404() ) {

					// da loop
					while ( have_posts() ) {
						the_post();
						get_template_part( 'templates/404', 'index' );
					}

				// Stray template (can that even happen?) floating around? I got this.
				} else {

					// da loop
					while ( have_posts() ) {
						the_post();
						get_template_part( 'templates/content', get_post_format() );
					}
				}
			} else {
				get_template_part( 'templates/no-results', 'index' );
			}
		?>
	</div>
<?php
}