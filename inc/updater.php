<?php
/** updater.php
 *
 ***** THIS IS A CORE VOLATYL FILE AND SHOULD NOT BE EDITED!
 ***** ALL CUSTOM CODING SHOULD BE DONE IN A CHILD THEME.
 ***** MORE INFORMATION - http://volatylthemes.com/why-child-themes/
 *******************************************************************
 *
 * Handle the license key activation and deactivation remotely
 *
 * Also perform automatic updates on installs with valid licenses
 *
 * This updater was created by the talented Pippin Williamson
 * of Pippin's Plugins. He deserves the credit.
 *
 * Easy Digital Downloads
 * https://easydigitaldownloads.com?ref=184
 *
 * @package Volatyl
 * @since Volatyl 1.0
 */

define('VOL_STORE_URL', 'http://volatylthemes.com');
define('VOL_DOWNLOAD_NAME', 'Volatyl Framework');

/** The Volatyl updater
 *
 * @since Volatyl 1.0
 */
$test_license = trim(get_option('vol_license_key'));

$vol_updater = new VOL_Updater(array(
		'remote_api_url' 	=> VOL_STORE_URL, 
		'version' 			=> '1.0', 
		'license' 			=> $test_license,
		'item_name' 		=> VOL_DOWNLOAD_NAME,
		'author'			=> 'Sean Davis'
	)
);


/** Activate the license key
 *
 * @since Volatyl 1.0
 */
function vol_activate_license() {

	if(isset($_POST['vol_license_activate'])) { 
	 	if(!check_admin_referer('vol_nonce', 'vol_nonce')) 	
			return; // get out if we didn't click the Activate button

		global $wp_version;
		$license = trim(get_option('vol_license_key'));
		$api_params = array(
			'edd_action' => 'activate_license', 
			'license' => $license, 
			'item_name' => urlencode(VOL_DOWNLOAD_NAME) 
		);
		
		$response = wp_remote_get(add_query_arg($api_params, VOL_STORE_URL), array(
			'timeout' => 15, 
			'sslverify' => false 
		));

		if (is_wp_error($response))
			return false;

		$license_data = json_decode(wp_remote_retrieve_body($response));
		
		// $license_data->license will be either "active" or "inactive"
		update_option('vol_license_key_status', $license_data->license);

	}
}
add_action('admin_init', 'vol_activate_license');


/** Deactivate the license key
 *
 * @since Volatyl 1.0
 */
function vol_deactivate_license() {

	// listen for our activate button to be clicked
	if(isset($_POST['vol_license_deactivate'])) {

		// run a quick security check 
	 	if(!check_admin_referer('vol_nonce', 'vol_nonce')) 	
			return; // get out if we didn't click the Activate button

		// retrieve the license from the database
		$license = trim(get_option('vol_license_key'));

		// data to send in our API request
		$api_params = array(
			'edd_action'=> 'deactivate_license', 
			'license' 	=> $license, 
			'item_name' => urlencode(VOL_DOWNLOAD_NAME)
		);
		
		// Call the custom API.
		$response = wp_remote_get(add_query_arg($api_params, VOL_STORE_URL), array(
			'timeout' => 15, 
			'sslverify' => false 
		));

		// make sure the response came back okay
		if (is_wp_error($response))
			return false;

		// decode the license data
		$license_data = json_decode(wp_remote_retrieve_body($response));
		
		// $license_data->license will be either "deactivated" or "failed"
		if($license_data->license == 'deactivated')
			delete_option('vol_license_key');
	}
}
add_action('admin_init', 'vol_deactivate_license');


/** Check to see if the license is valid
 *
 * @since Volatyl 1.0
 */
function vol_check_license() {
	global $wp_version;
	$license = trim(get_option('vol_license_key'));
	$api_params = array(
		'edd_action' => 'check_license', 
		'license' => $license, 
		'item_name' => urlencode(VOL_DOWNLOAD_NAME) 
	);
	
	$response = wp_remote_get(add_query_arg($api_params, VOL_STORE_URL), array(
		'timeout' => 15, 
		'sslverify' => false 
	));

	if (is_wp_error($response))
		return false;
	$license_data = json_decode(wp_remote_retrieve_body($response));
	if($license_data->license == 'valid') {
		echo 'valid'; 
		exit;
		// this license is still valid
	} else {
		echo 'invalid'; 
		exit;
		// this license is no longer valid
	}
}


/** Volatyl updater class
 *
 * @since Volatyl 1.0
 */
class VOL_Updater {
	private $remote_api_url;
	private $request_data;
	private $response_key;
	private $theme_slug;
	private $license_key;
	private $version;
	private $author;

	function __construct($args = array()) {
		$args = wp_parse_args($args, array(
			'remote_api_url' => 'http://easydigitaldownloads.com',
			'request_data'   => array(),
			'theme_slug'     => get_template(),
			'item_name'      => '',
			'license'        => '',
			'version'        => '',
			'author'         => ''
		));
		extract($args);

		$this->license        = $license;
		$this->item_name      = $item_name;
		$this->version        = $version;
		$this->theme_slug     = sanitize_key($theme_slug);
		$this->author         = $author;
		$this->remote_api_url = $remote_api_url;
		$this->response_key   = $this->theme_slug . '-update-response';

		add_filter('site_transient_update_themes', array(&$this, 'theme_update_transient'));
		add_filter('delete_site_transient_update_themes', array(&$this, 'delete_theme_update_transient'));
		add_action('load-update-core.php', array(&$this, 'delete_theme_update_transient'));
		add_action('load-themes.php', array(&$this, 'delete_theme_update_transient'));
		add_action('load-themes.php', array(&$this, 'load_themes_screen'));
	}

	function load_themes_screen() {
		add_thickbox();
		add_action('admin_notices', array(&$this, 'update_nag'));
	}

	function update_nag() {
		$theme = wp_get_theme($this->theme_slug);

		$api_response = get_transient($this->response_key);

		if(false === $api_response)
			return;

		$update_url = wp_nonce_url('update.php?action=upgrade-theme&amp;theme=' . urlencode($this->theme_slug), 'upgrade-theme_' . $this->theme_slug);
		$update_onclick = ' onclick="if (confirm(\'' . esc_js(__("Updating Volatyl will not erase any customizations you have made to a child theme. However, if you wrongly made changes to Volatyl, those changes will be overwritten. 'Cancel' to stop, 'OK' to update.")) . '\')) {return true;}return false;"';

		if (version_compare($theme->get('Version'), $api_response->new_version, '<')) {

			echo '<div id="update-nag">';
				printf('<strong>%1$s %2$s</strong> is available. <a href="%3$s" class="thickbox" title="%4s"><strong>READ THE CHANGE LOG</strong></a> first and then <a href="%5$s"%6$s>update</a>. <strong>Always</strong> backup first!',
					$theme->get('Name'),
					$api_response->new_version,
					'#TB_inline?width=640&amp;inlineId=' . $this->theme_slug . '_changelog',
					$theme->get('Name'),
					$update_url,
					$update_onclick
				);
			echo '</div>';
			echo '<div id="' . $this->theme_slug . '_' . 'changelog" style="display:none;">';
				echo wpautop($api_response->sections['changelog']);
			echo '</div>';
		}
	}

	function theme_update_transient($value) {
		$update_data = $this->check_for_update();
		if ($update_data) {
			$value->response[$this->theme_slug] = $update_data;
		}
		return $value;
	}

	function delete_theme_update_transient() {
		delete_transient($this->response_key);
	}

	function check_for_update() {
		$theme = wp_get_theme($this->theme_slug);
		$update_data = get_transient($this->response_key);
		if (false === $update_data) {
			$failed = false;

			$api_params = array(
				'edd_action' 	=> 'get_version',
				'license' 		=> $this->license,
				'name' 			=> $this->item_name,
				'slug' 			=> $this->theme_slug,
				'author'		=> $this->author
			);

			$response = wp_remote_post($this->remote_api_url, array(
				'timeout' => 15, 
				'sslverify' => false, 
				'body' => $api_params 
			));

			// make sure the response was successful
			if (is_wp_error($response) || 200 != wp_remote_retrieve_response_code($response)) {
				$failed = true;
			}

			$update_data = json_decode(wp_remote_retrieve_body($response));

			if (!is_object($update_data)) {
				$failed = true;
			}

			// if the response failed, try again in 30 minutes
			if ($failed) {
				$data = new stdClass;
				$data->new_version = $theme->get('Version');
				set_transient($this->response_key, $data, strtotime('+30 minutes'));
				return false;
			}

			// if the status is 'ok', return the update arguments
			if (!$failed) {
				$update_data->sections = maybe_unserialize($update_data->sections);
				set_transient($this->response_key, $update_data, strtotime('+12 hours'));
			}
		}

		if (version_compare($theme->get('Version'), $update_data->new_version, '>=')) {
			return false;
		}
		return (array) $update_data;
	}
}