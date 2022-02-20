(function ($) {
	"use strict"; 
	
	$('.basicbtn').on('click',function(){
		var id= $(this).data('id');
		$(this).attr('disabled', 'disabled');
		$(this).html('<div class="spinner-border text-light spinner-border-sm" role="status"><span class="sr-only">Loading...</span></div></div></span>');
		$('.basicform'+id).submit();
	});

})(jQuery);	  