(function ($) {
    "use strict";	
      $('.location').on('change',function(){
          var option=$(this).find('option:selected').data('method')
          $('.shipping_item').remove();
          
           $.each(option, function(index, value){
               var price=parseFloat(value.slug);  
               var html='<div class="u-s-m-b-10 shipping_item">';
                   html +='<div class="radio-box">';
                   html +='<input type="radio" name="shipping_mode" value="'+value.id+'" id="payment_method_'+value.id+'" data-price="'+price+'"  class="shipping_mode" >';
                   html +='<div class="radio-box__state radio-box__state--primary">';
                   html +='<label class="radio-box__label shipping_mode" for="payment_method_'+value.id+'">&nbsp&nbsp'+ value.name+'</label>';
                   html +='</div></div></div></div>';
                  
               $('.shipping_methods').append(html);
               $('.shipping_area').show();
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