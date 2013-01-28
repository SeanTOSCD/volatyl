<?php
/** options-arrays.php
 *
 * Set up arrays with theme options
 *
 * @package Volatyl
 * @since Volatyl 1.0
 */


/** Create arrays for column layout options
 *
 * This array is used by the /inc/options/theme-options.php file
 * as well as the post-meta.php file for singular layouts.
 *
 * @since Volatyl 1.0
 */
$column_image = '<img src="' . THEME_PATH_URI . '/inc/options/images';
$column_options = array(
	'c1' => array(
		'value' 		=> 'c1',
		'description' 	=> 'Content (No Sidebars)',
		'label' 		=> $column_image . '/c1.png">'
	),
	'c2' => array(
		'value' 		=> 'c2',
		'description' 	=> 'Content (Sidebars below)',
		'label' 		=> $column_image . '/c2.png">'
	),
	'cs' => array(
		'value' 		=> 'cs',
		'description' 	=> 'Content - Sidebar',
		'label' 		=> $column_image . '/cs.png">'
	),
	'sc' => array(
		'value' 		=> 'sc',
		'description' 	=> 'Sidebar - Content',
		'label' 		=> $column_image . '/sc.png">'
	),
	'css' => array(
		'value' 		=> 'css',
		'description' 	=> 'Content - Sidebar - Sidebar',
		'label' 		=> $column_image . '/css.png">'
	),
	'scs' => array(
		'value' 		=> 'scs',
		'description' 	=> 'Sidebar - Content - Sidebar',
		'label' 		=> $column_image . '/scs.png">'
	),
	'ssc' => array(
		'value' 		=> 'ssc',
		'description' 	=> 'Sidebar - Sidebar - Content',
		'label' 		=> $column_image . '/ssc.png">'
	)
);
return $column_options;


/** General Settings of the "General" tab
 *
 * This array is used to set up the General Settings options. The array
 * fields are designed to build an HTML table and utilize the built-in
 * styling that WordPress provides for settings pages.
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
function volatyl_general() {
	$vol_general = array( 
		'Admin Menu' 		=> array( 
			'table_name'	=> __( '<h3>General Settings</h3>', 'volatyl' ),
			'table'			=> '<table class="form-table">',
			'tr'			=> '<tr>',
			'th'			=> __( '<th scope="row">Display ', 'volatyl' ) . THEME_NAME . __( ' Toolbar</th>', 'volatyl' ),
			'td'			=> '<td>',
			
			'title'			=> 'adminmenu',
			'label'			=> __( 'This is the drop-down menu at the very top of your admin dashboard if enabled.', 'volatyl' ),
			'td_end'		=> '</td>',
			'tr_end'		=> '</tr>'
		),
		'Attribution' 		=> array( 
			'tr'			=> '<tr>',
			'th'			=> __( '<th scope="row">Display ', 'volatyl' ) . THEME_NAME . __( ' Attribution</th>', 'volatyl' ),
			'td'			=> '<td>',
			'title'			=> 'attribution',
			'label'			=> __( 'There\'s no fee to remove the ', 'volatyl' ) . THEME_NAME . __( ' attribution. ;)', 'volatyl' ),
			'td_end'		=> '</td>',
			'tr_end'		=> '</tr>',
		),
	);
	return $vol_general;
}


// Content Settings on the "Content" tab
function volatyl_content() {
	$vol_content = array( 
		'Site Title' 		=> array( 
			'table_name'	=> __( '<h3>Content Settings</h3>', 'volatyl' ),
			'table'			=> '<table class="form-table">',
			'tr'			=> '<tr>',
			'th'			=> __( '<th scope="row">Display Default Header Elements</th>', 'volatyl' ),
			'td'			=> '<td>',
			'title'			=> 'title',
			'label'			=> __( 'Site title', 'volatyl' ),
		),
		'Site Tagline' 		=> array( 
			'title'			=> 'tagline',
			'label'			=> __( 'Site tagline', 'volatyl' ) ,
		),
		'Header Menu' 		=> array( 
			'title'			=> 'headermenu',
			'label'			=> __( 'Header menu', 'volatyl' ),
			'td_end'		=> '</td>',
			'tr_end'		=> '</tr>' 
		),
		'Standard Menu' 	=> array( 
			'tr'			=> '<tr>',
			'th'			=> __( '<th scope="row">Activate Additional Menus</th>', 'volatyl' ),
			'td'			=> '<td>',
			'title'			=> 'standardmenu',
			'label'			=> __( 'Standard Menu - Displays below the site header *<br>', 'volatyl' ),
		),
		'Footer Menu' 		=> array( 
			'title'			=> 'footermenu',
			'label'			=> __( 'Footer Menu - Displays above the site footer *', 'volatyl' ),
			'notes'			=> __( '<span class="notes">* Once activated, you must <a href="nav-menus.php">create new menus</a> and add them to their respective "Theme Locations."</span>', 'volatyl' ),
			'td_end'		=> '</td>',
			'tr_end'		=> '</tr>'
		),
		'Fat Footer' 		=> array( 
			'tr'			=> '<tr>',
			'th'			=> __( '<th scope="row">Activate Widgetized (Fat) Footer</th>', 'volatyl' ),
			'td'			=> '<td>',
			'title'			=> 'fatfooter',
			'label'			=> __( 'Activate the 3-column, widget-ready footer. If activated, <a href="widgets.php">add widgets here</a>.', 'volatyl' ),
			'td_end'		=> '</td>',
			'tr_end'		=> '</tr>' 
		),
		'Default Widgets' 			=> array( 
			'tr'			=> '<tr>',
			'th'			=> __( '<th scope="row">Display Default Widgets</th>', 'volatyl' ),
			'td'			=> '<td>',
			'title'			=> 'widgets',
			'label'			=> __( 'Show default widgets in empty widgetized areas.', 'volatyl' ),
			'td_end'		=> '</td>',
			'tr_end'		=> '</tr>' 
		),
		'Pagination' 		=> array( 
			'tr'			=> '<tr>',
			'th'			=> __( '<th scope="row">Activate Pagination</th>', 'volatyl' ),
			'td'			=> '<td>',
			'title'			=> 'pagination',
			'label'			=> __( 'Activate numbered pagination on homepage, archives, search results, etc.', 'volatyl' ),
			'td_end'		=> '</td>',
			'tr_end'		=> '</tr>',
		),
	);
	return $vol_content;
}

// Post Settings on the "Content" tab
function volatyl_post() {
	$vol_post = array( 
		'Byline Date'		=> array(
			'table_name'	=> __( '</table><h3>Post Settings</h3>', 'volatyl' ),
			'table'			=> '<table class="form-table">',
			'tr'			=> '<tr>',
			'th'			=> __( '<th scope="row">Display Post Byline Elements</th>', 'volatyl' ),
			'td'			=> '<td>',
			'title'			=> 'by-date-post',
			'label'			=> __( 'Date', 'volatyl' ),
		),
		'Byline Author' 	=> array( 
			'title'			=> 'by-author-post',
			'label'			=> __( 'Author', 'volatyl' ),
		),
		'Byline Comments' 	=> array( 
			'title'			=> 'by-comments-post',
			'label'			=> __( 'Responses/Comments', 'volatyl' ),
		),
		'Byline Edit Link' 	=> array( 
			'title'			=> 'by-edit-post',
			'label'			=> __( 'Edit Link (logged in users)', 'volatyl' ),
		),
		'Byline Categories' => array( 
			'title'			=> 'by-cats',
			'label'			=> __( 'Categories', 'volatyl' ),
			'td_end'		=> '</td>',
			'tr_end'		=> '</tr>',
		),
		'Excerpts'			=> array(
			'tr'			=> '<tr>',
			'th'			=> __( '<th scope="row">Display Post Excerpts</th>', 'volatyl' ),
			'td'			=> '<td>',
			'title'			=> 'homeexcerpt',
			'label'			=> __( 'Display excerpts instead of full posts.', 'volatyl' ),
		),
		'Excerpt Link'			=> array(
			'title'			=> 'excerptlink',
			'label'			=> __( 'Link to full article in excerpts.', 'volatyl' ),
			'td_end'		=> '</td>',
			'tr_end'		=> '</tr>',
		),
		'Featured Image'			=> array(
			'tr'			=> '<tr>',
			'th'			=> __( '<th scope="row">Display Featured Images</th>', 'volatyl' ),
			'td'			=> '<td>',
			'title'			=> 'featuredimage',
			'label'			=> __( 'Display Featured Images that have been set in the Edit Post screen.', 'volatyl' ),
			'td_end'		=> '</td>',
			'tr_end'		=> '</tr>'
		),
		'Tags Feed'			=> array(
			'tr'			=> '<tr>',
			'th'			=> __( '<th scope="row">Display Tags Listings</th>', 'volatyl' ),
			'td'			=> '<td>',
			'title'			=> 'feedtags',
			'label'			=> __( 'Post Feeds (home, search, archives, etc.)', 'volatyl' ),
		),
		'Tags Posts'		=> array(
			'title'			=> 'singletags',
			'label'			=> __( 'Single Posts', 'volatyl' ),
			'td_end'		=> '</td>',
			'tr_end'		=> '</tr>',
		),
		'Post Pings'		=> array(
			'tr'			=> '<tr>',
			'th'			=> __( '<th scope="row">Display Post Pings</th>', 'volatyl' ),
			'td'			=> '<td>',
			'title'			=> 'postpings',
			'label'			=> __( 'Display trackbacks and pingbacks on posts below comments.', 'volatyl' ),
			'notes'			=> __( '<span class="notes">If pings already exist, choosing to no longer allow them on the "Edit Post" page will not remove the original ones from the Post. Checking this box will.</span>', 'volatyl' ),
			'td_end'		=> '</td>',
			'tr_end'		=> '</tr>',
		),
	);
	return $vol_post;
}

// Page Settings on the "Content" tab
function volatyl_page() {
	$vol_page = array( 
		'Search Pages'		=> array(
			'table_name'	=> __( '</table><h3>Page Settings</h3>', 'volatyl' ),
			'table'			=> '<table class="form-table">',
			'tr'			=> '<tr>',
			'th'			=> __( '<th scope="row">Display Pages in Search Results</th>', 'volatyl' ),
			'td'			=> '<td>',
			'title'			=> 'searchpages',
			'label'			=> __( 'Search results are usually limited to posts. Consider leaving this unchecked.', 'volatyl' ),
			'td_end'		=> '</td>',
			'tr_end'		=> '</tr>',
		),
		'Page Comments' 	=> array( 
			'tr'			=> '<tr>',
			'th'			=> __( '<th scope="row">Display Comments on all Pages</th>', 'volatyl' ),
			'td'			=> '<td>',
			'title'			=> 'pagecomments',
			'label'			=> __( 'Display comments, trackbacks, and pingbacks on Pages. ', 'volatyl' ),
			'notes'			=> __( '<span class="notes">If comments, trackbacks, or pingbacks already exist, choosing to no longer allow them on the "Edit Page" page will not remove the original ones from the Page. Checking this box will.</span>', 'volatyl' ),
			'td_end'		=> '</td>',
			'tr_end'		=> '</tr>',
		),
	);
	return $vol_page;
}
 
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
		'Site Info' 	=> array( 
			'name'				=> 'vol_site_info',
			'title' 			=> __( 'Site Information', 'volatyl' ),
			'description'		=> __( 'This displays just after (inline) the site attribution. If you remove the Volatyl attribution,<br>you can build your own information area here.', 'volatyl' ) 
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
		'vol_after_article_header' => array( 
			'name'				=> 'vol_after_article_header',
			'title' 			=> __( 'After Article Header', 'volatyl' ),
			'description'		=> __( 'Displays beneath article headline and byline (if byline items show).<br>Suggestion: Many bloggers place ads in this area.', 'volatyl' ) 
		),
		'vol_post_footer' 		=> array( 
			'name'				=> 'vol_post_footer',
			'title' 			=> __( 'Single Post Footer', 'volatyl' ),
			'description'		=> __( 'Displays below your articles but above the comments.<br>Suggestion: Use this area as a call-to-action after a vistor reads your content.', 'volatyl' ) 
		),
		'vol_before_sidebar_1' => array( 
			'name'				=> 'vol_before_sidebar_1',
			'title' 			=> __( 'Before Sidebar 1', 'volatyl' ),
			'description'		=> __( 'Directly above Sidebar 1 in all layouts', 'volatyl' ) 
		),
		'vol_after_sidebar_1' 	=> array( 
			'name'				=> 'vol_after_sidebar_1',
			'title' 			=> __( 'After Sidebar 1', 'volatyl' ),
			'description'		=> __( 'Directly below Sidebar 1 in all layouts', 'volatyl' ) 
		),
		'vol_before_sidebar_2' => array( 
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

// Hooks setup	
function vol_before_html() { 
	global $options; 
	echo stripslashes( $options[ 'vol_before_html' ] ); 
	do_action( 'vol_before_html' ); 
}
function vol_after_html() { 
	global $options; 
	echo stripslashes( $options[ 'vol_after_html' ] ); 
	do_action( 'vol_after_html' ); 
}
function vol_header_top() { 
	global $options; 
	echo stripslashes( $options[ 'vol_header_top' ] ); 
	do_action( 'vol_header_top' ); 
}
function vol_header_bottom() { 
	global $options; 
	echo stripslashes( $options[ 'vol_header_bottom' ] ); 
	do_action( 'vol_header_bottom' ); 
}
function vol_footer_top() { 
	global $options; 
	echo stripslashes( $options[ 'vol_footer_top' ] ); 
	do_action( 'vol_footer_top' ); 
}
function vol_footer_bottom() { 
	global $options; 
	echo stripslashes( $options[ 'vol_footer_bottom' ] ); 
	do_action( 'vol_footer_bottom' ); 
}
function vol_site_info() { 
	global $options; 
	echo stripslashes( $options[ 'vol_site_info' ] ); 
	do_action( 'vol_site_info' ); 
}
function vol_headliner() { 
	global $options; 
	echo stripslashes( $options[ 'vol_headliner' ] ); 
	do_action( 'vol_headliner' ); 
}
function vol_footliner() { 
	global $options; 
	echo stripslashes( $options[ 'vol_footliner' ] ); 
	do_action( 'vol_footliner' ); 
}
function vol_before_content_area() { 
	global $options; 
	echo stripslashes( $options[ 'vol_before_content_area' ] ); 
	do_action( 'vol_before_content_area' ); 
}
function vol_after_content_area() { 
	global $options; 
	echo stripslashes( $options[ 'vol_after_content_area' ] ); 
	do_action( 'vol_after_content_area' ); 
}
function vol_before_content() { 
	global $options; 
	echo stripslashes( $options[ 'vol_before_content' ] ); 
	do_action( 'vol_before_content' ); 
}
function vol_after_content() { 
	global $options; 
	echo stripslashes( $options[ 'vol_after_content' ] ); 
	do_action( 'vol_after_content' ); 
}
function vol_before_content_column() { 
	global $options; 
	echo stripslashes( $options[ 'vol_before_content_column' ] ); 
	do_action( 'vol_before_content_column' ); 
}
function vol_after_content_column() { 
	global $options; 
	echo stripslashes( $options[ 'vol_after_content_column' ] ); 
	do_action( 'vol_after_content_column' ); 
}
function vol_after_article_header() {
	global $options; 
	echo stripslashes( $options[ 'vol_after_article_header' ] ); 
	do_action( 'vol_after_article_header' ); 
}
function vol_post_footer() { 
	global $options; 
	echo stripslashes( $options[ 'vol_post_footer' ] ); 
	do_action( 'vol_post_footer' ); 
}
function vol_before_sidebar_1() { 
	global $options_hooks; 
	echo stripslashes( $options_hooks[ 'vol_before_sidebar_1' ] ); 
	do_action( 'vol_before_sidebar_1' ); 
}
function vol_after_sidebar_1() { 
	global $options_hooks; 
	echo stripslashes( $options_hooks[ 'vol_after_sidebar_1' ] ); 
	do_action( 'vol_after_sidebar_1' ); 
}
function vol_before_sidebar_2() { 
	global $options_hooks; 
	echo stripslashes( $options_hooks[ 'vol_before_sidebar_2' ] ); 
	do_action( 'vol_before_sidebar_2' ); 
}
function vol_after_sidebar_2() { 
	global $options_hooks; 
	echo stripslashes( $options_hooks[ 'vol_after_sidebar_2' ] ); 
	do_action( 'vol_after_sidebar_2' ); 
}