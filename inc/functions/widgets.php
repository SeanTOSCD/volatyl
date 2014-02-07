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
function vol_widgets_init() {
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
		'description'   => __('In all layouts including two sidebars, this will be the rightmost sidebar (secondary).', 'volatyl'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' 	=> '</aside>',
		'before_title' 	=> '<h4 class="widget-title">',
		'after_title' 	=> '</h4>',
	));
		
	// Fat (widgetized) footer
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
add_action('widgets_init', 'vol_widgets_init', 10);

// Default widget when no widgets are present in a widgetized area
if (!function_exists('vol_default_widget')) {
	function vol_default_widget() {
		$options_content = get_option('vol_content_options');
		
		// Only show when selection is made in the options
		if ($options_content['widgets'] == 1) : ?>
			<aside class="widget default-widget">
				<h4 class="widget-title">
					<?php _e('Default Widget', 'volatyl'); ?>
				</h4>
				<p><?php _e('This is a widget placeholder. You have a widgetized area activated with no assigned widgets. Add widgets in the ', 'volatyl'); ?><a href="<?php echo admin_url('/widgets.php'); ?>"><?php _e('widgets page', 'volatyl'); ?></a><?php _e(' of your WordPress dashboard.', 'volatyl'); ?></p>
			</aside>
		<?php
		endif;
	}
}


/** Body class by fat footer use
 *
 * Add specific CSS class by filter for fat footer usage.
 * Based on the added class, the appropriate CSS will be used in style.css
 *
 * @since Volatyl 1.0
 */
function vol_fat_footer_body_class($classes) {
	
// add class name to the $classes array based on conditions
if ((is_active_sidebar('footer-left') && !is_active_sidebar('footer-middle') && !is_active_sidebar('footer-right')) ||
	(!is_active_sidebar('footer-left') && is_active_sidebar('footer-middle') && !is_active_sidebar('footer-right')) ||
	(!is_active_sidebar('footer-left') && !is_active_sidebar('footer-middle') && is_active_sidebar('footer-right')))
	$classes[] = "one-footer-col";
elseif ((is_active_sidebar('footer-left') && is_active_sidebar('footer-middle') && !is_active_sidebar('footer-right')) ||
	(is_active_sidebar('footer-left') && !is_active_sidebar('footer-middle') && is_active_sidebar('footer-right')) ||
	(!is_active_sidebar('footer-left') && is_active_sidebar('footer-middle') && is_active_sidebar('footer-right')))
	$classes[] = "two-footer-col";
elseif ((is_active_sidebar('footer-left') && is_active_sidebar('footer-middle') && is_active_sidebar('footer-right')))
	$classes[] = "three-footer-col";
	
	// return the $classes array
	return $classes;
}
add_filter('body_class', 'vol_fat_footer_body_class');