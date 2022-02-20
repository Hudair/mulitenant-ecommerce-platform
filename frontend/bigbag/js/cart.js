"use strict";

function currncy_format(price) {
    var currency_position= $('#currency_position').val();
    var currency_name= $('#currency_name').val();
    var currency_icon= $('#currency_icon').val();
    
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
    $('.cart_'+id).html('<div class="spinner-border spinner-border-sm text-white" role="status"><span class="sr-only">Loading...</span></div>');

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
   $('#cart_count').html(data.count);

   $('.cart-item').remove();
   $.each(data.cart_add, function(index, value){
    var rowId=value.rowId;
    var term_id=value.id;
   
    var html='<li class="cart-item cart-row'+value.rowId+'"><div class="cart-img"><a href="'+base_url+'/product/'+value.name+'/'+term_id+'"><img src="'+value.options.preview+'" alt=""></a></div><div class="cart-info"><a href="'+base_url+'/product/'+value.name+'/'+term_id+'">'+value.name+'</a><p>'+value.qty+' x <span>'+value.price+'</span></p></div><div class="cart-remove"><a href="javascript:void(0)" onclick="remove_cart('+value.id+')"><i class="fas fa-times"></i></a></div><input type="hidden" value="'+rowId+'" id="rowid'+value.id+'"></li>';

    $('.cart-list').append(html);

  });
 }

function render_products(data,target,badge_status=false) {
    var preloader= $('#preloader').val();
    var base_url= $('#base_url').val();
    $.each(data, function(index, value){  
        var name=value.title;
        var name=str_limit(name,22,true);
        var url = base_url+'/product/'+value.slug+'/'+value.id;
        if (value.preview != null) {
          var image=image_size(value.preview.media.url,'medium');  
        }
        else{
            var image=base_url+'/uploads/default.png';
        }
         
     
        if(value.price.starting_date == null || value.price.ending_date == null){
          var price=currncy_format(value.price.price);
        }
        else if(value.price.price == value.price.regular_price){
          var price=currncy_format(value.price.price);
        }
        else{
          var price='<del>'+currncy_format(value.price.regular_price)+'</del> '+currncy_format(value.price.price);
        }
        if (value.category != null) {
          var category=value.category.category.name;  
       }
       else{
           var category='';
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

       
       if(next == false && value.stock.stock_manage != 1){
        var cart_url='<a href="javascript:void(0)" onclick="add_to_cart('+value.id+')" class="cart_'+value.id+'"><i class="fas fa-shopping-basket"></i></a>';
       
       }
       else{
        var cart_url='<a href="'+url+'"><i class="fas fa-shopping-basket"></i></a>';
       }

       if(badge_status == true){
         if(value.featured == 1){
          var badge='<span class="new-badge">Trending</span>';
         }
         else if(value.featured == 2){
          var badge='<span class="new-badge">Best selling</span>';
         }
         else{
           badge='';
         }
        
       }
      
       else{
         badge='';
       }

       if(value.stock.stock_status == 0){
        var badge='<span class="new-badge">Stock Out</span>';
       }

       

        var html ='<div class="product-card">';
            html +='<div class="product-img">';
            html +='<img src="'+image+'" alt="product-4">';
            html +=badge;
            html +='<ul class="product-widget">';
            html +='<li>'+cart_url+'</li>';
            html +='<li><a href="'+url+'"><i class="fas fa-search"></i></a></li>';
            html +='<li><a class="wishlist_'+value.id+'" onclick="add_to_wishlist('+value.id+')"><i class="fas fa-heart"></i></a></li>';
            html +='</ul></div>';
            html +='<div class="product-content">';
            html +=' <div class="product-cate">';
            html +=' <p>'+category+'</p>';
            html +='</div>';
            html +='</div>';
            html +='<div class="product-name">';
            html +='<a href="'+url+'"><h3>'+name+'</h3></a></div>';
            html +='<div class="product-price">';
            html +='<p>'+price+'</p>';
            html +='<ul class="product-rating">';
            html +='<li>';
            html +='<i class="fas fa-star"></i>';
            html +=' <span>('+value.reviews_count+')</span>';
            html +='</li></ul></div></div>';

       
        $(target).append(html);
    });
  }



  function render_shop_products(data,target) {
    var preloader= $('#preloader').val();
    var base_url= $('#base_url').val();
    $('.product-card').remove();

   $.each(data, function(index, value){  
    var name=value.title;
    var name=str_limit(name,22,true);
    var url = base_url+'/product/'+value.slug+'/'+value.id;
    if (value.preview != null) {
      var image=image_size(value.preview.media.url,'medium');  
    }
    else{
        var image=base_url+'/uploads/default.png';
    }
     
 
    if(value.price.starting_date == null || value.price.ending_date == null ){
      var price=currncy_format(value.price.price);
    }
    else if(value.price.price == value.price.regular_price){
      var price=currncy_format(value.price.price);
    }
    else{
      var price='<del>'+currncy_format(value.price.regular_price)+'</del> '+currncy_format(value.price.price);
    }
    if (value.category != null) {
      var category=value.category.category.name;  
   }
   else{
       var category='';
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

   
   if(next == false && value.stock.stock_manage != 1){
    var cart_url='<a href="javascript:void(0)" onclick="add_to_cart('+value.id+')" class="cart_'+value.id+'"><i class="fas fa-shopping-basket"></i></a>';
   
   }
   else{
    var cart_url='<a href="'+url+'"><i class="fas fa-shopping-basket"></i></a>';
   }

   
     if(value.featured == 1){
      var badge='<span class="new-badge">Trending</span>';
     }
     else if(value.featured == 2){
      var badge='<span class="new-badge">Best selling</span>';
     }
     else{
       badge='';
     }
    
   

   if(value.stock.stock_status == 0){
    var badge='<span class="new-badge">Stock Out</span>';
   }

   

    var html ='<div class="product-card">';
        html +='<div class="product-img">';
        html +='<img src="'+image+'" alt="product-4">';
        html +=badge;
        html +='<ul class="product-widget">';
        html +='<li>'+cart_url+'</li>';
        html +='<li><a href="'+url+'"><i class="fas fa-search"></i></a></li>';
        html +='<li><a class="wishlist_'+value.id+'" onclick="add_to_wishlist('+value.id+')"><i class="fas fa-heart"></i></a></li>';
        html +='</ul></div>';
        html +='<div class="product-content">';
        html +=' <div class="product-cate">';
        html +=' <p>'+category+'</p>';
        html +='</div>';
        html +='</div>';
        html +='<div class="product-name">';
        html +='<a href="'+url+'"><h3>'+name+'</h3></a><p> </p></div>';
        html +='<div class="product-price">';
        html +='<p>'+price+'</p>';
        html +='<ul class="product-rating">';
        html +='<li>';
        html +='<i class="fas fa-star"></i>';
        html +=' <span>('+value.reviews_count+')</span>';
        html +='</li></ul></div></div>';

   
    $(target).append(html);
          
   });
  }


function add_to_wishlist(id) {
  var base_url=$('#base_url').val();
  var dom = $('.wishlist_'+id).html();
  $('.wishlist_'+id).html('<div class="spinner-border spinner-border-sm text-white" role="status"><span class="sr-only">Loading...</span></div>');

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
                var html='<li  class="page-item"><a '+is_disabled+' class="page-link '+is_active+'" href="javascript:void(0)" data-url="'+value.url+'"><i class="fas fa-long-arrow-alt-left"></i></a></li>';
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
                var html='<li class="page-item"><a '+is_disabled+'  class="page-link '+is_active+'" href="javascript:void(0)" data-url="'+value.url+'"><i class="fas fa-long-arrow-alt-right"></i></a></li>';
            }
            else{
                if(value.active==true){
                    var is_active="active";
                    var is_disabled="disabled";
                    var url=null;

                }
                else{
                    var is_active='page-link-no'+key;
                    var is_disabled='onClick="PaginationClicked('+key+')"';
                    var url=value.url;
                }
                var html='<li class="page-item"><a class="page-link '+is_active+'" '+is_disabled+' href="javascript:void(0)" data-url="'+url+'">'+value.label+'</a></li>';
            }
            if(value.url !== null){
              $(target).append(html);
            }
            
       });
    }