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
	'search_field_text'		=> 'Enter Keyword(s)&hellip;',
	'search_submit_text'	=> 'Search'
	) 
);

printf('<form method="get" id="searchform" action="%1$s" role="search"><label for="s" class="assistive-text">' . __('Search', 'volatyl') . '</label><input type="text" class="field" name="s" value="%2$s" id="s" placeholder="%3$s" /><input type="submit" class="submit" name="submit" id="searchsubmit" value="%4$s" /></form>', 
	esc_url(home_url('/')), 
	esc_attr(get_search_query()), 
	esc_attr($search_text['search_field_text'], 'volatyl'), 
	esc_attr($search_text['search_submit_text'], 'volatyl')
);