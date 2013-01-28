<?php
/** loops.php
 *
 * Loops, and loops, and loops! This file is one big conditional that
 * handles the WordPress loop for:
 *
 * is_home()
 * is_single()
 * is_page()
 * is_archive()
 * is_attachment()
 *
 * These loops are not included in template files for Volatyl because 
 * there's a lot of site structure work done before getting to the loops.
 * 
 * Any of these loops can be overwritten by simply creating the actual
 * template file responsible for that particular template. For example,
 * creating a single.php file in a child theme (or in the core... but 
 * don't) will override the is_single() argument in this conditional.
 *
 * @package Volatyl
 * @since Volatyl 1.0
 */

function vol_content() {
	global $options, $tab3, $tab6;
	echo "<div id=\"content\" class=\"site-content border-box clearfix\">";
	
	if ( have_posts() ) {

		// Blog home
		if ( is_home() ) {

			// vol_before_content_column
			if ( $options[ 'switch_vol_before_content_column' ] == 0 ) {
				if 	( $options[ 'home_vol_before_content_column' ] == 0 ) {
						vol_before_content_column();
				} else {
					do_action( 'vol_before_content_column' );
				}
			}
		
			// Da loop
			while ( have_posts() ) { 
				the_post();
				get_template_part( 'content', get_post_format() );
			}
			
			// vol_after_content_column
			if ( $options[ 'switch_vol_after_content_column' ] == 0 ) {
				if 	( $options[ 'home_vol_after_content_column' ] == 0 ) {
						vol_after_content_column();
				} else {
					do_action( 'vol_after_content_column' );
				}
			}
			
			pagination_type(); // /inc/functions/page-nav.php
	
		// Single posts
		} elseif ( is_single() && ! is_attachment() ) { 

			// vol_before_content_column
			if ( $options[ 'switch_vol_before_content_column' ] == 0 ) {
				if 	( $options[ 'posts_vol_before_content_column' ] == 0 ) {
						vol_before_content_column();
				} else {
					do_action( 'vol_before_content_column' );
				}
			}
		
			// Da loop
			while ( have_posts() ) { 
				
				the_post();
				
				echo 	"\t<article id=\"post-", the_ID(), 
						"\"", post_class(), ">\n",
						"\t\t<header class=\"entry-header\">\n",
						"{$tab3}<h1 class=\"entry-title\">", the_title(), "</h1>\n",
						"{$tab3}<div class=\"entry-meta\">\n", 
						volatyl_post_meta(),
						"{$tab3}</div>\n",
						"\t\t</header>\n";

				// vol_after_article_header
				if ( $options[ 'switch_vol_after_article_header' ] == 0 ) {
					if 	( $options[ 'posts_vol_after_article_header' ] == 0 ) {
							vol_after_article_header();
					} else {
						do_action( 'vol_after_article_header' );
					}
				}
				
				echo "\t\t<div class=\"entry-content\">\n",  the_content();

				// Show feed tags
				$options_posts = get_option( 'vol_content_options' );
				
				$article_tags_text = apply_filters( 'article_tags_text', 'Tags: ' );
				
				if ( $options_posts[ 'singletags' ] == 1 )
					the_tags( __( '<div class="entry-meta tags post-meta-footer">' . $article_tags_text, 'volatyl' ), ', ', '<br /></div>' );
				
				$post_page_nav = apply_filters( 'post_page_nav', 'Pages:' );
			
				wp_link_pages( array( 'before' => '<div class="page-links post-meta-footer">' . __( $post_page_nav, 'volatyl' ), 'after' => '</div>' ) );
			
				echo 	"\t\t</div>\n",
						"\t</article>\n";

				// vol_post_footer
				if ( $options[ 'switch_vol_post_footer' ] == 0 ) {
					if 	( $options[ 'posts_vol_post_footer' ] == 0 ) {
							vol_post_footer();
					} else {
						do_action( 'vol_post_footer' );
					}
				}
			
				if ( comments_open() || '0' != get_comments_number() )
					comments_template( '', true );
				
				volatyl_content_nav( 'nav-below' );
			}

			// vol_after_content_column
			if ( $options[ 'switch_vol_after_content_column' ] == 0 ) {
				if 	( $options[ 'posts_vol_after_content_column' ] == 0 ) {
						vol_after_content_column();
				} else {
					do_action( 'vol_after_content_column' );
				}
			}
	
		// Pages
		} elseif ( is_page() ) {
	
			// Da loop
			while ( have_posts() ) {
			
				the_post();
				
				echo 	"\t<article id=\"post-", the_ID(), "\"",
						post_class(), ">\n",
						"\t\t<header class=\"entry-header\">\n",
						"{$tab3}<h1 class=\"entry-title\">", the_title(), "</h1>\n",
						"\t\t</header>\n",
						"\t\t<div class=\"entry-content\">\n",  the_content();
					
				$options = get_option( 'vol_content_options' );
				if ( $options[ 'pagecomments' ] == 1 )
					if ( comments_open() || '0' != get_comments_number() )
						comments_template( '', true );
				
						$page_page_nav = apply_filters( 'page_page_nav', 'Pages:' ); 
					
						wp_link_pages( array( 'before' => '<div class="page-links post-meta-footer">' . __( $page_page_nav, 'volatyl' ), 'after' => '</div>' ) );
					
				echo 	"\t\t</div>\n",
						"\t</article>\n";
			}
	
		// Search results
		} elseif ( is_search() ) {
			global $post;
			
			echo 	"\t<header class=\"page-header\">\n",
					"\t\t<h1 class=\"page-title\">";
					printf( __( 'Search Results for: %s', 'volatyl' ), '<span>' . get_search_query() . '</span>' );
			echo 	"</h1>\n",
					"\t</header>";
		
			// Da loop		
			while ( have_posts() ) { 
			
				the_post();
				
				if ( is_search() && ( $post->post_type=='page' ) ) 
					continue;
					
				get_template_part( 'content', 'search' );
			}
		
			pagination_type();

		// Archives including categories, tags, authors, dates, and bears. Oh my!
		} elseif ( is_archive() ) {
		
			// Custom filters
			$cat_header = apply_filters( 'cat_header', 'Category Archives:' );
			$tag_header = apply_filters( 'tag_header', 'Tag Archives:' );
			$author_header = apply_filters( 'author_header', 'Author Archives:' );
			$daily_header = apply_filters( 'daily_header', 'Daily Archives:' );
			$monthly_header = apply_filters( 'monthly_header', 'Monthly Archives:' );
			$yearly_header = apply_filters( 'yearly_header', 'Yearly Archives:' );

			// vol_before_content_column
			$options_hooks = get_option( 'vol_hooks_options' );
			if ( $options_hooks[ 'switch_vol_before_content_column' ] == 0 )
				vol_before_content_column();
		
			echo 	"\t<header class=\"page-header\">\n",
					"\t\t<h1 class=\"page-title\">";
				
			if ( is_category() ) {
				printf( __( $cat_header . ' %s', 'volatyl' ), '<span>' . single_cat_title( '', false ) . '</span>' );

			} elseif ( is_tag() ) {
				printf( __( $tag_header . ' %s', 'volatyl' ), '<span>' . single_tag_title( '', false ) . '</span>' );

			} elseif ( is_author() ) {
	
				// Queue the first post, that way we know
				// what author we're dealing with (if that is the case)
				the_post();
			
				printf( __( $author_header . ' %s', 'volatyl' ), '<span class="vcard"><a class="fn" href="' . get_author_posts_url( get_the_author_meta( "ID" ) ) . '" title="' . esc_attr( get_the_author() ) . '">' . get_the_author() . '</a></span>' );
			
				// Since we called the_post() above, we need to
				// rewind the loop back to the beginning that way
				// we can run the loop properly, in full.
				rewind_posts();
			
			} elseif ( is_day() ) {
				printf( __( $daily_header . ' %s', 'volatyl' ), '<span>' . get_the_date() . '</span>' );

			} elseif ( is_month() ) {
				printf( __( $monthly_header . ' %s', 'volatyl' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );

			} elseif ( is_year() ) {
				printf( __( $yearly_header . ' %s', 'volatyl' ), '<span>' . get_the_date( 'Y' ) . '</span>' );

			} else {
				_e( 'Archives', 'volatyl' );

			}
		
			echo "\t\t</h1>\n";
		
			if ( is_category() ) {
		
				// show an optional category description
				$category_description = category_description();
			
				if ( ! empty( $category_description ) )
					echo apply_filters( 'category_archive_meta', '<div class="taxonomy-description">' . $category_description . '</div>' );
				
			} elseif ( is_tag() ) {
	
				// show an optional tag description
				$tag_description = tag_description();
			
				if ( ! empty( $tag_description ) )
					echo apply_filters( 'tag_archive_meta', '<div class="taxonomy-description">' . $tag_description . '</div>' );
				
			}
		
			echo "\t</header>";
			
			// Da loop
			while ( have_posts() ) {
				the_post();
				get_template_part( 'content', get_post_format() );
			}

			// vol_after_content_column
			$options_hooks = get_option( 'vol_hooks_options' );
			
			if ( $options_hooks[ 'switch_vol_after_content_column' ] == 0 ) {
				if 	( is_archive() && $options_hooks[ 'archive_vol_after_content_column' ] == 0 ) {
						vol_after_content_column();
				} else {
					do_action( 'vol_after_content_column' );
				}
			}
			
			pagination_type();
	
		// Attachment pages
		} elseif ( is_attachment() ) {
			global $post;
			
			// Custom filters
			$previous_image = apply_filters( 'previous_image', '&larr; Previous' );
			$next_image = apply_filters( 'next_image', 'Next &rarr;' );
		
			// Da loop
			while ( have_posts() ) {
				
				the_post();
		
				echo 	"\t<article id=\"post-", the_ID(), "\"", post_class(), ">\n",
						"\t\t<header class=\"entry-header\">\n",
						"{$tab3}<h1 class=\"entry-title\">", the_title(), "</h1>\n",
						"{$tab3}<div class=\"entry-meta\">\n";
					
				$metadata = wp_get_attachment_metadata();
			
				printf( __( 'Published <span class="entry-date"><time class="entry-date" datetime="%1$s" pubdate>%2$s</time></span> at <a href="%3$s" title="Link to full-size image">%4$s &times; %5$s</a> in <a href="%6$s" title="Return to %7$s" rel="gallery">%7$s</a>', 'volatyl' ),
					esc_attr( get_the_date( 'c' ) ),
					esc_html( get_the_date() ),
					wp_get_attachment_url(),
					$metadata[ 'width' ],
					$metadata[ 'height' ],
					get_permalink( $post->post_parent ),
					get_the_title( $post->post_parent )
				);
			
				echo 	"\t\t</header>\n",
						"\t\t<div class=\"entry-content\">\n",
						"{$tab3}<div class=\"entry-attachment\">\n",
						"{$tab3}\t<div class=\"attachment\">\n";

				/* Grab the IDs of all the image attachments in a gallery so we can get the URL of the next adjacent image in a gallery, or the first image (if we're looking at the last image in a gallery), or, in a gallery of one, just the link to that image file */

				$attachments = array_values( get_children( array( 
					'post_parent'		=> $post->post_parent, 
					'post_status' 		=> 'inherit', 
					'post_type' 		=> 'attachment', 
					'post_mime_type' 	=> 'image', 
					'order' 			=> 'ASC', 
					'orderby' 			=> 'menu_order ID'
					) 
				) );
			
				foreach ( $attachments as $k => $attachment ) {
					if ( $attachment->ID == $post->ID )
						break;
				}
				$k++;
			
				// If there is more than 1 attachment in a gallery
				if ( count( $attachments ) > 1 ) {
					if ( isset( $attachments[ $k ] ) )
				
						// get the URL of the next image attachment
						$next_attachment_url = get_attachment_link( $attachments[ $k ]->ID );
					else
				
						// or get the URL of the first image attachment
						$next_attachment_url = get_attachment_link( $attachments[ 0 ]->ID );
				} else {
			
					// or, if there's only 1 image, get the URL of the image
					$next_attachment_url = wp_get_attachment_url();
				}
				
				echo 	"<a href=\"",
						$next_attachment_url,
						"\" title=\"",
						esc_attr( get_the_title() ),
						"\" rel=\"attachment\">";
			
				// Filterable image size.		
				$attachment_size = apply_filters( 'volatyl_attachment_size', array( 1200, 1200 ) );
			
				echo 	wp_get_attachment_image( $post->ID, $attachment_size ),
						"</a>\n{$tab3}\t</div>\n";	
						
				if ( ! empty( $post->post_excerpt ) )
				
					echo 	"{$tab3}\t<div class=\"entry-caption\">\n", 
							the_excerpt(),
							"{$tab3}\t</div>\n";
			
				echo "{$tab3}</div>\n";
				
				$attachment_page_nav = apply_filters( 'attachment_page_nav', 'Pages:' );
			
				wp_link_pages( array( 'before' => '<div class="page-links post-meta-footer">' . __( $attachment_page_nav, 'volatyl' ), 'after' => '</div>' ) );
			
				echo 	"{$tab3}</div>\n",
						"{$tab3}<nav class=\"site-navigation image-navigation\">",
						"{$tab3}\t<span class=\"previous-image\">", 
						previous_image_link( false, __( $previous_image, 'volatyl' ) ), "</span>\n",
						"{$tab3}\t<span class=\"next-image\">", 
						next_image_link( false, __( $next_image, 'volatyl' ) ), "</span>\n",
						"{$tab3}</nav>\n",
						"\t\t</div>\n",
						"\t</article>";
			}
	
		// Stray template (can that even happen?) floating around? I got this.
		} else {
		
			// Da loop
			while ( have_posts() ) {
				the_post();
				get_template_part( 'content', get_post_format() );
			}
		}	
	} else {
		get_template_part( 'no-results', 'index' );
	}
		
	echo "</div>";
}