<?php
/** header.php
 *
 * Doctype, opening HTML, everything located inside the <head> of your
 * website, and the opening <body> tag can be found here.
 *
 * @package Volatyl
 * @since Volatyl 1.0
 */ 

global $page, $paged;
$title = get_bloginfo( 'name' );
$tagline = get_bloginfo( 'description' );
$char = get_bloginfo( 'description' );
$ping = get_bloginfo( 'pingback_url' );
 
echo 	"<!DOCTYPE html>\n",
		"<html ", language_attributes(), ">\n",
		"<head>\n",
		"<meta charset=\"", $char, "\" />\n",
		"<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\n",
		"<title>",
		
			// Print the <title> tag based on what is being viewed.	 
			wp_title( '|', false, 'right' ),
	
			// Add the blog name.
			$title,
	
			// Add the blog description for the home/front page.
			( ! empty( $tagline ) && ( is_home() || is_front_page() ) ? " | $tagline" : '' ),
		
			// Add a page number if necessary:
			( $page >= 2 || $page >= 2 ? ' | ' . sprintf( __( 'Page %s', 'volatyl' ), max( $paged, $page ) ) : '' ),

		"</title>\n",
		"<link rel=\"profile\" href=\"http://gmpg.org/xfn/11\" />\n",
		"<link rel=\"pingback\" href=\"", $ping, "\" />\n",

		// HTML5 Shiv
		"<!--[if lt IE 9]>\n\t<script src=\"", THEME_PATH, "/inc/js/html5.js\" type=\"text/javascript\"></script>\n<![endif]-->\n";

// WordPress' <head> hook
wp_head();
echo "</head>\n<body ", body_class(), ">";