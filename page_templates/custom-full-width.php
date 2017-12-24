<?php
/** Template Name: Full-width Page
 *
 ***** THIS IS A CORE VOLATYL FILE AND SHOULD NOT BE EDITED!
 ***** ALL CUSTOM CODING SHOULD BE DONE IN A CHILD THEME.
 ***** MORE INFORMATION - http://volatylthemes.com/why-child-themes/
 *******************************************************************
 *
 * This is a basic full-width page template. Your complete header,
 * footer, branding, and navigation menus remain in place. All that
 * happens is the content column spans the full width of the site.
 *
 * @package Volatyl
 * @since Volatyl 2.0
 */
$options = get_option( 'vol_hooks_options' );

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
