jQuery(document).ready(function($) {

	jQuery('.create-sidebar').change( function() {

		var sidebar_1 = jQuery('#_create-sidebar-1:checked').val(),
			sidebar_2 = jQuery('#_create-sidebar-2:checked').val(),
			post_id = jQuery('#post_ID').val();

		$.ajax({
			type: "POST",
			url: theme_meta_ajax_url,
			data: {
				action:    'save_sidebar_meta',
				a:         'save_custom_sidebars',
				post_id:   post_id,
				sidebar_1: sidebar_1,
				sidebar_2: sidebar_2
			},
			success:function( data ) {
			},
			error: function() {
			}
		});

	});

});