<?php 
/** widgets.php
 *
 ***** THIS IS A CORE VOLATYL FILE AND SHOULD NOT BE EDITED!
 ***** ALL CUSTOM CODING SHOULD BE DONE IN A CHILD THEME.
 ***** MORE INFORMATION - http://volatylthemes.com/why-child-themes/
 *******************************************************************
 *
 * Register Volatyl widgetized areas (single post and page sidebars
 * are registered in the /inc/options/post-meta.php file)
 *
 * @package Volatyl
 * @since Volatyl 1.0
 */

// Register widgetized areas
function volatyl_widgets_init() {
	register_sidebar(array(
		'name' 			=> __('Standard Sidebar 1', 'volatyl'),
		'id' 			=> 'sidebar-1',
		'description'   => __('In all layouts including sidebars, this will be the leftmost sidebar (primary).', 'volatyl'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' 	=> '</aside>',
		'before_title' 	=> '<h4 class="widget-title">',
		'after_title' 	=> '</h4>',
	));
	register_sidebar(array(
		'name' 			=> __('Standard Sidebar 2', 'volatyl'),
		'id' 			=> 'sidebar-2',
		'description'   => __('In all layouts including sidebars, this will be the right most sidebar (secondary).', 'volatyl'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' 	=> '</aside>',
		'before_title' 	=> '<h4 class="widget-title">',
		'after_title' 	=> '</h4>',
	));
		
	// Fat (widgetized) footer
	$options = get_option('vol_content_options');
	if ($options['fatfooter'] == 1) {
		register_sidebar(array(
			'name' 			=> __('Footer Left', 'volatyl'),
			'id' 			=> 'footer-left',
			'description'   => __('Far left footer widget', 'volatyl'),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' 	=> '</aside>',
			'before_title' 	=> '<h4 class="widget-title">',
			'after_title' 	=> '</h4>',
		));
		register_sidebar(array(
			'name' 			=> __('Footer Middle', 'volatyl'),
			'id' 			=> 'footer-middle',
			'description'   => __('Middle footer widget', 'volatyl'),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' 	=> '</aside>',
			'before_title' 	=> '<h4 class="widget-title">',
			'after_title' 	=> '</h4>',
		));
		register_sidebar(array(
			'name' 			=> __('Footer Right', 'volatyl'),
			'id' 			=> 'footer-right',
			'description'   => __('Far right footer widget', 'volatyl'),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' 	=> '</aside>',
			'before_title' 	=> '<h4 class="widget-title">',
			'after_title' 	=> '</h4>',
		));
	}
}
add_action('widgets_init', 'volatyl_widgets_init', 10);

// Default widget when no widgets are present in a widgetized area
function default_widget() {
	$options_content = get_option('vol_content_options');
	
	// Only show when selection is made in the options
	echo (($options_content['widgets'] == 1) ?
		"\t<aside class=\"widget default-widget\">\n
		\t\t<h4 class=\"widget-title\">\n" .
		__('Default Widget', 'volatyl') . 
		"\t\t</h4>\n
		\t\t<p>" . __('This is a widget placeholder. You have a widgetized area activated with no assigned widgets. Add widgets in the <a href="' . admin_url('/widgets.php') . '">widgets page</a> of your WordPress dashboard.', 'volatyl') . "</p>\n
		\t</aside>\n" : 
	'');
}