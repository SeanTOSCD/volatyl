<?php
/** admin-menu.php
 * 
 * Admin Menu (very top menu bar) Volatyl Options
 *
 * You can't tell me this isn't handy. If you create your own options
 * tab, hack into this array to add your options to the menu.
 *
 * @since Volatyl 1.0
 */
 
$options = get_option( 'vol_general_options' );
if ( $options[ 'adminmenu' ] == 1 ) {

	function volatyl_toolbar( $admin_bar ) {
		$admin_bar->add_menu( array(
			'id'			=> 'volatyl',
			'title' 		=> 'Volatyl',
			'meta'  		=> array(
				'title'		=> 'Volatyl',			
			),
		));
		$admin_bar->add_menu( array(
			'id'    		=> 'volatyl-options-global',
			'parent' 		=> 'volatyl',
			'title' 		=> __( 'Global Options', 'volatyl' ),
			'href'  		=> site_url( '/wp-admin/themes.php?page=volatyl_options&tab=global' ),
			'meta'  		=> array(
				'title' 	=> __( 'Global Options', 'volatyl' ),
				'target'	=> '_self'
			),
		));
		$admin_bar->add_menu( array(
			'id'			=> 'volatyl-options-content',
			'parent' 		=> 'volatyl',
			'title' 		=> __( 'Content Options', 'volatyl' ),
			'href'  		=> site_url( '/wp-admin/themes.php?page=volatyl_options&tab=content' ),
			'meta'  		=> array(
				'title' 	=> __( 'Content Options', 'volatyl' ),
				'target' 	=> '_self'
			),
		));
		$admin_bar->add_menu( array(
			'id'    		=> 'volatyl-options-hooks',
			'parent' 		=> 'volatyl',
			'title' 		=> __( 'Hooks', 'volatyl' ),
			'href'  		=> site_url( '/wp-admin/themes.php?page=volatyl_options&tab=hooks' ),
			'meta'  		=> array(
				'title' 	=> __( 'Hooks', 'volatyl' ),
				'target' 	=> '_self'
			),
		));
		$admin_bar->add_menu( array(
			'id'    		=> 'volatyl-docs',
			'parent' 		=> 'volatyl',
			'title' 		=> __( 'Documentation', 'volatyl' ),
			'href'  		=> 'http://volatylthemes.com/docs/',
			'meta'  		=> array(
				'title' 	=> __( 'Documentation', 'volatyl' ),
				'target' 	=> '_blank'
			),
		));
	}
	add_action( 'admin_bar_menu', 'volatyl_toolbar', 100 );
}