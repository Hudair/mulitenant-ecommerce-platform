(function ($) {
  "use strict";	
	$('.location').on('change',function(){
		var option=$(this).find('option:selected').data('method')
		$('.payment_mode').remove();
		 $.each(option, function(index, value){
		 	var price=parseFloat(value.slug);
		 	var html='<li class="wc_payment_method payment_method_bacs payment_mode"><input id="payment_method_'+value.id+'" type="radio" class="input-radio shipping_mode" name="shipping_mode" data-price="'+price+'" value="'+value.id+'"><label for="payment_method_'+value.id+'"> &nbsp&nbsp'+ value.name+'</label></li>';
		 	$('.shipping_methods').append(html);
		 	$('.bigbag-checkout-payment').show();
		 });
	})
	
	$('.create_account').on('click',function(e) {
		if($('.create_account').is(":checked")){
			$('.password_area').show();
		}
		else{
			$('.password_area').hide();
		}

	});

	$('.checkout_form').on('submit',function(){
		var html=$('.checkout_submit_btn').html();
		$('.checkout_submit_btn').attr('disabled','disabled');
		$('.checkout_submit_btn').html('<div class="spinner-border text-light spinner-border-sm" role="status"><span class="sr-only">Loading...</span></div></div>&nbsp&nbsp Please Wait...</span>');
	});

	$(document).on('click','.shipping_mode',function(e) {
		var price=$(this).data('price');
		$('#shipping_charge').html(currncy_format(price));
		$('.shipping_charge').show();
		var price=parseFloat(price);
		var total_amount=parseFloat($('#total_amount').val());
		var calculate=total_amount+price;
		$('.total_cost_amount').html(currncy_format(calculate));

	});

})(jQuery); 