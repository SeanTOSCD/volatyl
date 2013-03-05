jQuery( document ).ready( function() {
	jQuery( '#upload_logo_button' ).click( function() {
		formfield = jQuery( '#logo_url' ).attr( 'name' );
		tb_show( 'Upload a site logo', 'media-upload.php?referer=volatyl_options&TB_iframe=true', false );
		return false;
	} );
	window.send_to_editor = function(html) {
		imgurl = jQuery( 'img',html ).attr( 'src' );
		jQuery( '#logo_url' ).val( imgurl );
		tb_remove();
		jQuery( '#upload_logo_preview img' ).attr( 'src',imgurl );  
		jQuery( '#submit_options_form' ).trigger( 'click' );
	}
} );