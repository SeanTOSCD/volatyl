<?php
/** around-content.php
 *
 * Dumb filename, huh? The two functions here, before_content() and
 * after_content(), cover everything from the bottom of the <head> to
 * the top of the main content... and the bottom of the main content
 * to the top of the site footer. They actually are "around the content."
 *
 * @package Volatyl
 * @since Volatyl 1.0
 */

function before_content() {
	global $options;
	$options = get_option( 'vol_hooks_options' );
	$options_content = get_option( 'vol_content_options' );
	$options_structure = get_option( 'vol_structure_options' );

	// vol_before_html
	if ( $options[ 'switch_vol_before_html' ] == 0 ) {
		if 	( ( is_home() && $options[ 'home_vol_before_html' ] == 0 ) ||
			( is_single() && $options[ 'posts_vol_before_html' ] == 0 ) ||
			( is_page() && $options[ 'pages_vol_before_html' ] == 0 ) ||
			( is_archive() && $options[ 'archive_vol_before_html' ] == 0 ) ||
			( is_search() && $options[ 'search_vol_before_html' ] == 0 ) ||
			( is_404() && $options[ '404_vol_before_html' ] == 0 ) ) {
				vol_before_html();
		} else {
			do_action( 'vol_before_html' );
		}
	}

	echo 
	header_frame(),
	standard_menu_on();

	// vol_headliner
	if ( $options[ 'switch_vol_headliner' ] == 0 && ! is_page_template( 'custom-landing.php' ) && ! is_page_template( 'custom-layout.php' ) ) {
		if 	( ( is_home() && $options[ 'home_vol_headliner' ] == 0 ) ||
			( is_single() && $options[ 'posts_vol_headliner' ] == 0 ) ||
			( is_page() && $options[ 'pages_vol_headliner' ] == 0 ) ||
			( is_archive() && $options[ 'archive_vol_headliner' ] == 0 ) ||
			( is_search() && $options[ 'search_vol_headliner' ] == 0 ) ||
			( is_404() && $options[ '404_vol_headliner' ] == 0 ) ) {
				show_vol_headliner();
		} else {
			do_action( 'vol_headliner' );
		}
	}

	// vol_before_content
	if ( $options[ 'switch_vol_before_content' ] == 0 && ! is_page_template( 'custom-landing.php' ) && $options_structure[ 'wide' ] == 0 ) {
		if 	( ( is_home() && $options[ 'home_vol_before_content' ] == 0 ) ||
			( is_single() && $options[ 'posts_vol_before_content' ] == 0 ) ||
			( is_page() && $options[ 'pages_vol_before_content' ] == 0 ) ||
			( is_archive() && $options[ 'archive_vol_before_content' ] == 0 ) ||
			( is_search() && $options[ 'search_vol_before_content' ] == 0 ) ||
			( is_404() && $options[ '404_vol_before_content' ] == 0 ) ) {
				vol_before_content();
		} else {
			do_action( 'vol_before_content' );
		}
	}

	// vol_before_content_area
	if ( $options[ 'switch_vol_before_content_area' ] == 0 && ! is_page_template( 'custom-landing.php' ) && $options_structure[ 'wide' ] == 1 ) {
		if 	( ( is_home() && $options[ 'home_vol_before_content_area' ] == 0 ) ||
			( is_single() && $options[ 'posts_vol_before_content_area' ] == 0 ) ||
			( is_page() && $options[ 'pages_vol_before_content_area' ] == 0 ) ||
			( is_archive() && $options[ 'archive_vol_before_content_area' ] == 0 ) ||
			( is_search() && $options[ 'search_vol_before_content_area' ] == 0 ) ||
			( is_404() && $options[ '404_vol_before_content_area' ] == 0 ) ) {
				vol_before_content_area();
		} else {
			do_action( 'vol_before_content_area' );
		}
	}
	
}

function after_content() {
	global $options;
	$options = get_option( 'vol_hooks_options' );
	$options_content = get_option( 'vol_content_options' );
	$options_structure = get_option( 'vol_structure_options' );

	// vol_after_content_area
	if ( $options[ 'switch_vol_after_content_area' ] == 0 && ! is_page_template( 'custom-landing.php' ) && $options_structure[ 'wide' ] == 1 ) {
		if 	( ( is_home() && $options[ 'home_vol_after_content_area' ] == 0 ) ||
			( is_single() && $options[ 'posts_vol_after_content_area' ] == 0 ) ||
			( is_page() && $options[ 'pages_vol_after_content_area' ] == 0 ) ||
			( is_archive() && $options[ 'archive_vol_after_content_area' ] == 0 ) ||
			( is_search() && $options[ 'search_vol_after_content_area' ] == 0 ) ||
			( is_404() && $options[ '404_vol_after_content_area' ] == 0 ) ) {
				vol_after_content_area();
		} else {
			do_action( 'vol_after_content_area' );
		}
	}

	// vol_after_content
	if ( $options[ 'switch_vol_after_content' ] == 0 && ! is_page_template( 'custom-landing.php' ) && $options_structure[ 'wide' ] == 0 ) {
		if 	( ( is_home() && $options[ 'home_vol_after_content' ] == 0 ) ||
			( is_single() && $options[ 'posts_vol_after_content' ] == 0 ) ||
			( is_page() && $options[ 'pages_vol_after_content' ] == 0 ) ||
			( is_archive() && $options[ 'archive_vol_after_content' ] == 0 ) ||
			( is_search() && $options[ 'search_vol_after_content' ] == 0 ) ||
			( is_404() && $options[ '404_vol_after_content' ] == 0 ) ) {
				vol_after_content();
		} else {
			do_action( 'vol_after_content' );
		}
	}

	// vol_footliner
	if ( $options[ 'switch_vol_footliner' ] == 0 && ! is_page_template( 'custom-landing.php' ) && ! is_page_template( 'custom-layout.php' ) ) {
		if 	( ( is_home() && $options[ 'home_vol_footliner' ] == 0 ) ||
			( is_single() && $options[ 'posts_vol_footliner' ] == 0 ) ||
			( is_page() && $options[ 'pages_vol_footliner' ] == 0 ) ||
			( is_archive() && $options[ 'archive_vol_footliner' ] == 0 ) ||
			( is_search() && $options[ 'search_vol_footliner' ] == 0 ) ||
			( is_404() && $options[ '404_vol_footliner' ] == 0 ) ) {
				show_vol_footliner();
		} else {
			do_action( 'vol_footliner' );
		}
	}
	
	footer_menu_on();
	footer_frame();

	// vol_after_html
	if ( $options[ 'switch_vol_after_html' ] == 0 ) {
		if 	( ( is_home() && $options[ 'home_vol_after_html' ] == 0 ) ||
			( is_single() && $options[ 'posts_vol_after_html' ] == 0 ) ||
			( is_page() && $options[ 'pages_vol_after_html' ] == 0 ) ||
			( is_archive() && $options[ 'archive_vol_after_html' ] == 0 ) ||
			( is_search() && $options[ 'search_vol_after_html' ] == 0 ) ||
			( is_404() && $options[ '404_vol_after_html' ] == 0 ) ) {
				vol_after_html();
		} else {
			do_action( 'vol_after_html' );
		}
	}
	
}