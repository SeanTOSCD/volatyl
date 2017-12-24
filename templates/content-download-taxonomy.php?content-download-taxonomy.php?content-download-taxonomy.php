<?php
/** content-download-taxonomy.php
 *
 ***** THIS IS A CORE VOLATYL FILE AND SHOULD NOT BE EDITED!
 ***** ALL CUSTOM CODING SHOULD BE DONE IN A CHILD THEME.
 ***** MORE INFORMATION - http://volatylthemes.com/why-child-themes/
 *******************************************************************
 *
 * This template mocks the Store Front Page Template. However, this
 * template is only used for download taxonomies. If you would like to
 * display your products by taxonomy in a store front style, simply add
 * categories or tags to them and view the respective taxonomy URL to
 * observe this template.
 *
 * @package Volatyl
 * @since Volatyl 1.2.2.2
 */
?>
<?php if (vol_is_full_width()) { // HTML structure flexibility ?>
	<div id="main-content" class="store-front taxonomy-store-front full clearfix">
		<div class="main">
<?php } else { ?>
	<div id="main-content" class="store-front taxonomy-store-front clearfix">
<?php } ?>

<div class="products inner">
	<div class="products-container clearfix">
	<?php if (have_posts()) : $i = 1; ?>
		<?php while (have_posts()) : the_post(); ?>
			<div class="product-box product<?php if($i % 4 == 0) { echo ' last'; } ?> border-box">
				<a class="product-title" href="<?php the_permalink(); ?>">
					<h2><?php the_title(); ?></h2>
				</a>
				<div class="product-image">
					<a href="<?php the_permalink(); ?>">
						<?php the_post_thumbnail('product-image', array('class' => 'product-img')); ?>
					</a>
					<?php if(function_exists('edd_price')) { ?>
						<div class="product-price">
							<?php	
							if (edd_has_variable_prices(get_the_ID())) {
	
								// if the download has variable prices,
								// show the first one as a starting price
								echo $item_info['starting_price'] . ' '; 
								edd_price(get_the_ID());
							} elseif ('0' != edd_get_download_price(get_the_ID()) && !edd_has_variable_prices( get_the_ID())) {
								echo $item_info['price'] . ' '; 
								edd_price(get_the_ID()); 
							} else {
								echo $item_info['free'] . ' ';
							} ?>
						</div>
					<?php } ?>
				</div>
				<?php if(function_exists('edd_price')) { ?>
					<div class="product-buttons">
						<?php if(!edd_has_variable_prices(get_the_ID())) { ?>
							<?php echo edd_get_purchase_link(get_the_ID(), __('Add to Cart', 'volatyl'), 'button'); ?>
						<?php } else { ?>
							<a href="<?php the_permalink(); ?>"><?php _e('View Details', 'volatyl'); ?></a>
						<?php } ?>
					</div>
				<?php } ?>
			</div>
			<?php $i+=1; ?>
		<?php endwhile; ?>
	</div>		
	<div class="product-pagination">
		<?php
			// need an unlikely integer		
			$big = 999999999;				
			echo paginate_links(array(
				'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
				'current' => max(1, $current_page),
				'total' => $wp_query->max_num_pages
			));
		?>
	</div>
	<?php else : ?>
		<div class="no-results-found">
			<h2><?php _e('Not Found', 'volatyl'); ?></h2>
			<p><?php _e('Sorry, but you are looking for something that isn\'t here. Try searching.', 'volatyl'); ?></p>
			<?php get_search_form(); ?>
		</div>
	<?php endif; ?>
</div>

<?php
// HTML structure flexibility
if (vol_is_full_width()) { ?>
	</div>
	<?php
}
?>
</div>