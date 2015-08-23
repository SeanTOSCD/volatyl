<?php
/** options-setup.php
 *
 ***** THIS IS A CORE VOLATYL FILE AND SHOULD NOT BE EDITED!
 ***** ALL CUSTOM CODING SHOULD BE DONE IN A CHILD THEME.
 ***** MORE INFORMATION - http://volatylthemes.com/why-child-themes/
 *******************************************************************
 *
 * Set up arrays for theme options - theme-options.php
 *
 * @package Volatyl
 * @since Volatyl 1.0
 */


/**
 * Volatyl Hooks of the "Hooks" tab
 *
 * This array is used to set up the Volatyl Hooks information. The array
 * fields are designed to build an HTML table and utilize the built-in
 * styling that WordPress provides for settings pages (Settings API).
 *
 * The /inc/options/theme-options.php file uses the variables that hold
 * theses arrays and runs them through foreach loops to create the options
 * fields. Not every main array key holds the same type of values. Depending
 * on an option's placement in the table, it may opening the beginning or
 * closing HTML tags of certain <table> elements.
 *
 * The foreach loops check first to see if the array items have a certain
 * key in place before attempting to put it in the table. If that key doesn't
 * exist, the foreach will move on. It's pretty cool.
 *
 * @since Volatyl 1.0
 */
function volatyl_hooks() {
	$vol_hooks = array(
		'vol_before_html' 		=> array(
			'name'				=> 'vol_before_html',
			'title' 			=> __( 'Before HTML', 'volatyl' ),
			'description'		=> __( 'The first content inside of the opening &lt;body&gt; tag.<br>Suggestion: Use this hook to build a "Hello Bar" style attention grabber.', 'volatyl' ) 
		),
		'vol_after_html' 		=> array(
			'name'				=> 'vol_after_html',
			'title' 			=> __( 'After HTML', 'volatyl' ),
			'description'		=> __( 'The last content on your page just inside of the closing &lt;/body&gt; tag', 'volatyl' ) 
		),
		'vol_header_top' 		=> array(
			'name'				=> 'vol_header_top',
			'title' 			=> __( 'Header Top', 'volatyl' ),
			'description'		=> __( 'Inside of your header above where your site title and site tagline are located.<br>Suggestion: Try turning off your site title and site tagline to build your own header here.', 'volatyl' ) 
		),
		'vol_header_bottom' 	=> array(
			'name'				=> 'vol_header_bottom',
			'title' 			=> __( 'Header Bottom', 'volatyl' ),
			'description'		=> __( 'Inside of your header below where your site title and site tagline are located.<br>Suggestion: Try turning off your site title and site tagline to build your own header here.', 'volatyl' ) 
		),
		'vol_header_after_title_tagline' 	=> array(
			'name'				=> 'vol_header_after_title_tagline',
			'title' 			=> __( 'Header After Title/Tagline', 'volatyl' ),
			'description'		=> __( 'Inside of your header below site title and site tagline but above<br>your header menu <em>in the HTML flow</em>', 'volatyl' ) 
		),
		'vol_footer_top' 		=> array(
			'name'				=> 'vol_footer_top',
			'title' 			=> __( 'Footer Top', 'volatyl' ),
			'description'		=> __( 'This displays inside of your footer at the very top.<br>If you have the Fat Footer activated, this will display above that.', 'volatyl' ) 
		),
		'vol_footer_bottom' 	=> array(
			'name'				=> 'vol_footer_bottom',
			'title' 			=> __( 'Footer Bottom', 'volatyl' ),
			'description'		=> __( 'This displays inside of your footer at the bottom. If you have the Fat Footer<br>activated, this will display below that but above the copyright section.', 'volatyl' ) 
		),
		'vol_site_info' 		=> array(
			'name'				=> 'vol_site_info',
			'title' 			=> __( 'Site Information', 'volatyl' ),
			'description'		=> __( 'This displays just after (inline) the site attribution. If you remove the ', 'volatyl' ) . THEME_NAME . __( ' attribution,<br>you can build your own information area here.', 'volatyl' ) 
		),
		'vol_headliner' 		=> array(
			'name'				=> 'vol_headliner',
			'title' 			=> __( 'Headliner', 'volatyl' ),
			'description'		=> __( 'Better known as a "Feature Box" displaying beneath the header but above content', 'volatyl' ) 
		),
		'vol_footliner' 		=> array(
			'name'				=> 'vol_footliner',
			'title' 			=> __( 'Footliner', 'volatyl' ),
			'description'		=> __( 'Much like the Headliner, this area can be used to highlight important<br>information below the main content area.', 'volatyl' ) 
		),
		'vol_before_content_area' 	=> array(
			'name'				=> 'vol_before_content_area',
			'title' 			=> __( 'Before Content Area', 'volatyl' ),
			'description'		=> __( 'Only active on full-width HTML structure, use this hook<br>to add full-width sections to your layout.', 'volatyl' ) 
		),
		'vol_after_content_area' 	=> array(
			'name'				=> 'vol_after_content_area',
			'title' 			=> __( 'After Content Area', 'volatyl' ),
			'description'		=> __( 'Only active on full-width HTML structure, use this hook<br>to add full-width sections to your layout.', 'volatyl' ) 
		),
		'vol_before_content' 	=> array(
			'name'				=> 'vol_before_content',
			'title' 			=> __( 'Before Content', 'volatyl' ),
			'description'		=> __( 'Only active on page-width HTML structure, use this hook<br>to add stacked sections to your layout', 'volatyl' ) 
		),
		'vol_after_content' 	=> array(
			'name'				=> 'vol_after_content',
			'title' 			=> __( 'After Content', 'volatyl' ),
			'description'		=> __( 'Only active on page-width HTML structure, use this hook<br>to add stacked sections to your layout', 'volatyl' ) 
		),
		'vol_before_content_column' 	=> array(
			'name'				=> 'vol_before_content_column',
			'title' 			=> __( 'Before Content Column', 'volatyl' ),
			'description'		=> __( 'Very top of the content column before article/feed<br>(home, archive, & single posts only)', 'volatyl' ) 
		),
		'vol_after_content_column' 	=> array(
			'name'				=> 'vol_after_content_column',
			'title' 			=> __( 'After Content Column', 'volatyl' ),
			'description'		=> __( 'Very bottom of the content column after article/feed<br>(home, archive, & single posts only)', 'volatyl' ) 
		),
		'vol_before_article_header' => array(
			'name'				=> 'vol_before_article_header',
			'title' 			=> __( 'Before Article Header', 'volatyl' ),
			'description'		=> __( 'Displays above article headline and byline .<br>Suggestion: Many bloggers place ads in this area.', 'volatyl' ) 
		),
		'vol_after_article_header' => array(
			'name'				=> 'vol_after_article_header',
			'title' 			=> __( 'After Article Header', 'volatyl' ),
			'description'		=> __( 'Displays beneath article headline and byline (if byline items show).<br>Suggestion: Many bloggers place ads in this area.', 'volatyl' ) 
		),
		'vol_last_byline_item'	=> array(
			'name'				=> 'vol_last_byline_item',
			'title' 			=> __( 'Last Byline Item', 'volatyl' ),
			'description'		=> __( 'Displays as the last item in the byline any time the byline is shown.<br>Your content will appear before the "edit" link as that link is not seen by visitors.', 'volatyl' ) 
		),
		'vol_post_footer' 		=> array(
			'name'				=> 'vol_post_footer',
			'title' 			=> __( 'Single Post Footer', 'volatyl' ),
			'description'		=> __( 'Displays below your articles but above the comments.<br>Suggestion: Use this area as a call-to-action after a vistor reads your content.', 'volatyl' ) 
		),
		'vol_before_sidebar_1' 	=> array(
			'name'				=> 'vol_before_sidebar_1',
			'title' 			=> __( 'Before Sidebar 1', 'volatyl' ),
			'description'		=> __( 'Directly above Sidebar 1 in all layouts', 'volatyl' ) 
		),
		'vol_after_sidebar_1' 	=> array(
			'name'				=> 'vol_after_sidebar_1',
			'title' 			=> __( 'After Sidebar 1', 'volatyl' ),
			'description'		=> __( 'Directly below Sidebar 1 in all layouts', 'volatyl' ) 
		),
		'vol_before_sidebar_2' 	=> array(
			'name'				=> 'vol_before_sidebar_2',
			'title' 			=> __( 'Before Sidebar 2', 'volatyl' ),
			'description'		=> __( 'Directly above Sidebar 2 in all layouts', 'volatyl' ) 
		),
		'vol_after_sidebar_2' 	=> array(
			'name'				=> 'vol_after_sidebar_2',
			'title' 			=> __( 'After Sidebar 2', 'volatyl' ),
			'description'		=> __( 'Directly below Sidebar 2 in all layouts', 'volatyl' ) 
		),
	);
	return $vol_hooks;
}


/**
 * Volatyl Hooks Setup
 *
 * All Volatyl hooks are built and output here. Volatyl Hooks
 * under the "Hooks" tab in the Volatyl Options are displayed 
 * using the following functions as well as any custom functions
 * that are called with a hook name from a WordPress action.
 * 
 * @since Volatyl 1.0
 */
function vol_before_html() {
	global $options; 
	echo stripslashes( $options['vol_before_html'] );
}
function vol_after_html() {
	global $options; 
	echo stripslashes( $options['vol_after_html'] );
}
function vol_header_top() {
	global $options; 
	echo stripslashes( $options['vol_header_top'] );
}
function vol_header_bottom() {
	global $options; 
	echo stripslashes( $options['vol_header_bottom'] );
}
function vol_header_after_title_tagline() {
	global $options; 
	echo stripslashes( $options['vol_header_after_title_tagline'] );
}
function vol_footer_top() {
	global $options; 
	echo stripslashes( $options['vol_footer_top'] );
}
function vol_footer_bottom() {
	global $options; 
	echo stripslashes( $options['vol_footer_bottom'] );
}
function vol_site_info() {
	global $options; 
	echo stripslashes( $options['vol_site_info'] );
}
function vol_headliner() {
	global $options; 
	echo stripslashes( $options['vol_headliner'] );
}
function vol_footliner() {
	global $options; 
	echo stripslashes( $options['vol_footliner'] );
}
function vol_before_content_area() {
	global $options; 
	echo stripslashes( $options['vol_before_content_area'] );
}
function vol_after_content_area() {
	global $options; 
	echo stripslashes( $options['vol_after_content_area'] );
}
function vol_before_content() {
	global $options; 
	echo stripslashes( $options['vol_before_content'] );
}
function vol_after_content() {
	global $options; 
	echo stripslashes( $options['vol_after_content'] );
}
function vol_before_content_column() {
	global $options; 
	echo stripslashes( $options['vol_before_content_column'] );
}
function vol_after_content_column() {
	global $options; 
	echo stripslashes( $options['vol_after_content_column'] );
}
function vol_before_article_header() {
	global $options; 
	echo stripslashes( $options['vol_before_article_header'] );
}
function vol_after_article_header() {
	global $options; 
	echo stripslashes( $options['vol_after_article_header'] );
}
function vol_last_byline_item() {
	global $options_hooks; 
	echo stripslashes( $options_hooks['vol_last_byline_item'] );
}
function vol_post_footer() {
	global $options; 
	echo stripslashes( $options['vol_post_footer'] );
}
function vol_before_sidebar_1() {
	global $options_hooks; 
	echo stripslashes( $options_hooks['vol_before_sidebar_1'] );
}
function vol_after_sidebar_1() {
	global $options_hooks; 
	echo stripslashes( $options_hooks['vol_after_sidebar_1'] );
}
function vol_before_sidebar_2() {
	global $options_hooks; 
	echo stripslashes( $options_hooks['vol_before_sidebar_2'] );
}
function vol_after_sidebar_2() {
	global $options_hooks; 
	echo stripslashes( $options_hooks['vol_after_sidebar_2'] );
}