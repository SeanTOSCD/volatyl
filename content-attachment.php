<?php
/** content-attachment.php
 *
 ***** THIS IS A CORE VOLATYL FILE AND SHOULD NOT BE EDITED!
 ***** ALL CUSTOM CODING SHOULD BE DONE IN A CHILD THEME.
 ***** MORE INFORMATION - http://volatylthemes.com/why-child-themes/
 *******************************************************************
 *
 * File attachments use this template to output content. To override this
 * template in a child theme, copy this file into the root of your child
 * theme folder and make ADJUSTMENTS there. Use this file as a starting
 * point so you don't lose any variables, constants, etc.
 *
 * This template covers the actual attachment <article> and associated
 * hooks and navigation.
 *
 * @package Volatyl
 * @since Volatyl 1.0
 */
global $post, $options, $tab3;
$metadata = wp_get_attachment_metadata();
$attachment_size = apply_filters( 'volatyl_attachment_size', array( 1200, 1200 ) );
$attachment_page_nav = apply_filters( 'attachment_page_nav', 'Pages:' );

// Custom filters
$attachment_navigation = apply_filters( 'attachment_navigation', array(
	'previous_image'	=> '&larr; Previous',
	'next_image'		=> 'Next &rarr;'
	)
);

echo "\t<article id=\"post-", the_ID(), "\"", post_class(), ">\n
\t\t<header class=\"entry-header\">\n
{$tab3}<h1 class=\"entry-title\">", the_title(), "</h1>\n
{$tab3}<div class=\"entry-meta\">\n" .
sprintf( __( 'Published <span class="entry-date"><time class="entry-date" datetime="%1$s" pubdate>%2$s</time></span> at <a href="%3$s" title="Link to full-size image">%4$s &times; %5$s</a> in <a href="%6$s" title="Return to %7$s" rel="gallery">%7$s</a>', 'volatyl' ),
	esc_attr( get_the_date( 'c' ) ),
	esc_html( get_the_date() ),
	wp_get_attachment_url(),
	$metadata[ 'width' ],
	$metadata[ 'height' ],
	get_permalink( $post->post_parent ),
	get_the_title( $post->post_parent )
) .
"{$tab3}</div>\n
\t\t</header>\n
\t\t<section class=\"entry-content\">\n
{$tab3}<div class=\"entry-attachment\">\n
{$tab3}\t<div class=\"attachment\">\n";
/**
 * Grab the IDs of all the image attachments in a
 * gallery so we can get the URL of the next adjacent
 * image in a gallery, or the first image (if we're
 * looking at the last image in a gallery), or, in a
 * gallery of one, just the link to that image file
 */
$attachments = array_values( get_children( array(
	'post_parent'		=> $post->post_parent,
	'post_status' 		=> 'inherit',
	'post_type' 		=> 'attachment',
	'post_mime_type' 	=> 'image',
	'order' 			=> 'ASC',
	'orderby' 			=> 'menu_order ID'
	)
) );
foreach ( $attachments as $k => $attachment ) {
	if ( $attachment->ID == $post->ID )
		break;
}
$k++;

// If there is more than 1 attachment in a gallery
if ( count( $attachments ) > 1 ) {
	( ( isset( $attachments[ $k ] ) ) ?
		$next_attachment_url = get_attachment_link( $attachments[ $k ]->ID ) :
		$next_attachment_url = get_attachment_link( $attachments[ 0 ]->ID ) );
} else {
	$next_attachment_url = wp_get_attachment_url();
}
echo "<a href=\"", $next_attachment_url, "\" title=\"", esc_attr( get_the_title() ), "\" rel=\"attachment\">",
wp_get_attachment_image( $post->ID, $attachment_size ),
"</a>\n
{$tab3}\t</div>\n",
( ( ! empty( $post->post_excerpt ) ) ? sprintf( "{$tab3}\t<div class=\"entry-caption\">\n" ) . the_excerpt() .	sprintf( "{$tab3}\t</div>\n" ) : '' );
wp_link_pages( array( 'before' => '<nav class="page-links post-meta-footer">' . __( $attachment_page_nav, 'volatyl' ), 'after' => '</nav>' ) );
echo "{$tab3}</div>\n
{$tab3}<nav class=\"site-navigation image-navigation clearfix\">
{$tab3}\t<div class=\"nav-previous image-nav\">",
previous_image_link( false, __( $attachment_navigation[ 'previous_image' ], 'volatyl' ) ),
"{$tab3}\t</div>\n
{$tab3}\t<div class=\"nav-next image-nav\">",
next_image_link( false, __( $attachment_navigation[ 'next_image' ], 'volatyl' ) ),
"{$tab3}\t</div>\n
{$tab3}</nav>\n
\t\t</section>\n
\t</article>";