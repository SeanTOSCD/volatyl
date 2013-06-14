<?php
/** menus.php
 *
 ***** THIS IS A CORE VOLATYL FILE AND SHOULD NOT BE EDITED!
 ***** ALL CUSTOM CODING SHOULD BE DONE IN A CHILD THEME.
 ***** MORE INFORMATION - http://volatylthemes.com/why-child-themes/
 *******************************************************************
 *
 * Volatyl supports multiple menus. If the additional menus are turned on, 
 * their structures are determined here and called from the structure.php file.
 * 
 * @package Volatyl
 * @since Volatyl 1.0
 */	

function vol_header_menu() {
	$header_menu_toggle = apply_filters('header_menu_toggle', array(
		'header_open'		=> 'Menu',
		'header_close'		=> 'Hide'
		)
	);
	$options_content = get_option('vol_content_options');

	/** Show header menu? - Always hide on landing page	
	 * 
	 * The header menu is replaced with a link beneath a certain screen
	 * width. At that point, the menu will show once the link is clicked.
	 *
	 * @since Volatyl 1.0
	 */
	(($options_content['headermenu'] == 1 && ! is_page_template('custom-landing.php') && (true == has_nav_menu('header'))) ?
		printf("<div id=\"header-menu-container\" class=\"header-menu-wrap\">
		<div class=\"header-menu-toggle\">
		<a href=\"#header-menu-container\" class=\"open-header-menu menu-toggle\"><span class=\"header-open\">") . printf(__($header_menu_toggle['header_open'], 'volatyl')) . printf("</span></a>
		<a href=\"#header-menu-collapse\" class=\"close-header-menu menu-toggle\" id=\"header-menu-collapse\"><span class=\"header-close\">") . printf(__($header_menu_toggle['header_close'], 'volatyl')) . printf("</span></a>
		</div>
		\t<nav role=\"navigation\" id=\"header-menu-wrap\" class=\"site-navigation short-menu header-navigation border-box\">\n") .
		((has_nav_menu('header')) ? wp_nav_menu(array('theme_location' => 'header')) : '') .
		printf("\t</nav>\n
		</div>") : 
	'');	
}
 
// Standard Menu
function vol_standard_menu_on() {
	$options_structure = get_option('vol_structure_options');
	$options_content = get_option('vol_content_options');
	
	// Wide Structure?
	(($options_structure['wide'] == 1) ?
		(($options_content['standardmenu'] == 1) ?
			printf("<div id=\"menu-area-standard\" class=\"full\">
			<div class=\"main\">") .
			vol_standard_menu() .
			printf("</div></div>") : 
		'') :
		(($options_content['standardmenu'] == 1) ? 
			vol_standard_menu() : 
		'')
	);
}

// The standard menu itself... called above
function vol_standard_menu() {	
	$standard_menu_toggle = apply_filters('standard_menu_toggle', array(
		'standard_open'		=> 'Navigation',
		'standard_close'	=> 'Hide'
		)
	);

	/**
	 * The standard menu is replaced with a link beneath a certain screen
	 * width. At that point, the menu will show once the link is clicked.
	 *
	 * @since Volatyl 1.0
	 */
	echo "<div id=\"standard-menu-container\" class=\"standard-menu-wrap border-box\">
	<div class=\"standard-menu-toggle\">
	<a href=\"#standard-menu-container\" class=\"open-standard-menu menu-toggle\"><span class=\"standard-open\">" . __($standard_menu_toggle['standard_open'], 'volatyl') . "</span></a>
	<a href=\"#standard-menu-collapse\" class=\"close-standard-menu menu-toggle\" id=\"standard-menu-collapse\"><span class=\"standard-close\">" . __($standard_menu_toggle['standard_close'], 'volatyl') . "</span></a>
	</div>
	\t<nav id=\"standard-menu-wrap\" role=\"navigation\" class=\"site-navigation full-menu standard-navigation border-box\">\n",
	((has_nav_menu('standard')) ? wp_nav_menu(array('theme_location' => 'standard')) : ''),
	"\t</nav>\n
	</div>";
}

// Footer Menu
function vol_footer_menu_on() {
	$options_structure = get_option('vol_structure_options');
	$options_content = get_option('vol_content_options');
	
	// Wide Structure?
	(($options_structure['wide'] == 1) ?
		(($options_content['footermenu'] == 1) ?
			printf("<div id=\"menu-area-footer\" class=\"full\">
			<div class=\"main\">") .
			vol_footer_menu() .
			printf("</div></div>") : 
		'') :
		(($options_content['footermenu'] == 1) ? 
			vol_footer_menu() : 
		'')
	);
}

// The footer menu itself... called above
function vol_footer_menu() {
	$footer_menu_toggle = apply_filters('footer_menu_toggle', array(
		'footer_open'		=> 'Navigation',
		'footer_close'		=> 'Hide'
		)
	);

	/**
	 * The footer menu is replaced with a link beneath a certain screen
	 * width. At that point, the menu will show once the link is clicked.
	 *
	 * @since Volatyl 1.0
	 */
	echo "<div id=\"footer-menu-container\" class=\"footer-menu-wrap border-box\">
	<div class=\"footer-menu-toggle\">
	<a href=\"#footer-menu-container\" class=\"open-footer-menu menu-toggle \"><span class=\"footer-open\">" . __($footer_menu_toggle['footer_open'], 'volatyl') . "</span></a>
	<a href=\"#footer-menu-collapse\" class=\"close-footer-menu menu-toggle\" id=\"footer-menu-collapse\"><span class=\"footer-close\">" . __($footer_menu_toggle['footer_close'], 'volatyl') . "</span></a>
	</div>
	\t<nav id=\"footer-menu-wrap\" role=\"navigation\" class=\"site-navigation full-menu footer-navigation border-box\">\n",
	((has_nav_menu('footer')) ? wp_nav_menu(array('theme_location' => 'footer')) : ''),
	"\t</nav>\n
	</div>";
}