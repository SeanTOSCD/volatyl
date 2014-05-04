<?php
/** functions.php
 *
 ***** THIS IS A CORE VOLATYL FILE AND SHOULD NOT BE EDITED!
 ***** ALL CUSTOM CODING SHOULD BE DONE IN A CHILD THEME.
 ***** MORE INFORMATION - http://volatylthemes.com/why-child-themes/
 *******************************************************************
 *
 * This file calls directly to another file that has what you're 
 * used to seeing in a functions.php file. Based on the way a child 
 * theme's functions.php file is ran BEFORE the parent theme's
 * functions.php file, we'll place everything in a separate file
 * so that the child theme's functions.php has the opportunity to
 * "require_once" that file directly before this file can.
 *
 * That simplifies the process for using custom functions in the
 * child theme's functions.php to overwrite parent theme functions. 
 *
 * Child themes MUST write the following line first in order for 
 * this system to work properly:
 *
 ***** require_once(get_template_directory() . '/inc/init-functions.php');
 *
 * When that line is called in the child theme's functions.php file,
 * it will grab those initial theme functions itself and totally ignore
 * the call to the same file you see below. Outstanding.
 *
 * MORE INFORMATION http://volatylthemes.com/create-child-theme/
 *
 * @package Volatyl
 * @since Volatyl 1.0
 */

// We need this! Only if a child theme hasn't gotten to it first
require_once(dirname(__FILE__) . '/inc/init-functions.php');

// Only allow automatic updates if option is checked
$options = get_option('vol_general_options');
if ($options['updates'] == 1) {
	
	// License key setup and Volatyl automatic updater
	require_once(dirname(__FILE__) . '/inc/updater.php');
}