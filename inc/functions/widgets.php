<?php 
/** widgets.php
 *
 ***** THIS IS A CORE VOLATYL FILE AND SHOULD NOT BE EDITED!
 ***** ALL CUSTOM CODING SHOULD BE DONE IN A CHILD THEME.
 ***** MORE INFORMATION - http://volatylthemes.com/why-child-themes/
 *******************************************************************
 *
 * Register Volatyl widgetized areas
 *
 * @package Volatyl
 * @since Volatyl 1.0
 */

// Register widgetized areas and update sidebar with default widgets
function volatyl_widgets_init() {
	register_sidebar( array(
		'name' 			=> __( 'Sidebar 1', 'volatyl' ),
		'id' 			=> 'sidebar-1',
		'description'   => __( 'Primary sidebar: On 1-column layouts, this sidebar will show. On 2-column layouts, this sidebar will be furthest to the left.', 'volatyl' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' 	=> '</aside>',
		'before_title' 	=> '<h3 class="widget-title">',
		'after_title' 	=> '</h3>',
	) );
	register_sidebar( array(
		'name' 			=> __( 'Sidebar 2', 'volatyl' ),
		'id' 			=> 'sidebar-2',
		'description'   => __( 'Secondary sidebar: On 1-column layouts, this sidebar will not show. On 2-column layouts, this sidebar will be furthest to the right.', 'volatyl' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' 	=> '</aside>',
		'before_title' 	=> '<h3 class="widget-title">',
		'after_title' 	=> '</h3>',
	) );
		
	// Fat footer (widgetized)
	$options = get_option( 'vol_content_options' );
	if ( $options[ 'fatfooter' ] == 1 ) {
		register_sidebar( array(
			'name' 			=> __( 'Footer Left', 'volatyl' ),
			'id' 			=> 'footer-left',
			'description'   => __( 'Far left footer widget', 'volatyl' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' 	=> '</aside>',
			'before_title' 	=> '<h3 class="widget-title">',
			'after_title' 	=> '</h3>',
		) );
		register_sidebar( array(
			'name' 			=> __( 'Footer Middle', 'volatyl' ),
			'id' 			=> 'footer-middle',
			'description'   => __( 'Middle footer widget', 'volatyl' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' 	=> '</aside>',
			'before_title' 	=> '<h3 class="widget-title">',
			'after_title' 	=> '</h3>',
		) );
		register_sidebar( array(
			'name' 			=> __( 'Footer Right', 'volatyl' ),
			'id' 			=> 'footer-right',
			'description'   => __( 'Far right footer widget', 'volatyl' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' 	=> '</aside>',
			'before_title' 	=> '<h3 class="widget-title">',
			'after_title' 	=> '</h3>',
		) );
	}
}
add_action( 'widgets_init', 'volatyl_widgets_init' );


// Default widget when no widgets are present in a widgetized area
function default_widget() {
	$options_content = get_option( 'vol_content_options' );
	
	// Only show when selection is made in the options
	echo 	( ( $options_content[ 'widgets' ] == 1 ) ?
			"\t<aside class=\"widget\">\n
			\t\t<h3 class=\"widget-title\">\n". 
			__( 'Default Widget', 'volatyl' ). 
			"\t\t</h3>\n
			\t\t<p>" . __( 'This is a widget placeholder. You have a widgetized area activated with no assigned widgets. Add widgets in the <a href="wp-admin/widgets.php">widgets page</a> of your WordPress dashboard.', 'volatyl' ) . "</p>\n
			\t</aside>\n" : '' );
}