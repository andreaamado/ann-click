(function($) {
	
	$(document).ready(function() {
		
		// when user select the type
		$('#typeChange').on( 'change', function(event) {
			var info = $(this).val();
			window.location = info;

			//location.reload();
		});
		
	});
	
})( jQuery );