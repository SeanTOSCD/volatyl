<?php
/** 404.php
 *
 ***** THIS IS A CORE VOLATYL FILE AND SHOULD NOT BE EDITED!
 ***** ALL CUSTOM CODING SHOULD BE DONE IN A CHILD THEME.
 ***** MORE INFORMATION - http://volatylthemes.com/why-child-themes/
 *******************************************************************
 *
 * 404 error pages use this template to output content. To override this
 * template in a child theme, copy this file into the root of your child
 * theme folder and make ADJUSTMENTS there. Use this file as a starting
 * point so you don't lose any variables, constants, etc.
 *
 * @package Volatyl
 * @since Volatyl 1.0
 */
global $tab3;
echo "\t<article id=\"post-0\" class=\"post error404 not-found\">
\t\t<header class=\"entry-header\">\n
{$tab3}<h1 class=\"entry-title\">", __('404, eh? Well that\'s no good.', 'volatyl'), "</h1>
\t\t</header>\n
\t\t<section class=\"entry-content\">\n
{$tab3}<p>". __('We can\'t change the past but let\'s try to make things right for the future. Use the search form and other tools below to find what you were looking for.', 'volatyl'), "</p>\n";
get_search_form();
the_widget('WP_Widget_Recent_Posts');
echo "{$tab3}<div class=\"widget\">\n
{$tab3}\t<h2 class=\"widgettitle\">", __('Most Used Categories', 'volatyl'), "</h2>\n
{$tab3}\t<ul>\n";
wp_list_categories(array(
	'orderby' 	=> 'count', 
	'order' 	=> 'DESC', 
	'title_li' 	=> '', 
	'number' 	=> 10, 
	'depth' 	=> -1, 
));
echo "{$tab3}\t</ul>\n
</div>";

// translators: %1$s: smilie
$archive_content = '<p>' . sprintf(__('Try looking in the monthly archives. %1$s', 'volatyl'), convert_smilies(':)')) . '</p>';
the_widget('WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$archive_content");
the_widget('WP_Widget_Tag_Cloud');
echo "\t\t</section	>\n
\t</article>\n";