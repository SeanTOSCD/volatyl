<?php
/** content-page.php
 *
 ***** THIS IS A CORE VOLATYL FILE AND SHOULD NOT BE EDITED!
 ***** ALL CUSTOM CODING SHOULD BE DONE IN A CHILD THEME.
 ***** MORE INFORMATION - http://volatylthemes.com/why-child-themes/
 *******************************************************************
 *
 * Pages use this template to output Page content. To override this
 * template in a child theme, copy this file into the root/templates folder
 * of your child theme and make ADJUSTMENTS there. Use this file as a starting
 * point so you don't lose any variables, constants, etc.
 *
 * This template covers the basic Page <article> and associated
 * hooks and navigation. Landing, squeeze, and other custom Pages
 * have their own templates names custom-tamplate-name.php in the
 * root of the Volatyl folder.
 *
 * @package Volatyl
 * @since Volatyl 1.0
 */
$da_title_or_no = get_post_meta($post->ID, '_singular-title', true);

// Custom filter
$page_page_nav = apply_filters('page_page_nav', __('Pages:', 'volatyl')); ?>

<article id="post-<?php echo the_ID(); ?>" <?php post_class(); ?>>
	<?php if (0 == $da_title_or_no) { ?>
		<header class="entry-header">
			<?php the_title('<h1 class="entry-title">', '</h1>'); ?>
		</header>
	<?php } ?>
	<section class="entry-content">	
		<?php 
			// display page content
			the_content(); 
				
			// internal page navigation
			wp_link_pages(array('before' => '<nav class="page-links post-meta-footer">' . $page_page_nav, 'after' => '</nav>'));
			
			// page comments
			if (vol_page_comments_on()) {
				if (comments_open() || '0' != get_comments_number()) {
					comments_template('', true);
				}
			}
		?>
	</section>
</article>