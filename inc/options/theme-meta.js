jQuery(document).ready(function($) {
	'use strict';

	// Setup tooltips
	$('.volatyl-help-tip').tooltip({
		content: function() {
			return $(this).prop('title');
		},
		position: {
			my: 'left bottom',
			at: 'left top-5px',
			collision: 'flipfit'
		},
		hide: {
			duration: 10
		},
		show: {
			duration: 200
		}
	});
});