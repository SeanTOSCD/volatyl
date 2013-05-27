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

echo "<div id=\"sidebars\" class=\"widget-area sidebar-1 border-box\">\n";

// vol_before_sidebar_1
if ($options_hooks['switch_vol_before_sidebar_1'] == 0) {
	if 	((is_home() && is_front_page() && $options_hooks['home_vol_before_sidebar_1'] == 0 && $options_hooks['front_vol_before_sidebar_1'] == 0) ||
		(is_home() && ! is_front_page() && $options_hooks['home_vol_before_sidebar_1'] == 0) ||
		(is_front_page() && ! is_home() && $options_hooks['front_vol_before_sidebar_1'] == 0) ||
		(is_single() && $options_hooks['posts_vol_before_sidebar_1'] == 0) ||
		(is_page() && ! is_front_page() && $options_hooks['pages_vol_before_sidebar_1'] == 0) ||
		(is_archive() && $options_hooks['archive_vol_before_sidebar_1'] == 0) ||
		(is_search() && $options_hooks['search_vol_before_sidebar_1'] == 0) ||
		(is_404() && $options_hooks['404_vol_before_sidebar_1'] == 0)) {
			vol_before_sidebar_1();
	} else {
		do_action('vol_before_sidebar_1');
	}
}

// Display Sidebar 1 only if there is no post/page specific sidebar with content
do_action('before_sidebar');
$singular_sidebar_1 = get_post_meta($post->ID, '_create-sidebar-1', true);
if ('' !== $singular_sidebar_1 || 0 !== $singular_sidebar_1) {
	((!dynamic_sidebar('sidebar-1-' . $post->ID)) ? 
		((!dynamic_sidebar('sidebar-1')) ? vol_default_widget() : '') : 
	'');
} else {
	((!dynamic_sidebar('sidebar-1')) ? vol_default_widget() : '');
}

// vol_after_sidebar_1
if ($options_hooks['switch_vol_after_sidebar_1'] == 0) {
	if 	((is_home() && is_front_page() && $options_hooks['home_vol_after_sidebar_1'] == 0 && $options_hooks['front_vol_after_sidebar_1'] == 0) ||
		(is_home() && ! is_front_page() && $options_hooks['home_vol_after_sidebar_1'] == 0) ||
		(is_front_page() && ! is_home() && $options_hooks['front_vol_after_sidebar_1'] == 0) ||
		(is_single() && $options_hooks['posts_vol_after_sidebar_1'] == 0) ||
		(is_page() && ! is_front_page() && $options_hooks['pages_vol_after_sidebar_1'] == 0) ||
		(is_archive() && $options_hooks['archive_vol_after_sidebar_1'] == 0) ||
		(is_search() && $options_hooks['search_vol_after_sidebar_1'] == 0) ||
		(is_404() && $options_hooks['404_vol_after_sidebar_1'] == 0)) {
			vol_after_sidebar_1();
	} else {
		do_action('vol_after_sidebar_1');
	}
}
echo "</div>";