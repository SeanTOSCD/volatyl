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
function vol_header_element() {
	global $options;
	$options = get_option('vol_hooks_options');
	$options_content = get_option('vol_content_options');
	$title = $options_content['title'];
	$logo = $options_content['logo'];
	$tagline = $options_content['tagline'];
	
	// The following condition swaps the title and headline HTML tags like old school SEO required.
	// Read the message below this condition.
	if (is_home() || is_front_page()) {
		$seotitle = "h1";
		$seotagline = "h2";
	} else {
		$seotitle = "p";
		$seotagline = "p";
	}
	// Please understand that Volatyl is written in HTML5. What you see above isn't even necessary. 
	// The title and tagline will already be inside of a <header> so they can be H1s and H2s all day long!
	?>
	
	<header class="site-header inner">
		<?php
			// vol_header_top hook
			vol_header_top_output();				
			
			// Show site title? This controls the text title AND logo			
			if ($title == 1) { ?>
				<<?php echo $seotitle; ?> class="site-title">
					<a href="<?php echo esc_url(home_url('/')); ?>" title="<?php esc_attr_e(get_bloginfo('name')); ?>" rel="home">
						<?php
							// If a logo is uploaded, show it. If not, show the site title.
							if ($logo != '') { ?>
								<img src="<?php echo $options_content['logo']; ?>" alt="<?php esc_attr_e(get_bloginfo('name')); ?>">
								<?php
							} else {
								echo get_bloginfo('name');
							}
						?>
					</a>
				</<?php echo $seotitle; ?>>
				<?php
			}
			
			// Show site tagline? Always hide on landing page		
			if ($tagline == 1 && ! is_page_template('custom-landing.php')) { ?>
				<<?php echo $seotagline; ?> class="site-description">
					<?php echo esc_attr_e(get_bloginfo('description')); ?>
				</<?php echo $seotagline; ?>>
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
	function vol_header_frame() {
		$options_structure = get_option('vol_structure_options'); ?>
		
		<?php if ($options_structure['wide'] == 1) { ?>
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