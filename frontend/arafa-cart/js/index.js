(function ($) {
  "use strict";
  var preloader= $('#preloader').val();
  var base_url= $('#base_url').val();
  var request_count = 0;
  var all_products=[];

  


  get_data();
 
  $(document).on('click','.filter__btn',function(e) {
    $('.filter__btn').removeClass('js-checked');
    $(this).addClass('js-checked');
    var id= $(this).data('filter');
    render_filter_product(id);
  });

  function render_filter_product(id){
    if(id == 0){
      $('.filter_product').remove();
     $('.product_preload_item').remove();
     render_products('#random_product',all_products,'col-xl-3 col-lg-4 col-md-6 col-sm-6 filter_product');
     run_lazy();
    }
    else{
       $.ajax({
            type: 'get',
            url: base_url+'/get_shop_products',
            dataType: 'json',
            data:{order: 'DSC',categories: [id]},
            beforeSend: function() {
              $('.filter_product').remove();
              product_preload('#random_product',5);
            },           
            success: function(response){ 
               $('.product_preload_item').remove();
               render_products('#random_product',response.data,'col-xl-3 col-lg-4 col-md-6 col-sm-6 filter_product');
               run_lazy();
               CountDown();
            },
            error: function() 
            {
               $('.product_preload_item').remove();
            }
        })
    }

  }

  function get_data() {
      $.ajax({
            type: 'get',
            url: base_url+'/get_home_page_products',
            data:{latest_product:1,random_product:1,best_selling_product:1,sliders:1,bump_adds:1,banner_adds:1,featured_brand:1,featured_category:1,menu_category:1,get_offerable_products:20},
            dataType: 'json',            
            beforeSend: function() {
                product_preload('.new_product_preload',5)
                product_preload('.trending_products',9)
                product_preload('.bump_ads',5)
                product_preload('#random_product',9)
                
            },            
            success: function(response){ 
                $('.cat-item').remove();
                $('.slider_area').removeClass('content-placeholder');
                $('.banner_ads').removeClass('content-placeholder');
                $('.slider_area').removeClass('slider_preload');
                $('.banner_ads').removeClass('slider_preload');
                $('.new_product_preload').remove();
                $('.product_preload_item').remove();
                
                if(response.get_menu_category.length > 0){                 
                  $.each(response.get_menu_category, function(index, value){
                    
                    var html = '<li >';
                        html += '<a href="'+base_url+'/category/'+value.slug+'/'+value.id+'">';
                        html += '<span>'+value.name+'</span></a>';
                        html += '<span class="js-menu-toggle js-toggle-mark"></span></li>';
                        
                    $('#menu_category').append(html);
                  });
                }
                
                if(response.featured_category.length > 0){
                    $.each(response.featured_category, function(index, value){
                      var html ='<div class="filter__category-wrapper">';
                      html +='<button class="btn filter__btn filter__btn--style-1" type="button" data-filter="'+value.id+'">'+value.name+'</button>';
                      html +='</div>';
                      $('.filter-category-container').append(html)
                    });
                }
                
                if (response.sliders.length > 0) {
                     $.each(response.sliders, function(index, value){
                      var img=value.slider;
                      var title=value.meta.title;
                      var btn_text=value.meta.btn_text;
                      var url=value.url;
                      var html='<div class="hero-slide" style="background-image:url('+img+')">';
                      html +='<div class="container">';
                      html +='<div class="row">';
                      html +='<div class="col-12">';
                      html +='<div class="slider-content slider-content--animation">';
                      html +='<span class="content-span-2 u-c-secondary">'+title+'</span>';
                      html +='<span class="content-span-4 u-c-secondary">';
                      html +='<a class="shop-now-link btn--e-brand" href="'+url+'">'+btn_text+'</a>';
                      html +='</div></div></div></div></div>';
                      $('#hero-slider').append(html);
                    });  
                    primarySlider();
                }
                else{
                    $('.slider_area').remove();
                }

                if (response.get_best_selling_product.length > 0) {
                  render_products('.bestseles_products',response.get_best_selling_product);
                } 
                else{
                  $('.bestseles_products_area').remove();
                } 


                if (response.get_offerable_products.length > 0) {                 
                   render_products('#get_offerable_products',response.get_offerable_products);
                   $('.get_offerable_products').show(); 
                }
                
                else{
                    $('.get_offerable_products').remove();
                }

                if (response.get_latest_products.length > 0) {
                   render_products('.new_product_area',response.get_latest_products);                  
                   productSlider(); 
                  
                }
                else{
                    $('.new_product_area').remove();
                }


                if (response.get_random_products.length > 0) {
                   all_products=response.get_random_products;
                   render_products('#random_product',response.get_random_products,'col-xl-3 col-lg-4 col-md-6 col-sm-6 filter_product');                  
                  
                    
                }
                else{
                    $('#random_product').remove();
                }
                var i=5;
                if(response.bump_adds.length > 0){
                  $.each(response.bump_adds, function(index, value){  
                     if(i == 7){
                      i=5;
                      
                      var col='col-lg-7 col-md-7';
                      var aspect='aspect--1286-890';
                     }
                     else{    
                      i = 7;     
                      var col='col-lg-5 col-md-5';
                       var aspect='aspect--square';
                     }
                     if(isOdd(index+1) == false){
                      i = 7; 
                     }                           
                    var html='<div class="'+col+' u-s-m-b-30"> <a class="collection" href="'+value.url+'"><div class="aspect aspect--bg-grey '+aspect+'"> <img class="aspect__img collection__img lazy"  src="'+preloader+'" data-src="'+value.image+'"  alt=""></div> </a></div>'
                   
                   $('.bump_ads').append(html);
                  });

                }
                else{
                  $('.featured_category_section').remove();
                }

                if(response.banner_adds.length > 0){
                   $.each(response.banner_adds, function(index, value){
                   var html='<a href="'+value.url+'" ><img src="'+value.image+'" alt=""></a>';
                   $('.banner_ads').html(html)
                   });  
                }
                else{

                }  

                if(response.featured_brand.length > 0){
                  $.each(response.featured_brand, function(index, value){
                    var html='<div class="brand-slide"><a href="'+base_url+'/brand/'+value.slug+'/'+value.id+'"><img src="'+preloader+'" data-src="'+value.preview+'" class="lazy"  alt=""></a></div>';
                    $('#brand-slider').append(html);
                  })
                  brandSlider();
                }
                else{
                  $('.brand_area').remove();
                }


                
             
              run_lazy();
              CountDown();
               
            },
            error: function() 
            {
                if(request_count == 0){
                  get_data();  
                }
                request_count+1;
                
            }
        });

   
  }


 
 // Bind all sliders into the page
var primarySlider = function() {
      var primarySlider = $('#hero-slider');
        if (primarySlider.length) {
            primarySlider.owlCarousel({
                items: 1,
                autoplayTimeout: 3000,
                loop: true,
                margin: -1,
                dots: false,
                smartSpeed: 1500,
                rewind: false, // Go backwards when the boundary has reached
                nav: false,
                responsive: {
                    992: {
                        dots: true
                    }
                }
            });
        }
}



  // Bind Brand slider
  var brandSlider = function() {
    var $brandSlider = $('#brand-slider');
        // Check if brand slider on the page
        if ($brandSlider.length) {
          var itemPerLine = $brandSlider.data('item');
          $brandSlider.on('initialize.owl.carousel', function () {
            $(this).closest('.slider-fouc').removeAttr('class');
          }).owlCarousel({
            autoplay: false,
            loop: false,
            dots: false,
            rewind: true,
            nav: true,
            navElement: 'div',
            navClass: ['b-prev', 'b-next'],
            navText: ['<i class="fas fa-angle-left"></i>', '<i class="fas fa-angle-right"></i>'],
            responsive: {
              0: {
                items: 2
              },
              768: {
                items: 3,
              },
              991: {
                items: itemPerLine
              },
              1200: {
                items: itemPerLine
              }
            }

          });
        }
      };
function isOdd(num) {
 return num % 2;
}
})(jQuery);
    