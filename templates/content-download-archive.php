<?php
/*
 * content-download-archive.php
 */
global $wp_query;
?>

<div class="edd_downloads_list edd_download_columns_3">
	<?php
		while ( have_posts() ) { the_post();
			?>
			<div itemscope itemtype="http://schema.org/Product" class="edd_download" id="edd_download_<?php echo get_the_ID(); ?>">
				<div class="edd_download_inner">
					<?php
					edd_get_template_part( 'shortcode', 'content-image' );
					edd_get_template_part( 'shortcode', 'content-title' );
					edd_get_template_part( 'shortcode', 'content-excerpt' );
					edd_get_template_part( 'shortcode', 'content-price' );
					edd_get_template_part( 'shortcode', 'content-cart-button' );
					?>
				</div>
			</div>
			<?php
		}
		?>
		<div class="edd_download flex-grid-cheat"></div>
		<div class="edd_download flex-grid-cheat"></div>
		<div class="edd_download flex-grid-cheat"></div>
		<?php
	?>
</div>
<?php
if ( $wp_query->max_num_pages > 1 ) {
	?>
	<div id="edd_download_pagination" class="store-pagination navigation">
		<?php
		$big = 999999999; // need an unlikely integer
		echo paginate_links( array(
			'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'format'    => '?paged=%#%',
			'current'   => max( 1, get_query_var( 'paged' ) ),
			'total'     => $wp_query->max_num_pages,
			'prev_text' => __( '&laquo; Previous', 'vendd' ),
			'next_text' => __( 'Next  &raquo;', 'vendd' ),
		) );
		?>
	</div>
	<?php
}