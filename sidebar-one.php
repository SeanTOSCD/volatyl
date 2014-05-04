<?php
/** sidebar-one.php
 *
 ***** THIS IS A CORE VOLATYL FILE AND SHOULD NOT BE EDITED!
 ***** ALL CUSTOM CODING SHOULD BE DONE IN A CHILD THEME.
 ***** MORE INFORMATION - http://volatylthemes.com/why-child-themes/
 *******************************************************************
 *
 * Sidebar 1 containing widget area and hooks
 *
 * @package Volatyl
 * @since Volatyl 1.0
 */
global $options_hooks, $new_sidebars;
$options_hooks = get_option('vol_hooks_options');
?>

<div id="sidebars" class="widget-area sidebar-1 border-box">
	<?php
		// vol_before_sidebar_1 hook
		vol_before_sidebar_1_output();
		
		// Display Sidebar 1 only if there is no post/page specific sidebar with content
		$singular_sidebar_1 = get_post_meta($post->ID, '_create-sidebar-1', true);
		if ('' !== $singular_sidebar_1 || 0 !== $singular_sidebar_1) {
			if (!dynamic_sidebar('sidebar-1-' . $post->ID)) {
				if (!dynamic_sidebar('sidebar-1')) {
					vol_default_widget();
				}
			}
		} else {
			if (!dynamic_sidebar('sidebar-1')) {
				vol_default_widget();
			}
		}
		
		// vol_after_sidebar_1 hook
		vol_after_sidebar_1_output();
	?>
</div>