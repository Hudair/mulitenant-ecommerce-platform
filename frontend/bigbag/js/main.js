(function ($) {
  "use strict";

// FOR NAVBAR FIXED WHEN SCROLL
$(window).on("scroll", function(){
  var scrolling = $(this).scrollTop();
  if (scrolling > 300){
    $(".navbar-part").addClass("navbar-fixed");
  }else{
    $(".navbar-part").removeClass("navbar-fixed");
  }
});

var theme_color=$('#theme_color').val(); 
//for scroll effect 
$(".cate-scroll").niceScroll({
  cursorcolor: theme_color,
  cursorborder: "none",
});


// FOR RIGHT SIDEBAR SHOW & HIDE
$(".cart-icon").on("click", function(){
  $(".right-sidebar").addClass("active");
  $(".right-cross").on('click', function(){
    $(".right-sidebar").removeClass("active");
  });
});


// FOR LEFT SIDEBAR SHOW & HIDE
$(".left-bar, .left-src").on("click", function(){
  $(".left-sidebar").addClass("active");
  $(".left-cross").on('click', function(){
    $(".left-sidebar").removeClass("active");
  });
});


// FOR NAVBAR ACTIVE MENU
$(".banner-cate").on("click", function(){
  $(".banner-cate").toggleClass("active");
});


// FOR GRID SYSTEM PRODUCT CARD
$('.grid-hori').on('click', function(){
  $('.product-card').addClass('product-list-card');
  $('.grid-hori').addClass('active');
  $('.grid-verti').removeClass('active');
  $('.grid-verti').on('click', function(){
    $('.product-card').removeClass('product-list-card');
    $('.grid-verti').addClass('active');
    $('.grid-hori').removeClass('active');
  });
});




//for attribute change
$('.radio-attribute').on('change', function () {

  var id = $(this).val();
  var data_price = $(this).data('price');
  var data_stockqty = $(this).data('stockqty');
  var data_stockmanage = $(this).data('stockmanage');
  var data_stockstatus = $(this).data('stockstatus');
  var data_sku = $(this).data('sku');
  $('.single-product-price').html('<h3>'+data_price+'</h3>');
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

function Sweet(icon,title,time=3000){
  
  const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: time,
    timerProgressBar: true,
    onOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
  })

  
  Toast.fire({
    icon: icon,
    title: title,
  })
}
