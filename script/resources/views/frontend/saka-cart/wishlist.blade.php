@extends('frontend.saka-cart.layouts.app')
@section('content')
<!--====== App Content ======-->
<div class="app-content">
   <!--====== Section 1 ======-->
   <div class="u-s-p-y-60">
      <!--====== Section Content ======-->
      <div class="section__content">
         <div class="container">
            <div class="breadcrumb">
               <div class="breadcrumb__wrap">
                  <ul class="breadcrumb__list">
                     <li class="has-separator">
                        <a href="{{ url('/') }}">{{ __('Home') }}</a>
                     </li>
                     <li class="is-marked">
                        <a >{{ __('Wishlist') }}</a>
                     </li>
                  </ul>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!--====== End - Section 1 ======-->
   <!--====== Section 2 ======-->
   <div class="u-s-p-b-60">
      <!--====== Section Intro ======-->
      <div class="section__intro u-s-m-b-60">
         <div class="container">
            <div class="row">
               <div class="col-lg-12">
                  <div class="section__text-wrap">
                     <h1 class="section__heading u-c-secondary">{{ __('Wishlist') }}</h1>
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
               <div class="col-lg-12 col-md-12 col-sm-12">
                  @foreach(Cart::instance('wishlist')->content() as $row)  
                  <!--====== Wishlist Product ======-->
                  <div class="w-r u-s-m-b-30">
                     <div class="w-r__container">
                        <div class="w-r__wrap-1">
                           <div class="w-r__img-wrap">
                              <img class="u-img-fluid" src="{{ $row->options->preview }}" alt="">
                           </div>
                           <div class="w-r__info">
                              <span class="w-r__name">
                              <a href="{{ url('/product/'.$row->name.'/'.$row->id) }}">{{ Str::limit($row->name,70) }} </a>
                              </span>
                              <span class="w-r__category">
                              <a href="{{ url('/product/'.$row->name.'/'.$row->id) }}"> @foreach ($row->options->attribute as $attribute)

                                       <p><b>{{ $attribute->attribute->name }}</b> : {{ $attribute->variation->name }}</p>
                                       @endforeach
                                       @foreach ($row->options->options as $op)
                                       <small>{{ $op->name }}</small>,
                                       @endforeach</a>
                              </span>
                              <span class="w-r__price"> {{ amount_format($row->price) }}
                              
                              </span>
                           </div>
                        </div>
                        <div class="w-r__wrap-2">
                           <a class="w-r__link btn--e-brand-b-2" href="{{ url('/product/'.$row->name.'/'.$row->id) }}">{{ __('ADD TO CART') }}</a>
                           <a class="w-r__link btn--e-transparent-platinum-b-2" href="{{ url('/product/'.$row->name.'/'.$row->id) }}">{{ __('VIEW') }}</a>
                           <a class="w-r__link btn--e-transparent-platinum-b-2" href="{{ url('/wishlist/remove',$row->rowId) }}">{{ __('REMOVE') }}</a>
                        </div>
                     </div>
                  </div>
                  <!--====== End - Wishlist Product ======-->
                @endforeach
               </div>
               <div class="col-lg-12">
                  <div class="route-box">
                     <div class="route-box__g">
                        <a class="route-box__link" href="{{ url('/shop') }}">
                        <i class="fas fa-long-arrow-alt-left"></i>
                        <span>{{ __('Continue Shopping') }}</span>
                        </a>
                     </div>
                     <div class="route-box__g">
                        <a class="route-box__link" href="{{ url('/') }}">
                        <i class="fas fa-home"></i>
                        <span>{{ __('Go Home') }}</span>
                        </a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!--====== End - Section Content ======-->
   </div>
   <!--====== End - Section 2 ======-->
</div>
<!--====== End - App Content ======-->
@endsection