<?php
/** header-html.php
 *
 ***** THIS IS A CORE VOLATYL FILE AND SHOULD NOT BE EDITED!
 ***** ALL CUSTOM CODING SHOULD BE DONE IN A CHILD THEME.
 ***** MORE INFORMATION - http://volatylthemes.com/why-child-themes/
 *******************************************************************
 *
 * This is the main <header> element of your site. 
 *
 * The vol_header_element() function is the <header> itself while the
 * vol_header_frame() displays the header based on the site structure.
 * 
 * @package Volatyl
 * @since Volatyl 1.0
 */

// The standard header element
function vol_header_element() { ?>
	
	<header class="site-header inner">
		<?php
			// vol_header_top hook
			vol_header_top_output();				
			
			// Show site title? This controls the text title AND logo			
			if (vol_site_title_on()) { ?>
				<h1 class="site-title">
					<a href="<?php echo esc_url(home_url('/')); ?>" title="<?php esc_attr(get_bloginfo('name')); ?>" rel="home">
						<?php
							// If a logo is uploaded, show it. If not, show the site title.
							if (vol_has_logo()) { ?>
								<img src="<?php echo esc_url(vol_get_logo()); ?>" alt="<?php esc_attr(get_bloginfo('name')); ?>">
								<?php
							} else {
								echo get_bloginfo('name');
							}
						?>
					</a>
				</h1>
				<?php
			}
			
			// Show site tagline? Always hide on landing page		
			if (vol_site_tagline_on() && ! is_page_template('custom-landing.php')) { ?>
				<h2 class="site-description">
					<?php echo esc_attr_e(get_bloginfo('description')); ?>
				</h2>
				<?php
			}
		
			// vol_header_after_title_tagline hook - Always hidden in landing page header
			vol_header_after_title_tagline_output();
						
			// Display header menu
			vol_header_menu();
		
			// vol_header_bottom hook - Always hidden in landing page header
			vol_header_bottom_output();
		?>
	</header>
	<?php
}

// The above <header> will display based on HTML structure options
if (!function_exists('vol_header_frame')) {
	function vol_header_frame() { ?>
		
		<?php if (vol_is_full_width()) { ?>
			<div id="header-area" class="full">
				<div class="main">
					<?php vol_header_element(); ?> 
				</div>
			</div>
		<?php } else { ?>
			<div id="container">
				<?php vol_header_element(); ?>
		<?php }
	}
}