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
global $options;
$options_posts = get_option('vol_content_options');

// Custom filters
$single_tags_text = apply_filters('single_tags_text', 'Tags: ');
$post_page_nav = apply_filters('post_page_nav', 'Pages:'); ?>

<article id="post-<?php echo the_ID(); ?>" <?php post_class(); ?>>

	<?php
	// vol_before_article_header
	(($options['switch_vol_before_article_header'] == 0) ?
		(($options['posts_vol_before_article_header'] == 0) ?
			vol_before_article_header() :
			do_action('vol_before_article_header')) :
	''); ?>
	
	<header class="entry-header">
		<h1 class="entry-title">
			<?php the_title(); ?>
		</h1>
		
		<?php
		// post meta info
		if ($options_posts['by-date-post'] == 1 || $options_posts['by-author-post'] == 1 || $options_posts['by-comments-post'] == 1 || $options_posts['by-edit-post'] == 1 || $options_posts['by-cats'] == 1) { ?>
			<div class="entry-meta">
				<?php volatyl_post_meta(); ?>
			</div>
		<?php } ?>

	</header>
		
	<?php // Activate Featured Images
	(($options_posts['singlefeaturedimage'] == 1) ?
		the_post_thumbnail('full', array(
			'class'	=> 'featured-img', 
			'alt'	=> the_title_attribute('echo=0') 
		)) :
	'');

	// vol_after_article_header
	(($options['switch_vol_after_article_header'] == 0) ?
		(($options['posts_vol_after_article_header'] == 0) ?
			vol_after_article_header() :
			do_action('vol_after_article_header')) :
	''); ?>
	
	<section class="entry-content">
	
		<?php 
		// output post content
		the_content();
		
		// internal post navigation
		wp_link_pages(array('before' => '<nav class="page-links post-meta-footer">' . __($post_page_nav, 'volatyl'), 'after' => '</nav>'));

		// Show feed tags
		(($options_posts['singletags'] == 1) ?
			the_tags('<div class="entry-meta tags post-meta-footer">' . __($single_tags_text, 'volatyl'), ', ', '<br /></div>') :
		''); ?>
		
	</section>
</article>

<?php 
// vol_post_footer
(($options['switch_vol_post_footer'] == 0) ?
	(($options['posts_vol_post_footer'] == 0) ?
		vol_post_footer() :
		do_action('vol_post_footer')) :
'');

// post comments
((comments_open() || '0' != get_comments_number()) ? comments_template('', true) : '');

// post navigation
volatyl_content_nav('nav-below');