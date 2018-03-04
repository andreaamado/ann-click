(function($) {
	
	$(document).ready(function() {
		
		// when user clicks the link
		$('.ajax-ann-click').on( 'click', function(event) {
			
			// prevent default
			event.preventDefault();
			
			// add loading message
			// $(this).find('.ajax-loading').html('Loading...');
			$(this).find('.ajax-loading').css({ display: "block" });
			
			// define url
			var post_id = $(this).data('id');
			var type = $(this).data('type');
			var info = $(this).data('info');
			// alert(post_id + ' - ' + type);
			
			// to prevent popup blocker
			if(type > 2) {
				var annClickUrl = window.open(info);
			}
			
			// submit the data
			$.post(ann_click_ajax.ajaxurl, {
				
				nonce:     ann_click_ajax.nonce,
				action:    'public_hook',
				post_id:   post_id,
				type:      type
				
			}, function(data) {
				
				// log data
				console.log(data);
				
				// display data
				$('.ajax-loading').html(data);
				
			}).done(function() {
				if(type == 1) {
					$('#annClickPhone').dialog({
						title: "Phone Number",
						width: 400,
						height: 230,
						autoOpen: true,
						modal: true,
						open: function (event, ui) {
							$(".ui-widget-overlay").css({
								background: "rgb(0, 0, 0)",
								opacity: ".70 !important",
								filter: "Alpha(Opacity=70)",
							});
						},
						buttons: {
							Close: function () {
								$(this).dialog("close");
							}
						}
				
					});
				} else if(type == 2) {
					$('#annClickEmail').dialog({
						title: "Email",
						width: 400,
						height: 230,
						autoOpen: true,
						modal: true,
						open: function (event, ui) {
							$(".ui-widget-overlay").css({
								background: "rgb(0, 0, 0)",
								opacity: ".70 !important",
								filter: "Alpha(Opacity=70)",
							});
						},
						buttons: {
							Close: function () {
								$(this).dialog("close");
							}
						}
				
					});
				} else {
					annClickUrl.location = info;
				}
			});
			
		});
		
	});
	
})( jQuery );