<?php 
/** edd-functions.php
 *
 ***** THIS IS A CORE VOLATYL FILE AND SHOULD NOT BE EDITED!
 ***** ALL CUSTOM CODING SHOULD BE DONE IN A CHILD THEME.
 ***** MORE INFORMATION - http://volatylthemes.com/why-child-themes/
 *******************************************************************
 *
 * Various functions pertaining to Easy Digital Downloads
 *
 * @package Volatyl
 * @since Volatyl 1.0
 */
global $download_id;

	
// No purchase button below download content
remove_action( 'edd_after_download_content', 'edd_append_purchase_link' );


// Remove all EDD styling
if ( get_theme_mod( 'volatyl_disable_edd_styles', 0 ) ) {
	remove_action( 'wp_enqueue_scripts', 'edd_register_styles' );
}
	

// Allow comments on downloads
function vol_edd_add_comments_support($supports) {
	$supports[] = 'comments';
	return $supports;	
}
add_filter('edd_download_supports', 'vol_edd_add_comments_support');


// Item info above sidebar on single download items
function vol_download_item_before_sidebar() { ?>		
	<div class="item-info-wrapper">
		<div class="edd-sidebar-price">
			<?php vol_edd_item_price_template(); ?>
		</div>	
		<div class="edd_download_buy_button">
			<?php echo edd_get_purchase_link( array( 'id' => get_the_ID() ) ); ?>
		</div>
	</div>
<?php }


// Item pricing information
function vol_edd_item_price_template() { 	

	// custom filters 
	$item_info = apply_filters('item_info', array(
		'price'				=> __('Price:', 'volatyl'),
		'starting_price'	=> __('Starting at:', 'volatyl'),
		'free'				=> __('Free', 'volatyl')
	));
	
	if (edd_has_variable_prices(get_the_ID())) {

		// if the download has variable prices,
		// show the first one as a starting price
		echo $item_info['starting_price'] . ' '; 
		edd_price(get_the_ID());
	} elseif ('0' != edd_get_download_price(get_the_ID()) && !edd_has_variable_prices( get_the_ID())) {
		echo $item_info['price'] . ' '; 
		edd_price(get_the_ID()); 
	} else {
		echo $item_info['free'] . ' ';
	}
}