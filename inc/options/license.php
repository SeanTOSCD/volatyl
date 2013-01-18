<?php
/** license.php
 *
 * Handles the license key settings
 * 
 * @since Volatyl 1.0
 */


/** Activate license key
 *
 * @since Volatyl 1.0
 */
function volatyl_activate_license() {

	if( isset( $_POST['volatyl_license_activate'] ) ) { 
	 	if( ! check_admin_referer( 'vol_lic_nonce', 'vol_lic_nonce' ) ) 	
			return; // get out if we didn't click the Activate button

		global $wp_version;

		$license = trim( get_option( 'volatyl_license_key' ) );
				
		$api_params = array( 
			'edd_action' => 'activate_license', 
			'license' => $license, 
			'item_name' => urlencode( VOL_DL_THEME_NAME ) 
		);
		
		$response = wp_remote_get( add_query_arg( $api_params, VOL_STORE_URL ), array( 'timeout' => 15, 'sslverify' => false ) );

		if ( is_wp_error( $response ) )
			return false;

		$license_data = json_decode( wp_remote_retrieve_body( $response ) );
		
		// $license_data->license will be either "active" or "inactive"

		update_option( 'volatyl_license_key_status', $license_data->license );

	}
}
add_action('admin_init', 'volatyl_activate_license');


/** Deactivate license key
 *
 * @since Volatyl 1.0
 */
function volatyl_deactivate_license() {

	// listen for our activate button to be clicked
	if( isset( $_POST['volatyl_license_deactivate'] ) ) {

		// run a quick security check 
	 	if( ! check_admin_referer( 'vol_lic_nonce', 'vol_lic_nonce' ) ) 	
			return; // get out if we didn't click the Activate button

		// retrieve the license from the database
		$license = trim( get_option( 'volatyl_license_key' ) );
			

		// data to send in our API request
		$api_params = array( 
			'edd_action'=> 'deactivate_license', 
			'license' 	=> $license, 
			'item_name' => urlencode( VOL_DL_THEME_NAME ) // the name of our product in EDD
		);
		
		// Call the custom API.
		$response = wp_remote_get( add_query_arg( $api_params, VOL_STORE_URL ), array( 'timeout' => 15, 'sslverify' => false ) );

		// make sure the response came back okay
		if ( is_wp_error( $response ) )
			return false;

		// decode the license data
		$license_data = json_decode( wp_remote_retrieve_body( $response ) );
		
		// $license_data->license will be either "deactivated" or "failed"
		if( $license_data->license == 'deactivated' )
			delete_option( 'volatyl_license_key' );

	}
}
add_action('admin_init', 'volatyl_deactivate_license');


/** Is the license valid?
 *
 * @since Volatyl 1.0
 */
function volatyl_check_license() {

	global $wp_version;

	$license = trim( get_option( 'volatyl_license_key' ) );
		
	$api_params = array( 
		'edd_action' => 'check_license', 
		'license' => $license, 
		'item_name' => urlencode( VOL_DL_THEME_NAME ) 
	);
	
	$response = wp_remote_get( add_query_arg( $api_params, VOL_STORE_URL ), array( 'timeout' => 15, 'sslverify' => false ) );

	if ( is_wp_error( $response ) )
		return false;

	$license_data = json_decode( wp_remote_retrieve_body( $response ) );

	if( $license_data->license == 'valid' ) {
		echo 'valid'; exit;
		// this license is still valid
	} else {
		echo 'invalid'; exit;
		// this license is no longer valid
	}
}