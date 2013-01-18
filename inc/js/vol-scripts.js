/** vol-scripts.js
 *
 * All basic JS scripts for Volatyl.
 *
 * @since Volatyl 1.0
 */
 
// Remove HTML elements if they are empty
jQuery( document ).ready( function( $ ) {
	
	// Standard Menu
	$('nav.standard-navigation:empty').parent().remove();
		$('div#menu-area-header:empty').remove();

	// Headliner
	$('div#headliner:empty').parent().remove();
		$('div#headliner-area:empty').remove();
	
	// Footliner
	$('div#footliner:empty').parent().remove();
		$('div#footliner-area:empty').remove();
	
	// Footer Menu
	$('nav.footer-navigation:empty').parent().remove();
		$('div#menu-area-footer:empty').remove();
	
	// Site Information (copyright & attribution)
	$('div.site-info:empty').remove();
} );