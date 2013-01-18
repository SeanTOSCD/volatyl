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
if ( $options_hooks[ 'switch_vol_before_sidebar_2' ] == 0 )
	vol_before_sidebar_2();

do_action( 'before_sidebar' );

if ( ! dynamic_sidebar( 'sidebar-2' ) )
	default_widget();

// vol_after_sidebar_2
if ( $options_hooks[ 'switch_vol_after_sidebar_2' ] == 0 )
	vol_after_sidebar_2();

echo "</div>";
