<?php
/** customizer.php
 *
 ***** THIS IS A CORE VOLATYL FILE AND SHOULD NOT BE EDITED!
 ***** ALL CUSTOM CODING SHOULD BE DONE IN A CHILD THEME.
 ***** MORE INFORMATION - http://volatylthemes.com/why-child-themes/
 *******************************************************************
 *
 * The options created here replace the old options from Volatyl 1.0.
 * Implemented in version 2.0, these options are set from an update
 * script based on the old options.
 *
 * @package Volatyl/Customizer
 * @since Volatyl 2.0
 */


/**
 * Volatyl Customizer
 */
function volatyl_customize_register( $wp_customize ) {


	/** ===============
	 * Allow arbitrary HTML controls
	 */
	class Volatyl_Customizer_HTML extends WP_Customize_Control {

		public $content = '';
		public function render_content() {
			if ( isset( $this->label ) ) {
				echo '<hr><h3 class="settings-heading">' . $this->label . '</h3>';
			}
			if ( isset( $this->description ) ) {
				echo '<div class="description customize-control-description settings-description">' . $this->description . '</div>';
			}
		}
	}

	// Site Identity - Priority 10

	/** ===============
	 * Global Settings
	 */
	$wp_customize->add_section( 'volatyl_global', array(
		'title'         => THEME_NAME . ' ' . __( 'Global Settings', 'volatyl' ),
		'description'   => __( 'Site-wide settings and behavior.', 'volatyl' ),
		'priority'      => 20,
	) );

	// Framework updates
	$wp_customize->add_setting( 'volatyl_framework_updates', array( 
		'default'           => 1,
		'sanitize_callback' => 'volatyl_sanitize_checkbox'
	) );
	$wp_customize->add_control( 'volatyl_framework_updates', array(
		'label'     => __( 'Enable Framework Updates', 'volatyl' ),
		'section'   => 'volatyl_global',
		'priority'  => 10,
		'type'      => 'checkbox',
	) );

	// Toolbar
	$wp_customize->add_setting( 'volatyl_toolbar', array( 
		'default'           => 1,
		'sanitize_callback' => 'volatyl_sanitize_checkbox'
	) );
	$wp_customize->add_control( 'volatyl_toolbar', array(
		'label'     => __( 'Display Volatyl Toolbar', 'volatyl' ),
		'section'   => 'volatyl_global',
		'priority'  => 20,
		'type'      => 'checkbox',
	) );

	// Attribution
	$wp_customize->add_setting( 'volatyl_attribution', array( 
		'default'           => 1,
		'sanitize_callback' => 'volatyl_sanitize_checkbox'
	) );
	$wp_customize->add_control( 'volatyl_attribution', array(
		'label'     => __( 'Display Volatyl Attribution', 'volatyl' ),
		'section'   => 'volatyl_global',
		'priority'  => 30,
		'type'      => 'checkbox',
	) );


	/** ===============
	 * Design Settings
	 */
	$wp_customize->add_section( 'volatyl_design', array(
		'title'         => THEME_NAME . ' ' . __( 'Design Settings', 'volatyl' ),
		'description'   => __( 'Structural and visual settings.', 'volatyl' ),
		'priority'      => 20,
	) );

	// logo
	$wp_customize->add_setting( 'volatyl_logo', array(
		'default' => null
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'volatyl_logo', array(
		'label'     => __( 'Site Logo (replaces title)', 'volatyl' ),
		'section'   => 'volatyl_design',
		'priority'  => 10
	) ) );

	// Content Layout
	$wp_customize->add_setting( 'volatyl_content_layout', array( 
		'default'           => 'sc', 
		'sanitize_callback' => 'volatyl_sanitize_content_layout' 
	) );
	$wp_customize->add_control( 'volatyl_content_layout', array(
		'label'   => __( 'Choose a content layout:', 'shoppette' ),
		'section' => 'volatyl_design',
		'priority'  => 20,
		'type'    => 'select',
		'choices' => array(
			'c1'  => __( 'Content (no sidebars)', 'volatyl' ),
			'c2'  => __( 'Content (sidebars below)', 'volatyl' ),
			'cs'  => __( 'Content / Sidebar', 'volatyl' ),
			'sc'  => __( 'Sidebar / Content', 'volatyl' ),
			'css' => __( 'Content / Sidebar / Sidebar', 'volatyl' ),
			'scs' => __( 'Sidebar / Content / Sidebar', 'volatyl' ),
			'ssc' => __( 'Sidebar / Sidebar / Content', 'volatyl' ),
	) ) );

	// HTML Structure
	$wp_customize->add_setting( 'volatyl_html_structure', array( 
		'default'           => 1,
		'sanitize_callback' => 'volatyl_sanitize_checkbox'
	) );
	$wp_customize->add_control( 'volatyl_html_structure', array(
		'label'     => __( 'Wide (100%) HTML Structure', 'volatyl' ),
		'section'   => 'volatyl_design',
		'priority'  => 30,
		'type'      => 'checkbox',
	) );

	// Responsive CSS
	$wp_customize->add_setting( 'volatyl_responsive_css', array( 
		'default'           => 1,
		'sanitize_callback' => 'volatyl_sanitize_checkbox'
	) );
	$wp_customize->add_control( 'volatyl_responsive_css', array(
		'label'     => __( 'Enable Responsive CSS', 'volatyl' ),
		'section'   => 'volatyl_design',
		'priority'  => 40,
		'type'      => 'checkbox',
	) );


	/** ===============
	 * Content Settings
	 */
	$wp_customize->add_section( 'volatyl_content', array(
		'title'         => THEME_NAME . ' ' . __( 'Content Settings', 'volatyl' ),
		'description'   => __( 'General site content settings.', 'volatyl' ),
		'priority'      => 20,
	) );

	// Header elements section
	$wp_customize->add_setting( 'volatyl_header_elements', array() );
	$wp_customize->add_control( new Volatyl_Customizer_HTML( $wp_customize, 'volatyl_header_elements', array(
		'section' => 'volatyl_content',
		'priority' => 10,
		'label' => __( 'Default Header Elements', 'volatyl' ),
	) ) );

	// Site title
	$wp_customize->add_setting( 'volatyl_site_title', array( 
		'default'           => 1,
		'sanitize_callback' => 'volatyl_sanitize_checkbox'
	) );
	$wp_customize->add_control( 'volatyl_site_title', array(
		'label'     => __( 'Display Site Title', 'volatyl' ),
		'section'   => 'volatyl_content',
		'priority'  => 20,
		'type'      => 'checkbox',
	) );

	// Site tagline
	$wp_customize->add_setting( 'volatyl_site_tagline', array( 
		'default'           => 1,
		'sanitize_callback' => 'volatyl_sanitize_checkbox'
	) );
	$wp_customize->add_control( 'volatyl_site_tagline', array(
		'label'     => __( 'Display Site Tagline', 'volatyl' ),
		'section'   => 'volatyl_content',
		'priority'  => 30,
		'type'      => 'checkbox',
	) );

	// Header menu
	$wp_customize->add_setting( 'volatyl_header_menu', array( 
		'default'           => 1,
		'sanitize_callback' => 'volatyl_sanitize_checkbox'
	) );
	$wp_customize->add_control( 'volatyl_header_menu', array(
		'label'     => __( 'Display Header Menu', 'volatyl' ),
		'section'   => 'volatyl_content',
		'priority'  => 40,
		'type'      => 'checkbox',
	) );

	// Menus section
	$wp_customize->add_setting( 'volatyl_menus', array() );
	$wp_customize->add_control( new Volatyl_Customizer_HTML( $wp_customize, 'volatyl_menus', array(
		'section'     => 'volatyl_content',
		'priority'    => 50,
		'label' => __( 'Activate Additional Menus', 'volatyl' ),
		'description' => __( 'Once activated, you must create new menus and add them to their respective "Theme Locations."', 'volatyl' )
	) ) );

	// Standard menu
	$wp_customize->add_setting( 'volatyl_standard_menu', array( 
		'default'           => 0,
		'sanitize_callback' => 'volatyl_sanitize_checkbox'
	) );
	$wp_customize->add_control( 'volatyl_standard_menu', array(
		'label'     => __( 'Display Standard Menu', 'volatyl' ),
		'section'   => 'volatyl_content',
		'priority'  => 60,
		'type'      => 'checkbox',
	) );

	// Footer menu
	$wp_customize->add_setting( 'volatyl_footer_menu', array( 
		'default'           => 0,
		'sanitize_callback' => 'volatyl_sanitize_checkbox'
	) );
	$wp_customize->add_control( 'volatyl_footer_menu', array(
		'label'     => __( 'Display Footer Menu', 'volatyl' ),
		'section'   => 'volatyl_content',
		'priority'  => 70,
		'type'      => 'checkbox',
	) );

	// Widgets section
	$wp_customize->add_setting( 'volatyl_widgets', array() );
	$wp_customize->add_control( new Volatyl_Customizer_HTML( $wp_customize, 'volatyl_widgets', array(
		'section' => 'volatyl_content',
		'priority' => 80,
		'label' => __( 'Default Widgets', 'volatyl' ),
		'description' => __( 'The default widget does not show in footer widgetized areas because they only display if an actual widget is used.', 'volatyl' ),
	) ) );

	// Default widgets
	$wp_customize->add_setting( 'volatyl_default_widgets', array( 
		'default'           => 1,
		'sanitize_callback' => 'volatyl_sanitize_checkbox'
	) );
	$wp_customize->add_control( 'volatyl_default_widgets', array(
		'label'     => __( 'Display Default Widgets', 'volatyl' ),
		'section'   => 'volatyl_content',
		'priority'  => 90,
		'type'      => 'checkbox',
	) );

	// Pagination section
	$wp_customize->add_setting( 'volatyl_pagination', array() );
	$wp_customize->add_control( new Volatyl_Customizer_HTML( $wp_customize, 'volatyl_pagination', array(
		'section' => 'volatyl_content',
		'priority' => 100,
		'label' => __( 'Pagination', 'volatyl' ),
	) ) );

	// Pagination
	$wp_customize->add_setting( 'volatyl_enhanced_pagination', array( 
		'default'           => 0,
		'sanitize_callback' => 'volatyl_sanitize_checkbox'
	) );
	$wp_customize->add_control( 'volatyl_enhanced_pagination', array(
		'label'     => __( 'Activate Pagination', 'volatyl' ),
		'section'   => 'volatyl_content',
		'priority'  => 110,
		'type'      => 'checkbox',
	) );

	// Byline section
	$wp_customize->add_setting( 'volatyl_posts', array() );
	$wp_customize->add_control( new Volatyl_Customizer_HTML( $wp_customize, 'volatyl_posts', array(
		'section' => 'volatyl_content',
		'priority' => 120,
		'label' => __( 'Post Byline Elements', 'volatyl' ),
	) ) );

	// Byline date
	$wp_customize->add_setting( 'volatyl_byline_date', array( 
		'default'           => 1,
		'sanitize_callback' => 'volatyl_sanitize_checkbox'
	) );
	$wp_customize->add_control( 'volatyl_byline_date', array(
		'label'     => _x( 'Date', 'post byline date setting', 'volatyl' ),
		'section'   => 'volatyl_content',
		'priority'  => 130,
		'type'      => 'checkbox',
	) );

	// Byline author
	$wp_customize->add_setting( 'volatyl_byline_author', array( 
		'default'           => 1,
		'sanitize_callback' => 'volatyl_sanitize_checkbox'
	) );
	$wp_customize->add_control( 'volatyl_byline_author', array(
		'label'     => _x( 'Author', 'post byline author setting', 'volatyl' ),
		'section'   => 'volatyl_content',
		'priority'  => 140,
		'type'      => 'checkbox',
	) );

	// Byline responses/comments
	$wp_customize->add_setting( 'volatyl_byline_responses_comments', array( 
		'default'           => 1,
		'sanitize_callback' => 'volatyl_sanitize_checkbox'
	) );
	$wp_customize->add_control( 'volatyl_byline_responses_comments', array(
		'label'     => _x( 'Responses/Comments', 'post byline responses/comments setting', 'volatyl' ),
		'section'   => 'volatyl_content',
		'priority'  => 150,
		'type'      => 'checkbox',
	) );

	// Byline edit link
	$wp_customize->add_setting( 'volatyl_byline_edit_link', array( 
		'default'           => 1,
		'sanitize_callback' => 'volatyl_sanitize_checkbox'
	) );
	$wp_customize->add_control( 'volatyl_byline_edit_link', array(
		'label'     => _x( 'Edit Link', 'post byline edit link setting', 'volatyl' ),
		'section'   => 'volatyl_content',
		'priority'  => 160,
		'type'      => 'checkbox',
	) );

	// Byline responses/comments
	$wp_customize->add_setting( 'volatyl_byline_categories', array( 
		'default'           => 1,
		'sanitize_callback' => 'volatyl_sanitize_checkbox'
	) );
	$wp_customize->add_control( 'volatyl_byline_categories', array(
		'label'     => _x( 'Categories', 'post byline categories setting', 'volatyl' ),
		'section'   => 'volatyl_content',
		'priority'  => 170,
		'type'      => 'checkbox',
	) );

	// Post excerpts
	$wp_customize->add_setting( 'volatyl_excerpts', array() );
	$wp_customize->add_control( new Volatyl_Customizer_HTML( $wp_customize, 'volatyl_excerpts', array(
		'section' => 'volatyl_content',
		'priority' => 180,
		'label' => __( 'Post Excerpts', 'volatyl' ),
	) ) );

	// Excerpts
	$wp_customize->add_setting( 'volatyl_post_excerpts', array( 
		'default'           => 0,
		'sanitize_callback' => 'volatyl_sanitize_checkbox'
	) );
	$wp_customize->add_control( 'volatyl_post_excerpts', array(
		'label'     => __( 'Display Post Excerpts', 'volatyl' ),
		'section'   => 'volatyl_content',
		'priority'  => 190,
		'type'      => 'checkbox',
	) );

	// Excerpt link
	$wp_customize->add_setting( 'volatyl_post_excerpt_link', array( 
		'default'           => 0,
		'sanitize_callback' => 'volatyl_sanitize_checkbox'
	) );
	$wp_customize->add_control( 'volatyl_post_excerpt_link', array(
		'label'     => __( 'Link to Full Article', 'volatyl' ),
		'section'   => 'volatyl_content',
		'priority'  => 200,
		'type'      => 'checkbox',
	) );

	// Featured images
	$wp_customize->add_setting( 'volatyl_featured_images', array() );
	$wp_customize->add_control( new Volatyl_Customizer_HTML( $wp_customize, 'volatyl_featured_images', array(
		'section' => 'volatyl_content',
		'priority' => 210,
		'label' => __( 'Featured Images', 'volatyl' ),
	) ) );

	// Post feed featured images
	$wp_customize->add_setting( 'volatyl_feed_featured_images', array( 
		'default'           => 0,
		'sanitize_callback' => 'volatyl_sanitize_checkbox'
	) );
	$wp_customize->add_control( 'volatyl_feed_featured_images', array(
		'label'     => __( 'Display on Post Feeds', 'volatyl' ),
		'section'   => 'volatyl_content',
		'priority'  => 220,
		'type'      => 'checkbox',
	) );

	// Single post featured images
	$wp_customize->add_setting( 'volatyl_post_featured_image', array( 
		'default'           => 1,
		'sanitize_callback' => 'volatyl_sanitize_checkbox'
	) );
	$wp_customize->add_control( 'volatyl_post_featured_image', array(
		'label'     => __( 'Display on Single Posts', 'volatyl' ),
		'section'   => 'volatyl_content',
		'priority'  => 230,
		'type'      => 'checkbox',
	) );

	// Tags
	$wp_customize->add_setting( 'volatyl_tags', array() );
	$wp_customize->add_control( new Volatyl_Customizer_HTML( $wp_customize, 'volatyl_tags', array(
		'section' => 'volatyl_content',
		'priority' => 240,
		'label' => __( 'Tags', 'volatyl' ),
	) ) );

	// Post feed tags
	$wp_customize->add_setting( 'volatyl_feed_tags', array( 
		'default'           => 1,
		'sanitize_callback' => 'volatyl_sanitize_checkbox'
	) );
	$wp_customize->add_control( 'volatyl_feed_tags', array(
		'label'     => __( 'Display on Post Feeds', 'volatyl' ),
		'section'   => 'volatyl_content',
		'priority'  => 250,
		'type'      => 'checkbox',
	) );

	// Single post tags
	$wp_customize->add_setting( 'volatyl_post_tags', array( 
		'default'           => 1,
		'sanitize_callback' => 'volatyl_sanitize_checkbox'
	) );
	$wp_customize->add_control( 'volatyl_post_tags', array(
		'label'     => __( 'Display on Single Posts', 'volatyl' ),
		'section'   => 'volatyl_content',
		'priority'  => 260,
		'type'      => 'checkbox',
	) );

	// Pings
	$wp_customize->add_setting( 'volatyl_pings_section', array() );
	$wp_customize->add_control( new Volatyl_Customizer_HTML( $wp_customize, 'volatyl_pings_section', array(
		'section' => 'volatyl_content',
		'priority' => 270,
		'label' => __( 'Pingbacks / Trackbacks', 'volatyl' ),
		'description' => __( 'If pings already exist, choosing to no longer allow them on the "Edit Post" page will not remove the original ones from the Post. Unchecking this box will.', 'volatyl' ),
	) ) );

	// Post pings
	$wp_customize->add_setting( 'volatyl_pings', array( 
		'default'           => 1,
		'sanitize_callback' => 'volatyl_sanitize_checkbox'
	) );
	$wp_customize->add_control( 'volatyl_pings', array(
		'label'     => __( 'Display Trackbacks / Pingbacks', 'volatyl' ),
		'section'   => 'volatyl_content',
		'priority'  => 280,
		'type'      => 'checkbox',
	) );

	// Pages
	$wp_customize->add_setting( 'volatyl_pages', array() );
	$wp_customize->add_control( new Volatyl_Customizer_HTML( $wp_customize, 'volatyl_pages', array(
		'section' => 'volatyl_content',
		'priority' => 290,
		'label' => __( 'Page Settings', 'volatyl' ),
		'description' => __( 'If comments, trackbacks, or pingbacks already exist, choosing to no longer allow them on the "Edit Page" page will not remove the original ones from the Page. Unchecking this box will.', 'volatyl' ),
	) ) );

	// Page comments
	$wp_customize->add_setting( 'volatyl_page_comments', array( 
		'default'           => 0,
		'sanitize_callback' => 'volatyl_sanitize_checkbox'
	) );
	$wp_customize->add_control( 'volatyl_page_comments', array(
		'label'     => __( 'Display Comments on Pages', 'volatyl' ),
		'section'   => 'volatyl_content',
		'priority'  => 300,
		'type'      => 'checkbox',
	) );
}
add_action( 'customize_register', 'volatyl_customize_register' );


/** 
 * Sanitize checkbox options
 */
function volatyl_sanitize_checkbox( $input ) {
	return 1 == $input ? 1 : 0;
}


/** ===============
 * Sanitize the content layout select option
 */
function volatyl_sanitize_content_layout( $input ) {
	$valid = array(
		'c1'  => __( 'Content (no sidebars)', 'volatyl' ),
		'c2'  => __( 'Content (sidebars below)', 'volatyl' ),
		'cs'  => __( 'Content / Sidebar', 'volatyl' ),
		'sc'  => __( 'Sidebar / Content', 'volatyl' ),
		'css' => __( 'Content / Sidebar / Sidebar', 'volatyl' ),
		'scs' => __( 'Sidebar / Content / Sidebar', 'volatyl' ),
		'ssc' => __( 'Sidebar / Sidebar / Content', 'volatyl' ),
	);
	
	if ( array_key_exists( $input, $valid ) ) {
		return $input;
	} else {
		return 'sc';
	}
}


/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function volatyl_customize_preview_js() {
	wp_enqueue_script( 'volatyl_customizer', get_template_directory_uri() . '/inc/js/customizer.js', array( 'customize-preview' ), THEME_VERSION, true );
}
add_action( 'customize_preview_init', 'volatyl_customize_preview_js' );


/** 
 * Add Customizer UI styles to the <head> only on Customizer page
 */
function volatyl_customizer_styles() { ?>
	<style type="text/css">
		hr { margin-top: 15px; }
		.settings-heading { margin-bottom: 0; }
		.settings-description { margin-top: 6px; }
		.customize-control-checkbox { margin-bottom: 0; }
	</style>
<?php }
add_action( 'customize_controls_print_styles', 'volatyl_customizer_styles' );
