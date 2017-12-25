<?php
/** taxonomy-download_category.php
 *
 ***** THIS IS A CORE VOLATYL FILE AND SHOULD NOT BE EDITED!
 ***** ALL CUSTOM CODING SHOULD BE DONE IN A CHILD THEME.
 ***** MORE INFORMATION - http://volatylthemes.com/why-child-themes/
 *******************************************************************
 *
 * The purpose of this template is to display download category archives as if
 * the [downloads] shortcode was being used. That way any style changes
 * applied to the [downloads] shortcode should apply here as well.
 *
 * @package Volatyl
 * @since Volatyl 1.2.2.2
 */
get_header();
vol_html_before_content();

// build the container for the main content area based on HTML structure setting
// call vol_content() from loops.php to build the content column
if ( vol_is_full_width() ) : ?>

	<div id="main-content" class="full clearfix">
		<div class="main clearfix">
			<?php vol_content(); ?>
		</div>
	</div>

<?php else : ?>

	<div id="main-content" class="clearfix">
		<?php vol_content(); ?>
	</div>

<?php endif;

vol_html_after_content();
get_footer();