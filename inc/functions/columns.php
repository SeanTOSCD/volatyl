<?php 
/** columns.php
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
		
			echo 	vol_content();
			break;
			
		case 'c2':
		
			echo 	vol_content(),
					"\t\t<div id=\"sidebars-wrap\" class=\"clearfix\">\n",
					get_sidebar( 'one' ), 
					get_sidebar( 'two' ),
					"\t\t</div>\n";
			break;
			
		case 'cs':
		case 'sc':
		
			echo 	vol_content(), 
					get_sidebar( 'one' );
			break;
			
		case 'css':
		case 'ssc':
		
			echo 	vol_content(), 
					get_sidebar( 'one' ), 
					get_sidebar( 'two' );
			break;
			
		case 'scs':
		
			echo 	"\t\t<div id=\"wrap\">\n",
					vol_content(), 
					get_sidebar( 'one' ),
					"\t\t</div>\n",
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
		
			echo 	vol_content();
			break;
			
		case 'c2':
		
			echo 	vol_content(),
					"\t\t<div id=\"sidebars-wrap\" class=\"clearfix\">\n",
					get_sidebar( 'one' ), 
					get_sidebar( 'two' ),
					"\t\t</div>\n";
			break;
			
		case 'cs':
		case 'sc':
		
			echo 	vol_content(), 
					get_sidebar( 'one' );
			break;
			
		case 'css':
		case 'ssc':
		
			echo 	vol_content(), 
					get_sidebar( 'one' ), 
					get_sidebar( 'two' );
			break;
			
		case 'scs':
		
			echo 	"\t\t<div id=\"wrap\">\n",
					vol_content(), 
					get_sidebar( 'one' ),
					"\t\t</div>\n",
					get_sidebar( 'two' );
			break;
			
		default:
			$options = get_option( 'vol_structure_options' );
			
			switch ( $options[ 'column' ] ) {
				case 'c1':
				
					echo 	vol_content();
					break;
			
				case 'c2':
				
					echo 	vol_content(),
							"\t\t<div id=\"sidebars-wrap\" class=\"clearfix\">\n",
							get_sidebar( 'one' ), 
							get_sidebar( 'two' ),
							"\t\t</div>\n";
					break;
			
				case 'cs':
				case 'sc':
				
					echo 	vol_content(), 
							get_sidebar( 'one' );
					break;
			
				case 'css':
				case 'ssc':
				
					echo 	vol_content(), 
							get_sidebar( 'one' ), 
							get_sidebar( 'two' );
					break;
			
				case 'scs':
				
					echo 	"\t\t<div id=\"wrap\">\n",
							vol_content(), 
							get_sidebar( 'one' ),
							"\t\t</div>\n",
							get_sidebar( 'two' );
					break;
			}
	}
}


/** Body class based on column structure
 *
 * Add specific CSS class by filter based on column layout option.
 * Based on the added class, the appropriate CSS will be used in style.css
 *
 * Also, do it based on singular, site default, etc. If there are no special
 * conditions, though, just use the site default (Structure Settings).
 *
 * @since Volatyl 1.0
 */
function layout_class( $classes ) {
	global $post;
	$options = get_option( 'vol_structure_options' );
	$single_layout = get_post_meta( $post->ID, '_singular-column', true);
	
	// add class name to the $classes array based on conditions
	if ( is_singular() ) {
	
		if ( 'default' == $single_layout || '' == $single_layout )
			$classes[] = $options[ 'column' ];
		else
			$classes[] = $single_layout;
		
	} else {
		
		$classes[] = $options[ 'column' ];
				
	}
	
	// return the $classes array
	return $classes;
}
add_filter( 'body_class', 'layout_class' );