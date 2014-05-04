<?php
/** global-options.php
 *
 ***** THIS IS A CORE VOLATYL FILE AND SHOULD NOT BE EDITED!
 ***** ALL CUSTOM CODING SHOULD BE DONE IN A CHILD THEME.
 ***** MORE INFORMATION - http://volatylthemes.com/why-child-themes/
 *******************************************************************
 *
 * Global options tab
 *
 * @package Volatyl
 * @since Volatyl 1.4
 */
?>
<h3><?php _e('Structure Settings', 'volatyl'); ?></h3>
<table class="form-table">
	<tr>
		<th scope="row"><?php _e('Wide (100%) HTML Structure', 'volatyl'); ?></th>
		<td>
			<input class="checkbox-space" id="vol_structure_options[wide]" name="vol_structure_options[wide]" type="checkbox" value="1" <?php checked('1', $options_structure['wide'], true); ?>/>
			<label class="description" for="vol_structure_options[wide]"> 
				<?php _e('Activate (Recommended - A narrow structure look can still be achieved with the <em>.main</em> class.)', 'volatyl'); ?>
			</label>
		</td>
	</tr>
	<tr>
		<th scope="row"><?php _e('Content and Sidebars', 'volatyl'); ?></th>
		<td>
			<fieldset>
				<?php 
					echo !isset($checked) ? $checked = '' : '';
					foreach ($column_options as $option) {
						$column_setting = $options_structure['column'];					
						if ('' != $column_setting) {
							if ($options_structure['column'] == $option['value']) {
								$checked = 'checked="checked"';
							} else {
								$checked = '';
							}
						}
						?>						
						<label class="description layout-label">
							<input class="layout-radio" type="radio" name="vol_structure_options[column]" value="<?php echo $option['value']; ?>" <?php echo $checked; ?>/>
							<?php echo $option['label']; ?>
						</label>
						<?php
					} // end foreach
				?>
			</fieldset>
		</td>
	</tr>
</table>

<?php
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
		echo
		(isset($vg['table_name']) ? $vg['table_name'] : ''), 
		(isset($vg['table']) ? $vg['table'] : ''),
		$vg['tr'],
		$vg['th'],
		$vg['td'];
		?>	
		<input class="checkbox-space" id="vol_general_options[<?php echo $vg['title']; ?>]" name="vol_general_options[<?php echo $vg['title']; ?>]" type="checkbox" value="1" <?php checked('1', $options_general[$vg['title']], true); ?>/>
		<label class="description label-space" for="vol_general_options[<?php echo $vg['title']; ?>]">
			<?php echo $vg['label']; ?>
		</label>
		<?php
		echo (isset($vg['notes']) ? $vg['notes'] : ''),
		$vg['td_end'],
		$vg['tr_end'];
	}
?>
</table>
<hr>
<p><input name="volatyl_global_options[submit]" id="submit_options_form" type="submit" class="button-primary" value="<?php esc_attr_e('Save Global Settings', 'volatyl'); ?>"/></p>