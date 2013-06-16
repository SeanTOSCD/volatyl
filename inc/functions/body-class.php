<?php
/** body-class.php
 *
 ***** THIS IS A CORE VOLATYL FILE AND SHOULD NOT BE EDITED!
 ***** ALL CUSTOM CODING SHOULD BE DONE IN A CHILD THEME.
 ***** MORE INFORMATION - http://volatylthemes.com/why-child-themes/
 *******************************************************************
 *
 * On various pages of your site, different body classes are needed
 * for styling purposes. That happens here. 
 *
 * @package Volatyl
 * @since Volatyl 1.0
 */

/** Body class by custom page template
 *
 * Add specific CSS class by filter for custom templated pages.
 * Based on the added class, the appropriate CSS will be used in style.css
 *
 * @since Volatyl 1.0
 */
function vol_page_template_body_class($classes) {
	
	// add class name to the $classes array based on conditions
	if (is_page_template('custom-landing.php'))
		$classes[] = "landing";
	elseif (is_page_template('custom-squeeze.php'))
		$classes[] = "squeeze";
	
	// return the $classes array
	return $classes;
}
add_filter('body_class', 'vol_page_template_body_class');


/** Body class based on column structure
 *
 * Add specific CSS class by filter based on column layout option.
 * Based on the added classes, the appropriate CSS will be used in style.css
 *
 * Also, do it based on singular, site default, etc. If there are no special
 * conditions, though, just use the site default (Structure Settings).
 *
 * @since Volatyl 1.0
 */
function vol_main_layout_class($classes) {
	global $post;
	$options = get_option('vol_structure_options');
	
	if (!is_404() && !is_search())
		$single_layout = get_post_meta($post->ID, '_singular-column', true);
	
	// add class name to the $classes array based on conditions
	if (is_singular()) {
		if ('default' == $single_layout || '' == $single_layout) {
			if ($options['column'] == 'c1' || $options['column'] == 'c2') {
				$classes[] = 'one-col';
			} elseif ($options['column'] == 'cs' || $options['column'] == 'sc') {
				$classes[] = 'two-col';
			} elseif ($options['column'] == 'css' || $options['column'] == 'scs' || $options['column'] == 'ssc') {
				$classes[] = 'three-col';
			}
			$classes[] = $options['column'];
		} elseif ($single_layout == 'c1' || $single_layout == 'c2') {
			$classes[] = 'one-col';
			$classes[] = $single_layout;
		} elseif ($single_layout == 'cs' || $single_layout == 'sc') {
			$classes[] = 'two-col';
			$classes[] = $single_layout;
		} elseif ($single_layout == 'css' || $single_layout == 'scs' || $single_layout == 'ssc') {
			$classes[] = 'three-col';
			$classes[] = $single_layout;
		}
	} else {
		if ($options['column'] == 'c1' || $options['column'] == 'c2') {
			$classes[] = 'one-col';
		} elseif ($options['column'] == 'cs' || $options['column'] == 'sc') {
			$classes[] = 'two-col';
		} elseif ($options['column'] == 'css' || $options['column'] == 'scs' || $options['column'] == 'ssc') {
			$classes[] = 'three-col';
		}
		$classes[] = $options['column'];
	}
	
	// return the $classes array
	return $classes;
}
add_filter('body_class', 'vol_main_layout_class');


/** Body class by singular metabox options
 *
 * Add specific CSS class on each post or page edit screen
 *
 * @since Volatyl 1.0
 */
function vol_singular_body_class($classes) {
	global $post;
	
	if (!is_404() && !is_search())
		$singular_body_class = get_post_meta($post->ID, '_custom-class', true);
	
	// add class name to the $classes array based on conditions
	if (is_singular()) {
	
		// Add the body class if it exists
		if ('' !== $singular_body_class)
			$classes[] = $singular_body_class;
	}
	
	// return the $classes array
	return $classes;
}
add_filter('body_class', 'vol_singular_body_class');