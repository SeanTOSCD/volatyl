<?php
/** footer-html.php
 *
 ***** THIS IS A CORE VOLATYL FILE AND SHOULD NOT BE EDITED!
 ***** ALL CUSTOM CODING SHOULD BE DONE IN A CHILD THEME.
 ***** MORE INFORMATION - http://volatylthemes.com/why-child-themes/
 *******************************************************************
 *
 * This is the main <footer> element of your site. 
 *
 * The vol_footer_element() function is the <footer> itself while the
 * vol_footer_frame() displays the footer based on the site structure.
 * 
 * @package Volatyl
 * @since Volatyl 1.0
 */

// The standard footer element
function vol_footer_element() {
	global $options, $tab3, $tab6;
	$options = get_option('vol_hooks_options');
	$options_content = get_option('vol_content_options');
	$options_general = get_option('vol_general_options');

	echo "<footer class=\"site-footer\">\n";

	// vol_footer_top - Always hide on landing page
	if ($options['switch_vol_footer_top'] == 0 && ! is_page_template('custom-landing.php')) {
		if 	((is_home() && is_front_page() && $options['home_vol_footer_top'] == 0 && $options['front_vol_footer_top'] == 0) ||
			(is_home() && ! is_front_page() && $options['home_vol_footer_top'] == 0) ||
			(is_front_page() && ! is_home() && $options['front_vol_footer_top'] == 0) ||
			(is_single() && $options['posts_vol_footer_top'] == 0) ||
			(is_page() && ! is_front_page() && $options['pages_vol_footer_top'] == 0) ||
			(is_archive() && $options['archive_vol_footer_top'] == 0) ||
			(is_search() && $options['search_vol_footer_top'] == 0) ||
			(is_404() && $options['404_vol_footer_top'] == 0)) {
				vol_footer_top();
		} else {
			do_action('vol_footer_top');
		}
	}
		
	/** Fat footer (widgetized)
	 *
	 * If the fat footer option is selected, three widgetized columns
	 * will display.
	 * 
	 * Always hide on landing page	
	 *
	 * @since Volatyl 1.0
	 */
	if (!is_page_template('custom-landing.php') && (is_active_sidebar('footer-left') || is_active_sidebar('footer-middle') || is_active_sidebar('footer-right'))) : ?>
		<div id="fat-footer" class="clearfix">
			<?php if (is_active_sidebar('footer-left')) : ?>
				<div class="footer-widget border-box">
					<?php dynamic_sidebar('footer-left'); ?>
				</div>
			<?php endif; ?>
		
			<?php if (is_active_sidebar('footer-middle')) : ?>		
					<div class="footer-widget border-box">
						<?php dynamic_sidebar('footer-middle'); ?>
					</div>
			<?php endif; ?>
			
			<?php if (is_active_sidebar('footer-right')) : ?>
				<div class="footer-widget border-box">
					<?php dynamic_sidebar('footer-right'); ?>
				</div>
			<?php endif; ?>
		</div>
	<?php endif;

	// vol_footer_bottom - Always hide on landing page
	if ($options['switch_vol_footer_bottom'] == 0 && ! is_page_template('custom-landing.php')) {
		if 	((is_home() && is_front_page() && $options['home_vol_footer_bottom'] == 0 && $options['front_vol_footer_bottom'] == 0) ||
			(is_home() && ! is_front_page() && $options['home_vol_footer_bottom'] == 0) ||
			(is_front_page() && ! is_home() && $options['front_vol_footer_bottom'] == 0) ||
			(is_single() && $options['posts_vol_footer_bottom'] == 0) ||
			(is_page() && ! is_front_page() && $options['pages_vol_footer_bottom'] == 0) ||
			(is_archive() && $options['archive_vol_footer_bottom'] == 0) ||
			(is_search() && $options['search_vol_footer_bottom'] == 0) ||
			(is_404() && $options['404_vol_footer_bottom'] == 0)) {
				vol_footer_bottom();
		} else {
			do_action('vol_footer_bottom');
		}
	}
	echo "\t<div class=\"site-info\">",

	// Footer attribution
	(($options_general['attribution'] == 1) ? 

		// DO NOT CHANGE text IF displayed
		"<p class=\"attribution\">" . __('Built with ', 'volatyl') . "<a href=\"" . THEME_URI . "\">" . THEME_NAME . "</a>" . __(' for WordPress', 'volatyl') . "</p>" : 
	'');

	// vol_site_info
	if ($options['switch_vol_site_info'] == 0) {
		if 	((is_home() && is_front_page() && $options['home_vol_site_info'] == 0 && $options['front_vol_site_info'] == 0) ||
			(is_home() && ! is_front_page() && $options['home_vol_site_info'] == 0) ||
			(is_front_page() && ! is_home() && $options['front_vol_site_info'] == 0) ||
			(is_single() && $options['posts_vol_site_info'] == 0) ||
			(is_page() && ! is_front_page() && $options['pages_vol_site_info'] == 0) ||
			(is_archive() && $options['archive_vol_site_info'] == 0) ||
			(is_search() && $options['search_vol_site_info'] == 0) ||
			(is_404() && $options['404_vol_site_info'] == 0)) {
				vol_site_info();
		} else {
			do_action('vol_site_info');
		}
	}
	
	echo "</div>\n
	</footer>";
}

// The above <footer> will display based on HTML structure options
if (!function_exists('vol_footer_frame')) {
	function vol_footer_frame() {
		$options_structure = get_option('vol_structure_options'); ?>
		
		<?php if ($options_structure['wide'] == 1) : ?>
			<div id="footer-area" class="full">
				<div class="main">
					<?php vol_footer_element(); ?>
				</div>
			</div>
		<?php else : ?>
				<?php vol_footer_element(); ?> 
			</div>
		<?php endif;
	}
}