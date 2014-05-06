<?php
/** searchform.php
 *
 ***** THIS IS A CORE VOLATYL FILE AND SHOULD NOT BE EDITED!
 ***** ALL CUSTOM CODING SHOULD BE DONE IN A CHILD THEME.
 ***** MORE INFORMATION - http://volatylthemes.com/why-child-themes/
 *******************************************************************
 *
 * The template for displaying search forms in Volatyl
 *
 * @package Volatyl
 * @since Volatyl 1.0
 */	
$search_text = apply_filters('search_text', array(
	'search_field_text'		=> __('Enter Keywords', 'volatyl') . '&hellip;',
	'search_submit_text'	=> __('Search', 'volatyl')
));
?>
<form method="get" id="searchform" action="<?php echo esc_url(home_url('/')); ?>" role="search">
	<label for="s" class="assistive-text"><?php __('Search', 'volatyl'); ?></label>
	<input type="search" class="field" name="s" value="<?php esc_attr_e(get_search_query()); ?>" id="s" placeholder="<?php esc_attr_e($search_text['search_field_text']); ?>">
	<input type="submit" class="submit" name="submit" id="searchsubmit" value="<?php esc_attr_e($search_text['search_submit_text']); ?>" />
</form>