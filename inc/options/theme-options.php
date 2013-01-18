<?php
/** theme-options.php
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
	add_theme_page( THEME_NAME . __( 'Options', 'volatyl' ), THEME_NAME . __( 'Options', 'volatyl' ), 'edit_theme_options', 'volatyl_options', 'vol_options_do_page' );
	// Init general options
	register_setting( 'volatyl_global_options', 'vol_general_options', 'vol_options_validate' );
	// Init structure options
	register_setting( 'volatyl_global_options', 'vol_structure_options', 'vol_options_validate' );
	// Init hook options
	register_setting( 'volatyl_hooks_options', 'vol_hooks_options', 'vol_options_validate' );
	// Init content options
	register_setting( 'volatyl_content_options', 'vol_content_options', 'vol_options_validate' );
}
add_action( 'admin_menu', 'vol_options_add_page' );


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
	if ( ! isset( $_REQUEST['settings-updated'] ) )
		$_REQUEST[ 'settings-updated' ] = false;
	
	echo 	"<div class=\"wrap volatyl-options\">\n",
			$tab3, screen_icon(), "\n",
			"{$tab3}<h2>", THEME_NAME, THEME_VERSION, 
			__( 'Options', 'volatyl' ), "</h2>\n";
	
	// Warning: Save settings before switching tabs
	echo 	"{$tab3}<div class=\"save-settings radius\">\n",
			"{$tab3}\t<p><strong>",  
			__( 'Save changes before switching tabs!', 'volatyl' ), 
			"</strong></p>\n",
			"{$tab3}</div>\n";

	// Indicator: "Options Saved" message
	if ( false !== $_REQUEST[ 'settings-updated' ] )
	
		echo 	"{$tab3}<div class=\"updated fade radius\">\n",
				"{$tab3}\t<p><strong>", 
				__( 'Your settings have been updated. Nice.', 'volatyl' ), 
				"</strong></p>\n",
				"{$tab3}</div>\n";
	
	
	/* Tab Checker
	 *
	 * Check to see which tab is active. If none, default
	 * to the first tab 'global'
	 *
 	 * @since Volatyl 1.0
	 */
	$url = "{$tab3}\t<a href=\"?page=volatyl_options&tab=";
	$active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'global';
	
	echo 	"{$tab3}<h2 class=\"nav-tab-wrapper\">\n",
			"{$url}global\" class=\"nav-tab ", $active_tab == 'global' ? 
				'nav-tab-active' : '', "\">" . __( 'Global', 'volatyl' ) . "</a>\n",
			"{$url}content\" class=\"nav-tab ", $active_tab == 'content' ? 
				'nav-tab-active' : '', "\">" . __( 'Content', 'volatyl' ) . "</a>\n",
			"{$url}hooks\" class=\"nav-tab ", $active_tab == 'hooks' ? 
				'nav-tab-active' : '', "\">" . __( 'Hooks', 'volatyl' ) . "</a>\n",
			"{$tab3}</h2>\n";
	
		
	/* Tabbed - Global Settings (default)
	 *
	 * Display the options for site structure and general settings
	 *
 	 * @since Volatyl 1.0
	 */
	if ( $active_tab == 'global' ) {
		$options_structure = get_option( 'vol_structure_options' ); 
		$options_general = get_option( 'vol_general_options' ); 
		$vgeneral = volatyl_general();
	
		echo "{$tab3}<form method=\"post\" action=\"options.php\">\n{$tab3}\t";
		
		settings_fields( 'volatyl_global_options' );
		do_settings_sections( 'volatyl_global_options' ); 
				
		// Start structure options table
		echo 	"\n{$tab3}\t<h3>", __( 'Structure Settings', 'volatyl' ), "</h3>\n",
				 "{$tab3}\t<table class=\"form-table\">\n";
		
		// Site structure option
		echo 	"{$tab3}\t\t<tr>\n",
				"{$tab6}<th scope=\"row\">", 
				__( 'Wide (100%) HTML Structure', 'volatyl' ), 
				"</th>\n",
				"{$tab6}<td>\n",
				"{$tab6}\t<input class=\"checkbox-space\" id=\"vol_structure_options[wide]\" name=\"vol_structure_options[wide]\" type=\"checkbox\" value=\"1\"";
		checked( '1', $options_structure[ 'wide' ] );
		echo 	"/>\n",
				"{$tab6}\t<label class=\"description\" for=\"vol_structure_options[wide]\">", 
				__( 'Activate (Recommended - A narrow structure look can still be achieved with the <em>.main</em> class.)', 'volatyl' ), 
				"</label>\n",
				"{$tab6}</td>\n",
				"{$tab3}\t\t</tr>\n"; 
		
		// Site layout options
		echo 	"{$tab3}\t\t<tr>\n",
				"{$tab6}<th scope=\"row\">", 
				__( 'Content and Sidebar Structure', 'volatyl' ), 
				"</th>\n",
				"{$tab6}<td>\n",
				"{$tab6}\t<fieldset>\n";
		
		if ( ! isset( $checked ) )
			$checked = '';
			
		foreach ( $column_options as $option ) {
			$column_setting = $options_structure['column'];

			if ( '' != $column_setting )
			
				if ( $options_structure[ 'column' ] == $option[ 'value' ] )
					$checked = "checked=\"checked\"";
				else
					$checked = '';
				
			
			// Input and label for site layout options
			echo 	"\n{$tab6}\t\t<label class=\"description layout-label\">\n",
					"{$tab9}<input class=\"layout-radio\" type=\"radio\" name=\"vol_structure_options[column]\" value=\"";
			esc_attr_e( $option[ 'value' ] );
			echo 	"\" ", $checked, " />\n",
					"{$tab9}", $option[ 'label' ], "\n",
					"{$tab6}\t\t</label>\n";
					
		} 
		
		echo 	"{$tab6}\t</fieldset>\n",
				"{$tab6}</td>\n",
				"{$tab3}\t\t</tr>\n",
				"{$tab3}\t</table>\n";
	
	
		/** With the Volatyl general settings in an array in the 
		 * $vgeneral variable, create radio button and corresponding
		 * label for each option setting.
		 *
		 * Close out the table, display submit button to save
		 * all options regardless of section, and close form.
		 *
 		 * @since Volatyl 1.0
		 */
		foreach ( $vgeneral as $vg ) {
		
			echo "{$tab3}\t";
			
			if ( isset( $vg[ 'table_name' ] ) )
				echo $vg[ 'table_name' ], "\n{$tab3}\t";
			
			if ( isset( $vg[ 'table' ] ) )
				echo $vg[ 'table' ], "\n{$tab3}\t\t";
			
			echo 	$vg[ 'tr' ], "\n{$tab6}",
					$vg[ 'th' ], "\n{$tab6}",
					$vg[ 'td' ], "\n";
					
			// Input and labels for general options		
			echo 	"{$tab6}\t<input class=\"checkbox-space\" id=\"vol_general_options[", 
					$vg[ 'title' ], "]\" name=\"vol_general_options[", 
					$vg[ 'title' ], "]\" type=\"checkbox\" value=\"1\"";
			checked( '1', $options_general[ $vg[ 'title' ] ] );
			echo 	"/>\n{$tab6}\t<label class=\"description label-space\" for=\"vol_general_options[", 
					$vg[ 'title' ], "]\">", 
					$vg[ 'label' ], "</label>\n{$tab6}\t\t";
					
			if ( isset( $vg[ 'notes' ] ) )
				echo $vg[ 'notes' ], "\n{$tab6}";
			
			echo 	$vg[ 'td_end' ], "\n{$tab3}\t\t",
					$vg[ 'tr_end' ], "\n";
					
		}
		
		echo 	"{$tab3}\t</table>\n",
				"{$tab3}\t<hr>\n{$tab3}\t<p>\n{$tab3}\t\t<input name=\"volatyl_global_options[submit]\" id=\"submit_options_form\" type=\"submit\" class=\"button-primary\" value=\"";
		esc_attr_e( 'Save Settings', 'volatyl' );
		echo 	"\" />\n{$tab3}\t</p>\n",
				"{$tab3}</form>\n",
				"\t\t";
		
		
	/* Tabbed - Content Settings
	 *
	 * Display the options for content settings
	 *
 	 * @since Volatyl 1.0
	 */	
	} elseif ( $active_tab == 'content' ) {
		$options_content = get_option( 'vol_content_options' );
		
		// Collect all settings arrays
		$vcontent = volatyl_content();
		$vpost = volatyl_post();
		$vpage = volatyl_page();
		$varrays = array_merge( $vcontent, $vpost, $vpage );
	
		echo "{$tab3}<form method=\"post\" action=\"options.php\">\n{$tab3}\t";
		
		settings_fields( 'volatyl_content_options' );
		do_settings_sections( 'volatyl_content_options' );
		
		// Start content options table
		echo 	"\n{$tab3}\t<h3>", __( 'Logo Uploader', 'volatyl' ), "</h3>\n",
				"{$tab3}\t<table class=\"form-table\">\n";
		
		// Options for uploading and deleting Site Logo
		echo 	"{$tab3}\t\t<th scope=\"row\">", 
				__ ( 'Upload Your Site Logo', 'volatyl' ), "</th>\n",
				"{$tab3}\t\t<td>\n",
				"{$tab6}<input type=\"hidden\" id=\"logo_url\" name=\"vol_content_options[logo]\" value=\"", 
				esc_url( $options_content[ 'logo' ] ), "\" />\n",
				"{$tab6}<input id=\"upload_logo_button\" type=\"button\" class=\"button logo-button\" value=\"", __( 'Upload Logo', 'volatyl' ), "\" />\n",
				"{$tab6}<span class=\"description label-space\">", 
				__( 'Upload a logo image.', 'volatyl' ), "</span>\n";
				
		if ( '' != $options_content[ 'logo' ] )
		
			echo 	"{$tab6}<input id=\"delete_logo_button\" name=\"vol_content_options[delete_logo]\" type=\"submit\" class=\"button\" value=\"", 
					__( 'Delete Logo', 'volatyl' ), "\" />\n",
					"{$tab3}\t\t</td>\n";
	
	
		/** Logo Preview
		 *
		 * If header logo is uploaded through the Volatyl media
		 * uploader, display logo
		 *
 		 * @since Volatyl 1.0
		 */
		echo 	"{$tab3}\t\t<tr>\n",
				"{$tab6}<th scope=\"row\">", 
				__( 'Logo Preview', 'volatyl' ), "</th>\n",
				"{$tab6}<td>\n",
				"{$tab6}\t<div id=\"upload_logo_preview\">\n",
				"{$tab6}\t\t<img style=\"max-width:100%;\" src=\"", 
				esc_url( $options_content[ 'logo' ] ), "\" />\n",
				"{$tab6}\t</div>\n",
				"{$tab6}</td>\n",
				"{$tab3}\t\t</tr>\n",
				"{$tab3}\t</table>\n";
	
	
		/** With the Volatyl content settings collected in the 
		 * $varrays variable, create radio button and corresponding
		 * label for each option setting.
		 *
		 * Close out the table, display submit button to save
		 * all options regardless of section, and close form.
		 *
 		 * @since Volatyl 1.0
		 */
		foreach ( $varrays as $va ) {
		
			echo "{$tab3}\t";
			
			if ( isset( $va[ 'table_name' ] ) )
				echo $va[ 'table_name' ], "\n{$tab3}\t";
			
			if ( isset( $va[ 'table' ] ) )
				echo $va[ 'table' ], "\n{$tab3}\t\t";
			
			if ( isset( $va[ 'tr' ] ) )
				echo $va[ 'tr' ], "\n{$tab6}";
			
			if ( isset( $va[ 'th' ] ) )
				echo $va[ 'th' ], "\n{$tab6}";
			
			if ( isset( $va[ 'td' ] ) )
				echo $va[ 'td' ], "\n";
			
			// Input and labels for content options
			echo 	"{$tab6}\t<input class=\"checkbox-space\" id=\"vol_content_options[", 
					$va[ 'title' ], "]\" name=\"vol_content_options[", 
					$va[ 'title' ], "]\" type=\"checkbox\" value=\"1\"";
			checked( '1', $options_content[ $va[ 'title' ] ] );
			echo 	"/>\n{$tab6}\t<label class=\"description label-space\" for=\"vol_content_options[", 
					$va[ 'title' ], "]\">", 
					$va[ 'label' ], "</label>\n{$tab6}\t\t";
					
			if ( isset( $va[ 'notes' ] ) )
				echo "<br>", $va[ 'notes' ], "\n{$tab6}";
			
			if ( isset( $va[ 'td_end' ] ) )
				echo $va[ 'td_end' ], "\n{$tab3}\t\t";
			
			if ( isset( $va[ 'tr_end' ] ) )
				echo $va[ 'tr_end' ], "\n{$tab3}";
			
		}
		
		echo 	"{$tab3}\t</table>",
				"<hr>\n",
				"{$tab3}\t<p>\n",
				"{$tab3}\t\t<input name=\"volatyl_content_options[submit]\" id=\"submit_options_form\" type=\"submit\" class=\"button-primary\" value=\"";
		esc_attr_e( 'Save Settings', 'volatyl' );
		echo 	"\" />\n",
				"{$tab3}\t</p>\n",
				"{$tab3}</form>\n",
				"\t\t";
		
		
	/* Tabbed - Hooks Settings
	 *
	 * Display various hooks fields and hook options
	 *
 	 * @since Volatyl 1.0
	 */	
	} elseif ( $active_tab == 'hooks' ) {
		$options_hooks = get_option( 'vol_hooks_options' );
		$vhooks = volatyl_hooks();
		
		echo "{$tab3}<form method=\"post\" action=\"options.php\" class=\"hooks-form\">\n{$tab3}\t";
		
		settings_fields( 'volatyl_hooks_options' );
		do_settings_sections( 'volatyl_hooks_options' );
		
		echo 	"\n{$tab3}\t<h3>", THEME_NAME . __( ' Hooks', 'volatyl' ), "</h3>\n",
				"{$tab3}\t<p>", __( 'Hooks are areas of your website that can be “hooked” into at will. If you are familiar with WordPress core,<br>you probably already know about hooks like wp_head() and wp_footer(). You are <strong style="color: red">not</strong> allowed to use PHP<br>in these hooks! <a href="http://volatylthemes.com/hooks/#hooks-php" target="_blank">Write custom PHP functions</a> and place them inside of your child theme\'s functions file.', 'volatyl' ), "</p>\n";
	
	
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
		foreach ( $vhooks as $hook ) { 
		
			echo 	"{$tab3}\t<div class=\"hook-section\">\n",
					"{$tab3}\t\t<h4 class=\"hook-title\" id=\"", 
					$hook[ 'name' ], "\">", 
					$hook[ 'title' ], "</h4>\n{$tab3}\t\t<span class=\"hook-info\">", 
					$hook[ 'name' ], " - <span class=\"notes\">", 
					$hook[ 'description' ], "</span></span>\n",
					"{$tab3}\t\t<textarea class=\"hook-field\" cols=\"70\" rows=\"5\" id=\"vol_hooks_options[", 
					$hook[ 'name' ], "]\" name=\"vol_hooks_options[", 
					$hook[ 'name' ], "]\">", 
					stripslashes( esc_textarea( $options_hooks[ $hook[ 'name' ] ] ) ), 
					"</textarea><br>\n";
			
			// Disable hooks
			echo 	"{$tab3}\t\t<input id=\"vol_hooks_options[switch_", 
					$hook[ 'name' ], "]\" name=\"vol_hooks_options[switch_", 
					$hook[ 'name' ], "]\" type=\"checkbox\" value=\"1\"";
			checked( '1', $options_hooks[ 'switch_' . $hook[ 'name' ] ] );
			echo 	" />\n{$tab3}\t\t<label class=\"description label-space\" for=\"vol_hooks_options[switch_", 
					$hook[ 'name' ], "]\">", 
					__( ' Disable hook ', 'volatyl' ) . "<span class=\"notes\">" . __( '(Your changes will be saved)', 'volatyl' ), 
					"</span></label>\n";
					
			submit_hooks();
			
			echo "{$tab3}\t</div>\n";
			
		}
		
		echo 	"{$tab3}</form>\n",
				"\t\t";
	

	// Tab checker - WTF? Settings
	} else {
	
		echo "<p>", __( 'How did you get here? Get back to the <a href="themes.php?page=volatyl_options&tab=global">Volatyl Options</a> please.', 'volatyl'), "</p>";
		
	}
			
	echo "</div>";
	
}

// Submit button specifically for hooks
function submit_hooks() {
	global $tab3, $tab6;
	
	echo 	"{$tab3}\t\t<p>\n",
			"{$tab6}<input name=\"volatyl_hooks_options[submit]\" id=\"submit_options_form\" type=\"submit\" class=\"button-primary submit-hooks\" value=\"";
	esc_attr_e( 'Update Hooks', 'volatyl' );
	echo 	"\" />\n",
			"{$tab3}\t\t</p>";
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
function vol_options_validate( $input ) {
	global $column_options;
	$options_structure = get_option( 'vol_structure_options' );
	$options_content = get_option( 'vol_content_options' );
	$submit = ! empty( $input[ 'submit' ] ) ? true : false; 
	$delete_logo = ! empty( $input[ 'delete_logo' ] ) ? true : false;
	
	
	// Validate and sanitize header logo input
	if ( $submit ) {
		if ( $options_content[ 'logo' ] != $input[ 'logo' ] && $options_content[ 'logo' ] != '' ) {
			vol_delete_image( $options_content[ 'logo' ] );
			$valid_input[ 'logo' ] = $input[ 'logo' ];
			return $valid_input[ 'logo' ];
		}
	}
	
	if ( $delete_logo ) {
		vol_delete_image( $options_content[ 'logo' ] );
		$input[ 'logo' ] = '';
	}
	
	
	// Validate and sanitize site structure options
	if ( ! isset( $input[ 'wide' ] ) )
		$input[ 'wide' ] = null;
	$input[ 'wide' ] = ( $input[ 'wide' ] == 1 ? 1 : 0 );

	if ( ! isset( $options_structure[ 'column' ] ) )
		$input[ 'column' ] == $options_structure[ 'column' ];
	if ( ! array_key_exists( $options_structure[ 'column' ], $column_options ) )
		$input[ 'column' ] == 'cs';
	
	
	/** Validate and sanitize Volatyl content options for each
	 *  item in the content settings arrays
 	 */
	$vgeneral = volatyl_general();
	$vcontent = volatyl_content();
	$vpost = volatyl_post();
	$vpage = volatyl_page();
	$varrays = array_merge($vgeneral, $vcontent, $vpost, $vpage);
	foreach ( $varrays as $va ) { 
		if ( ! isset( $input[ $va[ 'title' ] ] ) )
			$input[ $va[ 'title' ] ] = null;
		$input[ $va[ 'title' ] ] = ( $input[ $va[ 'title' ] ] == 1 ? 1 : 0 );
	}
	
	
	/** Validate and sanitize Volatyl hooks for each item in 
	 *  volatyl_hooks() array
 	 */
	$vhooks = volatyl_hooks();
	foreach ( $vhooks as $hook ) { 
		if ( isset ( $input[ $hook[ 'name' ] ] ) )
			$input[ $hook[ 'name' ] ] = stripslashes( $input[ $hook[ 'name' ] ] );
			
		if ( ! isset( $input[ 'switch_' . $hook[ 'name' ] ] ) )
			$input[ 'switch_' . $hook[ 'name' ] ] = null;
		$input[ 'switch_' . $hook[ 'name' ] ] = ( $input[ 'switch_' . $hook[ 'name' ] ] == 1 ? 1 : 0 );
	}	
	
	return $input;
}