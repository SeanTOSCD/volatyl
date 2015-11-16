<?php
/** license-options.php
 *
 ***** THIS IS A CORE VOLATYL FILE AND SHOULD NOT BE EDITED!
 ***** ALL CUSTOM CODING SHOULD BE DONE IN A CHILD THEME.
 ***** MORE INFORMATION - http://volatylthemes.com/why-child-themes/
 *******************************************************************
 *
 * License options tab
 *
 * @package Volatyl
 * @since Volatyl 1.4
 */
?>
<h3><?php _e('License Key Settings', 'volatyl'); ?></h3>
<div class="instructions radius">
	<p><?php _e('Step 1: Enter your license key.<br>Step 2: Click the "Send License Key Changes to Database" button.<br>Step 3: Click the "Activate license" button and you&rsquo;re done!', 'volatyl'); ?></p>
	<p><?php printf(__('You can use your license on as many installs as your purchase allows. Your license is valid for 1 year. If you deactivate your license or you do not have a valid copy of %s, and therefore you do not have a valid license, you will not receive automatic updates to the Framework.', 'volatyl'), THEME_NAME); ?></p>
</div>
<table class="form-table">
	<tr valign="top">
		<th scope="row" valign="top"><?php _e('License Key', 'volatyl'); ?></th>
		<td>
			<input id="vol_license_key" name="vol_license_key" type="text" class="regular-text" value="<?php echo esc_attr($license, 'volatyl'); ?>" />
			<label class="description" for="vol_license_key"><?php _e(' Enter your license key', 'volatyl'); ?></label>
		</td>
	</tr>
	<?php
		if (false !== $license) { ?>
			<tr valign="top">
				<th scope="row" valign="top"><?php _e('Activate License', 'volatyl'); ?></th>
				<td>
					<?php
						if (false !== $status && 'valid' == $status) { ?>
							<span style="color: green;"><?php _e('active ', 'volatyl'); ?></span>
							<?php wp_nonce_field('vol_nonce', 'vol_nonce'); ?>
							<input type="submit" class="button-secondary" name="vol_license_deactivate" value="<?php _e('Deactivate License', 'volatyl'); ?>" />
							<?php
						} else {
							wp_nonce_field('vol_nonce', 'vol_nonce'); ?>
							<input type="submit" class="button-secondary" name="vol_license_activate" value="<?php _e('Activate License', 'volatyl'); ?>" />
							<?php
						}
					?>
				</td>
			</tr>
			<?php
		}
	?>
</table>
<hr>
<p><input name="volatyl_license_key[submit]" id="submit_options_form" type="submit" class="button-primary" value="<?php esc_attr_e('Send License Key Changes to Database', 'volatyl'); ?>" /></p>