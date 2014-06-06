<?php
/** content-options.php
 *
 ***** THIS IS A CORE VOLATYL FILE AND SHOULD NOT BE EDITED!
 ***** ALL CUSTOM CODING SHOULD BE DONE IN A CHILD THEME.
 ***** MORE INFORMATION - http://volatylthemes.com/why-child-themes/
 *******************************************************************
 *
 * Content options tab
 *
 * @package Volatyl
 * @since Volatyl 1.4
 */
?>
<h3><?php _e('Logo Uploader', 'volatyl'); ?></h3>
<table class="form-table">
	<th scope="row"><?php _e('Upload Your Site Logo', 'volatyl'); ?></th>
	<td>
		<input type="hidden" id="logo_url" name="vol_content_options[logo]" value="<?php echo esc_url(vol_get_logo()); ?>" />
		<input id="upload_logo_button" type="button" class="button logo-button" value="<?php esc_attr_e('Upload Logo', 'volatyl'); ?>" />
		<span class="description label-space"><?php _e('Upload a logo image.', 'volatyl'); ?></span>		
		<?php
			// Show delete button if logo exists
			if (vol_has_logo()) { ?>
				<input id="delete_logo_button" name="vol_content_options[delete_logo]" type="submit" class="button" value="<?php esc_attr_e('Delete Logo', 'volatyl'); ?>" />
				<?php
			}
		?>
	</td>

	<?php
		/** Logo Preview
		 *
		 * If header logo is uploaded through the Volatyl media
		 * uploader, display logo
		 *
		 * @since Volatyl 1.0
		 */
		if (vol_has_logo()) { ?>
			<tr>
				<th scope="row"><?php _e('Logo Preview', 'volatyl'); ?></th>
				<td>
					<div id="upload_logo_preview">
						<img style="max-width:100%;" src="<?php echo esc_url(vol_get_logo()); ?>" />
					</div>
				</td>
			</tr>
			<?php
		}
	?>
</table>

<?php
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
	echo 
	(isset($va['table_name']) ? $va['table_name'] : ''),
	(isset($va['table']) ? $va['table'] : ''),
	(isset($va['tr']) ? $va['tr'] : ''),
	(isset($va['th']) ? $va['th'] : ''),
	(isset($va['td']) ? $va['td'] : '');
	?>
	<span class="input-group">
		<input class="checkbox-space" id="vol_content_options[<?php echo $va['title']; ?>]" name="vol_content_options[<?php echo $va['title']; ?>]" type="checkbox" value="1" <?php checked('1', $options_content[$va['title']], true); ?>>
		<label class="description label-space" for="vol_content_options[<?php echo $va['title']; ?>]">
			<?php echo $va['label']; ?>
		</label>
	</span>
	<?php
	echo
	(isset($va['notes']) ? $va['notes'] : ''),
	(isset($va['td_end']) ? $va['td_end'] : ''),
	(isset($va['tr_end']) ? $va['tr_end'] : '');
}
?>
</table>
<hr>
<p><input name="volatyl_content_options[submit]" id="submit_options_form" type="submit" class="button-primary" value="<?php esc_attr_e('Save Content Settings', 'volatyl'); ?>" /></p>