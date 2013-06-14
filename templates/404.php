<?php
/** 404.php
 *
 ***** THIS IS A CORE VOLATYL FILE AND SHOULD NOT BE EDITED!
 ***** ALL CUSTOM CODING SHOULD BE DONE IN A CHILD THEME.
 ***** MORE INFORMATION - http://volatylthemes.com/why-child-themes/
 *******************************************************************
 *
 * 404 error pages use this template to output content. To override this
 * template in a child theme, copy this file into the root/templates folder
 * of your child theme and make ADJUSTMENTS there. Use this file as a starting
 * point so you don't lose any variables, constants, etc.
 *
 * @package Volatyl
 * @since Volatyl 1.0
 */

// Custom filters 
$error_404 = apply_filters('error_404_content', array(
	'error_title'	=> 'Oops! Looks like we have an error.',
	'error_content'	=> 'Use the search form and other tools below to find what you were looking for.'
)); ?>

<article id="post-0" class="post error404 not-found">
	<header class="entry-header">
		<h1 class="entry-title">
			<?php _e($error_404['error_title'], 'volatyl'); ?>
		</h1>
	</header>
	<section class="entry-content">
		<p>
			<?php _e($error_404['error_content'], 'volatyl'); ?>
		</p>
		
		<?php 
		// output search form
		get_search_form();
		
		// output recent posts and categories widgets
		the_widget('WP_Widget_Recent_Posts'); ?>
		
		<div class="widget">
			<h2 class="widgettitle">
				<?php _e('Most Used Categories', 'volatyl'); ?>
			</h2>
			<ul>
			
				<?php
				wp_list_categories(array(
					'orderby' 	=> 'count', 
					'order' 	=> 'DESC', 
					'title_li' 	=> '', 
					'number' 	=> 10, 
					'depth' 	=> -1, 
				)); ?>
			
			</ul>
		</div>
		
		<?php 
		// translators: %1$s: smilie
		$archive_content = '<p>' . sprintf(__('Try looking in the monthly archives. %1$s', 'volatyl'), convert_smilies(':)')) . '</p>';
		// output archives widget
		the_widget('WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$archive_content");
		
		// output tag cloud widget
		the_widget('WP_Widget_Tag_Cloud'); ?>
	</section>
</article>