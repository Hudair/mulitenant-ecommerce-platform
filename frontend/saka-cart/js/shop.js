(function ($) {
    "use strict";
    
    //filter by product limit
    $('#limit').on('change',function(){
        get_data(base_url+'/get_shop_products'); 
    });
    
    //filter by price limit
    $('.filter_btn').on('click',function(){
        min_price= $('#price-min').val();
        max_price= $('#price-max').val();
        get_data(base_url+'/get_shop_products'); 
    });
    
    //filter by attributes
    $(document).on('click','.attributes',()=> {
        var arr = [];
        $('.attributes:checkbox:checked').each(function () {
            var val=parseInt($(this).val());
            arr.push(val);
        });
        attributes = arr;
        get_data(base_url+'/get_shop_products');
    });
    
    //filter by category
    $(document).on('click','.categories',()=> {
        var arr = [];
        $('.categories:checkbox:checked').each(function () {
            var v=parseInt($(this).val());
            arr.push(v);
        });
        categories = arr;
        get_data(base_url+'/get_shop_products');
    });
    
  
  })(jQuery);  

    var preloader= $('#preloader').val();
    var base_url= $('#base_url').val();
    var min_price= $('#price-min').val();
    var max_price= $('#price-max').val();
    var order_by=$('.order_by').val();
    var src= $('.src').val();
    var attributes=[];
    var categories=[];
      
    if($('#category').val() != ''){
      categories.push($('#category').val());
    }  
  
    get_data(base_url+'/get_shop_products');
  
    $('.order_by').on('change',function(){
       order_by= $(this).val();
       get_data(base_url+'/get_shop_products'); 
    });
  
    
        $.ajax({
          type: 'get',
          url: base_url+'/get_shop_attributes',
          dataType: 'json',
          data:{order: order_by},
                    
          success: function(response){ 
              $('.cat-item').remove();
              
              var cat =$('#category').val();
  
              $.each(response.categories, function(index, value){
                  if(cat == value.id){
                    var selected="checked";
                  }
                  else{
                    var selected=null;
                  }
                  
                  var html='<li><div class="check-box">';
                      html +='<input type="checkbox" class="categories" id="category-'+index+'" '+selected+' value="'+value.id+'">';
                      html +='<div class="check-box__state check-box__state--primary">';
                      html +='<label class="check-box__label categories" for="category-'+index+'">'+value.name+' ('+value.posts_count+')</label></div>';
                      html +='</div></li>';
                  
                  $('.category_area').append(html);
  
              });
  
              $.each(response.brands, function(index, value){
                  if(cat == value.id){
                    var selected="checked";
                  }
                  else{
                    var selected=null;
                  }
                  var html='<li><div class="check-box">';
                      html +='<input type="checkbox" class="categories" id="category-'+index+'" '+selected+' value="'+value.id+'">';
                      html +='<div class="check-box__state check-box__state--primary">';
                      html +='<label class="check-box__label categories" for="category-'+index+'">'+value.name+' ('+value.posts_count+')</label></div>';
                      html +='</div></li>';
                   
                  $('.brand_area').append(html);
  
              });
              
  
              $.each(response.attributes, function(index, value){
                                
                 var html = '<div class="u-s-m-b-30">';
                     html += '<div class="shop-w">';
                     html += '<div class="shop-w__intro-wrap">';
                     html += '<h1 class="shop-w__h">Select by '+value.name+'</h1>';
                     html += '<span class="fas fa-minus shop-w__toggle" data-target="#s-shipping" data-toggle="collapse"></span>';
                     html += '</div>';
                     html += '<div class="shop-w__wrap collapse show" id="s-shipping">';
                     html += '<ul class="shop-w__list gl-scroll product-size-ul'+index+'">';
                     html += '</ul></div></div></div>';
                 $('#left_sidebar').append(html);
  
                 $.each(value.featured_child_with_post_count_attribute, function(i, v){
                    var li='<li><div class="check-box">';
                    li +='<input type="checkbox" class="attributes" id="attribute-'+v.id+'" value="'+v.id+'">';
                    li +='<div class="check-box__state check-box__state--primary">';
                    li +='<label class="check-box__label attributes" for="attribute-'+v.id+'">'+v.name+' ('+v.variations_count+')</label></div>';
                    li +='</div></li>';
                  
                 $('.product-size-ul'+index+'').append(li);
                 });
              });   
          },
          error: function() 
          {
              location.reload();
          }
      })
  
    function get_data(url) {
        var limit=$('#limit').val();
      
        $.ajax({
              type: 'get',
              url: url,
              dataType: 'json',
              data:{order: order_by,categories: categories,attrs:attributes,term:src,limit:limit,min_price:min_price,max_price:max_price},
              beforeSend: function() {
                  $('.product-card').remove();
                  
                  product_preload('.product_preload_area',parseInt(limit)+1,'col-lg-4 col-md-6 col-sm-6')
              },           
              success: function(response){ 
                  $('.product_preload_item').remove();
                  if(response.from == null){
                    var from=0;
                  }
                  else{
                    var from=response.from;
                  }
  
                  if(response.total == null){
                    var total=0;
                  }
                  else{
                    var total=response.total;
                  }
  
                  $('.grid-verti').click();
                  $('.content-placeholder').remove();
                  $('#from').html(from);
                  $('#to').html(response.to);
                  $('#total').html(total);
                  render_products('.product_area',response.data,'col-lg-4 col-md-6 col-sm-6 product-card');             
                
                  run_lazy();
                  if(response.links.length > 3) {
                  
                    render_pagination('.pagination',response.links);
                 }
                 else{
                  $('.page-item').remove();
                 }
                  CountDown();
                 
              },
              error: function() 
              {
                 get_data(base_url+'/get_shop_products');
              }
          })
    }
  
  

$(document).on('click','.page-link',function() {
   var url = $(this).data('url');
   //console.log(url)
   if(url != null){
   get_data(url);
}
  
});


  function PaginationClicked(key){
      var url = $('.page-link-no'+key).data('url');
  //  get_data(url)
  }