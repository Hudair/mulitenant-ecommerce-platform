@extends('frontend.bigbag.layouts.app')
@section('content')

 <!--=====================================
                    BANNER PART START
        =======================================-->
        <section class="banner-part">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-lg-3">
                        <div class="banner-cate active">
                            <div class="cate-heading">
                                <i class="fas fa-bars"></i>
                                <h4>{{ __('Top Categories') }}</h4>
                            </div>
                            <ul class="cate-scroll">
                             
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-8 col-lg-9 content-placeholder slider_preload">
                       
                        <div class="banner-slider">
                                                   
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--=====================================
                    BANNER PART END
        =======================================-->


        <!--=====================================
                    OFFER PART START
        =======================================-->
        <div class="offer-part">
            <div class="container">
                <div class="row">
                    <div class="col-sm-4 content-placeholder ads_preload"></div>
                    <div class="col-sm-4 content-placeholder ads_preload"></div>
                    <div class="col-sm-4 content-placeholder ads_preload"></div>
                </div>
                <div class="offer-slider">
                    
                </div>
            </div>
        </div>
        <!--=====================================
                    OFFER PART END
        =======================================-->


        <!--=====================================
                    TRENDING PART START
        =======================================-->
        <section class="trend-part">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-heading">
                            <h2>{{ __('Trending products') }}</h2>
                            <a href="{{ url('/shop') }}" class="btn btn-outline"><i class="fas fa-eye"></i> {{ __('view all') }}</a>
                        </div>
                    </div>
                </div>
                <div class="row">
                   
                    <div class="col-lg-12">

                        <div class="product-slider" id="trending_product_area">
                            
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--=====================================
                    TRENDING PART END
        =======================================-->


        <!--=====================================
                    BEST SELL PART START
        =======================================-->
        <section class="new-part get_offerable_products">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-heading">
                            <h2>{{ __('Avaible Offer') }}</h2>
                            <a href="{{ url('/shop') }}" class="btn btn-outline"><i class="fas fa-eye"></i> {{ __('view all') }}</a>
                        </div>
                    </div>
                </div>
                <div class="row">
                  
                    <div class="col-lg-12">
                        <div class="product-slider" id="get_offerable_products">
                            
                           
                        </div>
                    </div>
                </div>
            </div>
        </section>
       <section class="best-part">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-heading">
                            <h2>{{ __('Best selling products') }}</h2>
                            <a href="{{ url('/shop') }}" class="btn btn-outline"><i class="fas fa-eye"></i> {{ __('view all') }}</a>
                        </div>
                    </div>
                </div>
                <div class="row">
                  
                    <div class="col-lg-12">
                        <div class="product-slider" id="bast_selling_product_area">
                            
                           
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!--=====================================
                    BEST SELL PART END
        =======================================-->


        <!--=====================================
                    NEW PART START
        =======================================-->
        <section class="new-part">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-heading">
                            <h2>{{ __('New arrival products') }}</h2>
                            <a href="{{ url('/shop') }}" class="btn btn-outline"><i class="fas fa-eye"></i> {{ __('view all') }}</a>
                        </div>
                    </div>
                </div>
                <div class="row">
                   
                    <div class="col-lg-12">
                        <div class="product-slider" id="latest_product_area">                           
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--=====================================
                      NEW PART END
        =======================================-->



<!--=====================================
        ADD PART START
=======================================-->
<div class="add-part">
     <div class="container banner_ad">
        
      </div>
</div>
<!--=====================================
        ADD PART END
=======================================-->


@endsection
@push('js')
<script src="{{ asset('frontend/bigbag/js/index.js')}}"></script>
@endpush