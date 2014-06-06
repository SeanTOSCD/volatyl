<?php
/** content.php
 *
 ***** THIS IS A CORE VOLATYL FILE AND SHOULD NOT BE EDITED!
 ***** ALL CUSTOM CODING SHOULD BE DONE IN A CHILD THEME.
 ***** MORE INFORMATION - http://volatylthemes.com/why-child-themes/
 *******************************************************************
 * 
 * Generic template for basic Volatyl pages that haven't been targeted
 * by another template already. 
 * 
 * To override this template in a child theme, copy this file into the 
 * root/templates folder of your child theme and make ADJUSTMENTS there. 
 * Use this file as a starting point so you don't lose any variables, 
 * constants, etc.
 *
 * @package Volatyl
 * @since Volatyl 1.0
 */

// Custom filters
$feed_tags_text = apply_filters('feed_tags_text', __('Tags: ', 'volatyl'));
$more_link_text = apply_filters('more_link_text', __('Read More', 'volatyl') . ' &rarr;');
$feed_post_page_nav = apply_filters('feed_post_page_nav', __('Pages: ', 'volatyl')); ?>

<article id="post-<?php echo the_ID(); ?>" <?php post_class(); ?>>	
	<?php
		// vol_before_article_header hook
		vol_before_article_header_main_output();
	?>	
	<header class="entry-header"> 		
		<?php the_title('<h1 class="entry-title"><a href="' . esc_url(get_permalink()) . '" title="' . esc_attr(the_title_attribute('echo=0')) . '" rel="bookmark">', '</a></h1>'); ?>
		<?php			
			// display meta info
			if ('post' == get_post_type()) { 
				if (vol_has_byline_items()) { ?>
					<div class="entry-meta"> 
						<?php volatyl_post_meta(); ?>
					</div> 
					<?php
				}
			}
		?>		
	</header> 	
	<?php 
			
	// vol_after_article_header hook
	vol_after_article_header_main_output();
	
	// Activate Featured Images
	if (vol_archive_featured_image_on()) { 

		// If Featured Image is set for a post, show thumbnail.
		if (has_post_thumbnail()) { ?>		
			<a class="featured-img-anchor" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
				<?php
					the_post_thumbnail('post-thumbnail', array(
						'class'	=> 'featured-img', 
						'alt'	=> the_title_attribute('echo=0') 
					));
				?>
			</a>
			<?php
		}
	}

	// Only display Excerpts for Search or Home if options is selected
	if (is_search() || vol_excerpt_on()) { ?>
	
		<section class="entry-summary"> 
			<?php the_excerpt(); ?>
		</section> 
		<?php

	} else { // Otherwise, show full article ?>
	
		<section class="entry-content">		
			<?php 
				// display content
				the_content($more_link_text);
		
				// Navigate paginated posts
				wp_link_pages(array('before' => '<nav class="page-links">' . $feed_post_page_nav, 'after' => '</nav>'));
		
				// Show feed tags
				if (vol_archive_tags_on()) {
					the_tags('<div class="entry-meta tags">' . $feed_tags_text, ', ', '<br /></div>');
				}
			?>				
		</section>
		
	<?php } ?>
</article>