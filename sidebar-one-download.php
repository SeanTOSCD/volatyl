<?php
/** sidebar-one-download.php
 *
 ***** THIS IS A CORE VOLATYL FILE AND SHOULD NOT BE EDITED!
 ***** ALL CUSTOM CODING SHOULD BE DONE IN A CHILD THEME.
 ***** MORE INFORMATION - http://volatylthemes.com/why-child-themes/
 *******************************************************************
 *
 * Download Sidebar 1 containing widget area and download item info
 *
 * @package Volatyl
 * @since Volatyl 1.2
 */
?>

<div id="sidebars" class="widget-area sidebar-1 download-sidebar border-box">	
	<?php		
		// downloads sidebar item info - don't show on generic store pages
		if (!is_page_template('custom-store-page.php') && is_single()) {
			vol_download_item_before_sidebar();
		}
	
		// Display Download Sidebar 1 only if there is no download-specific sidebar WITH content
		$singular_sidebar_1 = get_post_meta($post->ID, '_create-sidebar-1', true);
		if ('' !== $singular_sidebar_1 || 0 !== $singular_sidebar_1) {
			if (!dynamic_sidebar('sidebar-1-' . $post->ID)){
				if (!dynamic_sidebar('download-sidebar-1')) {
					vol_default_widget();
				}
			}
		} else {
			if (!dynamic_sidebar('download-sidebar-1')) {
				vol_default_widget();
			}
		}
	?>
</div>