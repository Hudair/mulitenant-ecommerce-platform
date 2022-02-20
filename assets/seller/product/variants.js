(function ($) {
	"use strict";

	$('.add_attr').on('click',function(){
		var html=$('.attrs_row').html();
		var num=Math.floor(Math.random() * 99) + 1;  
		$('#data-body').append('<tr class="attr_'+num+'"><td><select  data-id="'+num+'" class="form-control parent_attr"><option value="" disabled selected>Select Varient</option>'+html+'</select></td><td><select name="child[]"  class="multi-select form-control child'+num+'" width="100%"></select></td><td><a data-id="'+num+'" class="btn btn-danger remove_attr text-white"><i class="fa fa-trash"></i></a></td></tr>');
	
	});	
	
	$(document).on('change','.parent_attr',function(){
		var variations=$('option:selected', this).attr('data-parentattribute');
		var variations=JSON.parse(variations);
		var id= $(this).attr('data-id');
		var value= $(this).val();

		$('.attr'+id).remove();
		$('.child'+id).attr('multiple','');
		$('.child'+id).attr('name','child['+value+'][]');
		$.each(variations, function (key, item) 
		{
			var html="<option value="+item.id+"  class='attr"+id+"'>"+item.name+"</option>";
			$('.child'+id).append(html);
		});
		$('.child'+id).val('');
		$('.multi-select').select2()
	});
	
	$(document).on('click','.remove_attr',function(){
		var id= $(this).data('id');
		$('.attr_'+id).remove();
	});

})(jQuery);
