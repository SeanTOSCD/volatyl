<?php
/** header.php
 *
 ***** THIS IS A CORE VOLATYL FILE AND SHOULD NOT BE EDITED!
 ***** ALL CUSTOM CODING SHOULD BE DONE IN A CHILD THEME.
 ***** MORE INFORMATION - http://volatylthemes.com/why-child-themes/
 *******************************************************************
 *
 * Doctype, opening HTML, everything located inside the <head> of your
 * website, and the opening <body> tag can be found here.
 *
 * @package Volatyl
 * @since Volatyl 1.0
 */ 
global $page, $paged;
$title = get_bloginfo('name');
$tagline = get_bloginfo('description');
$char = get_bloginfo('charset');
$ping = get_bloginfo('pingback_url');

echo "<!DOCTYPE html>
<html ", language_attributes(), ">
<head>
<meta charset=\"", $char, "\">
<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
<title>",

// Print the <title> tag based on what is being viewed.	 
wp_title('|', false, 'right'),
$title,

// Add the blog description for the home/front page.
(!empty($tagline) && (is_home() || is_front_page()) ? " | $tagline" : ''),

// Add a page number if necessary:
($paged >= 2 || $page >= 2 ? ' | ' . sprintf(__('Page %s', 'volatyl'), max($paged, $page)) : ''),

"</title>
<link rel=\"profile\" href=\"http://gmpg.org/xfn/11\" />
<link rel=\"pingback\" href=\"", $ping, "\" />",

// HTML5 Shiv
"<!--[if lt IE 9]>\t<script src=\"", THEME_PATH, "/inc/js/html5.js\" type=\"text/javascript\"></script><![endif]-->";

// WordPress' <head> hook
wp_head();
echo "</head><body ", body_class(), ">";