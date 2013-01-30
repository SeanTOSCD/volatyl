<?php
/** init-functions.php
 *
 ***** THIS IS A CORE VOLATYL FILE AND SHOULD NOT BE EDITED!
 ***** ALL CUSTOM CODING SHOULD BE DONE IN A CHILD THEME.
 ***** MORE INFORMATION - http://volatylthemes.com/why-child-themes/
 *******************************************************************
 *
 * Volatyl functions and definitions
 *
 * @package Volatyl
 * @since Volatyl 1.0
 */
 
// Constants
define ( 'THEME_NAME', 'Volatyl ' );
define ( 'THEME_VERSION', '1.0 ' );
define ( 'THEME_URI', 'http://volatylthemes.com' );
define ( 'THEME_PATH', get_template_directory() );
define ( 'THEME_PATH_URI', get_template_directory_uri() );
define ( 'THEME_STYLESHEET', get_stylesheet_uri() );
define ( 'THEME_HTML', THEME_PATH . '/inc/html' );
define ( 'THEME_OPTIONS', THEME_PATH . '/inc/options' );
define ( 'THEME_FUNCTIONS', THEME_PATH . '/inc/functions' );

// Load pretty important files
require_once ( THEME_PATH . '/loops.php' );
require_once ( THEME_PATH . '/structure.php' );	 
require_once ( THEME_PATH . '/template-tags.php' );

// Load site structure
require_once ( THEME_HTML . '/header-html.php' );
require_once ( THEME_HTML . '/around-content.php' );
require_once ( THEME_HTML . '/main-content.php' );
require_once ( THEME_HTML . '/footer-html.php' );

// Load theme goodies (options)
require_once ( THEME_OPTIONS . '/theme-options.php' );
require_once ( THEME_OPTIONS . '/options-setup.php' );
require_once ( THEME_OPTIONS . '/option-defaults.php' );
require_once ( THEME_OPTIONS . '/admin-menu.php' );
require_once ( THEME_OPTIONS . '/logo-uploader.php' );
require_once ( THEME_OPTIONS . '/post-meta.php' );

// Various functions used around Volatyl
require_once ( THEME_FUNCTIONS . '/menus.php' );
require_once ( THEME_FUNCTIONS . '/columns.php' );
require_once ( THEME_FUNCTIONS . '/widgets.php' );
require_once ( THEME_FUNCTIONS . '/byline.php' );
require_once ( THEME_FUNCTIONS . '/page-nav.php' );
require_once ( THEME_FUNCTIONS . '/content.php' );
require_once ( THEME_FUNCTIONS . '/body-class.php' );


//  Sets up theme defaults and registers support for various WordPress features
if ( ! function_exists( 'volatyl_setup' ) ) {
	function volatyl_setup() {

		// WordPress says it's required. *Shoulder shrug*
		if ( ! isset( $content_width ) ) $content_width = 1000;

		// Translations can be filed in the /languages/ directory
		load_theme_textdomain( 'volatyl', THEME_PATH . '/inc/languages' );

		// Add default posts and comments RSS feed links to head
		add_theme_support( 'automatic-feed-links' );

		// Support for Post Thumbnails
		add_theme_support( 'post-thumbnails' );

		// Register wp_nav_menu() in header. This is the only default menu.	 
		register_nav_menus( array(
			'header' => __( 'Header Menu (Supports 1 drop-down level)', 'volatyl' )
		) );
	
		// Register wp_nav_menu() below header (standard menu) if selected
		$options = get_option( 'vol_content_options' );
		
		( ( $options[ 'standardmenu' ] == 1 ) ? 
			register_nav_menus( array(
				'standard' => __( 'Standard Menu (unlimited drop-downs)', 'volatyl' )
			) ) : 
		'' );
	
		// Register wp_nav_menu() above footer (footer menu) if selected	
		( ( $options[ 'footermenu' ] == 1 ) ?
			register_nav_menus( array(
				'footer' => __( 'Footer Menu (unlimited drop-downs)', 'volatyl' )
			) ) :
		'' );
			
	}
}
add_action( 'after_setup_theme', 'volatyl_setup' );


/** Enqueue front-end scripts and styles
 *
 * @since Volatyl 1.0
 */
function volatyl_front_scripts() {
	wp_enqueue_style( 'style', THEME_STYLESHEET );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'keyboard-image-navigation', THEME_PATH . '/inc/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}
}
add_action( 'wp_enqueue_scripts', 'volatyl_front_scripts' );


/** Enqueue back-end scripts and styles
 *
 * @since Volatyl 1.0
 */
function volatyl_back_scripts() {
	wp_register_style( 'theme-options', THEME_PATH_URI . '/inc/options/theme-options.css' );
	wp_register_script( 'logo-upload', THEME_PATH_URI . '/inc/js/logo-upload.js', array( 'jquery','media-upload','thickbox' ) );
	if ( 'appearance_page_volatyl_options' == get_current_screen() -> id ) {
		wp_enqueue_style( 'theme-options' );
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'thickbox' );
		wp_enqueue_style( 'thickbox' );
		wp_enqueue_script( 'media-upload' );
		wp_enqueue_script( 'logo-upload' );
	}
}
add_action('admin_enqueue_scripts', 'volatyl_back_scripts' );


// Tabs are so annoying sometimes
$indent = 3;
$tab3 = str_repeat( "\t", $indent );
$tab6 = str_repeat( "\t", $indent + 3 );
$tab9 = str_repeat( "\t", $indent + 6 );