"use strict";
// FOR BANNER IMAGE SLIDER

function banner_slider(){
  $('.banner-slider').slick({
    dots: true,
    infinite: true,
    autoplay: true,
    arrows: true,
    speed: 1000,
    prevArrow: '<i class="fas fa-long-arrow-alt-right dandik"></i>',
    nextArrow: '<i class="fas fa-long-arrow-alt-left bamdik"></i>',
    slidesToShow: 1,
    slidesToScroll: 1,
    responsive: [
    {
      breakpoint: 1199,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
      }
    },
    {
      breakpoint: 991,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
      }
    },
    {
      breakpoint: 767,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
      }
    },
    {
      breakpoint: 576,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
      }
    }
    ]
  });

}

  // FOR OFFER IMAGE SLIDER
function offer_sliders(){
   $('.offer-slider').slick({
    dots: false,
    infinite: true,
    autoplay: false,
    arrows: true,
    speed: 1000,
    prevArrow: '<i class="fas fa-long-arrow-alt-right dandik"></i>',
    nextArrow: '<i class="fas fa-long-arrow-alt-left bamdik"></i>',
    slidesToShow: 3,
    slidesToScroll: 1,
    responsive: [
    {
      breakpoint: 1199,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1,
      }
    },
    {
      breakpoint: 991,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1,
      }
    },
    {
      breakpoint: 767,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1,
      }
    },
    {
      breakpoint: 576,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
      }
    }
    ]
  });

 }

 function product_slider() {
      // FOR PRODUCT CARD SLIDER
      $('.product-slider').slick({
        dots: false,
        infinite: true,
        autoplay: false,
        arrows: true,
        speed: 1000,
        prevArrow: '<i class="fas fa-long-arrow-alt-right dandik"></i>',
        nextArrow: '<i class="fas fa-long-arrow-alt-left bamdik"></i>',
        slidesToShow: 4,
        slidesToScroll: 4,
        responsive: [
        {
          breakpoint: 1199,
          settings: {
            slidesToShow: 4,
            slidesToScroll: 4,
          }
        },
        {
          breakpoint: 991,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 3,
          }
        },
        {
          breakpoint: 767,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 2,
          }
        },
        {
          breakpoint: 576,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 2,
            arrows: false,
          }
        }
        ]
      });
    }


// FOR SINGLE PRODUCT SLIDER
$('.single-product-slider').slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  arrows: true,
  fade: true,
  asNavFor: '.single-thumb-slider',
  prevArrow: '<i class="fas fa-long-arrow-alt-right dandik"></i>',
  nextArrow: '<i class="fas fa-long-arrow-alt-left bamdik"></i>',
  responsive: [
  {
    breakpoint: 576,
    settings: {
      slidesToShow: 1,
      slidesToScroll: 1,
      arrows: false,
    }
  }
  ]
});

$('.single-thumb-slider').slick({
  slidesToShow: 4,
  slidesToScroll: 1,
  asNavFor: '.single-product-slider',
  dots: false,
  arrows: false,
  centerMode: true,
  focusOnSelect: true,
  responsive: [
  {
    breakpoint: 991,
    settings: {
      slidesToShow: 2,
      slidesToScroll: 1,
      arrows: false,
    }
  },
  {
    breakpoint: 767,
    settings: {
      slidesToShow: 3,
      slidesToScroll: 1,
      arrows: false,
    }
  },
  {
    breakpoint: 576,
    settings: {
      slidesToShow: 3,
      slidesToScroll: 1,
      arrows: false,
    }
  },
  {
    breakpoint: 400,
    settings: {
      slidesToShow: 2,
      slidesToScroll: 1,
      arrows: false,
    }
  }
  ]
});

