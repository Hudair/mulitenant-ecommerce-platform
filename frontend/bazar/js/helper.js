"use strict";

 var preloader= $('#preloader').val();
 var whatsapp=false;
  if ($('.whatsapp-btn').length) {
    whatsapp=true;
    var whatsapp_url= $('.whatsapp-btn').data('url');
  }
function currncy_format(price) {
    var currency_position= $('#currency_position').val();
    var currency_name= $('#currency_name').val();
    var currency_icon= $('#currency_icon').val();
     var price=price.toLocaleString();
    if (currency_position == 'left'){
      var currency=currency_icon + price;
    }
    else{
      var currency=price + currency_icon;
    }

    return currency;
  }

  function image_size(url,size) {
    var new_string = url.substring(0, url.lastIndexOf(".")) + size + url.substring(url.lastIndexOf("."));
    return new_string;
  }

  function run_lazy() {
    $(".lazy").unveil(100, function() {
      $(this).on('load',function(){
         this.style.opacity = 1;
      });
    }); 
  }


  function str_limit(text, count, insertDots){
    return text.slice(0, count) + (((text.length > count) && insertDots) ? "..." : "");
  }

  function add_to_cart(id){
    var base_url=$('#base_url').val();
    var dom = $('.cart_'+id).html();
    $('.cart_'+id).html('<i class="fas fa-spinner"></i>');

    $.ajax({
      type: 'get',
      url: base_url+'/add_to_cart/'+id,
      dataType: 'json',          
      success: function(response){ 
        render_cart(response);
        var checkout=base_url+'/cart'
        $('.cart_'+id).attr('href',checkout);
        $('.cart_'+id).removeAttr('onclick');
        $('.cart_'+id).html('<i class="fas fa-check"></i>');
      }
    });    
  }

  function add_to_wishlist(id){
    var base_url=$('#base_url').val();
    var dom = $('.wishlist_'+id).html();
    $('.wishlist_'+id).html('<i class="fas fa-spinner"></i>');

    $.ajax({
      type: 'get',
      url: base_url+'/add_to_wishlist/'+id,
      dataType: 'json',          
      success: function(response){ 
        var wishlist=base_url+'/wishlist'
        $('.wishlist_'+id).attr('href',wishlist);
        $('.wishlist_'+id).removeAttr('onclick');
        $('.wishlist_'+id).html('<i class="fas fa-check"></i>');
        $('.wishlist_count').html(response)
      }
    });    
  }



  function remove_cart(id){
   var base_url=$('#base_url').val();
   var id=$('#rowid'+id).val();
   $('.cart-row'+id).remove();
   $.ajax({
    type: 'get',
    url: base_url+'/remove_cart/',
    data:{id:id},
    dataType: 'json',          
    success: function(response){ 
      render_cart(response);
    }
  }); 
   
 }

 function render_cart(data){
   var base_url=$('#base_url').val();
   $('#cart_sub_total').html(currncy_format(data.subtotal));
   $('#cart_total').html(currncy_format(data.total));
   $('.cart_count').html(data.count);

   $('.cart-item').remove();
   $.each(data.cart_add, function(index, value){
    var rowId=value.rowId;
    var term_id=value.id;
    var html='<div class="card-mini-product cart-item cart-row'+value.rowId+'">';
    html +='<div class="mini-product">';
    html +='<div class="mini-product__image-wrapper">';
    html +='<a class="mini-product__link" href="'+base_url+'/product/'+value.name+'/'+term_id+'">';
    html +='<img class="u-img-fluid" src="'+value.options.preview+'" alt=""></a></div>';
    html +='<div class="mini-product__info-wrapper"><span class="mini-product__name">';
    html +='<a href="'+base_url+'/product/'+value.name+'/'+term_id+'">'+value.name+'</a></span>';
    html +='<span class="mini-product__quantity">'+value.qty+' x</span>';
    html +='<span class="mini-product__price">'+currncy_format(value.price)+'</span></div></div>';
    html +='<a class="mini-product__delete-link far fa-trash-alt" onclick="remove_cart('+value.id+')"></a>';
    html +='<input type="hidden" value="'+rowId+'" id="rowid'+value.id+'"></div>';
    
    $('.cart-list').append(html);

  });
 }

 function product_preload(target, count=16,add_class="col-xl-3 col-lg-4 col-md-6 col-sm-6 u-s-m-b-30"){
  for (var i = 1; i < count; i++) {
   var html='<div class="'+add_class+' product_preload_item">';
       html+='<div class="product-o product-o--radius">';
       html+='<div class="content-placeholder thumbnail-size"></div>';
       html+='<span class="product-o__category content-placeholder h-13">';
       html+='<a></a></span><span class="product-o__name content-placeholder h-14"></span>';
       html+='<span class="product-o__price content-placeholder h-20"></span> </div></div>';
    $(target).append(html);

  }
 }

function render_products(target,data,additional_class='') {
    var base_url= $('#base_url').val();
    $.each(data, function(index, value){  
        var name=value.title;
        var name=str_limit(name,63,true);
        var url = base_url+'/product/'+value.slug+'/'+value.id;
        if (value.preview != null) {
          var image=image_size(value.preview.media.url,'medium');  
        }
        else{
            var image=base_url+'/uploads/default.png';
        }

        if(whatsapp == true){
          
          var contact_for_item = '<li><a href="'+whatsapp_url+url+'" target="_blank" data-tooltip="tooltip" data-placement="top" title="Contact us about this product"><i class="fab fa-whatsapp"></i></a></li>';
        }
        else{
          var contact_for_item='';
        }

        var next=false;

       if(value.attributes.length > 0){
        next=true;
       }
       if(value.options.length > 0){
        next=true;
       }
       if(value.affiliate != null){
        next=true;
       }


        if(value.price.starting_date == null || value.price.ending_date == null){
          var price='<span class="product-o__price">'+currncy_format(value.price.price)+'</span>';
          var counter='';
        }
        else if(value.price.price == value.price.regular_price){
          var price='<span class="product-o__price">'+currncy_format(value.price.price)+'</span>';
          var counter='';
        }
        else{
          var price='<span class="product-o__price">'+currncy_format(value.price.price)+'<span class="product-o__discount">'+currncy_format(value.price.regular_price)+'</span></span>';
          
          if(value.price.ending_date != null){
            var date=value.price.ending_date;
         
           var counter='<div class="product-o__special-count-wrap"><div class="countdown countdown--style-special" data-countdown="'+date.replace('-','/')+'"></div></div>';
        
          }
          else{
            var counter='';
          }
          
        }


        if(next == false && value.stock.stock_manage != 1){
            

            var add_to_cart='<li><a href="javascript:void(0)" data-tooltip="tooltip" data-placement="top" title="Add to Cart" onclick="add_to_cart('+value.id+')" class="cart_'+value.id+'"><i class="fas fa-plus-circle"></i></a></li>';
            var add_to_wishlist='<a href="javascript:void(0)" onclick="add_to_wishlist('+value.id+')" class="wishlist_'+value.id+'" data-tooltip="tooltip" data-placement="top" title="Add to Wishlist"><i class="fas fa-heart"></i></a>'; 
           
           
        }
        else{
            
             var add_to_cart='<li><a href="'+url+'" data-tooltip="tooltip" data-placement="top" title="Add to Cart"><i class="fas fa-plus-circle"></i></a> </li>';
            var add_to_wishlist='<a href="'+url+'" data-tooltip="tooltip" data-placement="top" title="Add to Wishlist"><i class="fas fa-heart"></i></a>';
          
        }

        if (value.category != null) {
            var category='<span class="product-o__category"><a href="'+base_url+'/category/'+value.category.category.slug+'/'+value.category.category.id+'">'+value.category.category.name+'</a></span>';
        }
        else{
            var category='';
        }
       
       var review_count='('+value.reviews_count+')';       
       


        var html='<div class="'+additional_class+'  u-s-m-b-30">';
            html +='<div class="product-o product-o--hover-on product-o2__wrap u-h-100">';
            html +='<div class="product-o__wrap"><a class="aspect aspect--bg-grey aspect--square u-d-block" href="'+url+'">';
            html +='<img class="aspect__img lazy" src="'+preloader+'" data-src="'+image+'" alt="">'+counter+'</a>';
            html +='<div class="product-o__action-wrap"> <ul class="product-o__action-list">';
            html +='<li> <a href="'+url+'" data-tooltip="tooltip" data-placement="top" title="View Product"><i class="fas fa-search-plus"></i></a>';
            html +='</li>'+add_to_cart+'<li> '+add_to_wishlist+' </li>'+contact_for_item+'</ul>';
            html +='</div></div>'+category+'<span class="product-o__name"> <a href="'+url+'">'+name+'</a></span>';
            html +='<div class="product-o__rating gl-rating-style">';
            html +='<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>';
            html +='<span class="product-o__review">'+review_count+'</span></div>';
            html +=''+price+' </div></div>';

        
        $(target).append(html);
    });
  }


function render_pagination(target,data){
        $('.page-item').remove();
       $.each(data, function(key,value){
            if(value.label === '&laquo; Previous'){
                if(value.url === null){
                    var is_disabled="disabled"; 
                    var is_active=null;
                }
                else{
                    var is_active='page-link-no'+key;
                    var is_disabled='onClick="PaginationClicked('+key+')"';
                }
                var html='<li  class="page-item"><a '+is_disabled+' class="fas fa-angle-left page-link '+is_active+'" href="javascript:void(0)" data-url="'+value.url+'"></a></li>';
            }
            else if(value.label === 'Next &raquo;'){
                if(value.url === null){
                    var is_disabled="disabled"; 
                    var is_active=null;
                }
                else{
                    var is_active='page-link-no'+key;
                   var is_disabled='onClick="PaginationClicked('+key+')"';
                }
                var html='<li class="page-item"><a '+is_disabled+'  class="fas fa-angle-right page-link '+is_active+'" href="javascript:void(0)" data-url="'+value.url+'"></a></li>';
            }
            else{
                if(value.active==true){
                    var is_active="is-active";
                    var is_disabled="disabled";
                    var url=null;

                }
                else{
                    var is_active='page-link-no'+key;
                    var is_disabled='onClick="PaginationClicked('+key+')"';
                    var url=value.url;
                }
                var html='<li class="page-item '+is_active+'"><a class="page-link '+is_active+'" '+is_disabled+' href="javascript:void(0)" data-url="'+url+'">'+value.label+'</a></li>';
            }
            if(value.url !== null){
              $(target).append(html);
            }
            
       });
    }


 // Bind all sliders into the page
 var productSlider = function() {
        // 0 is falsy value, 1 is truthy
        var collectionProductSlider = $('.product-slider')
        if (collectionProductSlider.length) {
          collectionProductSlider.on('initialize.owl.carousel', function () {
            $(this).closest('.slider-fouc').removeAttr('class');
          }).each(function () {
            var thisInstance = $(this);
            var itemPerLine = thisInstance.data('item');
            thisInstance.owlCarousel({
              autoplay: false,
              loop: false,
              dots: false,
              rewind: true,
              smartSpeed: 1500,
              nav: true,
              navElement: 'div',
              navClass: ['p-prev', 'p-next'],
              navText: ['<i class="fas fa-long-arrow-alt-left"></i>', '<i class="fas fa-long-arrow-alt-right"></i>'],
              responsive: {
                0: {
                  items: 1
                },
                768: {
                  items: itemPerLine - 2
                },
                991: {
                  items: itemPerLine - 1
                },
                1200: {
                  items: itemPerLine
                }
              }
            });
          });
        }

}

function CountDown(){
  var collectionCountDown = $('[data-countdown]');
         if (collectionCountDown.length) {
            collectionCountDown.each(function () {
                var $this = $(this),
                    finalDate = $(this).data('countdown');
                $this.countdown(finalDate, function (event) {
                      $this.html(event.strftime('<div class="countdown__content"><div><span class="countdown__value">%D</span><span class="countdown__key">Days</span></div></div><div class="countdown__content"><div><span class="countdown__value">%H</span><span class="countdown__key">Hours</span></div></div><div class="countdown__content"><div><span class="countdown__value">%M</span><span class="countdown__key">Mins</span></div></div><div class="countdown__content"><div><span class="countdown__value">%S</span><span class="countdown__key">Secs</span></div></div>'));
                });
            });
    }
}     