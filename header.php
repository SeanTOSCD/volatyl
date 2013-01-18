<?php
/** header.php
 *
 * Doctype, opening HTML, everything located inside the <head> of your
 * website, and the opening <body>
 *
 * @package Volatyl
 * @since Volatyl 1.0
 */ 

global $page, $paged;
$title = get_bloginfo( 'name' );
$tagline = get_bloginfo( 'description' );
$char = get_bloginfo( 'charset' );
$ping = get_bloginfo( 'pingback_url' );
 
echo 	"<!DOCTYPE html>\n",
		"<html ", language_attributes(), ">\n",
		"<head>\n",
		"<meta charset=\"", $char, "\" />\n",
		"<meta name=\"viewport\" content=\"width=device-width\" />\n",
		"<title>"; 
		
			// Print the <title> tag based on what is being viewed
			wp_title( '|', true, 'right' );
	
			// Add the blog name.
			echo $title;
	
			// Add the blog description for the home/front page
			if ( $tagline && ( is_home() || is_front_page() ) )
				echo " | $tagline";
		
			// Add a page number if necessary:
			if ( $paged >= 2 || $page >= 2 )
				echo ' | ' . sprintf( __( 'Page %s', 'volatyl' ), max( $paged, $page ) );
			
echo 	"</title>\n",
		"<link rel=\"profile\" href=\"http://gmpg.org/xfn/11\" />\n",
		"<link rel=\"pingback\" href=\"", $ping, "\" />\n",

		// HTML5 Shiv
		"<!--[if lt IE 9]>\n\t<script src=\"", THEME_PATH, "/inc/js/html5.js\" type=\"text/javascript\"></script>\n<![endif]-->\n";

// WordPress' <head> hook
wp_head();

echo "</head>\n<body ", body_class(), ">";