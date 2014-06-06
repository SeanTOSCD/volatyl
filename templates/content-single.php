<?php
/** content-single.php
 *
 ***** THIS IS A CORE VOLATYL FILE AND SHOULD NOT BE EDITED!
 ***** ALL CUSTOM CODING SHOULD BE DONE IN A CHILD THEME.
 ***** MORE INFORMATION - http://volatylthemes.com/why-child-themes/
 *******************************************************************
 *
 * Single posts use this template to output content. To override this
 * template in a child theme, copy this file into the root/templates folder
 * of your child theme and make ADJUSTMENTS there. Use this file as a starting
 * point so you don't lose any variables, constants, etc.
 *
 * This template covers the actual post <article> and associated
 * hooks and navigation.
 *
 * @package Volatyl
 * @since Volatyl 1.0
 */

// Custom filters
$post_page_nav = apply_filters('post_page_nav', __('Pages:', 'volatyl'));
$single_tags_text = apply_filters('single_tags_text', __('Tags: ', 'volatyl')); ?>

<article id="post-<?php echo the_ID(); ?>" <?php post_class(); ?>>
	<?php
		// vol_before_article_header hook
		vol_before_article_header_posts_output();
	?>	
	<header class="entry-header">
		<?php the_title('<h1 class="entry-title">', '</h1>'); ?>		
		<?php
			// post meta info
			if (vol_has_byline_items()) { ?>
				<div class="entry-meta">
					<?php volatyl_post_meta(); ?>
				</div>
				<?php 
			}
		?>
	</header>		
	<?php
		// vol_after_article_header hook
		vol_after_article_header_posts_output();
		 
		// Activate Featured Images
		if (vol_single_featured_image_on()) {
			the_post_thumbnail('full', array(
				'class'	=> 'featured-img', 
				'alt'	=> the_title_attribute('echo=0') 
			));
		}
	?>	
	<section class="entry-content">	
		<?php 
			// output post content
			the_content();
			
			// internal post navigation
			wp_link_pages(array('before' => '<nav class="page-links post-meta-footer">' . $post_page_nav, 'after' => '</nav>'));
	
			// Show feed tags
			if (vol_single_tags_on()) {
				the_tags('<div class="entry-meta tags post-meta-footer">' . $single_tags_text, ', ', '<br /></div>');
			}
		?>		
	</section>
</article>
<?php 

// vol_post_footer hook
vol_post_footer_output();

// post comments
if (comments_open() || '0' != get_comments_number()) {
	comments_template('', true);
}

// post navigation
volatyl_content_nav('nav-below');