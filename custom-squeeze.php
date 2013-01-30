<?php
/** Template Name: Squeeze Page
 *
 * This template is almost pointless... except that it's not.
 * A squeeze page typically serves ONE purpose. That purpose
 * is whatever you want it to be. Most people collect email
 * addresses or show a video. Something simple.
 *
 * There are no exit links form this page. Header, footer, 
 * sidebars, etc... they're all gone. Set your title and your
 * content. That's all you've got to work with. 
 *
 * @package Volatyl
 * @since Volatyl 1.0
 */
$options_structure = get_option( 'vol_structure_options' );

get_header();
( ( $options_structure[ 'wide' ] == 1 ) ?
	printf( "<div id=\"main-content\" class=\"full clearfix\">
	<div class=\"main clearfix\">" ) .
	vol_content() .
	printf( "</div></div>" ) : 
	printf( "<div id=\"main-content\" class=\"clearfix\">" ) .
	vol_content() .
	printf ("</div>" ) 
);
get_footer();