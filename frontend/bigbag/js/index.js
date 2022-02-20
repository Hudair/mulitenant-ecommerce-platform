(function ($) {
  "use strict";
  var preloader= $('#preloader').val();
  var base_url= $('#base_url').val();
  var request_count = 0;
  get_data();

  function get_data() {
      $.ajax({
            type: 'get',
            url: base_url+'/get_home_page_products',
            data:{latest_product:1,random_product:1,trending_products:1,best_selling_product:1,sliders:1,menu_category:1,bump_adds:1,banner_adds:1,get_offerable_products:1},
            dataType: 'json',
            
            beforeSend: function() {
                $('.product-card').remove();
                for (var i = 1; i < 5; i++) {
                    var img='<div class="content-placeholder product_preload"></div>';
                    var html='<div class="product-card content-placeholder"><div class="product-img"> <a href="#" class="text-dark">'+img+'</div><div class="product-content"><div class="product-name"><h3></h3></a><p></p></div><div class="product-price"><h4></h4><p></p></div><div class="product-cart"></div></div></div>';
                    var cat='<li class="cat-item cat-item"><p><span class="content-placeholder h-20">&nbsp;</span></p></li>';
                    $('#bast_selling_product_area').append(html);
                    $('#trending_product_area').append(html);
                    $('#latest_product_area').append(html);
                    $('.cate-scroll').append(cat);
                    
                }

                for (var i = 1; i < 10; i++) {
                    
                    var cat='<li class="cat-item cat-item"><p><span class="content-placeholder h-20">&nbsp;</span></p></li>';
                    
                    $('.cate-scroll').append(cat);
                    
                }
               
                
            },            
            success: function(response){ 
                $('.slider_preload').removeClass('content-placeholder');
                $('.slider_preload').removeClass('slider_preload');
                $('.content-placeholder').remove();
                
                $('.cat-item').remove();
                if (response.get_best_selling_product.length > 0) {
                   render_products(response.get_best_selling_product,'#bast_selling_product_area'); 
                }
                else{
                    $('.best-part').remove();
                }
                if (response.get_trending_products.length > 0) {
                   render_products(response.get_trending_products,'#trending_product_area'); 
                }
                else{
                    $('.trend-part').remove();
                }
                if (response.get_offerable_products.length > 0) {                 
                   render_products(response.get_offerable_products,'#get_offerable_products');
                   $('.get_offerable_products').show(); 
                }
                
                else{
                    $('.get_offerable_products').remove();
                }
                if (response.get_latest_products.length > 0) {
                   render_products(response.get_latest_products,'#latest_product_area',true); 
                }
                else{
                    $('.new-part').remove();
                }
                
                if (response.sliders.length > 0) {
                     $.each(response.sliders, function(index, value){
                       var html='<a href="'+value.url+'"><img src="'+value.slider+'" alt=""></a>';
                       $('.banner-slider').append(html);
                    });  
                    banner_slider();
                }
                else{
                    $('.banner-slider').remove();
                }

                if (response.get_menu_category.length > 0) {
                     $.each(response.get_menu_category, function(index, value){
                       var html='<li><a href="'+base_url+'/category/'+value.slug+'/'+value.id+'">'+value.name+'</a></li>';
                      $('.cate-scroll').append(html);
                    });  
                   
                }
                else{
                    $('.cate-scroll').remove();
                }  

                if (response.bump_adds.length > 0) {
                     $.each(response.bump_adds, function(index, value){
                       var html='<a href="'+value.url+'"><img src="'+value.image+'" alt=""></a>';
                       $('.offer-slider').append(html);
                    }); 
                    offer_sliders(); 
                    
                }
                else{
                    $('.offer-part').remove();
                }

                if (response.banner_adds.length > 0) {
                     $.each(response.banner_adds, function(index, value){
                       var html='<a href="'+value.url+'"><img src="'+value.image+'" alt=""></a>';
                       $('.banner_ad').append(html);
                    });  
                    
                }
                else{
                    $('.add-part').remove();
                }


              product_slider();
              run_lazy();
               
            },
            error: function() 
            {
                if(request_count == 0){
                  get_data();  
                }
                request_count+1;
                
            }
        })
  }

})(jQuery);
    