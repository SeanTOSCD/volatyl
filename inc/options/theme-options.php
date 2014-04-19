<?php
/** theme-options.php
 *
 ***** THIS IS A CORE VOLATYL FILE AND SHOULD NOT BE EDITED!
 ***** ALL CUSTOM CODING SHOULD BE DONE IN A CHILD THEME.
 ***** MORE INFORMATION - http://volatylthemes.com/why-child-themes/
 *******************************************************************
 *
 * The options pages for Volatyl are created here. The options
 * implemented here were created in the /inc/options/options-setup.php
 * file.
 *
 * @package Volatyl
 * @since Volatyl 1.0
 */ 

/** Load the Volatyl Options page 
 *
 * Creates the Volatyl Options page located in the 'Appearance'
 * section of the dashboard. The Volatyl Options use a tabbed
 * structure with one or more sections on each tab.
 *
 * For each clearly defined section of options, register_setting()
 * is used to establish the options.
 *
 * @since Volatyl 1.0
 */ 
function vol_options_add_page() {
	add_theme_page(THEME_NAME . __(' Options', 'volatyl'), THEME_NAME . __(' Options', 'volatyl'), 'edit_theme_options', 'volatyl_options', 'vol_options_do_page');
	// Init general options
	register_setting('volatyl_global_options', 'vol_general_options', 'vol_options_validate');
	// Init structure options
	register_setting('volatyl_global_options', 'vol_structure_options', 'vol_options_validate');
	// Init hook options
	register_setting('volatyl_hooks_options', 'vol_hooks_options', 'vol_options_validate');
	// Init content options
	register_setting('volatyl_content_options', 'vol_content_options', 'vol_options_validate');
	// Init license key
	register_setting('volatyl_license_key', 'vol_license_key', 'vol_sanitize_license');
}
add_action('admin_menu', 'vol_options_add_page');


/** Change WordPress admin footer
 *
 * @since Volatyl 1.2.8
 */
function vol_adjust_footer_admin() {
	echo __('Powered by ', 'volatyl') . '<a href="http://www.wordpress.org" target="_blank">WordPress</a> ' . __('and', 'volatyl') . ' <a href="http://volatylthemes.com" target="_blank">Volatyl</a>';
}
add_filter('admin_footer_text', 'vol_adjust_footer_admin');


/* Volatyl Options Form (all tabs included)
 *
 * The Volatyl Options page uses a tabbed structure with one
 * or more sections on each tab.
 *
 * Each tab is its own separate page. Therefore, each tab has
 * its own independent form and table.
 *
 * @since Volatyl 1.0
 */
function vol_options_do_page() {
	global $column_options, $tab3, $tab6, $tab9;

	// Check to see if settings are updated
	if (!isset($_REQUEST['settings-updated']))
		$_REQUEST['settings-updated'] = false;
	
	echo "<div class=\"wrap volatyl-options\">\n",
	$tab3, "<h2 class=\"vol-options-title\">", THEME_NAME, " ", THEME_VERSION, " ", __('Options', 'volatyl'), "</h2>\n",
	
	// Warning: Save settings before switching tabs
	"{$tab3}<div class=\"save-settings half radius\">\n
	{$tab3}\t<p><strong>",  
	__('Save changes before switching tabs.', 'volatyl'), 
	"</strong></p>\n
	{$tab3}</div>\n";

	// Indicator: "Options Saved" message
	((false !== $_REQUEST['settings-updated']) ?
		printf("{$tab3}<div class=\"updated half fade radius\">\n
		{$tab3}\t<p><strong>" . 
		__('Your settings have been updated.', 'volatyl') . 
		"</strong></p>\n
		{$tab3}</div>\n") :
	'');
	
	
	/* Tab Checker
	 *
	 * Check to see which tab is active. If none, default
	 * to the first tab 'global'
	 *
 	 * @since Volatyl 1.0
	 */
	$active_tab = isset($_GET['tab']) ? $_GET['tab'] : 'global';
	$add_tab = array(__('global', 'volatyl'), __('content', 'volatyl'), __('hooks', 'volatyl'), __('license', 'volatyl'), __('information', 'volatyl'));
	
	echo "{$tab3}<h2 class=\"nav-tab-wrapper\">\n";
	
	// Add Volatyl Options tabs
	foreach ($add_tab as $tab) {
		echo "{$tab3}\t<a href=\"?page=volatyl_options&tab=" . $tab . "\" class=\"nav-tab ", 
		($active_tab == $tab ? 'nav-tab-active' : ''), "\">" . 
		$tab . "</a>\n";
	}
	echo "{$tab3}</h2>\n";
	
		
	/* Tabbed - Global Settings (default)
	 *
	 * Display the options for site structure and general settings
	 *
 	 * @since Volatyl 1.0
	 */
	if ($active_tab == 'global') {
		$options_structure = get_option('vol_structure_options'); 
		$options_general = get_option('vol_general_options'); 
		$vgeneral = volatyl_general();
	
		echo "{$tab3}<form method=\"post\" action=\"options.php\">\n{$tab3}\t",
		settings_fields('volatyl_global_options'),
		do_settings_sections('volatyl_global_options'),
				
		// Start structure options table
		"\n{$tab3}\t<h3>", __('Structure Settings', 'volatyl'), "</h3>\n
		{$tab3}\t<table class=\"form-table\">\n",

		// Site structure option
		"{$tab3}\t\t<tr>\n
		{$tab6}<th scope=\"row\">", 
		__('Wide (100%) HTML Structure', 'volatyl'), 
		"</th>\n
		{$tab6}<td>\n
		{$tab6}\t<input class=\"checkbox-space\" id=\"vol_structure_options[wide]\" name=\"vol_structure_options[wide]\" type=\"checkbox\" value=\"1\"";
		checked('1', $options_structure['wide'], true);
		echo "/>\n{$tab6}\t<label class=\"description\" for=\"vol_structure_options[wide]\">", 
		__('Activate (Recommended - A narrow structure look can still be achieved with the <em>.main</em> class.)', 'volatyl'), 
		"</label>\n", "{$tab6}</td>\n", "{$tab3}\t\t</tr>\n",

		// Site layout options
		"{$tab3}\t\t<tr>\n
		{$tab6}<th scope=\"row\">", 
		__('Content and Sidebars', 'volatyl'), 
		"</th>\n", "{$tab6}<td>\n", "{$tab6}\t<fieldset>\n";
		
		((!isset($checked)) ? $checked = '' : '');
		
		foreach ($column_options as $option) {
			$column_setting = $options_structure['column'];

			(('' != $column_setting) ?
				(($options_structure['column'] == $option['value']) ? 
					$checked = "checked=\"checked\"" : 
					$checked = '' 
				) :
			'');
				
			
			// Input and label for site layout options
			echo "\n{$tab6}\t\t<label class=\"description layout-label\">\n
			{$tab9}<input class=\"layout-radio\" type=\"radio\" name=\"vol_structure_options[column]\" value=\"", $option['value'], "\" ", $checked, " />\n
			{$tab9}", $option['label'], "\n
			{$tab6}\t\t</label>\n";
		} 
		
		echo "{$tab6}\t</fieldset>\n
		{$tab6}</td>\n
		{$tab3}\t\t</tr>\n
		{$tab3}\t</table>\n";
	
	
		/** With the Volatyl general settings in an array in the 
		 * $vgeneral variable, create checkbox and corresponding
		 * label for each option setting.
		 *
		 * Close out the table, display submit button to save
		 * all options regardless of section, and close form.
		 *
 		 * @since Volatyl 1.0
		 */
		foreach ($vgeneral as $vg) {
			echo "{$tab3}\t",
			(isset($vg['table_name']) ? $vg['table_name'] : ''), 
			"\n{$tab3}\t",
			(isset($vg['table']) ? $vg['table'] : ''), 
			"\n{$tab3}\t\t",
			$vg['tr'], "\n{$tab6}", 
			$vg['th'], "\n{$tab6}", 
			$vg['td'], "\n",	
			"{$tab6}\t<input class=\"checkbox-space\" id=\"vol_general_options[", 
			$vg['title'], "]\" name=\"vol_general_options[", 
			$vg['title'], "]\" type=\"checkbox\" value=\"1\"";
			checked('1', $options_general[$vg['title']], true);
			echo "/>\n{$tab6}\t<label class=\"description label-space\" for=\"vol_general_options[", 
			$vg['title'], "]\">", 
			$vg['label'], "</label>\n{$tab6}\t\t",
			(isset($vg['notes']) ? $vg['notes'] : ''), "\n{$tab6}",
			$vg['td_end'], "\n{$tab3}\t\t",
			$vg['tr_end'], "\n";
		}
		
		echo "{$tab3}\t</table>\n
		{$tab3}\t<hr>\n{$tab3}\t<p>\n{$tab3}\t\t<input name=\"volatyl_global_options[submit]\" id=\"submit_options_form\" type=\"submit\" class=\"button-primary\" value=\"", 
		esc_attr_e('Save Global Settings', 'volatyl'), "\" />\n
		{$tab3}\t</p>\n
		{$tab3}</form>\n", "\t\t";
		
		
	/* Tabbed - Content Settings
	 *
	 * Display the options for content settings
	 *
 	 * @since Volatyl 1.0
	 */	
	} elseif ($active_tab == 'content') {
		$options_content = get_option('vol_content_options');
		
		// Collect all settings arrays
		$vcontent = volatyl_content();
		$vpost = volatyl_post();
		$vpage = volatyl_page();
		$varrays = array_merge($vcontent, $vpost, $vpage);
	
		echo "{$tab3}<form method=\"post\" action=\"options.php\">\n{$tab3}\t";
		settings_fields('volatyl_content_options');
		do_settings_sections('volatyl_content_options');
		
		// Start content options table
		echo "\n{$tab3}\t<h3>", __('Logo Uploader', 'volatyl'), "</h3>\n",
		"{$tab3}\t<table class=\"form-table\">\n",
		
		// Options for uploading and deleting Site Logo
		"{$tab3}\t\t<th scope=\"row\">", 
		__ ('Upload Your Site Logo', 'volatyl'), "</th>\n",
		"{$tab3}\t\t<td>\n
		{$tab6}<input type=\"hidden\" id=\"logo_url\" name=\"vol_content_options[logo]\" value=\"", 
		esc_url($options_content['logo']), "\" />\n",
		"{$tab6}<input id=\"upload_logo_button\" type=\"button\" class=\"button logo-button\" value=\"", __('Upload Logo', 'volatyl'), "\" />\n
		{$tab6}<span class=\"description label-space\">", 
		__('Upload a logo image.', 'volatyl'), "</span>\n",
		
		// Show delete button if logo exists
		(('' != $options_content['logo']) ? 
			"{$tab6}<input id=\"delete_logo_button\" name=\"vol_content_options[delete_logo]\" type=\"submit\" class=\"button\" value=\"" .  __('Delete Logo', 'volatyl') . "\" />\n
			{$tab3}\t\t</td>\n" : 
		'');
	
	
		/** Logo Preview
		 *
		 * If header logo is uploaded through the Volatyl media
		 * uploader, display logo
		 *
		 * @since Volatyl 1.0
		 */
		if ('' != $options_content['logo']) :
			echo "{$tab3}\t\t<tr>\n",
			"{$tab6}<th scope=\"row\">", 
			__('Logo Preview', 'volatyl'), "</th>\n",
			"{$tab6}<td>\n
			{$tab6}\t<div id=\"upload_logo_preview\">\n
			{$tab6}\t\t<img style=\"max-width:100%;\" src=\"", 
			esc_url($options_content['logo']), "\" />\n
			{$tab6}\t</div>\n
			{$tab6}</td>\n
			{$tab3}\t\t</tr>\n";
		endif;
		echo "{$tab3}\t</table>\n";
	
	
		/** With the Volatyl content settings collected in the 
		 * $varrays variable, create checkbox and corresponding
		 * label for each option setting.
		 *
		 * Close out the table, display submit button to save
		 * all options regardless of section, and close form.
		 *
 		 * @since Volatyl 1.0
		 */
		foreach ($varrays as $va) {
			echo "{$tab3}\t",
			(isset($va['table_name']) ? $va['table_name'] . "\n{$tab3}\t" : ''),
			(isset($va['table']) ? $va['table'] . "\n{$tab3}\t\t" : ''),
			(isset($va['tr']) ? $va['tr'] . "\n{$tab6}" : ''),
			(isset($va['th']) ? $va['th'] . "\n{$tab6}" : ''),
			(isset($va['td']) ? $va['td'] . "\n" : ''),
	
			// Input and labels for content options
			"{$tab6}\t<span class=\"input-group\"><input class=\"checkbox-space\" id=\"vol_content_options[", 
			$va['title'], "]\" name=\"vol_content_options[", 
			$va['title'], "]\" type=\"checkbox\" value=\"1\"";
			checked('1', $options_content[$va['title']], true);
			echo ">\n{$tab6}\t<label class=\"description label-space\" for=\"vol_content_options[", 
			$va['title'], "]\">", 
			$va['label'], "</label></span>\n{$tab6}\t\t",
			
			(isset($va['notes']) ? "<br>" . $va['notes'] . "\n{$tab6}" : ''),
			(isset($va['td_end']) ? $va['td_end'] . "\n{$tab3}\t\t" : ''),
			(isset($va['tr_end']) ? $va['tr_end'] . "\n{$tab3}" : '');
		}
		
		echo "{$tab3}\t</table>
		<hr>\n
		{$tab3}\t<p>\n
		{$tab3}\t\t<input name=\"volatyl_content_options[submit]\" id=\"submit_options_form\" type=\"submit\" class=\"button-primary\" value=\"",
		esc_attr_e('Save Content Settings', 'volatyl'),
		"\" />\n
		{$tab3}\t</p>\n
		{$tab3}</form>\n
		\t\t";
		
		
	/* Tabbed - Hooks Settings
	 *
	 * Display various hooks fields and hook options
	 *
 	 * @since Volatyl 1.0
	 */	
	} elseif ($active_tab == 'hooks') {
		$options_hooks = get_option('vol_hooks_options');
		$vhooks = volatyl_hooks();
		
		echo "{$tab3}<form method=\"post\" action=\"options.php\" class=\"hooks-form\">\n{$tab3}\t",
		settings_fields('volatyl_hooks_options'),
		do_settings_sections('volatyl_hooks_options'),
		
		// Hooks intro
		"\n{$tab3}\t<h3>", THEME_NAME . __(' Hooks', 'volatyl'), "</h3>\n
		{$tab3}\t<div class=\"instructions radius\">\n
		{$tab3}\t\t<p>", __('Hooks are areas of your website that can be "hooked" into at will. If you are familiar with WordPress core, you probably already know about hooks like wp_head() and wp_footer(). <strong>You are not allowed to use PHP</strong> in the hooks below! ', 'volatyl') . '<a href="http://volatylthemes.com/hooks-guide/#hooks-php" target="_blank">' . __('Write custom PHP functions', 'volayl') . '</a>' . __(' and place them inside of your child theme\'s functions file.', 'volatyl'), 
		"</p>\n
		{$tab3}\t</div>";
	
	
		/** With the Volatyl hooks settings collected in the 
		 * $vhooks variable, create textarea and corresponding
		 * options for each hook.
		 *
		 * Display submit button beneath each hook to save
		 * all hooks and options regardless of section 
		 * and close form.
		 *
 		 * @since Volatyl 1.0
		 */
		foreach ($vhooks as $hook) { 
		
			echo "{$tab3}\t<div class=\"hook-section\">\n
			{$tab3}\t\t<h4 class=\"hook-title\" id=\"", 
			$hook['name'], "\">", 
			$hook['title'], "</h4>\n{$tab3}\t\t<span class=\"hook-info\">", 
			$hook['name'], " - <span class=\"notes\">", 
			$hook['description'], "</span></span>\n",
			"{$tab3}\t\t<textarea class=\"hook-field\" cols=\"70\" rows=\"5\" id=\"vol_hooks_options[", 
			$hook['name'], "]\" name=\"vol_hooks_options[", 
			$hook['name'], "]\">", 
			stripslashes(esc_textarea($options_hooks[$hook['name']])), 
			"</textarea><br>\n",
			"<span class=\"hide-on\">", __(' Hide on:', 'volatyl'), "</span>";
			
			switch ($hook['name']) {
				case 'vol_post_footer':
					echo '';
					break;
				default:
					// Hide on blog
					echo "{$tab3}\t\t<span class=\"input-hook-conditions\"><input id=\"vol_hooks_options[home_", 
					$hook['name'], "]\" name=\"vol_hooks_options[home_", 
					$hook['name'], "]\" type=\"checkbox\" value=\"1\"";
					checked('1', $options_hooks['home_' . $hook['name']], true);
					echo "/>\n{$tab3}\t\t<label class=\"description hook-label-space\" for=\"vol_hooks_options[home_",
					$hook['name'], "]\">", 
					__(' Blog ', 'volatyl'),
					"</label></span>\n";
			}
			
			switch ($hook['name']) {
				case 'vol_post_footer':
				case 'vol_below_first_post':
				case 'vol_last_byline_item':
					echo '';
					break;
				default:
					// Hide on front page
					echo "{$tab3}\t\t<span class=\"input-hook-conditions\"><input id=\"vol_hooks_options[front_", 
					$hook['name'], "]\" name=\"vol_hooks_options[front_", 
					$hook['name'], "]\" type=\"checkbox\" value=\"1\"";
					checked('1', $options_hooks['front_' . $hook['name']], true);
					echo "/>\n{$tab3}\t\t<label class=\"description hook-label-space\" for=\"vol_hooks_options[front_",
					$hook['name'], "]\">", 
					__(' Front Page ', 'volatyl'),
					"</label></span>\n";
			}
			
			switch ($hook['name']) {
				case 'vol_below_first_post':
					echo '';
					break;
				default:
					// Hide on posts
					echo "{$tab3}\t\t<span class=\"input-hook-conditions\"><input id=\"vol_hooks_options[posts_", 
					$hook['name'], "]\" name=\"vol_hooks_options[posts_", 
					$hook['name'], "]\" type=\"checkbox\" value=\"1\"";
					checked('1', $options_hooks['posts_' . $hook['name']], true);
					echo "/>\n{$tab3}\t\t<label class=\"description hook-label-space\" for=\"vol_hooks_options[posts_",
					$hook['name'], "]\">", 
					__(' Posts ', 'volatyl'),
					"</label></span>\n";
			}
			
			switch ($hook['name']) {
				case 'vol_before_content_column':
				case 'vol_after_content_column':
				case 'vol_before_article_header':
				case 'vol_after_article_header':
				case 'vol_last_byline_item':
				case 'vol_post_footer':
				case 'vol_below_first_post':
					echo '';
					break;
				default:
					// Hide on pages
					echo "{$tab3}\t\t<span class=\"input-hook-conditions\"><input id=\"vol_hooks_options[pages_", 
					$hook['name'], "]\" name=\"vol_hooks_options[pages_", 
					$hook['name'], "]\" type=\"checkbox\" value=\"1\"";
					checked('1', $options_hooks['pages_' . $hook['name']], true);
					echo "/>\n{$tab3}\t\t<label class=\"description hook-label-space\" for=\"vol_hooks_options[pages_",
					$hook['name'], "]\">", 
					__(' Pages ', 'volatyl'),
					"</label></span>\n";
			}
			
			switch ($hook['name']) {
				case 'vol_before_article_header':
				case 'vol_after_article_header':
				case 'vol_post_footer':
				case 'vol_below_first_post':
					echo '';
					break;
				default:
					// Hide on archives
					echo "{$tab3}\t\t<span class=\"input-hook-conditions\"><input id=\"vol_hooks_options[archive_", 
					$hook['name'], "]\" name=\"vol_hooks_options[archive_", 
					$hook['name'], "]\" type=\"checkbox\" value=\"1\"";
					checked('1', $options_hooks['archive_' . $hook['name']], true);
					echo "/>\n{$tab3}\t\t<label class=\"description hook-label-space\" for=\"vol_hooks_options[archive_",
					$hook['name'], "]\">", 
					__(' Archives ', 'volatyl'),
					"</label></span>\n";
			}
			
			switch ($hook['name']) {
				case 'vol_before_content_column':
				case 'vol_after_content_column':
				case 'vol_before_article_header':
				case 'vol_after_article_header':
				case 'vol_post_footer':
				case 'vol_below_first_post':
					echo '';
					break;
				default:
					// Hide on search
					echo "{$tab3}\t\t<span class=\"input-hook-conditions\"><input id=\"vol_hooks_options[search_", 
					$hook['name'], "]\" name=\"vol_hooks_options[search_", 
					$hook['name'], "]\" type=\"checkbox\" value=\"1\"";
					checked('1', $options_hooks['search_' . $hook['name']], true);
					echo "/>\n{$tab3}\t\t<label class=\"description hook-label-space\" for=\"vol_hooks_options[search_",
					$hook['name'], "]\">", 
					__(' Search ', 'volatyl'),
					"</label></span>\n";
			}
			
			switch ($hook['name']) {
				case 'vol_before_content_column':
				case 'vol_after_content_column':
				case 'vol_before_article_header':
				case 'vol_after_article_header':
				case 'vol_last_byline_item':
				case 'vol_post_footer':
				case 'vol_below_first_post':
					echo '';
					break;
				default:
					// Hide on 404
					echo "{$tab3}\t\t<span class=\"input-hook-conditions\"><input id=\"vol_hooks_options[404_", 
					$hook['name'], "]\" name=\"vol_hooks_options[404_", 
					$hook['name'], "]\" type=\"checkbox\" value=\"1\"";
					checked('1', $options_hooks['404_' . $hook['name']], true);
					echo "/>\n{$tab3}\t\t<label class=\"description hook-label-space\" for=\"vol_hooks_options[404_",
					$hook['name'], "]\">", 
					__(' 404 ', 'volatyl'),
					"</label></span>\n";
			}
			
			// Disable hooks
			echo "<br>{$tab3}\t\t<input id=\"vol_hooks_options[switch_", 
			$hook['name'], "]\" name=\"vol_hooks_options[switch_", 
			$hook['name'], "]\" type=\"checkbox\" value=\"1\"";
			checked('1', $options_hooks['switch_' . $hook['name']], true);
			echo "/>\n{$tab3}\t\t<label class=\"description label-space\" for=\"vol_hooks_options[switch_", 
			$hook['name'], "]\">", 
			__(' Disable hook ', 'volatyl') . 
			"<span class=\"notes\">" . 
			__('(Your changes will be saved)', 'volatyl'), 
			"</span></label>\n",
			submit_hooks(),
			"{$tab3}\t</div>\n";
		}
		echo "{$tab3}</form>\n\t\t";
		
		
	/* Tabbed - License Key Setup
	 *
	 * Activate and deactivate license key
	 *
 	 * @since Volatyl 1.0
	 */	
	} elseif ($active_tab == 'license') {
		$license = get_option('vol_license_key');
		$status = get_option('vol_license_key_status');
	
		echo "{$tab3}<form method=\"post\" action=\"options.php\">\n{$tab3}\t",
		
		settings_fields('volatyl_license_key'),
		do_settings_sections('volatyl_license_key'),
		
		// Start license options table
		"\n{$tab3}\t<h3>", 
		__('License Key Settings', 'volatyl'), "</h3>\n",
		"{$tab3}\t<div class=\"instructions radius\">\n
		{$tab3}\t\t<p>", __('Step 1: Enter your license key.<br>Step 2: Click the "Send License Key Changes to Database" button.<br>Step 3: Click the "Activate license" button and you&rsquo;re done!', 'volatyl'), "</p>\n
		{$tab3}\t\t<p>", __('You can use this exact license key on as many installs as you would like. Also, your license is valid for all of eternity. If you deactivate your license or you stole ', 'volatyl') . THEME_NAME . __(' and you don\'t have one, you will not receive updates to the Framework. In other words, the fun will not last forever!', 'volatyl'), "</p>\n
		{$tab3}\t</div>
		{$tab3}<table class=\"form-table\">\n
		<tr valign=\"top\">
		<th scope=\"row\" valign=\"top\">",
		__('License Key', 'volatyl'), "</th>", "<td>",
		"<input id=\"vol_license_key\" name=\"vol_license_key\" type=\"text\" class=\"regular-text\" value=\"",
		esc_attr($license, 'volatyl'), "\" />",
		"<label class=\"description\" for=\"vol_license_key\">",
		__(' Enter your license key', 'volatyl'),
		"</label>", "</td>", "</tr>",
		((false !== $license) ?
			"<tr valign=\"top\">
			<th scope=\"row\" valign=\"top\">" .
			__('Activate License', 'volatyl') . "</th>" . "<td>" .
			(($status !== false && $status == 'valid') ?
				"<span style=\"color: green;\">" .
				__('active ', 'volatyl') . "</span>" .
				wp_nonce_field('vol_nonce', 'vol_nonce') .
				"<input type=\"submit\" class=\"button-secondary\" name=\"vol_license_deactivate\" value=\"" .
				__('Deactivate License', 'volatyl') .
				"\"/>" : 
				wp_nonce_field('vol_nonce', 'vol_nonce') .
				"<input type=\"submit\" class=\"button-secondary\" name=\"vol_license_activate\" value=\"" .
				__('Activate License', 'volatyl') .
			"\"/>") : 
		''),
		"</td>", "</tr>
		{$tab3}\t</table>
		<hr>\n
		{$tab3}\t<p>\n
		{$tab3}\t\t<input name=\"volatyl_license_key[submit]\" id=\"submit_options_form\" type=\"submit\" class=\"button-primary\" value=\"",
		esc_attr_e('Send License Key Changes to Database', 'volatyl'),
		"\" />\n
		{$tab3}\t</p>\n
		{$tab3}</form>\n\t\t";
		
		
	/* Tabbed - Information
	 *
 	 * @since Volatyl 1.0
	 */	
	} elseif ($active_tab == 'information') {	
		echo "{$tab3}<form method=\"post\" action=\"options.php\">\n{$tab3}\t",
		
		// Start information table
		"{$tab3}<table class=\"form-table vol-information\">\n
		<tr valign=\"top\">
		<th scope=\"row\" valign=\"top\">",
		"<strong>", __('The ', 'volatyl'), THEME_NAME, __(' Framework', 'volatyl'), "</strong>:</th><td>";
		
		$vol_links = array(
			'Docs'	=> array(
				'name'	=> __('Documentation', 'volatyl'),
				'url'	=> 'http://volatylthemes.com/docs'
			),
			'Support'	=> array(
				'name'	=> __('Support', 'volatyl'),
				'url'	=> 'http://support.volatylthemes.com/forums/'
			),
			'Members'	=> array(
				'name'	=> __('Members Area', 'volatyl'),
				'url'	=> 'http://volatylthemes.com/members/'
			),
			'Affiliate'	=> array(
				'name'	=> __('Affiliate Program', 'volatyl'),
				'url'	=> 'http://volatylthemes.com/affiliates/'
			),
			'Skeletons'	=> array(
				'name'	=> __('Child Theme Skeletons', 'volatyl'),
				'url'	=> 'http://volatylthemes.com/skeletons-market/'
			),
		);
		
		echo '<strong>' . __('version ', 'volatyl') . THEME_VERSION . '</strong>';
		
		foreach ($vol_links as $vl) {
			printf(' &middot; <a href="%2$s" target="_blank"><strong>%1$s</strong></a>', $vl['name'], $vl['url']); 
		}
		echo "</td></tr>		
		<tr valign=\"top\">
		<th scope=\"row\" valign=\"top\">",
		__('The Creation of ', 'volatyl'), THEME_NAME, ":</th><td>",
		"{$tab3}\t\t<p>", sprintf(THEME_NAME . __(' is an %1$s project created by Sean Davis and the wonderful WordPress Codex. Along the way, thanks to %2$s, email, and public begging on <strong>Austin, TX</strong> street corners, what you have here is a unique collection of concepts and codes to help you build websites with WordPress.</p>', 'volatyl'), '<a href="http://sdavismedia.com/" target="_blank">SDavis Media</a>', '<a href="http://sdvs.me/twitter" target="_blank">Twitter</a>'),
		"{$tab3}\t\t<p>", sprintf(__('While there\'s no clear %1$s for the public begging, those who have taken the time to help solve coding problems, share their experiences, or provide encouragement deserve to be recognized. When you see these people around the universe, thank them.', 'volatyl'), '<acronym title="Return on Investment" style="border-bottom: 1px dotted #ccc;">ROI</acronym>'), "</p>\n
		{$tab3}\t\t<p class=\"notes\">", __('Note: There were no core code contributors. Blame all of your bugs on Sean. ;)', 'volatyl'), "</p>\n
		</td></tr>
		
		<tr valign=\"top\">
		<th scope=\"row\" valign=\"top\">",
		__('Special thanks to:', 'volatyl'), "</th><td>";
		
		$thanks_yo = array(
			'Andrew Norcross'	=> array(
				'name'			=> 'Andrew Norcross',
				'homepage_url'	=> 'http://andrewnorcross.com/',
				'twitter_url'	=> 'https://twitter.com/norcross/',
				'notes'			=> __('Norcross probably sleeps on Twitter. Anytime a development issue was faced in the creation of ', 'volatyl') . THEME_NAME . __(', a simple tweet <em>always</em> led to his assistance. He reviewed code, suggested changes, offered solutions, and never asked for anything in return. Outstanding.', 'volatyl')
			),
			'Alex Mangini'	=> array(
				'name'			=> 'Alex Mangini',
				'homepage_url'	=> 'http://kolakube.com/',
				'twitter_url'	=> 'https://twitter.com/afrais/',
				'notes'			=> __('"The kid," as we like to call him, has backed ', 'volatyl') . THEME_NAME . __(' from inception to launch. Many of the features that made the final cut were put through the ultimate "your friends will tell you the truth" test by Alex. His feedback and troubleshooting efforts are greatly appreciated.', 'volatyl')
			),
			'Pippin Williamson'	=> array(
				'name'			=> 'Pippin Williamson',
				'homepage_url'	=> 'http://pippinsplugins.com/',
				'twitter_url'	=> 'https://twitter.com/pippinsplugins',
				'notes'			=> __('Pippin is one of the most talented and hardworking developers I know. Not only was ', 'volatyl') . THEME_NAME . __(' for Easy Digital Downloads built based on his work, but he also lends a helping hand when needed. Without his help, many aspects of ', 'volatyl') . THEME_NAME . __(' wouldn&rsquo;t exist.', 'volatyl')
			),
		);
		foreach ($thanks_yo as $ty) {
			printf('<a href="%2$s" target="_blank"><strong>%1$s</strong></a> &middot; 
			<a href="%3$s" target="_blank">Twitter</a><br><p>%4$s</p> ',
				$ty['name'],
				$ty['homepage_url'],
				$ty['twitter_url'],
				$ty['notes']
			);
		}
		echo "</td></tr>
		
		{$tab3}\t</table>
		{$tab3}</form>\n\t\t";

	// Tab checker - WTF? Settings
	} else {
	
		echo "<p>", __('How did you get here? Get back to the ', 'volatyl'), "<a href=\"themes.php?page=volatyl_options&tab=global\">", THEME_NAME, __(' Options', 'volatyl'), "</a>", __(' please.', 'volatyl'), "</p>";
		
	}	
	echo "</div>";
}

// Submit button specifically for hooks
function submit_hooks() {
	global $tab3, $tab6;
	
	echo "{$tab3}\t\t<p>\n
	{$tab6}<input name=\"volatyl_hooks_options[submit]\" id=\"submit_options_form\" type=\"submit\" class=\"button-primary submit-hooks\" value=\"", esc_attr_e('Update Hooks', 'volatyl'), "\" />\n
	{$tab3}\t\t</p>";
}


/* Sanitize and validate all user input!
 *
 * The Volatyl Options are built mainly with checkbox options 
 * making sanitization extremely simple.
 *
 * For all other option types, the appropriate sanitization and
 * validation methods are used.
 *
 * @since Volatyl 1.0
 */
function vol_options_validate($input) {
	global $column_options;
	$options_structure = get_option('vol_structure_options');
	$options_content = get_option('vol_content_options');
	$submit = ! empty($input['submit']) ? true : false; 
	$delete_logo = ! empty($input['delete_logo']) ? true : false;
	
	
	// Validate and sanitize header logo input
	if ($submit) {
		if ($options_content['logo'] != $input['logo'] && $options_content['logo'] != '') {
			vol_delete_image($options_content['logo']);
			$valid_input['logo'] = $input['logo'];
			return $valid_input['logo'];
		}
	}
	
	// Delete uploaded logo
	if ($delete_logo) {
		vol_delete_image($options_content['logo']);
		$input['logo'] = '';
	}
	
	
	/** Validate and sanitize Volatyl structure options for
	 * HTML framework and column layouts
 	 */
	if (!isset($input['wide']))
		$input['wide'] = null;
	$input['wide'] = ($input['wide'] == 1 ? 1 : 0);

	if (!isset($options_structure['column']))
		$input['column'] == $options_structure['column'];
	if (!array_key_exists($options_structure['column'], $column_options))
		$input['column'] == 'cs';
	
	
	/** Validate and sanitize Volatyl content options for each
	 *  item in the content settings arrays
 	 */
	$vgeneral = volatyl_general();
	$vcontent = volatyl_content();
	$vpost = volatyl_post();
	$vpage = volatyl_page();
	$varrays = array_merge($vgeneral, $vcontent, $vpost, $vpage);
	foreach ($varrays as $va) { 
		if (!isset($input[$va['title']]))
			$input[$va['title']] = null;
		$input[$va['title']] = ($input[$va['title']] == 1 ? 1 : 0);
	}
	
	
	/** Validate and sanitize Volatyl hooks for each item in 
	 *  volatyl_hooks() array
 	 */
	$vhooks = volatyl_hooks();
	$hook_conditions = array('switch_', 'home_', 'front_', 'posts_', 'pages_', 'archive_', 'search_', '404_');
	
	foreach ($vhooks as $hook) { 
		if (isset ($input[$hook['name']]))
			$input[$hook['name']] = stripslashes($input[$hook['name']]);
		
		// Conditionals and disable option for each hook
		foreach ($hook_conditions as $hc) {
			if (!isset($input[$hc . $hook['name']]))
				$input[$hc . $hook['name']] = null;
			$input[$hc . $hook['name']] = ($input[$hc . $hook['name']] == 1 ? 1 : 0);
		}
	}
	return $input;
}

function vol_sanitize_license($new) {
	$old = get_option('vol_license_key');
	
	if($old && $old != $new)
	
		// new license has been entered, so must reactivate
		delete_option('vol_license_key_status'); 
	return $new;
}