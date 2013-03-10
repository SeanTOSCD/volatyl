<?php
/** logo-uploader.php
 *
 ***** THIS IS A CORE VOLATYL FILE AND SHOULD NOT BE EDITED!
 ***** ALL CUSTOM CODING SHOULD BE DONE IN A CHILD THEME.
 ***** MORE INFORMATION - http://volatylthemes.com/why-child-themes/
 *******************************************************************
 *
 * Use the built-in WordPress media uploader in the Volatyl content
 * settings to upload a header logo.
 *
 * Once uploaded, create function to delete logo
 *
 * @package Volatyl
 * @since Volatyl 1.0
 */ 

// Upload logo
function vol_logo_options_setup() {
	global $pagenow;
	
	if ('media-upload.php' == $pagenow || 'async-upload.php' == $pagenow)
	
		// Now we'll replace the 'Insert into Post Button' inside Thickbox
		add_filter('gettext', 'vol_replace_thickbox_text'  , 1, 3);
}
add_action('admin_init', 'vol_logo_options_setup');

function vol_replace_thickbox_text($translated_text, $text, $domain) {
	if ('Insert into Post' == $text) {
		$referer = strpos(wp_get_referer(), 'volatyl_options');
		
		if ($referer != '')
			return __('Use my sweet new logo!', 'volatyl');
	}
	return $translated_text;
}

// Delete logo
function vol_delete_image($image_url) {
	global $wpdb;
	
	// We need to get the image's meta ID.
	$query = "SELECT ID FROM wp_posts where guid = '" . esc_url($image_url) . "' AND post_type = 'attachment'";
	$results = $wpdb->get_results($query);
	
	// And delete it
	foreach ($results as $row) {
		wp_delete_attachment($row->ID);
	}
}