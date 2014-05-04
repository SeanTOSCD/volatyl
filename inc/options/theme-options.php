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

/** 
 * Load the Volatyl Options page 
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
	global $column_options;

	// Check to see if settings are updated
	if (!isset($_REQUEST['settings-updated'])) {
		$_REQUEST['settings-updated'] = false;
	}
	?>	
	<div class="wrap volatyl-options">
		<h2 class="vol-options-title"><?php printf(__('%1$s %2$s Options', 'volatyl'), THEME_NAME, THEME_VERSION); ?></h2>
		<div class="save-settings half radius">
			<p><strong><?php _e('Save changes before switching tabs.', 'volatyl'); ?></strong></p>
		</div>
		<?php if (false !== $_REQUEST['settings-updated']) { ?>
			<div class="updated half fade radius">
				<p><strong><?php _e('Your settings have been updated.', 'volatyl'); ?></strong></p>
			</div>
		<?php } ?>	
		<?php
			// build tabs
			$active_tab = isset($_GET['tab']) ? $_GET['tab'] : 'global';
			$add_tab = array('global', 'content', 'hooks', 'license', 'information');
		?>		
		<h2 class="nav-tab-wrapper">		
			<?php
				// tab checker
				foreach ($add_tab as $tab) { ?>
					<a href="?page=volatyl_options&tab=<?php echo $tab; ?>" class="nav-tab<?php echo ($active_tab == $tab ? ' nav-tab-active' : ''); ?>"><?php echo $tab; ?></a>
					<?php
				}
			?>
		</h2>
		<?php
		/**
		 * Tabbed - Global Settings (default)
		 *
		 * Display the options for site structure and general settings
		 */
		if ($active_tab == 'global') {
			$options_structure = get_option('vol_structure_options'); 
			$options_general = get_option('vol_general_options'); 
			$vgeneral = volatyl_general();
			?>			
			<form method="post" action="options.php">
				<?php
					settings_fields('volatyl_global_options');
					do_settings_sections('volatyl_global_options');
					
					// form output for the Global options tab
					require_once(THEME_OPTIONS . '/options-pages/global-options.php');
				?>			
			</form>		
		<?php	
		/**
		 * Tabbed - Content Settings
		 *
		 * Display the options for content settings
		 */	
		} elseif ($active_tab == 'content') {
			$options_content = get_option('vol_content_options');
			
			// Collect all settings arrays
			$vcontent = volatyl_content();
			$vpost = volatyl_post();
			$vpage = volatyl_page();
			$varrays = array_merge($vcontent, $vpost, $vpage);
			?>		
			<form method="post" action="options.php">
				<?php
					settings_fields('volatyl_content_options');
					do_settings_sections('volatyl_content_options');
			
					// form output for the Content options tab
					require_once(THEME_OPTIONS . '/options-pages/content-options.php');
				?>
			</form>
		<?php
		/**
		 * Tabbed - Hooks Settings
		 *
		 * Display various hooks fields and hook options
		 */	
		} elseif ($active_tab == 'hooks') {
			$options_hooks = get_option('vol_hooks_options');
			$vhooks = volatyl_hooks();
			?>			
			<form method="post" action="options.php" class="hooks-form">
				<?php
					settings_fields('volatyl_hooks_options');
					do_settings_sections('volatyl_hooks_options');
			
					// form output for the Hooks options tab
					require_once(THEME_OPTIONS . '/options-pages/hooks-options.php');
				?>
			</form>			
		<?php	
		/**
		 * Tabbed - License Key Setup
		 *
		 * Activate and deactivate license key
		 */	
		} elseif ($active_tab == 'license') {
			$license = get_option('vol_license_key');
			$status = get_option('vol_license_key_status');
			?>		
			<form method="post" action="options.php">
				<?php
					settings_fields('volatyl_license_key');
					do_settings_sections('volatyl_license_key');
			
					// form output for the License options tab
					require_once(THEME_OPTIONS . '/options-pages/license-options.php');
				?>
			</form>
		<?php
		/**
		 * Tabbed - Information
		 */	
		} elseif ($active_tab == 'information') {	
			
			// output for the Information tab
			require_once(THEME_OPTIONS . '/options-pages/information.php');
	
		/**
		 * Tabbed - WTF? Settings
		 */
		} else { ?>	
			<p><?php printf(__('How did you get here? Get back to the %s Options please.', 'volatyl'), '<a href="themes.php?page=volatyl_options&tab=global">' . THEME_NAME . '</a>'); ?></p>
			<?php		
		}	
		?>
	</div>
	<?php
}


/**
 * Submit button specifically for hooks
 */
function submit_hooks() { ?>	
	<p><input name="volatyl_hooks_options[submit]" id="submit_options_form" type="submit" class="button-primary submit-hooks" value="<?php esc_attr_e('Update Hooks', 'volatyl'); ?>" /></p>
	<?php
}


/** Change WordPress admin footer
 *
 * @since Volatyl 1.2.8
 */
function vol_adjust_footer_admin() {
	echo sprintf(__('Powered by %1$s and %2$s', 'volatyl'), 
		'<a href="http://www.wordpress.org" target="_blank">WordPress</a> ',
		'<a href="http://volatylthemes.com" target="_blank">Volatyl</a>'
	);
}
add_filter('admin_footer_text', 'vol_adjust_footer_admin');


/**
 * Sanitize and validate all user input!
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


/**
 * sanitize the license key input
 */
function vol_sanitize_license($new) {
	$old = get_option('vol_license_key');
	
	if($old && $old != $new)
	
		// new license has been entered, so must reactivate
		delete_option('vol_license_key_status'); 
	return $new;
}