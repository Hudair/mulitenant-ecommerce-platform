(function ($) {
"use strict";

$('.type').on('change',()=>{
	var type=$('.type').val();
	if (type==1) {
		$('.location').show();
		}
		else{
			$('.location').hide();
		}
});

$('#location').on('change',()=>{
	var location_id=$('#location').val();
	var shipping_url=$('#shipping').val();			
	var url=shipping_url+'/'+location_id;			
	$.ajax({
		type: 'get',
		url: url,
		dataType: 'json',
		success: function(response){ 
			$('.shipping_method').remove();				

			$.each(response, function(index, row){
				var html='<div class="custom-control custom-radio shipping_method "><input id="'+row.id+'" name="shipping_method" data-amount="'+row.slug+'" value="'+row.id+'" type="radio" class="custom-control-input method'+row.id+'" onclick="calculateShipping('+row.id+')" required><label  class="custom-control-label" for="'+row.id+'">'+row.name+'</label></div>';
				$('#method_area').append(html);
			});


		},

	});

	$('.location').show()
});

})(jQuery);	

function calculateShipping(id) {

	var amount= $('.method'+id).attr('data-amount');
	var shipping_amount=parseFloat(amount);
	var TotalAmount=parseFloat($('#TotalAmount').val());


	var weight_amount= calculateWeight(shipping_amount);
	$('.total_shipping_area').show();
	$('#total_shipping_amount').html(weight_amount);
	var total=TotalAmount+weight_amount;
	$('#total_cart_amount').html(total)
}

function calculateWeight(amount) {

	return amount;
}

function success(argument) {
	location.reload()
}