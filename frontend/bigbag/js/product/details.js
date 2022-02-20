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


     $('.attribute').on('click',function(){
        $('.attribute').removeClass('active');
        $(this).addClass('active');
       
        $('input.variation:radio:checked').each(function () {
            var val= $(this).val()
            $('.attr'+val).addClass('active');
        });
    });
    

    $('.option').on('click',function(){
        $('.option').removeClass('active');
        $(this).addClass('active');
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
    


    var term=$('#term').val();
    var term=parseInt(term);
    var rev_url=base_url+'/get_reviews/'+term;
    get_data();
    render_review(rev_url);


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
        var id = $(this).data('id');       
        
              
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
               
                $('.heart').addClass('active');
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
                $('.product-card').remove();
                for (var i = 1; i < 5; i++) {
                    var img='<div class="content-placeholder product_preload"></div>';
                    var html='<div class="product-card content-placeholder"><div class="product-img"> <a href="#" class="text-dark">'+img+'</div><div class="product-content"><div class="product-name"><h3></h3></a><p></p></div><div class="product-price"><h4></h4><p></p></div><div class="product-cart"></div></div></div>';
                    $('#related_product_area').append(html);
                    $('#latest_product_area').append(html);
                   
                }
            },  
            success: function(response) {
               
               if(response.ratting_count > 0){
                   for(var i = 0; i < response.ratting_avg; i++){
                     $('.single-product-review').append('<li><i class="fas fa-star"></i></li>');
                 }
                 $('.single-product-review').append('<li><span>('+response.ratting_avg+'/5)</span></li>');
                 $('#review_count').html('('+response.ratting_count+')');
               }
               
                $('.content-placeholder').remove();
                $('.content-placeholder').remove();
                $('.product_preload').remove();
                if (response.get_related_products.length > 0) {
                    render_products(response.get_related_products, '#related_product_area');
                } else {
                    $('.related-part').remove();
                }

                if (response.get_latest_products.length > 0) {
                    render_products(response.get_latest_products, '#latest_product_area');
                } else {
                    $('.new-part').remove();
                }
                product_slider();
                run_lazy();

            },
            error: function() {
               get_data();
            }
        })
    }


    

})(jQuery);    

    function render_review(url){
      
        $.ajax({
            type: 'get',
            url: url,
            dataType: 'json',
            success: function(response) {
               $('.review-item').remove();
               $.each(response.data, function(key, value) {
                var avatar="https://ui-avatars.com/api/?background=random&name="+value.name;
                var html='<li class="review-item"><div class="reviewer-img"> <a href="#"><img src="'+avatar+'" alt="'+value.name+'"></a></div><div class="reviewer-descrip"><div class="reviewer-meta"> <a href="#">'+value.name+'</a><p>'+value.created_at+'</p></div><ul class="reviewer-rating rev_ar'+key+'"></ul><div class="reviewer-quote"><p>'+escapeHtml(value.comment)+'</p></div></div></li>';

                $('.review-list').append(html);
                render_star(key,value.rating);
               });

               if(response.links.links.length > 3) {
                
                 render_pagination('.pagination',response.links.links);
               }
              
            }
        })
    }

    function render_star(key,rating){

        for(var i = 0; i < 5; i++){
            if(i < rating){
                var cl="fas fa-star active";
            }
            else{
                var cl="fas fa-star";
            }
            var html='<li><i class="'+cl+'"></i>';

            $('.rev_ar'+key).append(html);
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