<?php
/**
 * Sidebar 2 containing widget area and hooks
 *
 * @package Volatyl
 * @since Volatyl 1.0
 */
 
$options_hooks = get_option( 'vol_hooks_options' );

echo "<div id=\"sidebars\" class=\"widget-area sidebar-2 border-box\" role=\"complementary\">\n";

// vol_before_sidebar_2
if ( $options_hooks[ 'switch_vol_before_sidebar_2' ] == 0 ) {
	if 	( ( is_home() && $options_hooks[ 'home_vol_before_sidebar_2' ] == 0 ) ||
		( is_single() && $options_hooks[ 'posts_vol_before_sidebar_2' ] == 0 ) ||
		( is_page() && $options_hooks[ 'pages_vol_before_sidebar_2' ] == 0 ) ||
		( is_archive() && $options_hooks[ 'archive_vol_before_sidebar_2' ] == 0 ) ||
		( is_search() && $options_hooks[ 'search_vol_before_sidebar_2' ] == 0 ) ||
		( is_404() && $options_hooks[ '404_vol_before_sidebar_2' ] == 0 ) ) {
			vol_before_sidebar_2();
	} else {
		do_action( 'vol_before_sidebar_2' );
	}
}

do_action( 'before_sidebar' );

echo ( ( ! dynamic_sidebar( 'sidebar-2' ) ) ? default_widget() : '' );

// vol_after_sidebar_2
if ( $options_hooks[ 'switch_vol_after_sidebar_2' ] == 0 ) {
	if 	( ( is_home() && $options_hooks[ 'home_vol_after_sidebar_2' ] == 0 ) ||
		( is_single() && $options_hooks[ 'posts_vol_after_sidebar_2' ] == 0 ) ||
		( is_page() && $options_hooks[ 'pages_vol_after_sidebar_2' ] == 0 ) ||
		( is_archive() && $options_hooks[ 'archive_vol_after_sidebar_2' ] == 0 ) ||
		( is_search() && $options_hooks[ 'search_vol_after_sidebar_2' ] == 0 ) ||
		( is_404() && $options_hooks[ '404_vol_after_sidebar_2' ] == 0 ) ) {
			vol_after_sidebar_2();
	} else {
		do_action( 'vol_after_sidebar_2' );
	}
}
echo "</div>";