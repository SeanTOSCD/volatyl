<?php
/** hooks-options.php
 *
 ***** THIS IS A CORE VOLATYL FILE AND SHOULD NOT BE EDITED!
 ***** ALL CUSTOM CODING SHOULD BE DONE IN A CHILD THEME.
 ***** MORE INFORMATION - http://volatylthemes.com/why-child-themes/
 *******************************************************************
 *
 * Hooks options tab
 *
 * @package Volatyl
 * @since Volatyl 1.4
 */
?>
<h3><?php echo THEME_NAME . __(' Hooks', 'volatyl'); ?></h3>
<div class="hook-selector">
	<h2><?php _e('Hook Selector', 'volatyl'); ?></h2>
	<p><?php _e('Use the select menu below to skip directly to the hook you\'d like to edit. Or just scroll.', 'volatyl'); ?></p>
	<select class="select-a-hook" name="hooks" onchange="location = this.options[this.selectedIndex].value;">
		<option value="#"><?php _e('-- Select a hook --', 'volatyl'); ?></option>
		<?php foreach ($vhooks as $link) { ?>
			<option value="<?php echo '#' . $link['name']; ?>"><?php echo $link['title']; ?></option>
		<?php } ?>
		<option value="#"><?php _e('-- to the top --', 'volatyl'); ?></option>
	</select>
	<span><a href="http://volatylthemes.com/visual-hooks-guide/" target="_blank"><?php _e('Visual Hooks Guide', ''); ?></a></span>
</div>
<div class="instructions radius">
	<p>
		<?php
			printf(__('Hooks are areas of your website that can be "hooked" into at will. If you are familiar with WordPress core, you probably already know about hooks like wp_head() and wp_footer(). <strong>You are not allowed to use PHP</strong> in the hooks below! %s and place them inside of your child theme\'s functions file.', 'volatyl'),
				'<a href="http://volatylthemes.com/hooks-guide/#hooks-php" target="_blank">' . __('Write custom PHP functions', 'volayl') . '</a>');
		?> 
	</p>
</div>

<?php
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
foreach ($vhooks as $hook) { ?>
	<div class="hook-section">
		<h4 class="hook-title" id="<?php echo $hook['name']; ?>"> <?php echo $hook['title']; ?></h4>
		<span class="hook-info"><?php echo $hook['name']; ?> - 
			<span class="notes"><?php echo $hook['description']; ?></span>
		</span>
		<textarea class="hook-field" cols="70" rows="5" id="vol_hooks_options[<?php echo $hook['name']; ?>]" name="vol_hooks_options[<?php echo $hook['name']; ?>]"><?php echo stripslashes(esc_textarea($options_hooks[$hook['name']])); ?></textarea>
		<br>
		<span class="hide-on"><?php _e(' Hide on:', 'volatyl'); ?></span>

		<?php
			switch ($hook['name']) {
				case 'vol_post_footer':
					echo '';
					break;
				default: // Hide on blog ?>
					<span class="input-hook-conditions">
						<input id="vol_hooks_options[home_<?php echo $hook['name']; ?>]" name="vol_hooks_options[home_<?php echo $hook['name']; ?>]" type="checkbox" value="1" <?php checked('1', $options_hooks['home_' . $hook['name']], true); ?> />
						<label class="description hook-label-space" for="vol_hooks_options[home_<?php echo $hook['name']; ?>]">
							<?php _e(' Blog ', 'volatyl'); ?>
						</label>
					</span>
					<?php
			}
			
			switch ($hook['name']) {
				case 'vol_post_footer':
				case 'vol_below_first_post':
				case 'vol_last_byline_item':
					echo '';
					break;
				default: // Hide on front page ?>
					<span class="input-hook-conditions">
						<input id="vol_hooks_options[front_<?php echo $hook['name']; ?>]" name="vol_hooks_options[front_<?php echo $hook['name']; ?>]" type="checkbox" value="1" <?php checked('1', $options_hooks['front_' . $hook['name']], true); ?> />
						<label class="description hook-label-space" for="vol_hooks_options[front_<?php echo $hook['name']; ?>]">
							<?php _e(' Front Page ', 'volatyl'); ?>
						</label>
					</span>
					<?php
			}
			
			switch ($hook['name']) {
				case 'vol_below_first_post':
					echo '';
					break;
				default: // Hide on posts ?>
					<span class="input-hook-conditions">
						<input id="vol_hooks_options[posts_<?php echo $hook['name']; ?>]" name="vol_hooks_options[posts_<?php echo $hook['name']; ?>]" type="checkbox" value="1" <?php checked('1', $options_hooks['posts_' . $hook['name']], true); ?> />
						<label class="description hook-label-space" for="vol_hooks_options[posts_<?php echo $hook['name']; ?>]">
							<?php _e(' Posts ', 'volatyl'); ?>
						</label>
					</span>
				<?php
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
				default: // Hide on pages ?>
					<span class="input-hook-conditions">
						<input id="vol_hooks_options[pages_<?php echo $hook['name']; ?>]" name="vol_hooks_options[pages_<?php echo $hook['name']; ?>]" type="checkbox" value="1" <?php checked('1', $options_hooks['pages_' . $hook['name']], true); ?> />
						<label class="description hook-label-space" for="vol_hooks_options[pages_<?php echo $hook['name']; ?>]">
							<?php _e(' Pages ', 'volatyl'); ?>
						</label>
					</span>
					<?php
			}
			
			switch ($hook['name']) {
				case 'vol_before_article_header':
				case 'vol_after_article_header':
				case 'vol_post_footer':
				case 'vol_below_first_post':
					echo '';
					break;
				default: // Hide on archives ?>
					<span class="input-hook-conditions">
						<input id="vol_hooks_options[archive_<?php echo $hook['name']; ?>]" name="vol_hooks_options[archive_<?php echo $hook['name']; ?>]" type="checkbox" value="1" <?php checked('1', $options_hooks['archive_' . $hook['name']], true); ?> />
						<label class="description hook-label-space" for="vol_hooks_options[archive_<?php echo $hook['name']; ?>]">
							<?php _e(' Archives ', 'volatyl'); ?>
						</label>
					</span>
					<?php
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
				default: // Hide on search ?>
					<span class="input-hook-conditions">
						<input id="vol_hooks_options[search_<?php echo $hook['name']; ?>]" name="vol_hooks_options[search_<?php echo $hook['name']; ?>]" type="checkbox" value="1" <?php checked('1', $options_hooks['search_' . $hook['name']], true); ?> />
						<label class="description hook-label-space" for="vol_hooks_options[search_<?php echo $hook['name']; ?>]">
							<?php _e(' Search ', 'volatyl'); ?>
						</label>
					</span>
					<?php
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
				default: // Hide on 404 ?>
					<span class="input-hook-conditions">
						<input id="vol_hooks_options[404_<?php echo $hook['name']; ?>]" name="vol_hooks_options[404_<?php echo $hook['name']; ?>]" type="checkbox" value="1" <?php checked('1', $options_hooks['404_' . $hook['name']], true); ?> />
						<label class="description hook-label-space" for="vol_hooks_options[404_<?php echo $hook['name']; ?>]">
							<?php _e(' 404 ', 'volatyl'); ?>
						</label>
					</span>
					<?php
			}
			?>
	<br>
	<input id="vol_hooks_options[switch_<?php echo $hook['name']; ?>]" name="vol_hooks_options[switch_<?php echo $hook['name']; ?>]" type="checkbox" value="1" <?php checked('1', $options_hooks['switch_' . $hook['name']], true); ?> />
	<label class="description label-space" for="vol_hooks_options[switch_<?php echo $hook['name']; ?>]">
		<?php 
			printf(__(' Disable hook %s', 'volatyl'), 
				'<span class="notes">' . __('(any content placed in the textarea above will be saved)', 'volatyl'), '</span>'
			);
		?>
	</label>
	<?php submit_hooks(); ?>
</div>
<?php
}