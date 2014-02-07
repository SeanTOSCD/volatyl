<?php
/** Template Name: Squeeze Page
 *
 ***** THIS IS A CORE VOLATYL FILE AND SHOULD NOT BE EDITED!
 ***** ALL CUSTOM CODING SHOULD BE DONE IN A CHILD THEME.
 ***** MORE INFORMATION - http://volatylthemes.com/why-child-themes/
 *******************************************************************
 *
 * This template is almost pointless... except that it's not.
 * A squeeze page typically serves ONE purpose. That purpose
 * is whatever you want it to be. Most people collect email
 * addresses or show a video. Something simple.
 *
 * There are no exit links form this page. Header, footer, 
 * sidebars, etc... they're all gone. Set your title and your
 * content. That's all you've got to work with. 
 *
 * @package Volatyl
 * @since Volatyl 1.0
 */
$options_structure = get_option('vol_structure_options');

// header.php
get_header();

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

// footer.php
get_footer();