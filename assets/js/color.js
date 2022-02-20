(function ($) {
	"use strict";

	$(".rgcolorpicker").colorpicker({
		format: 'rgba',
		component: '.input-group-append',
	});
	var count = 1;

	dynamic_field(count);

	function dynamic_field(number)
	{
		var html = '<tr>';
		html += '<td><input type="text" name="url[]" class="form-control" required /></td>';
		html += '<td><input type="text" name="icon[]" class="form-control" placeholder="fa fa-facebook" required /></td>';
		if(number > 1)
		{
			html += '<td><button type="button" name="remove" id="" class="btn btn-danger remove">Remove</button></td></tr>';
			$('tbody').append(html);
		}

	}
	$(document).on('click', '#add', function(){
		count++;
		dynamic_field(count);
	});
	$(document).on('click', '.remove', function(){
		count--;
		$(this).closest("tr").remove();
	});

})(jQuery);	