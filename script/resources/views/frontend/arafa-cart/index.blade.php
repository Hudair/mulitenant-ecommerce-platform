@extends('frontend.arafa-cart.layouts.app')
@section('content')
<!--====== App Content ======-->
<div class="app-content">
   <!--====== Primary Slider ======-->
   <div class="s-skeleton s-skeleton--h-600 s-skeleton--bg-grey slider_area content-placeholder slider_preload">
      <div class="owl-carousel primary-style-1" id="hero-slider">       
         
      </div>
   </div>
   <!--====== End - Primary Slider ======-->
   <!--====== Section 1 ======-->
   <div class="u-s-p-y-60 featured_category_section">
      <!--====== Section Intro ======-->
      <div class="section__intro u-s-m-b-46">
         <div class="container">
            <div class="row">
               <div class="col-lg-12">
                  <div class="section__text-wrap">
                     <h1 class="section__heading u-c-secondary u-s-m-b-12">{{ __('SHOP BY DEALS') }}</h1>
                     <span class="section__span u-c-silver">{{ __('BROWSE FAVOURITE DEALS') }}</span>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!--====== End - Section Intro ======-->
      <!--====== Section Content ======-->
      <div class="section__content">
         <div class="container">
            <div class="row bump_ads">
               
              
            </div>
         </div>
      </div>
      <!--====== Section Content ======-->
   </div>
   <!--====== End - Section 1 ======-->
   <!--====== Section 2 ======-->
   <div class="u-s-p-b-60">
      <!--====== Section Intro ======-->
      <div class="section__intro u-s-m-b-16">
         <div class="container">
            <div class="row">
               <div class="col-lg-12">
                  <div class="section__text-wrap">
                     <h1 class="section__heading u-c-secondary u-s-m-b-12">{{ __('Top Trending') }}</h1>
                     <span class="section__span u-c-silver">{{ __('Choose Category') }}</span>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!--====== End - Section Intro ======-->
      <!--====== Section Content ======-->
      <div class="section__content">
         <div class="container">
            <div class="row">
               <div class="col-lg-12">
                  <div class="filter-category-container">
                     <div class="filter__category-wrapper">
                        <button class="btn filter__btn filter__btn--style-1 js-checked" type="button" data-filter="0">{{ __('ALL') }}</button>
                     </div>
                                        
                  </div>
                  <div class="u-s-m-t-30">
                     <div class="row" id="random_product">
                     </div>
                  </div>
               </div>
               <div class="col-lg-12">
                  <div class="load-more">
                     <a class="btn btn--e-brand" href="{{ url('/shop') }}" type="button">{{ __('Load More') }}</a>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!--====== End - Section Content ======-->
   </div>
   <!--====== End - Section 2 ======-->
    <!--====== Section 4 ======-->
   <div class="u-s-p-b-60 get_offerable_products ">
      <!--====== Section Intro ======-->
      <div class="section__intro u-s-m-b-46">
         <div class="container">
            <div class="row">
               <div class="col-lg-12">
                  <div class="section__text-wrap">
                     <h1 class="section__heading u-c-secondary u-s-m-b-12">{{ __('Discount Available') }}</h1>
                     <span class="section__span u-c-silver">{{ __('Grab The Best One') }}</span>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!--====== End - Section Intro ======-->
      <!--====== Section Content ======-->
      <div class="section__content">
         <div class="container">
            <div class="row"></div>
            <div class="slider-fouc">
               <div class="owl-carousel product-slider" id="get_offerable_products" data-item="4">                 


               </div>
            </div>
         </div>
      </div>
      <!--====== End - Section Content ======-->
   </div>
   <!--====== End - Section 4 ======-->
   <!--====== Section 4 ======-->
   <div class="u-s-p-b-60">
      <!--====== Section Intro ======-->
      <div class="section__intro u-s-m-b-46">
         <div class="container">
            <div class="row">
               <div class="col-lg-12">
                  <div class="section__text-wrap">
                     <h1 class="section__heading u-c-secondary u-s-m-b-12">{{ __('New Arraivals') }}</h1>
                     <span class="section__span u-c-silver">{{ __('Get Up For New Arraivals') }}</span>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!--====== End - Section Intro ======-->
      <!--====== Section Content ======-->
      <div class="section__content">
         <div class="container">
            <div class="row new_product_preload"></div>
            <div class="slider-fouc">
               <div class="owl-carousel product-slider new_product_area" data-item="4">                 


               </div>
            </div>
         </div>
      </div>
      <!--====== End - Section Content ======-->
   </div>
   <!--====== End - Section 4 ======-->
  
 

   <!--====== Section 6 ======-->
   <div class="bestseles_products_area">
      <!--====== Section Intro ======-->
      <div class="section__intro u-s-m-b-46">
         <div class="container">
            <div class="row">
               <div class="col-lg-12">
                  <div class="section__text-wrap">
                     <h1 class="section__heading u-c-secondary u-s-m-b-12">{{ __('BEST SALES ITEM') }}</h1>
                     <span class="section__span u-c-silver">{{ __('FIND BEST SALES PRODUCTS') }}</span>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!--====== End - Section Intro ======-->
      <!--====== Section Content ======-->
      <div class="section__content">
         <div class="container">
            <div class="row new_product_preload"></div>
            <div class="slider-fouc">
               <div class="owl-carousel product-slider bestseles_products" data-item="4">                 


               </div>
            </div>
         </div>
      </div>
      <!--====== End - Section Content ======-->
   </div>
   <!--====== End - Section 6 ======-->
   <!--====== Section 7 ======-->
   <div class="u-s-p-b-60">
      <!--====== Section Content ======-->
      <div class="section__content">
         <div class="container">
            <div class="add-part  banner_ads content-placeholder slider_preload">              
               
            </div>
         </div>
      </div>
      <!--====== End - Section Content ======-->
   </div>
   <!--====== End - Section 7 ======-->
  
  
   <!--====== End - Section 11 ======-->
   <!--====== Section 12 ======-->
   <div class="u-s-p-b-60 brand_area">
      <!--====== Section Content ======-->
      <div class="section__content">
         <div class="container">
            <!--====== Brand Slider ======-->
            <div class="slider-fouc">
               <div class="owl-carousel" id="brand-slider" data-item="5">                 
                 
               </div>
            </div>
            <!--====== End - Brand Slider ======-->
         </div>
      </div>
      <!--====== End - Section Content ======-->
   </div>
   <!--====== End - Section 12 ======-->
</div>
<!--====== End - App Content ======-->
@endsection
@push('js')
<script src="{{ asset('frontend/arafa-cart/js/index.js') }}"></script>
@endpush
