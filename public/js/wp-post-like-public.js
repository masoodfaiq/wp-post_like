(function( $ ) {
	'use strict';
	var myajaxurl = ai_ajax_obj.ajax_url;
	$(function() {
		$(document).on('click', '.ai_like_btn', function(){
			var post_id = $(this).attr('data-postid');
			$.ajax({
				type: "POST",
				url : myajaxurl,
				data: {action: 'ai_process_like', post_id : post_id },
				success: function(response) {
					response = JSON.parse(response);
					if( response.code == '200' ) {
						alert(response.message);
					} else if( response.code == '400'  ) {
						alert(response.message);
					}
				}
			});
		});
	
	});
})( jQuery );
