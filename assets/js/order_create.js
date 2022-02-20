var dataId='';
(function ($) {
	"use strict";	
	$('.option').on('change',function(e){
		var price= $(this).find(':selected').attr('data-price');
		var price=parseFloat(price);
		var mainprice= $(this).find(':selected').attr('data-mainprice');
		var mainprice=parseFloat(mainprice);
		var price_type= $(this).find(':selected').attr('data-amounttype');
		var id= $(this).find(':selected').attr('data-productid');
		if(price_type == 0){
			var percent= mainprice * price / 100;
			var total_price=  mainprice+percent;
		}
		else{
			var total_price=mainprice+price;
		}
		$('#price'+id).html(total_price);

	});


	$(".basicform").on('submit', function(e){
		e.preventDefault();
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		var basicbtnhtml=$('#submitbtn'+dataId).html();
		$.ajax({
			type: 'POST',
			url: this.action,
			data: new FormData(this),
			dataType: 'json',
			contentType: false,
			cache: false,
			processData:false,
			beforeSend: function() {

				$('#submitbtn'+dataId).html('<div class="spinner-border text-white spinner-border-sm" role="status"> <span class="sr-only">Loading...</span></div>');
				$('#submitbtn'+dataId).attr('disabled','')

			},

			success: function(response){ 
				$('#submitbtn'+dataId).removeAttr('disabled')
				Sweet('success','Cart Item Added');
				$('#submitbtn'+dataId).html(basicbtnhtml);

				$('#cart_count').html(response.count);
				render_cart_item(response.items);
			},
			error: function(xhr, status, error) 
			{
				$('#submitbtn'+dataId).html(basicbtnhtml);

				$.each(xhr.responseJSON.errors, function (key, item) 
				{
					Sweet('error',item)
					$("#errors").html("<li class='text-danger'>"+item+"</li>")
				});

			}
		})


	});

	$(".cartform").on('submit', function(e){
		e.preventDefault();
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

		$.ajax({
			type: 'get',
			url: this.action,
			data: new FormData(this),
			dataType: 'json',


			success: function(response){ 

				Sweet('success','Cart Item Added');


				$('#cart_count').html(response.count);
				render_cart_item(response.items);
			},

		})
	});
})(jQuery);	

function assignId(id){
	dataId=id;
}

		

function render_cart_item(data) {
	
	var url = $('#removecart_url').val();
			
	$('.cart-row').remove();
	$.each(data, function(index, row){
		
		var r_id=row.rowId;
		var delete_url=url+'/'+r_id;
		var html='<tr class="cart-row cart'+row.rowId+'">';
		    html +='<td><img src="'+row.options.preview+'" height="50"></td>';
			html +='<td>'+row.name+'</td><td>'+row.price+'</td><td>'+row.qty+'</td>';
			html +='<td class="text-right"><a href="'+delete_url+'" class="btn btn-danger btn-sm remove_btn"><i class="fa fa-trash"></i></a></td></tr>';
		$('#cart-content').append(html);
	});
}