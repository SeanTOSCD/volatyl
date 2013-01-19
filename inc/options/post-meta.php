<?php 
/** post-meta.php
 *
 * Everything here is dedicated to adding options to your "Edit Post"
 * and "Edit Page" screens. 
 *
 * @package Volatyl
 * @since Volatyl 1.0
 */

// Add the "Volatyl Quick Options" meta box to post and page edit screens
function vol_add_meta_box() {  
    add_meta_box( 'post-layout', __( THEME_NAME . ' Quick Settings', 'volatyl' ), 'vol_meta_box', 'post', 'normal', 'high' );    
    add_meta_box( 'page-layout', __( THEME_NAME . ' Quick Settings', 'volatyl' ), 'vol_meta_box', 'page', 'normal', 'high' );  
} 
add_action( 'add_meta_boxes', 'vol_add_meta_box' ); 


// Callback for the above meta boxes. Posts and Pages share the same function.
function vol_meta_box( $post ) {  
	global $post, $column_options;
	$the_id = get_post_custom( $post->ID );
	$selected = isset( $the_id[ '_singular-column' ] ) ? esc_attr( $the_id[ '_singular-column' ][ 0 ] ) : ''; 
	$custom_class = isset( $the_id[ '_custom-class' ] ) ? esc_attr( $the_id[ '_custom-class' ][ 0 ] ) : '' ;
    wp_nonce_field( 'vol_meta_box_nonce', 'meta_box_nonce' );
    

	/** Select option input for singular layout choices
	 * 
	 * The first options is a standalone option - Site Default. It is not 
	 * included in the $column_options array and will only be used here.
	 */
    echo 	"<p><label for=\"_singular-column\">Select Column Layout: </label>",
    		"<select name=\"_singular-column\" id=\"_singular-column\">",
    		"<option value=\"default\""; 
    selected( $selected, 'default' );
    echo 	">Site Default</option>"; 
    
    // Create an option for each layout choice in the $column_options array
    foreach ( $column_options as $key ) {
    
		echo 	"<option value=\"", 
				$key[ 'value' ], "\""; 
		selected( $selected, $key[ 'value' ] );
		echo	 ">", 
				$key[ 'description' ], 
				"</option>"; 
    }   
    
    echo 	"</select></p>",
    		"<p><label for=\"_custom-class\">",
    		"CSS Class: </label>",
    		"<input id=\"_custom-class\" name=\"_custom-class\" ",
    		"value=\"", $custom_class, "\" size=\"30\" ",
    		"type=\"text\" ",
    		"placeholder=\"No Periods! Separate Classes by a Space\"></p>";
}


// Body class based on custom CSS field
function singular_body_class( $classes ) {
	global $post;
	
	if ( ! is_404() && ! is_search() )
		$singular_body_class = get_post_meta( $post->ID, '_custom-class', true);
	
	// add class name to the $classes array based on conditions
	if ( is_singular() ) {
	
		// Add the body class if it exists
		if ( '' !== $singular_body_class )
			$classes[] = $singular_body_class;
	}
	
	// return the $classes array
	return $classes;
}
add_filter( 'body_class', 'singular_body_class' );


// Validate singular layout options
function vol_meta_box_save( $post_id ) {
	global $options;
	$options_structure = get_option( 'vol_structure_options' );

	// Bail if we're doing an auto save
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
		return;
	
	// if our nonce isn't there, or we can't verify it, bail
	if ( ! isset( $_POST['meta_box_nonce'] ) || ! wp_verify_nonce( $_POST['meta_box_nonce'], 'vol_meta_box_nonce' ) ) 
		return;
		
	// if our current user can't edit this post, bail
	if ( isset( $_POST[ '_singular-column' ] ) )
		update_post_meta( $post_id, '_singular-column', esc_attr( $_POST[ '_singular-column' ] ) );
		
	elseif ( ! isset( $_POST[ '_singular-column' ] ) )
		$_POST[ '_singular-column' ] == $options_structure[ 'column' ];
	
	// Allowed HTML in custom class field... which is none
	$allowed = array();
		
	if ( isset( $_POST['_custom-class'] ) )  
        update_post_meta( $post_id, '_custom-class', wp_kses( $_POST[ '_custom-class' ], $allowed ) );  
		
}
add_action( 'save_post', 'vol_meta_box_save' );