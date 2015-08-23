<?php
/** admin-menu.php
 *
 ***** THIS IS A CORE VOLATYL FILE AND SHOULD NOT BE EDITED!
 ***** ALL CUSTOM CODING SHOULD BE DONE IN A CHILD THEME.
 ***** MORE INFORMATION - http://volatylthemes.com/why-child-themes/
 *******************************************************************
 *
 * Admin Menu (very top menu bar) Volatyl Options
 *
 * @since Volatyl 1.0
 */

if (get_theme_mod('volatyl_toolbar')) {
	function vol_toolbar($admin_bar) {
		$admin_bar->add_menu(array(
			'id'			=> 'volatyl',
			'title' 		=> THEME_NAME,
			'meta'  		=> array(
				'title'		=> THEME_NAME,			
			),
		));
		$admin_bar->add_menu(array(
			'id'    		=> 'volatyl-options-hooks',
			'parent' 		=> 'volatyl',
			'title' 		=> __('Custom Hooks', 'volatyl'),
			'href'  		=> admin_url('themes.php?page=volatyl_options&tab=hooks'),
			'meta'  		=> array(
				'title' 	=> __('Custom Hooks', 'volatyl'),
				'target' 	=> '_self'
			),
		));
		$admin_bar->add_menu(array(
			'id'    		=> 'volatyl-options-license',
			'parent' 		=> 'volatyl',
			'title' 		=> __('License Key', 'volatyl'),
			'href'  		=> admin_url('themes.php?page=volatyl_options&tab=license'),
			'meta'  		=> array(
				'title' 	=> __('License Key', 'volatyl'),
				'target' 	=> '_self'
			),
		));
		$admin_bar->add_menu(array(
			'id'    		=> 'volatyl-docs',
			'parent' 		=> 'volatyl',
			'title' 		=> __('Documentation', 'volatyl'),
			'href'  		=> 'http://volatylthemes.com/docs/',
			'meta'  		=> array(
				'title' 	=> __('Documentation', 'volatyl'),
				'target' 	=> '_blank'
			),
		));
		$admin_bar->add_menu(array(
			'id'    		=> 'volatyl-version',
			'parent' 		=> 'volatyl',
			'title' 		=> __('Version: ' . THEME_VERSION, 'volatyl')
		));
	}
	add_action('admin_bar_menu', 'vol_toolbar', 100);
}