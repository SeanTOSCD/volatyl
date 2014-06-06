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
$char = get_bloginfo('charset');
$ping = get_bloginfo('pingback_url');
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php echo $char; ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title><?php wp_title('|', true, 'right'); ?></title>
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<link rel="pingback" href="<?php echo $ping; ?>">
		<?php wp_head(); // do not remove ?>
	</head>
	<body <?php body_class(); ?>>