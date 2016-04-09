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
 * Load the Volatyl admin page
 *
 * @since Volatyl 1.0
 */
function vol_options_add_page() {
	add_theme_page( THEME_NAME, THEME_NAME, 'edit_theme_options', 'volatyl_options', 'vol_options_do_page' );
	// Init hook options
	register_setting( 'volatyl_hooks_options', 'vol_hooks_options', 'vol_options_validate' );
	// Init license key
	register_setting( 'volatyl_license_key', 'vol_license_key', 'vol_sanitize_license' );
}
add_action( 'admin_menu', 'vol_options_add_page' );


/**
 * Volatyl Settings Form (all tabs included)
 *
 * The Volatyl Settings page uses a tabbed structure with one
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
	if ( !isset( $_REQUEST['settings-updated'] ) ) {
		$_REQUEST['settings-updated'] = false;
	}
	?>
	<div class="wrap volatyl-options">
		<h2 class="vol-options-title"><?php printf( __( '%1$s %2$s Settings', 'volatyl' ), THEME_NAME, THEME_VERSION ); ?></h2>
		<?php if ( false !== $_REQUEST['settings-updated'] ) { ?>
			<div class="updated fade radius">
				<p><strong><?php _e( 'Your settings have been updated.', 'volatyl' ); ?></strong></p>
			</div>
		<?php } ?>
		<?php
			// build tabs
			$active_tab = isset( $_GET['tab'] ) ? $_GET['tab'] : 'hooks';
			$add_tab = array( 'hooks', 'license', 'information' );
		?>
		<h2 class="nav-tab-wrapper">
			<?php
				// tab checker
				foreach ( $add_tab as $tab ) { ?>
					<a href="?page=volatyl_options&tab=<?php echo $tab; ?>" class="nav-tab<?php echo ( $active_tab == $tab ? ' nav-tab-active' : '' ); ?>"><?php echo $tab; ?></a>
					<?php
				}
			?>
		</h2>
		<?php
		/**
		 * Tabbed - Hooks Settings
		 *
		 * Display various hooks fields and hook options
		 */
		if ( $active_tab == 'hooks' ) {
			$options_hooks = get_option( 'vol_hooks_options' );
			$vhooks = volatyl_hooks();
			?>
			<form method="post" action="options.php" class="hooks-form">
				<?php
					settings_fields( 'volatyl_hooks_options' );
					do_settings_sections( 'volatyl_hooks_options' );

					// form output for the Hooks options tab
					require_once( THEME_OPTIONS . '/options-pages/hooks-options.php' );
				?>
			</form>
		<?php
		/**
		 * Tabbed - License Key Setup
		 *
		 * Activate and deactivate license key
		 */
		} elseif ( $active_tab == 'license' ) {
			$license = get_option( 'vol_license_key' );
			$status = get_option( 'vol_license_key_status' );
			?>
			<form method="post" action="options.php">
				<?php
					settings_fields( 'volatyl_license_key' );
					do_settings_sections( 'volatyl_license_key' );

					// form output for the License options tab
					require_once( THEME_OPTIONS . '/options-pages/license-options.php' );
				?>
			</form>
		<?php
		/**
		 * Tabbed - Information
		 */
		} elseif ( $active_tab == 'information' ) {

			// output for the Information tab
			require_once( THEME_OPTIONS . '/options-pages/information.php' );

		/**
		 * Tabbed - {...?...} Settings
		 */
		} else { ?>
			<p><?php printf( __( 'How did you get here? Get back to the %s Settings please.', 'volatyl' ), '<a href="themes.php?page=volatyl_options&tab=hooks">' . THEME_NAME . '</a>' ); ?></p>
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
	<p><input name="volatyl_hooks_options[submit]" id="submit_options_form" type="submit" class="button-primary submit-hooks" value="<?php esc_attr_e( 'Update Hooks', 'volatyl' ); ?>" /></p>
	<?php
}


/**
 * Change WordPress admin footer
 *
 * @since Volatyl 1.2.8
 */
function vol_adjust_footer_admin() {
	echo sprintf( __( 'Powered by %1$s and %2$s', 'volatyl' ),
		'<a href="http://www.wordpress.org" target="_blank">WordPress</a> ',
		'<a href="http://volatylthemes.com" target="_blank">' . THEME_NAME . '</a>'
	);
}
add_filter( 'admin_footer_text', 'vol_adjust_footer_admin' );


/**
 * Sanitize and validate all user input!
 *
 * The Volatyl Settings are built mainly with checkbox options
 * making sanitization extremely simple.
 *
 * For all other option types, the appropriate sanitization and
 * validation methods are used.
 *
 * @since Volatyl 1.0
 */
function vol_options_validate( $input) {
	$submit = ! empty( $input['submit'] ) ? true : false;


	/**
	 * Validate and sanitize Volatyl hooks for each item in
	 *
	 * volatyl_hooks() array
 	 */
	$vhooks = volatyl_hooks();
	$hook_conditions = array( 'switch_', 'home_', 'front_', 'posts_', 'pages_', 'archive_', 'search_', '404_' );

	foreach ( $vhooks as $hook) {
		if ( isset ( $input[$hook['name']] ) )
			$input[$hook['name']] = stripslashes( $input[$hook['name']] );

		// Conditionals and disable option for each hook
		foreach ( $hook_conditions as $hc) {
			if ( !isset( $input[$hc . $hook['name']] ) )
				$input[$hc . $hook['name']] = null;
			$input[$hc . $hook['name']] = ( $input[$hc . $hook['name']] == 1 ? 1 : 0 );
		}
	}
	return $input;
}


/**
 * sanitize the license key input
 */
function vol_sanitize_license( $new ) {
	$old = get_option( 'vol_license_key' );

	if ( $old && $old != $new ) {

		// new license has been entered, so must reactivate
		delete_option( 'vol_license_key_status' );
	}
	return $new;
}