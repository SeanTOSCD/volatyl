<?php
/** content-archive.php
 *
 ***** THIS IS A CORE VOLATYL FILE AND SHOULD NOT BE EDITED!
 ***** ALL CUSTOM CODING SHOULD BE DONE IN A CHILD THEME.
 ***** MORE INFORMATION - http://volatylthemes.com/why-child-themes/
 *******************************************************************
 *
 * Archives use this template to output content. To override this
 * template in a child theme, copy this file into the root/templates folder
 * of your child theme and make ADJUSTMENTS there. Use this file as a starting
 * point so you don't lose any variables, constants, etc.
 *
 * This template covers the actual archives title, description, <article>s 
 * and associated hooks and navigation.
 *
 * @package Volatyl
 * @since Volatyl 1.0
 */
$archive_title = apply_filters('archive_title', array(
	'cat_title'			=> 'Category Archives:',
	'tag_title'			=> 'Tag Archives:',
	'author_title'		=> 'Author Archives:',
	'daily_title'		=> 'Daily Archives:',
	'monthly_title'		=> 'Monthly Archives:',
	'yearly_title'		=> 'Yearly Archives:'
	)
); ?>

<header class="page-header">
	<h1 class="page-title">
	
		<?php 
		// archive titles
		if (is_category()) {
			echo __($archive_title['cat_title'], 'volatyl'), ' <span>', single_cat_title('', true), '</span>';
			
		} elseif (is_tag()) {
			echo __($archive_title['tag_title'], 'volatyl'), ' <span>', single_tag_title('', true), '</span>';
		
		} elseif (is_author()) {

			// Queue the first post, that way we know
			// what author we're dealing with (if that is the case)
			the_post();
			
			echo __($archive_title['author_title'], 'volatyl'), ' <span class="vcard"><a class="fn" href="' . get_author_posts_url(get_the_author_meta("ID")) . '" title="' . esc_attr(get_the_author()) . '">' . get_the_author() . '</a></span>';
			
			// Since we called the_post() above, we need to
			// rewind the loop back to the beginning that way
			// we can run the loop properly, in full.
			rewind_posts();
			
		} elseif (is_day()) {
			echo __($archive_title['daily_title'], 'volatyl'), ' <span>', get_the_date(), '</span>';
			
		} elseif (is_month()) {
			echo __($archive_title['monthly_title'], 'volatyl'), ' <span>', get_the_date('F Y'), '</span>';
			
		} elseif (is_year()) {
			echo __($archive_title['yearly_title'], 'volatyl'), ' <span>', get_the_date('Y'), '</span>';
			
		} else {
			_e('Archives', 'volatyl');
			
		} ?>
		
	</h1>

	<?php
	// archive type specifics
	if (is_author()) ?>
		<p class="user-description"><?php echo get_the_author_meta('description'); ?></p>

	<?php
	if (is_category()) {

		// show an optional category description
		$category_description = category_description();
		if (!empty($category_description))
			echo apply_filters('category_archive_meta', '<div class="taxonomy-description">' . $category_description . '</div>');
	} elseif (is_tag()) {

		// show an optional tag description
		$tag_description = tag_description(); 
		if (!empty($tag_description))
			echo apply_filters('tag_archive_meta', '<div class="taxonomy-description">' . $tag_description . '</div>');
	} ?>
	
</header>

<?php
// Da loop
while (have_posts()) {
	the_post();
	get_template_part('templates/content', get_post_format());
}
vol_pagination_type();