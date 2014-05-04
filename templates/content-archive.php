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
	'cat_title'			=> __('Category Archives:', 'volatyl'),
	'tag_title'			=> __('Tag Archives:', 'volatyl'),
	'author_title'		=> __('Author Archives:', 'volatyl'),
	'daily_title'		=> __('Daily Archives:', 'volatyl'),
	'monthly_title'		=> __('Monthly Archives:', 'volatyl'),
	'yearly_title'		=> __('Yearly Archives:', 'volatyl'),
	'default_title'		=> __('Archives', 'volatyl')
	)
);
?>

<header class="page-header">
	<h1 class="page-title">	
		<?php 
			// archive titles
			if (is_category()) {
				echo $archive_title['cat_title'], ' <span>', single_cat_title('', true), '</span>';
				
			} elseif (is_tag()) {
				echo $archive_title['tag_title'], ' <span>', single_tag_title('', true), '</span>';
			
			} elseif (is_author()) {
	
				// Queue the first post, that way we know
				// what author we're dealing with (if that is the case)
				the_post();
				
				echo $archive_title['author_title'], ' <span class="vcard">' . get_the_author() . '</span>';
				
				// Since we called the_post() above, we need to
				// rewind the loop back to the beginning that way
				// we can run the loop properly, in full.
				rewind_posts();
				
			} elseif (is_day()) {
				echo $archive_title['daily_title'], ' <span>', get_the_date(), '</span>';
				
			} elseif (is_month()) {
				echo $archive_title['monthly_title'], ' <span>', get_the_date('F Y'), '</span>';
				
			} elseif (is_year()) {
				echo $archive_title['yearly_title'], ' <span>', get_the_date('Y'), '</span>';
				
			} else {
				echo $archive_title['default_title'];
				
			} 
		?>		
	</h1>

	<?php
		// archive type specifics
		if (is_author()) { ?>
			<p class="user-description"><?php echo get_the_author_meta('description'); ?></p>
			<?php
		} elseif (is_category()) {
	
			// show an optional category description
			$category_description = category_description();
			if (!empty($category_description)) {
				echo apply_filters('category_archive_meta', '<div class="taxonomy-description">' . $category_description . '</div>');
			}
		} elseif (is_tag()) {
	
			// show an optional tag description
			$tag_description = tag_description(); 
			if (!empty($tag_description)) {
				echo apply_filters('tag_archive_meta', '<div class="taxonomy-description">' . $tag_description . '</div>');
			}
		} 
	?>
</header>
<?php
// da loop
while (have_posts()) : the_post();
	get_template_part('templates/content', get_post_format());
endwhile;

vol_pagination_type();