<?php
/** Template Name: Landing Page
 *
 ***** THIS IS A CORE VOLATYL FILE AND SHOULD NOT BE EDITED!
 ***** ALL CUSTOM CODING SHOULD BE DONE IN A CHILD THEME.
 ***** MORE INFORMATION - http://volatylthemes.com/why-child-themes/
 *******************************************************************
 *
 * This is a custom landing page template. In conjunction with
 * the code in the header-html.php file, the entire .site-header
 * is stripped of everything BUT the logo and the vol_header_top
 * hook. That content becomes centered.
 *
 * No sidebars are included in this template and the content column,
 * as it stands alone, has a defined width. The footer is stripped
 * much like the header. The only remaining items are the attribution
 * and the vol_site_info hook.
 *
 * @package Volatyl
 * @since Volatyl 1.0
 */
$options_structure = get_option('vol_structure_options');

// header.php
get_header();

// inc/html/header-html.php
vol_header_frame();

// build the container for the main content area based on HTML structure setting
// call vol_content() from loops.php to build the content column
if ($options_structure['wide'] == 1) : ?>

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

// inc/html/footer-html.php
vol_footer_frame();

// footer.php
get_footer();