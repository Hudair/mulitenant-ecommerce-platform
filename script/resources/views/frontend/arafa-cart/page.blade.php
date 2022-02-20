@extends('frontend.arafa-cart.layouts.app')
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
                        <a >{{ $info->slug }}</a>
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
      <!--====== Section Content ======-->
      <div class="section__content">
         <div class="container">
            <div class="row">
               <div class="col-lg-12">
               	{{ content($info->content->value ?? '') }}
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection