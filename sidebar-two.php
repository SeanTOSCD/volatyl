<?php
/** sidebar-two.php
 *
 ***** THIS IS A CORE VOLATYL FILE AND SHOULD NOT BE EDITED!
 ***** ALL CUSTOM CODING SHOULD BE DONE IN A CHILD THEME.
 ***** MORE INFORMATION - http://volatylthemes.com/why-child-themes/
 *******************************************************************
 *
 * Sidebar 2 containing widget area and hooks
 *
 * @package Volatyl
 * @since Volatyl 1.0
 */
global $options_hooks;
$options_hooks = get_option('vol_hooks_options');
?>

<div id="sidebars" class="widget-area sidebar-2 border-box">
	<?php
		// vol_before_sidebar_2 hook
		vol_before_sidebar_2_output();
		
		// Display Sidebar 2 only if there is no post/page specific sidebar with content
		$singular_sidebar_2 = get_post_meta($post->ID, '_create-sidebar-2', true);
		if ('' !== $singular_sidebar_2 || 0 !== $singular_sidebar_2) {
			if (!dynamic_sidebar('sidebar-2-' . $post->ID)) { 
				if (!dynamic_sidebar('sidebar-2')) {
					vol_default_widget();
				}
			}
		} else {
			if (!dynamic_sidebar('sidebar-2')) {
				vol_default_widget();
			}
		}
		
		// vol_after_sidebar_2 hook
		vol_after_sidebar_2_output();
	?>
</div>