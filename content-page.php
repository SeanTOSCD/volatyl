<?php
/** content-page.php
 *
 ***** THIS IS A CORE VOLATYL FILE AND SHOULD NOT BE EDITED!
 ***** ALL CUSTOM CODING SHOULD BE DONE IN A CHILD THEME.
 ***** MORE INFORMATION - http://volatylthemes.com/why-child-themes/
 *******************************************************************
 *
 * Pages use this template to output Page content. To override this
 * template in a child theme, copy this file into the root of your child
 * theme folder and make ADJUSTMENTS there. Use this file as a starting
 * point so you don't lose any variables, constants, etc.
 *
 * This template covers the basic Page <article> and associated
 * hooks and navigation. Landing, squeeze, and other custom Pages
 * have their own templates names custom-tamplate-name.php in the
 * root of the Volatyl folder.
 *
 * @package Volatyl
 * @since Volatyl 1.0
 */
global $options, $tab3;
$options = get_option( 'vol_content_options' );

// Custom filter
$page_page_nav = apply_filters( 'page_page_nav', 'Pages:' );

echo "\t<article id=\"post-", the_ID(), "\"",
post_class(), ">\n
\t\t<header class=\"entry-header\">\n
{$tab3}<h1 class=\"entry-title\">", the_title(), "</h1>\n
\t\t</header>\n
\t\t<section class=\"entry-content\">\n",  the_content();
( ( $options[ 'pagecomments' ] == 1 ) ?
	( ( comments_open() || '0' != get_comments_number() ) ?
		comments_template( '', true ) :
	'' ) :
'' );

wp_link_pages( array( 'before' => '<nav class="page-links post-meta-footer">' . __( $page_page_nav, 'volatyl' ), 'after' => '</nav>' ) );
echo "\t\t</section>\n
\t</article>\n";