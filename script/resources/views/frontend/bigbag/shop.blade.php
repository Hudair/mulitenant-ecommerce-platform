@extends('frontend.bigbag.layouts.app')
@push('css')
<link rel="stylesheet" href="{{ asset('frontend/bigbag/css/jquery-ui.css')}}">
@endpush  
@section('content')    
<!--=====================================
         SINGLE BANNER PART START
=======================================-->
<section class="single-banner">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="single-content">
                            <h2>{{ $info->name ?? __('Product List') }}</h2>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ __('Home') }}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $info->name ?? __('Products') }}</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
</section>
<!--=====================================
         SINGLE BANNER PART END
=======================================-->


<!--=====================================
         PRODUCT LIST PART START
=======================================-->
<section class="product-list">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3" id="left_sidebar">
                     

                        <div class="product-list-bar cat">
                           <div class="product-list-bar"><h4 class="mb-3">{{ __('Filter by Category') }}</h4><ul class="product-size category_area">
                            <li class="cat-item cat-item"><p><span class="content-placeholder h-20">&nbsp;</span></p></li>
                            <li class="cat-item cat-item"><p><span class="content-placeholder h-20">&nbsp;</span></p></li>
                            <li class="cat-item cat-item"><p><span class="content-placeholder h-20">&nbsp;</span></p></li>
                            <li class="cat-item cat-item"><p><span class="content-placeholder h-20">&nbsp;</span></p></li>
                            <li class="cat-item cat-item"><p><span class="content-placeholder h-20">&nbsp;</span></p></li>
                            <li class="cat-item cat-item"><p><span class="content-placeholder h-20">&nbsp;</span></p></li>
                            <li class="cat-item cat-item"><p><span class="content-placeholder h-20">&nbsp;</span></p></li>
                            </ul>
                        </div>

                        </div>
                         
                        <div class="product-list-bar bran">
                         <div class="product-list-bar"><h4 class="mb-3">{{ __('Filter by Brand') }}</h4><ul class="product-size brand_area">
                            <li class="cat-item cat-item"><p><span class="content-placeholder h-20">&nbsp;</span></p></li>
                            <li class="cat-item cat-item"><p><span class="content-placeholder h-20">&nbsp;</span></p></li>
                            <li class="cat-item cat-item"><p><span class="content-placeholder h-20">&nbsp;</span></p></li>
                            <li class="cat-item cat-item"><p><span class="content-placeholder h-20">&nbsp;</span></p></li>
                            <li class="cat-item cat-item"><p><span class="content-placeholder h-20">&nbsp;</span></p></li>
                            <li class="cat-item cat-item"><p><span class="content-placeholder h-20">&nbsp;</span></p></li>
                            <li class="cat-item cat-item"><p><span class="content-placeholder h-20">&nbsp;</span></p></li>
                         </ul></div>
                        </div> 
                    </div>
                    <div class="col-lg-9">
                        <div class="product-filter">
                            <div class="product-page-number">
                                <p>{{ __('Showing') }} <span id="from">0</span>–<span id="to">0</span> of <span id="total">0</span> {{ __('results') }}</p>
                            </div>
                            <select class="custom-select order_by" name="order">
                                <option value="DESC">{{ __('Short by new item') }}</option>
                                <option value="ASC">{{ __('Short by old item') }}</option>
                                <option value="bast_sell">{{ __('Short by best selling') }}</option>
                                
                            </select>
                            
                        </div>
                        <div class="preload_area"></div>
                        <div class="product-parent">
                        </div>
                        <ul class="pagination pagi-ghape">
                        </ul>
                    </div>
                </div>
        </div>
</section>
<!--=====================================
         PRODUCT LIST PART END
=======================================-->


<input type="hidden" id="category" value="{{ $info->id ?? null }}">       
    
@endsection      
@push('js')
<script src="{{ asset('frontend/bigbag/js/jquery-ui.js')}}"></script>
<script src="{{ asset('frontend/bigbag/js/shop.js')}}"></script>

@endpush





