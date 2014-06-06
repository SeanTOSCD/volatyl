<?php
/** conditionals.php
 *
 ***** THIS IS A CORE VOLATYL FILE AND SHOULD NOT BE EDITED!
 ***** ALL CUSTOM CODING SHOULD BE DONE IN A CHILD THEME.
 ***** MORE INFORMATION - http://volatylthemes.com/why-child-themes/
 *******************************************************************
 *
 * These functions return either true, false, or a specific value
 * based on the current state of a given Volatyl option.
 *
 * @package Volatyl
 * @since Volatyl 1.4.4
 */

/**
 * Wide (100%) HTML Structure
 *
 * @return bool The option checkbox state
 */
function vol_is_full_width() {
	$option = get_option('vol_structure_options');
	if (1 == $option['wide']) {
		return true;
	} else {
		return false;
	}
}

/**
 * Content and Sidebars
 *
 * @return string The value based on selected column configuration
 */
function vol_get_layout() {
	$option = get_option('vol_structure_options');
	switch ($option['column']) {
		case 'c1':
			$layout = 'c1';
			break;
		case 'c2':
			$layout = 'c2';
			break;
		case 'sc':
			$layout = 'sc';
			break;
		case 'cs':
			$layout = 'cs';
			break;
		case 'css':
			$layout = 'css';
			break;
		case 'scs':
			$layout = 'scs';
			break;
		case 'ssc':
			$layout = 'ssc';
			break;
	}
	return $layout;
}

/**
 * Column configuration groupings
 *
 * @return integer The total number of layout columns
 */
function vol_get_column_count() {
	$options = get_option('vol_structure_options');
	if ('c1' == $options['column'] || 'c2' == $options['column']) {
		return 1;
	} elseif ('sc' == $options['column'] || 'cs' == $options['column']) {
		return 2;
	} elseif ('css' == $options['column'] || 'scs' == $options['column'] || 'ssc' == $options['column']) {
		return 3;
	}
}

/**
 * Framework Updates
 *
 * @return bool The option checkbox state
 */
function vol_updates_on() {
	$option = get_option('vol_general_options');
	if (1 == $option['updates']) {
		return true;
	} else {
		return false;
	}
}

/**
 * Enable Reponsive CSS
 *
 * @return bool The option checkbox state
 */
function vol_is_responsive() {
	$option = get_option('vol_general_options');
	if (1 == $option['responsive']) {
		return true;
	} else {
		return false;
	}
}

/**
 * Logo Uploader
 *
 * @return bool Whether or not a logo has been uploaded
 */
function vol_has_logo() {
	$option = get_option('vol_content_options');
	if ('' != $option['logo']) {
		return true;
	} else {
		return false;
	}
}

/**
 * Logo Image URL
 *
 * @return mixed The logo URL or false if no logo uploaded
 */
function vol_get_logo() {
	$option = get_option('vol_content_options');
	if (vol_has_logo()) {
		return $option['logo'];
	} else {
		return false;
	}
}

/**
 * Site Title
 *
 * @return bool The option checkbox state
 */
function vol_site_title_on() {
	$option = get_option('vol_content_options');
	if (1 == $option['title']) {
		return true;
	} else {
		return false;
	}
}

/**
 * Site Tagline
 *
 * @return bool The option checkbox state
 */
function vol_site_tagline_on() {
	$option = get_option('vol_content_options');
	if (1 == $option['tagline']) {
		return true;
	} else {
		return false;
	}
}

/**
 * Header Menu
 *
 * @return bool The option checkbox state
 */
function vol_header_menu_on() {
	$option = get_option('vol_content_options');
	if (1 == $option['headermenu']) {
		return true;
	} else {
		return false;
	}
}

/**
 * Standard Menu
 *
 * @return bool The option checkbox state
 */
function vol_standard_menu_on() {
	$option = get_option('vol_content_options');
	if (1 == $option['standardmenu']) {
		return true;
	} else {
		return false;
	}
}

/**
 * Footer Menu
 *
 * @return bool The option checkbox state
 */
function vol_footer_menu_on() {
	$option = get_option('vol_content_options');
	if (1 == $option['footermenu']) {
		return true;
	} else {
		return false;
	}
}

/**
 * Default Widget
 *
 * @return bool The option checkbox state
 */
function vol_default_widget_on() {
	$option = get_option('vol_content_options');
	if (1 == $option['widgets']) {
		return true;
	} else {
		return false;
	}
}

/**
 * Pagination
 *
 * @return bool The option checkbox state
 */
function vol_pagination_on() {
	$option = get_option('vol_content_options');
	if (1 == $option['pagination']) {
		return true;
	} else {
		return false;
	}
}

/**
 * Post Byline Date
 *
 * @return bool The option checkbox state
 */
function vol_byline_date_on() {
	$option = get_option('vol_content_options');
	if (1 == $option['by-date-post']) {
		return true;
	} else {
		return false;
	}
}

/**
 * Post Byline Author
 *
 * @return bool The option checkbox state
 */
function vol_byline_author_on() {
	$option = get_option('vol_content_options');
	if (1 == $option['by-author-post']) {
		return true;
	} else {
		return false;
	}
}

/**
 * Post Byline Comments
 *
 * @return bool The option checkbox state
 */
function vol_byline_comments_on() {
	$option = get_option('vol_content_options');
	if (1 == $option['by-comments-post']) {
		return true;
	} else {
		return false;
	}
}

/**
 * Post Byline Edit Link
 *
 * @return bool The option checkbox state
 */
function vol_byline_edit_on() {
	$option = get_option('vol_content_options');
	if (1 == $option['by-edit-post']) {
		return true;
	} else {
		return false;
	}
}

/**
 * Post Byline Categories
 *
 * @return bool The option checkbox state
 */
function vol_byline_cats_on() {
	$option = get_option('vol_content_options');
	if (1 == $option['by-cats']) {
		return true;
	} else {
		return false;
	}
}

/**
 * Determine whether or not any byline items are on
 *
 * @return bool The option checkbox state
 */
function vol_has_byline_items() {
	if (vol_byline_date_on() || vol_byline_author_on() || vol_byline_comments_on() || vol_byline_edit_on() || vol_byline_cats_on()) {
		return true;
	} else {
		return false;
	}
}

/**
 * Post Excerpt
 *
 * @return bool The option checkbox state
 */
function vol_excerpt_on() {
	$option = get_option('vol_content_options');
	if (1 == $option['homeexcerpt']) {
		return true;
	} else {
		return false;
	}
}

/**
 * Post Excerpt Link
 *
 * @return bool The option checkbox state
 */
function vol_excerpt_link_on() {
	$option = get_option('vol_content_options');
	if (1 == $option['excerptlink']) {
		return true;
	} else {
		return false;
	}
}

/**
 * Archive Featured Images
 *
 * @return bool The option checkbox state
 */
function vol_archive_featured_image_on() {
	$option = get_option('vol_content_options');
	if (1 == $option['feedfeaturedimage']) {
		return true;
	} else {
		return false;
	}
}

/**
 * Post Featured Images
 *
 * @return bool The option checkbox state
 */
function vol_single_featured_image_on() {
	$option = get_option('vol_content_options');
	if (1 == $option['singlefeaturedimage']) {
		return true;
	} else {
		return false;
	}
}

/**
 * Archive Post Tags
 *
 * @return bool The option checkbox state
 */
function vol_archive_tags_on() {
	$option = get_option('vol_content_options');
	if (1 == $option['feedtags']) {
		return true;
	} else {
		return false;
	}
}

/**
 * Post Tags
 *
 * @return bool The option checkbox state
 */
function vol_single_tags_on() {
	$option = get_option('vol_content_options');
	if (1 == $option['singletags']) {
		return true;
	} else {
		return false;
	}
}

/**
 * Post Pings
 *
 * @return bool The option checkbox state
 */
function vol_pings_on() {
	$option = get_option('vol_content_options');
	if (1 == $option['postpings']) {
		return true;
	} else {
		return false;
	}
}

/**
 * Search Pages
 *
 * @return bool The option checkbox state
 */
function vol_search_pages_on() {
	$option = get_option('vol_content_options');
	if (1 == $option['searchpages']) {
		return true;
	} else {
		return false;
	}
}

/**
 * Page Comments
 *
 * @return bool The option checkbox state
 */
function vol_page_comments_on() {
	$option = get_option('vol_content_options');
	if (1 == $option['pagecomments']) {
		return true;
	} else {
		return false;
	}
}