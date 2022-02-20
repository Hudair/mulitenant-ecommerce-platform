(function ($) {
  "use strict";
  
  $(document).on('click','.attributes',()=> {
    var arr = [];
    $('.attributes:checkbox:checked').each(function () {
        var val=parseInt($(this).val());
        arr.push(val);
    });
    attributes = arr;
    get_data(base_url+'/get_shop_products');
  });

  $(document).on('click','.categories',()=> {
    var arr = [];
    $('.categories:checkbox:checked').each(function () {
        var v=parseInt($(this).val());
        arr.push(v);
    });
    categories = arr;
    get_data(base_url+'/get_shop_products');
  });

  $(document).on('click','.filter_btn',()=> {
    get_data(base_url+'/get_shop_products');
  });

})(jQuery);  
  var preloader= $('#preloader').val();
  var base_url= $('#base_url').val();
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
                var html='<li><label class="attrs" for="category-'+index+'"><h5><input type="checkbox" class="categories" '+selected+' value="'+value.id+'" id="category-'+index+'"> '+value.name+'</h5><p>('+value.posts_count+')</p></label></li>';
                $('.category_area').append(html);

            });

            $.each(response.brands, function(index, value){
                if(cat == value.id){
                  var selected="checked";
                }
                else{
                  var selected=null;
                }

                var html='<li><label class="attrs" for="category-'+value.id+'"><h5><input type="checkbox" class="categories" '+selected+' value="'+value.id+'" id="category-'+value.id+'"> '+value.name+'</h5><p>('+value.posts_count+')</p></label></li>';
                $('.brand_area').append(html);

            });
            

            $.each(response.attributes, function(index, value){
               var html='<div class="product-list-bar"><h4 class="mb-3">Select by '+value.name+'</h4><ul class="product-size product-size-ul'+index+'"></ul></div>';
               $('#left_sidebar').append(html);

               $.each(value.featured_child_with_post_count_attribute, function(i, v){

                var li='<li><label  for="attribute-'+v.id+'"><h5><input class="attributes" type="checkbox" value="'+v.id+'" id="attribute-'+v.id+'"> '+v.name+'</h5><p>('+v.variations_count+')</p></label></li>';
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
     
      $.ajax({
            type: 'get',
            url: url,
            dataType: 'json',
            data:{order: order_by,categories: categories,attrs:attributes,term:src},
            beforeSend: function() {
                $('.product-card').remove();
                for (var i = 1; i < 10; i++) {
                    var img='<div class="content-placeholder product_preload"></div>';
                    var html='<div class="product-card content-placeholder"><div class="product-img"> <a href="#" class="text-dark">'+img+'</div><div class="product-content"><div class="product-name"><h3></h3></a><p></p></div><div class="product-price"><h4></h4><p></p></div><div class="product-cart"></div></div></div>';
                    $('.preload_area').append(html);
                }
            },           
            success: function(response){ 
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
                render_shop_products(response.data,'.product-parent');             
                
                product_slider();
                run_lazy();
                if(response.links.length > 3) {
                
                 render_pagination('.pagination',response.links);
               }
               else{
                $('.page-item').remove();
               }
               
            },
            error: function() 
            {
               get_data(base_url+'/get_shop_products');
            }
        })
  }



function PaginationClicked(key){
    var url =$('.page-link-no'+key).data('url');
  //  get_data(url)
}

$(document).on('click','.page-link',function() {
 var url = $(this).data('url');
   //console.log(url)
   if(url != null){
     get_data(url);
   }

});