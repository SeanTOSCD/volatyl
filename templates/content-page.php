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
global $options;
$options = get_option('vol_content_options');

// Custom filter
$page_page_nav = apply_filters('page_page_nav', 'Pages:'); ?>

<article id="post-<?php echo the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</header>
	<section class="entry-content">
	
		<?php 
		// display page content
		the_content(); 
			
		// internal page navigation
		wp_link_pages(array('before' => '<nav class="page-links post-meta-footer">' . __($page_page_nav, 'volatyl'), 'after' => '</nav>'));
		
		// page comments
		if ($options['pagecomments'] == 1)
			((comments_open() || '0' != get_comments_number()) ? comments_template('', true) : ''); ?>
		
	</section>
</article>