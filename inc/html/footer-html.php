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
	global $options;
	$options = get_option('vol_hooks_options');
	$options_content = get_option('vol_content_options');
	$options_general = get_option('vol_general_options'); ?>

	<footer class="site-footer">
	
		<?php
		// vol_footer_top hook - Always hidden in landing page footer
		vol_footer_top_output();
			
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
				<?php if (is_active_sidebar('footer-left')) { ?>
					<div class="footer-widget border-box">
						<?php dynamic_sidebar('footer-left'); ?>
					</div>
				<?php } ?>
			
				<?php if (is_active_sidebar('footer-middle')) { ?>		
						<div class="footer-widget border-box">
							<?php dynamic_sidebar('footer-middle'); ?>
						</div>
				<?php } ?>
				
				<?php if (is_active_sidebar('footer-right')) { ?>
					<div class="footer-widget border-box">
						<?php dynamic_sidebar('footer-right'); ?>
					</div>
				<?php } ?>
			</div>
		<?php endif;
	
		// vol_footer_bottom hook - Always hidden in landing page footer
		vol_footer_bottom_output();
		?>		
		<div class="site-info">		
		<?php
			// Footer attribution
			if ($options_general['attribution'] == 1) { ?>
				<p class="attribution">
					<?php printf(__('Built with <a href="%1$s">%2$s</a> for WordPress', 'volatyl'), THEME_URI ,THEME_NAME ); ?>
				</p>
				<?php
			}
		
			// vol_site_info hook
			vol_site_info_output();
		?>		
		</div>
	</footer>
	<?php
}

// The above <footer> will display based on HTML structure options
if (!function_exists('vol_footer_frame')) {
	function vol_footer_frame() {
		$options_structure = get_option('vol_structure_options'); ?>
		
		<?php if ($options_structure['wide'] == 1) { ?>
			<div id="footer-area" class="full">
				<div class="main">
					<?php vol_footer_element(); ?>
				</div>
			</div>
		<?php } else { ?>
				<?php vol_footer_element(); ?> 
			</div>
		<?php }
	}
}