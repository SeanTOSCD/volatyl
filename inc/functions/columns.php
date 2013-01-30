<?php 
/** columns.php
 *
 ***** THIS IS A CORE VOLATYL FILE AND SHOULD NOT BE EDITED!
 ***** ALL CUSTOM CODING SHOULD BE DONE IN A CHILD THEME.
 ***** MORE INFORMATION - http://volatylthemes.com/why-child-themes/
 *******************************************************************
 *
 * Depending on the site layout selected, different elements need to
 * be loaded. The magic happens here. 
 *
 * @package Volatyl
 * @since Volatyl 1.0
 */


/** Column layouts
 *
 * Various column layouts are built into Volatyl and can be toggled
 * in the Structure Settings. Depending on which layout is selected,
 * the appropriate columns will be echod.
 *
 * @since Volatyl 1.0
 */
function vol_columns() {
	$options = get_option( 'vol_structure_options' );
	
	switch ( $options[ 'column' ] ) {
		case 'c1':
			vol_content();
			break;
		case 'c2':
			vol_content();
			printf( "\t\t<div id=\"sidebars-wrap\" class=\"clearfix\">\n" );
			get_sidebar( 'one' ); 
			get_sidebar( 'two' );
			printf( "\t\t</div>\n" );
			break;
		case 'cs':
		case 'sc':
			vol_content();
			get_sidebar( 'one' );
			break;
		case 'css':
		case 'ssc':
			vol_content();
			get_sidebar( 'one' );
			get_sidebar( 'two' );
			break;
		case 'scs':
			printf( "\t\t<div id=\"wrap\">\n" );
			vol_content(); 
			get_sidebar( 'one' );
			printf( "\t\t</div>\n" );
			get_sidebar( 'two' );
			break;
		case '':
			echo __( 'Error: Please select a column structure in the ', 'volatyl' ) . THEME_NAME .  __( ' Options.', 'volatyl' );
	}
}


/** Singular (posts, pages, and attachments) Column layouts
 *
 * The above vol_columns() structure can be overwritten on single posts & pages.
 * The "default" case, which is used if no selection is made for the singular
 * layout, jumps back to the main site layout switch statement.
 *
 * @since Volatyl 1.0
 */
function columns_singular() {
	global $post;
	$single_layout = get_post_meta( $post->ID, '_singular-column', true);
	
	switch ( $single_layout ) {
		case 'c1':
			vol_content();
			break;
		case 'c2':
			vol_content();
			printf( "\t\t<div id=\"sidebars-wrap\" class=\"clearfix\">\n" );
			get_sidebar( 'one' );
			get_sidebar( 'two' );
			printf( "\t\t</div>\n" );
			break;
		case 'cs':
		case 'sc':
			vol_content();
			get_sidebar( 'one' );
			break;
		case 'css':
		case 'ssc':
			vol_content(); 
			get_sidebar( 'one' ); 
			get_sidebar( 'two' );
			break;
		case 'scs':
			printf( "\t\t<div id=\"wrap\">\n" );
			vol_content();
			get_sidebar( 'one' );
			printf( "\t\t</div>\n" );
			get_sidebar( 'two' );
			break;
		default:
			
			// Back to main site layout options			
			vol_columns();
	}
}