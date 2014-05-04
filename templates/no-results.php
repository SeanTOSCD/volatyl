<?php
/** no-results.php
 *
 ***** THIS IS A CORE VOLATYL FILE AND SHOULD NOT BE EDITED!
 ***** ALL CUSTOM CODING SHOULD BE DONE IN A CHILD THEME.
 ***** MORE INFORMATION - http://volatylthemes.com/why-child-themes/
 *******************************************************************
 *
 * template part for displaying a message that posts cannot be found
 * or a 404 error page. The actual 404 template is in the 404.php file
 *
 * @package Volatyl
 * @since Volatyl 1.0
 */
global $options;
	
// 404 error page
if (is_404()) {
	get_template_part('templates/404', 'index');
} else { ?>
	<article id="post-0" class="post no-results not-found">
		<header class="entry-header">
			<h1 class="entry-title">
				<?php _e('Nothing Found', 'volatyl'); ?>
			</h1>
		</header>
		<section class="entry-content">		
			<?php
				// Zero posts the viewer can create posts
				if (is_home() && current_user_can('publish_posts')) { ?>
					<p class="first-post">
						<?php echo __('Ready to publish your first post? ', 'volatyl'), '<a href="' . admin_url('post-new.php') . '">', __('Get started here', 'volatyl'), '</a>'; ?>
					</p>
					<?php
				
				} elseif (is_search()) { ?>
				
					<p class="no-search-results">
						<?php _e('Sorry, but nothing matched your search terms. Please try again with different keywords.', 'volatyl'); ?>
					</p>
					
					<?php get_search_form();
		
				// Zero posts in the loop
				} else { ?>
				
					<p class="no-posts">
						<?php _e('It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'volatyl'); ?>
					</p>
					
					<?php get_search_form();
				}
			?>			
		</section>
	</article>
	<?php
}