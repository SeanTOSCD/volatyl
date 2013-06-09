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
$options = get_option('vol_content_options');	
$options_hooks = get_option('vol_hooks_options');

// Custom filters
$feed_tags_text = apply_filters('feed_tags_text', 'Tags: ');
$more_link_text = apply_filters('more_link_text', 'Read More &rarr;');
$feed_post_page_nav = apply_filters('feed_post_page_nav', 'Pages: '); ?>

<article id="post-<?php echo the_ID(); ?>" <?php post_class(); ?>>
	
	<?php
	// vol_before_article_header
	(($options_hooks['switch_vol_before_article_header'] == 0) ?
		(((is_home() && is_front_page() && $options_hooks['home_vol_before_article_header'] == 0 && $options_hooks['front_vol_before_article_header'] == 0) || (is_home() && ! is_front_page() && $options_hooks['home_vol_before_article_header'] == 0) || (is_front_page() && ! is_home() && $options_hooks['front_vol_before_article_header'] == 0)) ?
			vol_before_article_header() :
			do_action('vol_before_article_header')) :
	''); ?>
	
	<header class="entry-header"> 

		<?php 
		// show title if not an aside post format
		if (!has_post_format('aside')) { ?>
		
			<h1 class="entry-title">
				<a href="<?php the_permalink(); ?>" title="<?php esc_attr(sprintf(__('%s', 'volatyl'), the_title_attribute('echo=0'))); ?>" rel="bookmark"><?php _e(the_title(), 'volatyl'); ?>
				</a>
			</h1>
			
		<?php }
			
		// display meta info
		if ('post' == get_post_type()) { 
			if ($options['by-date-post'] == 1 || $options['by-author-post'] == 1 || $options['by-comments-post'] == 1 || $options['by-edit-post'] == 1 || $options['by-cats'] == 1) { ?>
			
				<div class="entry-meta"> 
					<?php volatyl_post_meta(); ?>
				</div> 
				
			<?php }
		} 
		
		// vol_after_article_header
		(($options_hooks['switch_vol_after_article_header'] == 0) ?
			(((is_home() && is_front_page() && $options_hooks['home_vol_after_article_header'] == 0 && $options_hooks['front_vol_after_article_header'] == 0) || 
			(is_home() && ! is_front_page() && $options_hooks['home_vol_after_article_header'] == 0) || 
			(is_front_page() && ! is_home() && $options_hooks['front_vol_after_article_header'] == 0)) ?
				vol_after_article_header() :
				do_action('vol_after_article_header')) :
		''); ?>
		
	</header> 
	
	<?php 
	// Activate Featured Images
	if ($options['feedfeaturedimage'] == 1) { 

		// If Featured Image is set for a post, show thumbnail.
		if (has_post_thumbnail()) { ?>
		
			<a class="featured-img-anchor" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
				<?php the_post_thumbnail('post-thumbnail', array(
					'class'	=> 'featured-img', 
					'alt'	=> the_title_attribute('echo=0') 
				)); ?>
			</a>
			
		<?php }
	}

	// Only display Excerpts for Search or Home if options is selected
	if (is_search() || $options['homeexcerpt'] == 1 && !has_post_format('aside')) { ?>
	
		<section class="entry-summary"> 
			<?php the_excerpt(); ?>
		</section> 
		
	<?php 
	} else { // Otherwise, show full article ?>
		<section class="entry-content">
		
			<?php 
			// display content
			the_content(__($more_link_text, 'volatyl'));
	
			// Navigate paginated posts
			wp_link_pages(array('before' => '<nav class="page-links">' . __($feed_post_page_nav, 'volatyl'), 'after' => '</nav>'));
	
			// Show feed tags
			if ($options['feedtags'] == 1 && !has_post_format('aside'))
				the_tags('<div class="entry-meta tags">' . __($feed_tags_text, 'volatyl'), ', ', '<br /></div>'); ?>
				
		</section>
	<?php } ?>
</article>