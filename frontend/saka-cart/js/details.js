(function($) {
    "use strict";
    var preloader = $('#preloader').val();
    var base_url = $('#base_url').val();
    var inputs = $(".cat_id");
    var category=[];
    for(var i = 0; i < inputs.length; i++){
        var cat=$(inputs[i]).val();
        category.push(parseInt(cat));
    }
    var term=$('#term').val();
    var term=parseInt(term);
    var rev_url=base_url+'/get_reviews/'+term;
    get_data();
    render_review(rev_url);


     $('.option').on('click',function(){
       
       var main_amount=$('#main_amount').val();
       var main_amount=parseFloat(main_amount);
        var calculate_amount=$('#main_amount').val();
        var calculate_amount=parseFloat(calculate_amount);
        $('.options:checked').each(function () {
            var val= $(this).val()
            var amounttype= $(this).data('amounttype')
            var amounttype= parseInt($(this).data('amounttype'));
            var amount= $(this).data('amount');
            var amount= parseFloat(amount);
            $('.option'+val).addClass('active');
            
            if(amounttype == 1){
               var final_amount= calculate_amount+amount; 
            }
            else{
                var percent= calculate_amount * amount / 100;
                var final_amount= calculate_amount+percent;
               
            }
            calculate_amount=final_amount;
    
        });
       
        $('#amount').html(currncy_format(calculate_amount));
     });


     $(".cart-form").on('submit', function(e) {
      var btn_content = $('.submit_btn').html();
      e.preventDefault();
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      var required=false;
      if($('.req').length > 0){
        $('.req:checked').each(function () {
          if(this.checked == true){
            required=true;
          }
          else{
            required=false;
          }
          
        });
      }
      else{
        required=true;
      }
      if(required == false){
        $('.required_option').show();
      }
      else{
        $('.required_option').hide(); 
      }

        if(required == true){
        $.ajax({
            type: 'POST',
            url: this.action,
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                $('.submit_btn').attr('disabled', '');
                $('.submit_btn').html('Please wait...');
            },
            success: function(response) {
                $('.submit_btn').html("Cart Added");
               
                render_cart(response)
            }
        })

       }


    });


    $("#wishlist").on('click', function(e) {
        var btn_content = $('.wishlist-icon').html();
        var id= $(this).data('id');
        
              
        $.ajax({
            type: 'get',
            url: base_url+'/add_to_wishlist/'+id,
            dataType: 'html',
            beforeSend: function() {
                $('#wishlist').attr('disabled', '');
                $('#wishlist').html('<div class="spinner-border spinner-border-sm text-danger" role="status"><span class="sr-only">Loading...</span></div>');
            },
            success: function(response) {
                $('#wishlist').html(btn_content);
                $('#wishlist').html('Wishlist Added');
               
                $('.heart').addClass('u-c-brand');
                $('.wishlist_count').html(response)
            }
        })


    });




    $(".review-form").on('submit', function(e) {
        var btn_content = $('.review_btn').html();
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: this.action,
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                $('.review_btn').attr('disabled', '');
                $('.review_btn').html('Please wait...');
            },
            success: function(response) {
                $('.review_btn').html(response);
            },
            error: function(res){
              $('.review_btn').html('Please Make Review After 5 Minutes...!!');
            }
        })


    });



    function get_data() {
        var term=$('#term').val();
        $.ajax({
            type: 'get',
            url: base_url + '/get_ralated_product_with_latest_post',
            data:{categories:category,term:term},
            dataType: 'json',
            beforeSend: function() {
                
                product_preload('.new_product_preload',5)
            },  
            success: function(response) {
                $('.product_preload_item').remove();
                
               if(response.ratting_count > 0){                  
                  render_star('',response.ratting_avg,'.avg_review_area');
                  $('.review_count').html('('+response.ratting_count+')'+' Reviews');
                  $('.review_avg').html(response.ratting_avg);                
               }else{
                $('.review_count').html('Reviews');
               }             
              
               if (response.get_latest_products.length > 0) {
                   render_products('.new_product',response.get_latest_products,'pl-12'); 
                }
                else{
                    $('.new_product_area').remove();
                }

                if (response.get_related_products.length > 0) {
                   render_products('.related_product',response.get_related_products,'pl-12');
                }
                else{
                    $('.related_product_area').remove();
                }

               productSlider();
               run_lazy();
               CountDown();

            },
            error: function() {
               get_data();
            }
        })
    }


    
$('.attribute').on('click', function () {
  $('.attribute').removeClass('active');
  $(this).addClass('active');
});


//for attribute change
$('.radio-attribute').on('change', function () {

  var id = $(this).val();
  var data_price = $(this).data('price');
  var data_stockqty = $(this).data('stockqty');
  var data_stockmanage = $(this).data('stockmanage');
  var data_stockstatus = $(this).data('stockstatus');
  var data_sku = $(this).data('sku');
  $('.pd-detail__price').html(data_price);
  $('#sku_area').html(data_sku);
  if(data_stockmanage == 1){   
    $('.available_qty').show();
  }
  else{
    $('.available_qty').hide();
    
  }

  
  if(data_stockstatus == 1){
    $('.submit_btn').removeAttr('disabled');
    $('#qty').removeAttr('disabled');
    $('.submit_text').html('Add To Cart');
    $('#qty_area').html(data_stockqty);
    $('#qty').val(1);
   
    if(data_stockmanage == 1){   
      $('#max_qty').val(data_stockqty);
    }
    else{
      $('#max_qty').val(999);
    }
   
   
    initInputCounter()
  }
  else{
    $('.submit_btn').attr('disabled','disabled');
    $('#qty').attr('disabled','disabled');
    $('.submit_text').html('<del>Out Of Stock<del>');
    $('#qty_area').html(0);
    $('#qty').val(0);
    $('#max_qty').val(0);
  }

  $('#qty').on('change',function(){
     if($('.first_attr').is(':checked') == false){
    var qty_val = $('#qty').val();
    var max_qty = $('#max_qty').val();
     var qty_val=parseInt(qty_val);
    if(qty_val <= 0){
      $('#qty').val(1);
    }

    if(data_stockmanage == 1){
      if(qty_val >= max_qty){
        $('#qty').val(max_qty);
      }
    }
    }
    
  });

  
});

//for quantity change
$('#qty').on('change',function(){
 
  var qty_val = $('#qty').val();
  var qty_val=parseInt(qty_val);
  if($('.first_attr').is(':checked')){

     var data_stockmanage = $('.first_attr').data('stockmanage');
    var max_qty = $('#max_qty').val();
    if(data_stockmanage == 1){
      if(qty_val >= max_qty){
        $('#qty').val(max_qty);
      }
    }
    if(qty_val <= 0){
      $('#qty').val(1);
    }
  }
});

})(jQuery);    

    function render_review(url){
      
        $.ajax({
            type: 'get',
            url: url,
            dataType: 'json',
            success: function(response) {
               $('.review-o').remove();
               $.each(response.data, function(key, value) {
               
                var html    ='<div class="review-o u-s-m-b-15">';
                  html    +='<div class="review-o__info u-s-m-b-8">';
                  html    +='<span class="review-o__name">'+value.name+'</span>';
                  html    +='<span class="review-o__date">'+value.created_at+'</span></div>';
                  html    +='<div class="review-o__rating gl-rating-style u-s-m-b-8 rev_ar'+key+'">';
                  html    +='<span>('+value.rating+')</span></div>';
                  html    +='<p class="review-o__text"><p class="review-o__text">'+escapeHtml(value.comment)+'</p>';
               

                $('.review-list').append(html);
                render_star(key,value.rating);
               });

               if(response.links.links.length > 3) {
                
                 render_pagination('.pagination',response.links.links);
               }
              
            }
        })
    }

    function render_star(key,rating,target=".rev_ar"){

        for(var i = 0; i < 5; i++){
            if(i < rating){
                var cl="fas fa-star";
            }
            else{
                var cl="far fa-star";
            }
            var html='<i class="'+cl+'">';

            $(target+key).append(html);
        }

    }


  var entityMap = {
      '&': '&amp;',
      '<': '&lt;',
      '>': '&gt;',
      '"': '&quot;',
      "'": '&#39;',
      '/': '&#x2F;',
      '`': '&#x60;',
      '=': '&#x3D;'
  };

  function escapeHtml(string) {
      return String(string).replace(/[&<>"'`=\/]/g, function (s) {
        return entityMap[s];
    });
  }

function PaginationClicked(key){
    var url =$('.page-link-no'+key).data('url');
    render_review(url)
}


     // Input Counter
var initInputCounter = function() {
        
      var collectionInputCounter = $('.input-counter');
      // Check if Input Counters on the page
      if (collectionInputCounter.length) {
          // Attach Click event to plus button
          collectionInputCounter.find('.input-counter__plus').on('click',function () {
              var $input = $(this).parent().find('input');
              var count = parseInt($input.val()) + 1; // Number + Number
              $input.val(count).change();
          });
          // Attach Click event to minus button
          collectionInputCounter.find('.input-counter__minus').on('click',function () {
              var $input = $(this).parent().find('input');
              var count = parseInt($input.val()) - 1; // Number - Number
              $input.val(count).change();
          });
          // Fires when the value of the element is changed
          collectionInputCounter.find('input').change(function () {
              var $this = $(this);
              var min = $this.data('min');
              var max = $this.data('max');
              var val = parseInt($this.val());// Current value
              // Restrictions check
              if (!val) {
                 val = 1;
              }
              // The min() method returns the number with the lowest value
              val = Math.min(val,max);
              // The max() method returns the number with the highest value
              val = Math.max(val,min);
              // Sets the Value
              $this.val(val);
          });
      }
  };