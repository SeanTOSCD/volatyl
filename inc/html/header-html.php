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
	if (is_home() || is_front_page()) {
		$seotitle = "h1";
		$seotagline = "h2";
	} else {
		$seotitle = "p";
		$seotagline = "p";
	}
	
	echo "<header class=\"site-header inner\">\n";

	// vol_header_top
	if ($options['switch_vol_header_top'] == 0) {
		if 	((is_home() && is_front_page() && $options['home_vol_header_top'] == 0 && $options['front_vol_header_top'] == 0) ||
			(is_home() && ! is_front_page() && $options['home_vol_header_top'] == 0) ||
			(is_front_page() && ! is_home() && $options['front_vol_header_top'] == 0) ||
			(is_single() && $options['posts_vol_header_top'] == 0) ||
			(is_page() && ! is_front_page() && $options['pages_vol_header_top'] == 0) ||
			(is_archive() && $options['archive_vol_header_top'] == 0) ||
			(is_search() && $options['search_vol_header_top'] == 0) ||
			(is_404() && $options['404_vol_header_top'] == 0)) {
				vol_header_top();
		} else {
			do_action('vol_header_top');
		}
	}
		
	// Show site title? This controls the text title AND logo			
	echo (($title == 1) ? "\t\t<{$seotitle} class=\"site-title\"><a href=\"" . home_url('/') . "\" title=\"" . esc_attr(get_bloginfo('name', 'display')) . "\" rel=\"home\">" .
	
	// If a logo is uploaded, show it. If not, show the site title.
	(($logo != '') ? "<img src=\"" . $options_content['logo'] . "\" alt=\"" . get_bloginfo('name', 'display') . "\" />" : get_bloginfo('name')) . "</a></{$seotitle}>\n" : ''),

	// Show site tagline? Always hide on landing page		
	(($tagline == 1 && ! is_page_template('custom-landing.php')) ? "\t\t<{$seotagline} class=\"site-description\">" . get_bloginfo('description') . "</{$seotagline}>\n" : '');

	// vol_header_after_title_tagline - Always hide on landing page
	if ($options['switch_vol_header_after_title_tagline'] == 0 && ! is_page_template('custom-landing.php')) {
		if 	((is_home() && is_front_page() && $options['home_vol_header_after_title_tagline'] == 0 && $options['front_vol_header_after_title_tagline'] == 0) ||
			(is_home() && ! is_front_page() && $options['home_vol_header_after_title_tagline'] == 0) ||
			(is_front_page() && ! is_home() && $options['front_vol_header_after_title_tagline'] == 0) ||
			(is_single() && $options['posts_vol_header_after_title_tagline'] == 0) ||
			(is_page() && ! is_front_page() && $options['pages_vol_header_after_title_tagline'] == 0) ||
			(is_archive() && $options['archive_vol_header_after_title_tagline'] == 0) ||
			(is_search() && $options['search_vol_header_after_title_tagline'] == 0) ||
			(is_404() && $options['404_vol_header_after_title_tagline'] == 0)) {
				vol_header_after_title_tagline();
		} else {
			do_action('vol_header_after_title_tagline');
		}
	}
	
	// Display header menu
	vol_header_menu();

	// vol_header_bottom - Always hide on landing page
	if ($options['switch_vol_header_bottom'] == 0 && ! is_page_template('custom-landing.php')) {
		if 	((is_home() && is_front_page() && $options['home_vol_header_bottom'] == 0 && $options['front_vol_header_bottom'] == 0) ||
			(is_home() && ! is_front_page() && $options['home_vol_header_bottom'] == 0) ||
			(is_front_page() && ! is_home() && $options['front_vol_header_bottom'] == 0) ||
			(is_single() && $options['posts_vol_header_bottom'] == 0) ||
			(is_page() && ! is_front_page() && $options['pages_vol_header_bottom'] == 0) ||
			(is_archive() && $options['archive_vol_header_bottom'] == 0) ||
			(is_search() && $options['search_vol_header_bottom'] == 0) ||
			(is_404() && $options['404_vol_header_bottom'] == 0)) {
				vol_header_bottom();
		} else {
			do_action('vol_header_bottom');
		}
	}
	echo "</header>";
}

// The above <header> will display based on HTML structure options
if (!function_exists('vol_header_frame')) {
	function vol_header_frame() {
		$options_structure = get_option('vol_structure_options'); ?>
		
		<?php if ($options_structure['wide'] == 1) : ?>
			<div id="header-area" class="full">
				<div class="main">
					<?php vol_header_element(); ?> 
				</div>
			</div>
		<?php else : ?>
			<div id="container">
				<?php vol_header_element(); ?>
		<?php endif;
	}
}