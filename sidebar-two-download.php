<?php
/** sidebar-two-download.php
 *
 ***** THIS IS A CORE VOLATYL FILE AND SHOULD NOT BE EDITED!
 ***** ALL CUSTOM CODING SHOULD BE DONE IN A CHILD THEME.
 ***** MORE INFORMATION - http://volatylthemes.com/why-child-themes/
 *******************************************************************
 *
 * Download Sidebar 2 containing widget area and download item info
 *
 * @package Volatyl
 * @since Volatyl 1.2
 */
?>

<div id="sidebars" class="widget-area sidebar-2 download-sidebar border-box">
	<?php
		// Display Download Sidebar 2 only if there is no download-specific sidebar WITH content
		$singular_sidebar_2 = get_post_meta($post->ID, '_create-sidebar-2', true);
		if ('' !== $singular_sidebar_2 || 0 !== $singular_sidebar_2) {
			if (!dynamic_sidebar('sidebar-2-' . $post->ID)) {
				if (!dynamic_sidebar('download-sidebar-2')) {
					vol_default_widget();
				}
			}
		} else {
			if (!dynamic_sidebar('download-sidebar-2')) {
				vol_default_widget();
			}
		}
	?>
</div>