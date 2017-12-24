<?php
/** Template Name: Store Page
 *
 ***** THIS IS A CORE VOLATYL FILE AND SHOULD NOT BE EDITED!
 ***** ALL CUSTOM CODING SHOULD BE DONE IN A CHILD THEME.
 ***** MORE INFORMATION - http://volatylthemes.com/why-child-themes/
 *******************************************************************
 *
 * The purpose of this template is to display WordPess Pages for the store.
 * The template only exists to trigger the downloads sidebars.
 *
 * @package Volatyl
 * @since Volatyl 1.1.7
 */
get_header();
vol_html_before_content();

// Set by the post meta layout selector on Pages, Posts, and Downloads
do_action('main_content_singular');

vol_html_after_content();
get_footer();