<?php
/** content-single.php
 *
 ***** THIS IS A CORE VOLATYL FILE AND SHOULD NOT BE EDITED!
 ***** ALL CUSTOM CODING SHOULD BE DONE IN A CHILD THEME.
 ***** MORE INFORMATION - http://volatylthemes.com/why-child-themes/
 *******************************************************************
 *
 * Single posts use this template to output content. To override this
 * template in a child theme, copy this file into the root of your child
 * theme folder and make ADJUSTMENTS there. Use this file as a starting
 * point so you don't lose any variables, constants, etc.
 *
 * This template covers the actual post <article> and associated
 * hooks and navigation.
 *
 * @package Volatyl
 * @since Volatyl 1.0
 */
global $options, $tab3;
$options_posts = get_option('vol_content_options');

// Custom filters
$single_tags_text = apply_filters('single_tags_text', 'Tags: ');
$post_page_nav = apply_filters('post_page_nav', 'Pages:');

echo "\t<article id=\"post-", the_ID(), "\" ", post_class(), ">\n";

// vol_before_article_header
(($options['switch_vol_before_article_header'] == 0) ?
	(($options['posts_vol_before_article_header'] == 0) ?
		vol_before_article_header() :
		do_action('vol_before_article_header')) :
'');
echo "\t\t<header class=\"entry-header\">\n
{$tab3}<h1 class=\"entry-title\">", the_title(), "</h1>\n";

if ($options_posts['by-date-post'] == 1 || $options_posts['by-author-post'] == 1 || $options_posts['by-comments-post'] == 1 || $options_posts['by-edit-post'] == 1 || $options_posts['by-cats'] == 1) {
	printf("{$tab3}<div class=\"entry-meta\">\n");
	volatyl_post_meta();
	printf("{$tab3}</div>\n");
}

echo "\t\t</header>\n",

// vol_after_article_header
(($options['switch_vol_after_article_header'] == 0) ?
	(($options['posts_vol_after_article_header'] == 0) ?
		vol_after_article_header() :
		do_action('vol_after_article_header')) :
''),
"\t\t<section class=\"entry-content\">\n",
the_content();

// Show feed tags
(($options_posts['singletags'] == 1) ?
	the_tags(__('<div class="entry-meta tags post-meta-footer">' . $single_tags_text, 'volatyl'), ', ', '<br /></div>') :
'');

wp_link_pages(array('before' => '<nav class="page-links post-meta-footer">' . __($post_page_nav, 'volatyl'), 'after' => '</nav>'));
echo "\t\t</section>\n
\t</article>\n";

// vol_post_footer
(($options['switch_vol_post_footer'] == 0) ?
	(($options['posts_vol_post_footer'] == 0) ?
		vol_post_footer() :
		do_action('vol_post_footer')) :
'');
((comments_open() || '0' != get_comments_number()) ? comments_template('', true) : '');
volatyl_content_nav('nav-below');