<?php
/** post-meta.php
 *
 ***** THIS IS A CORE VOLATYL FILE AND SHOULD NOT BE EDITED!
 ***** ALL CUSTOM CODING SHOULD BE DONE IN A CHILD THEME.
 ***** MORE INFORMATION - http://volatylthemes.com/why-child-themes/
 *******************************************************************
 *
 * Everything here is dedicated to adding options to your "Edit Post"
 * and "Edit Page" screens.
 *
 * @package Volatyl
 * @since Volatyl 1.0
 */

// Add the "Volatyl Quick Options" meta box to post and page edit screens
function vol_add_meta_box() {
	add_meta_box( 'post-layout', __( THEME_NAME . ' Quick Post Settings', 'volatyl' ), 'vol_meta_box', 'post', 'normal', 'high' );
	add_meta_box( 'page-layout', __( THEME_NAME . ' Quick Page Settings', 'volatyl' ), 'vol_meta_box', 'page', 'normal', 'high' );
	add_meta_box( 'download-layout', __( THEME_NAME . ' Quick Download Settings', 'volatyl' ), 'vol_meta_box', 'download', 'normal', 'high' ); 
}
add_action( 'add_meta_boxes', 'vol_add_meta_box' );

// Callback for the above meta boxes. Posts and Pages share the same function.
function vol_meta_box( $post ) {
	global $post, $current_screen;
	$the_id = get_post_custom( $post->ID );
	$selected = isset( $the_id['_singular-column'] ) ? esc_attr( $the_id['_singular-column'][0] ) : '';
	$custom_class = isset( $the_id['_custom-class'] ) ? esc_attr( $the_id['_custom-class'][0] ) : '';
	$da_title = isset( $the_id['_singular-title'] ) ? $the_id['_singular-title'][0] : 0;
	$create_sidebar_1 = isset( $the_id['_create-sidebar-1'] ) ? $the_id['_create-sidebar-1'][0] : 0;
	$create_sidebar_2 = isset( $the_id['_create-sidebar-2'] ) ? $the_id['_create-sidebar-2'][0] : 0;
	$new_sidebars = array(
		'Sidebar 1'  => array(
			'name'   => '_create-sidebar-1',
			'label'  => __( 'Create Sidebar 1:', 'volatyl' ),
			'state'  => $create_sidebar_1
		),
		'Sidebar 2'  => array(
			'name'   => '_create-sidebar-2',
			'label'  => __( 'Create Sidebar 2:', 'volatyl' ),
			'state'  => $create_sidebar_2
		)
	);
	$column_image = '<img src="' . THEME_PATH_URI . '/inc/options/images';
	$column_options = array(
		'c1' => array(
			'value' 		=> 'c1',
			'description' 	=> __('Content (No Sidebars)', 'volatyl'),
			'label' 		=> $column_image . '/c1.png">'
		),
		'c2' => array(
			'value' 		=> 'c2',
			'description' 	=> __('Content (Sidebars below)', 'volatyl'),
			'label' 		=> $column_image . '/c2.png">'
		),
		'cs' => array(
			'value' 		=> 'cs',
			'description' 	=> __('Content / Sidebar', 'volatyl'),
			'label' 		=> $column_image . '/cs.png">'
		),
		'sc' => array(
			'value' 		=> 'sc',
			'description' 	=> __('Sidebar / Content', 'volatyl'),
			'label' 		=> $column_image . '/sc.png">'
		),
		'css' => array(
			'value' 		=> 'css',
			'description' 	=> __('Content / Sidebar / Sidebar', 'volatyl'),
			'label' 		=> $column_image . '/css.png">'
		),
		'scs' => array(
			'value' 		=> 'scs',
			'description' 	=> __('Sidebar / Content / Sidebar', 'volatyl'),
			'label' 		=> $column_image . '/scs.png">'
		),
		'ssc' => array(
			'value' 		=> 'ssc',
			'description' 	=> __('Sidebar / Sidebar / Content', 'volatyl'),
			'label' 		=> $column_image . '/ssc.png">'
		)
	);

	wp_nonce_field( 'vol_meta_box_nonce', 'meta_box_nonce' );

	/**
	 * Select option input for singular layout choices
	 *
	 * The first options is a standalone option - Site Default. It is not
	 * included in the $column_options array and will only be used here.
	 */
	?>
	<p>
		<label for="_singular-column"><?php _e( 'Select Column Layout: ', 'volatyl' ); ?> </label>
		<select name="_singular-column" id="_singular-column">
			<option value="default" <?php selected( $selected, 'default' ); ?>><?php _e( 'Site Default', 'volatyl' ); ?></option>
			<?php
				// Create an option for each layout choice in the $column_options array
				foreach ( $column_options as $key) { ?>
					<option value="<?php echo $key['value']; ?>" <?php selected( $selected, $key['value'] ); ?>>
						<?php echo $key['description']; ?>
					</option>
					<?php
				}
			?>
		</select>
	</p>
	<p>
		<label for="_custom-class"><?php _e( 'CSS Class: ', 'volatyl' ); ?> </label>
		<input id="_custom-class" class="custom-class" name="_custom-class" value="<?php echo $custom_class; ?>" size="30" type="text" placeholder="<?php _e( 'Separate by space. No periods.', 'volatyl' ); ?>">
	</p>
	<p>
		<?php
			// Create sidebars per Page, Post, or Download
			foreach ( $new_sidebars as $ns ) { ?>
				<span class="input-group">
					<label for="<?php echo $ns['name']; ?>"><?php echo $ns['label']; ?> </label>
					<input id="<?php echo $ns['name']; ?>" class="create-sidebar" name="<?php echo $ns['name']; ?>" value="<?php echo $ns['state']; ?>" type="checkbox" <?php checked( '1', $ns['state'], '1' ); ?>>
				</span>
				<?php
			}
		?>
		<span class="volatyl-help-tip dashicons dashicons-editor-help" title="<?php esc_attr_e( 'When you select to create a new sidebar, it will not register until you publish the post/page. However, the site-wide, default sidebar content will continue to display until you go to your widgets panel and add widgets to your new sidebar(s).', 'volatyl' ); ?>"></span>
	</p>
	<?php
		// only show the option to remove titles if on the edit PAGE screen
		if ( 'page' == $current_screen->post_type ) { ?>
			<p>
				<span class="input-group">
					<label for="_singular-title"><?php _e( 'Remove Page Title: ', 'volatyl' ); ?> </label>
					<input id="_singular-title" name="_singular-title" value="<?php echo $da_title; ?>" size="30" type="checkbox" <?php checked( '1', $da_title, '1' ); ?>>
				</span>
				<span class="volatyl-help-tip dashicons dashicons-editor-help" title="<?php esc_attr_e( "Check this option if you would like to remove the title from your WordPress Page. This is a very useful feature if your page uses the Landing Page or Squeeze Page template. However, you should keep Search Engine Optimization in mind. Your default title is an H1. It's best that you rebuild it somewhere in your content if you use this option.", 'volatyl' ); ?>"></span>
			</p>
			<?php
		}
}

// pull the posts / pages / downloads for custom sidebars
function vol_single_sidebar_posts( $meta_key = '' ) {

	// quick check to bail if no key was passed
	if ( empty( $meta_key ) ) {
		return false;
	}

	// check for the transient, only run if missing
	if (false === get_transient( 'vol_single_sidebar_posts_' . $meta_key ) ) {

		// our query args including the meta key that was passed
		$args = array(
			'fields'     => 'ids',
			'post_type'  => array( 'post', 'page', 'download' ),
			'meta_key'   => $meta_key,
			'meta_value' => 1,
			'nopaging'   => true
		);

		$items = get_posts( $args );

		// bail if none found
		if ( !$items ) {
			return false;
		}

		// set our transient with no expiration since we will
		// delete it when post meta is saved
		set_transient( 'vol_single_sidebar_posts_' . $meta_key, $items, 0 );
	}

	// retrieve our transient
	$items = get_transient( 'vol_single_sidebar_posts_' . $meta_key );

	// send it back
	return $items;
}

// Register new sidebars "on the fly" when the option is selected on singulars
function singular_widgets_init() {

	// fetch our items for the first and second sidebar set
	$sidebar_1_items = vol_single_sidebar_posts( '_create-sidebar-1' );
	$sidebar_2_items = vol_single_sidebar_posts( '_create-sidebar-2' );

	// proceed if we have custom 1st sidebar items
	if ( !empty( $sidebar_1_items ) ) {

		// loop through our items and build the sidebars
		foreach ( $sidebar_1_items as $side1_id ) {

			// fetch the title
			$side1_title = get_the_title( $side1_id );

			// build the sidebar
			register_sidebar( array(
				'name'				=> 'Sidebar 1 &#8212; ' . esc_html( $side1_title ),
				'id'				=> 'sidebar-1-' . absint( $side1_id ),
				'description'   	=> sprintf( __( 'This sidebar is specific to the Post/Page titled "%s." Sidebar 1 will always be the leftmost sidebar, the first sidebar in the HTML flow.', 'volatyl' ), esc_html( $side1_title ) ),
				'before_widget' 	=> '<aside id="%1$s" class="widget %2$s">',
				'after_widget' 		=> '</aside>',
				'before_title' 		=> '<h4 class="widget-title">',
				'after_title' 		=> '</h4>',
			) );
		}
	}

	// proceed if we have custom 2nd sidebar items
	if ( !empty( $sidebar_2_items ) ) {

		// loop through our items and build the sidebars
		foreach ( $sidebar_2_items as $side2_id ) {

			// fetch the title
			$side2_title = get_the_title( $side2_id );

			// build the sidebar
			register_sidebar( array(
				'name'				=> 'Sidebar 2 &#8212; ' . esc_html( $side2_title ),
				'id'				=> 'sidebar-2-' . absint( $side2_id ),
				'description'   	=> sprintf( __( 'This sidebar is specific to the Post/Page titled "%s." Sidebar 2 will always be the rightmost sidebar, the last sidebar in the HTML flow.', 'volatyl' ), esc_html( $side2_title ) ),
				'before_widget' 	=> '<aside id="%1$s" class="widget %2$s">',
				'after_widget' 		=> '</aside>',
				'before_title' 		=> '<h4 class="widget-title">',
				'after_title' 		=> '</h4>',
			) );
		}
	}
}
add_action( 'widgets_init', 'singular_widgets_init', 20 );

// validate singular quick settings
function vol_meta_box_save( $post_id ) {
	global $options;

	// Bail if we're doing an auto save
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
		return;

	// if our nonce isn't there, or we can't verify it, bail
	if ( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'vol_meta_box_nonce' ) )
		return;

	// if our current user can't edit this post, bail
	if ( isset( $_POST['_singular-column'] ) )
		update_post_meta( $post_id, '_singular-column', esc_attr( $_POST['_singular-column'] ) );

	elseif ( !isset( $_POST['_singular-column'] ) )
		$_POST['_singular-column'] == get_theme_mod( 'volatyl_content_layout', 'sc' );

	// Allowed HTML in custom class field... which is none
	$allowed = array();

	if ( isset( $_POST['_custom-class'] ) )
		update_post_meta( $post_id, '_custom-class', wp_kses( $_POST['_custom-class'], $allowed ) );

	/*
	$new_sidebar_1 = isset( $_POST['_create-sidebar-1'] ) ? 1 : 0;
		update_post_meta( $post_id, '_create-sidebar-1', $new_sidebar_1 );

	$new_sidebar_2 = isset( $_POST['_create-sidebar-2'] ) ? 1 : 0;
		update_post_meta( $post_id, '_create-sidebar-2', $new_sidebar_2 );
	*/

	$da_title_ = isset( $_POST['_singular-title'] ) ? 1 : 0;
		update_post_meta( $post_id, '_singular-title', $da_title_ );

	// delete the transients for custom sidebars regardless of checkbox status
	// since no checkmark still indicates a change
	/*
	delete_transient( 'vol_single_sidebar_posts__create-sidebar-1' );
	delete_transient( 'vol_single_sidebar_posts__create-sidebar-2' );
	*/
}
add_action( 'save_post', 'vol_meta_box_save' );



function vol_meta_box_save_ajax() {

	switch ( $_REQUEST['a'] ) {

		case 'save_custom_sidebars':
			$post_id = $_REQUEST['post_id'];
			$sidebar_1 = $_REQUEST['sidebar_1'];
			$sidebar_2 = $_REQUEST['sidebar_2'];
			$new_sidebars_array = array(
				'_create-sidebar-1' => $sidebar_1,
				'_create-sidebar-2' => $sidebar_2
			);

			foreach ( $new_sidebars_array as $meta_key => $meta_value ) {

				// Get the posted data and sanitize it.
				$new_meta_value = ( isset( $meta_value ) ? 1 : 0 );

				// Get the meta value of the custom field key.
				$meta_value = get_post_meta( $post_id, $meta_key, true );

				if ( $new_meta_value && '' == $meta_value ) {
					// If a new meta value was added and there was no previous value, add it.
					add_post_meta( $post_id, $meta_key, $new_meta_value, true );

				} elseif ( $new_meta_value && $new_meta_value != $meta_value ) {
					// If the new meta value does not match the old value, update it.
					update_post_meta( $post_id, $meta_key, $new_meta_value );

				} elseif ( '' == $new_meta_value && $meta_value ) {
					// If there is no new meta value but an old value exists, delete it.
					delete_post_meta( $post_id, $meta_key, $meta_value );
				}
			}

			// delete the transients for custom sidebars regardless of checkbox status
			// since no checkmark still indicates a change
			delete_transient( 'vol_single_sidebar_posts__create-sidebar-1' );
			delete_transient( 'vol_single_sidebar_posts__create-sidebar-2' );

		break;

		default:
			print "No action \"".$_POST['a']."\" exist in ".__file__;
	}
	die();
}
add_action( 'wp_ajax_save_sidebar_meta', 'vol_meta_box_save_ajax', 11 );
add_action( 'wp_ajax_nopriv_save_sidebar_meta', 'vol_meta_box_save_ajax', 11 );