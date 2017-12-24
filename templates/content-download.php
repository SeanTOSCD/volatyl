<?php
/** content-download.php
 *
 ***** THIS IS A CORE VOLATYL FILE AND SHOULD NOT BE EDITED!
 ***** ALL CUSTOM CODING SHOULD BE DONE IN A CHILD THEME.
 ***** MORE INFORMATION - http://volatylthemes.com/why-child-themes/
 *******************************************************************
 *
 * Downloads use this template to output content. To override this
 * template in a child theme, copy this file into the root/templates folder
 * of your child theme and make ADJUSTMENTS there. Use this file as a starting
 * point so you don't lose any variables, constants, etc.
 *
 * @package Volatyl
 * @since Volatyl 1.2
 */
global $options;

// Custom filters
$single_tags_text = apply_filters('single_tags_text', __('Tags: ', 'volatyl')); ?>

<article id="post-<?php echo the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title('<h1 class="entry-title">', '</h1>'); ?>
	</header>		
	<?php 
		// Download item Featured Image
		the_post_thumbnail('full', array(
			'class'	=> 'featured-img download-img', 
			'alt'	=> the_title_attribute('echo=0') 
		));
	?>	
	<section class="entry-content">	
		<?php 
			// display download content
			the_content();
	
			// Show feed tags
			if (vol_single_tags_on()) {
				the_tags('<div class="entry-meta tags post-meta-footer">' . $single_tags_text, ', ', '<br /></div>');
			}
			
			// Only show comments if option is turned on
			if (vol_download_comments_on()) {
				if (comments_open() || '0' != get_comments_number()) {
					comments_template('', true);
				}
			}		
		?>
	</section>
</article>