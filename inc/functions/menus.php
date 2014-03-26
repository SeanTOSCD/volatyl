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
 
if (!function_exists('vol_header_menu')) {
	function vol_header_menu() {
		$header_menu_toggle = apply_filters('header_menu_toggle',  __('Menu', 'volatyl'));
		$options_content = get_option('vol_content_options');
	
		/** Show header menu? - Always hide on landing page	
		 * 
		 * The header menu is replaced with a link beneath a certain screen
		 * width. At that point, the menu will show once the link is clicked.
		 *
		 * @since Volatyl 1.0
		 */
		if ($options_content['headermenu'] == 1 && ! is_page_template('custom-landing.php') && (true == has_nav_menu('header'))) : ?>
			<nav id="header-menu-wrap" class="site-navigation header-navigation border-box">
				<span class="header-menu-toggle"><?php echo $header_menu_toggle; ?></span>
				<?php wp_nav_menu(array('theme_location' => 'header')); ?>
			</nav>
		<?php
		endif;
	}
}

// The standard menu itself... called below
if (!function_exists('vol_standard_menu')) {
	function vol_standard_menu() {	
		$standard_menu_toggle = apply_filters('standard_menu_toggle',  __('Navigation', 'volatyl'));
	
		/**
		 * The standard menu is replaced with a link beneath a certain screen
		 * width. At that point, the menu will show once the link is clicked.
		 *
		 * @since Volatyl 1.0
		 */
		?>
		<nav id="standard-menu-wrap" class="site-navigation secondary-navigation standard-navigation border-box">
			<span class="standard-menu-toggle secondary-menu-toggle"><?php echo $standard_menu_toggle; ?></span>
			<?php wp_nav_menu(array('theme_location' => 'standard')); ?>
		</nav>
	<?php }
}

// The footer menu itself... called below
if (!function_exists('vol_footer_menu')) {
	function vol_footer_menu() {
		$footer_menu_toggle = apply_filters('footer_menu_toggle',  __('Navigation', 'volatyl'));
	
		/**
		 * The footer menu is replaced with a link beneath a certain screen
		 * width. At that point, the menu will show once the link is clicked.
		 *
		 * @since Volatyl 1.0
		 */
		?>
		<nav id="footer-menu-wrap" class="site-navigation secondary-navigation footer-navigation border-box">
			<span class="footer-menu-toggle secondary-menu-toggle"><?php echo $footer_menu_toggle; ?></span>
			<?php wp_nav_menu(array('theme_location' => 'footer')); ?>
		</nav>
	<?php }
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