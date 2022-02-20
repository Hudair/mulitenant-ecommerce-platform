@extends('frontend.bazar.layouts.app')
@section('content')
  <!--====== App Content ======-->
  <div class="app-content">

    <!--====== Section 1 ======-->
    <div class="u-s-p-y-90">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-12">
                    <div class="shop-w-master">
                        <h1 class="shop-w-master__heading u-s-m-b-30"><i class="fas fa-filter u-s-m-r-8"></i>

                            <span>{{ __('FILTERS') }}</span></h1>
                        <div class="shop-w-master__sidebar sidebar--bg-snow" id="left_sidebar">
                            <div class="u-s-m-b-30">
                                <div class="shop-w">
                                    <div class="shop-w__intro-wrap">
                                        <h1 class="shop-w__h">{{ __('CATEGORY') }}</h1>

                                        <span class="fas fa-minus shop-w__toggle" data-target="#s-category1" data-toggle="collapse"></span>
                                    </div>
                                    <div class="shop-w__wrap collapse show" id="s-category1">
                                        <ul class="shop-w__category-list gl-scroll category_area">
                                           
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
                            </div>
                            <div class="u-s-m-b-30">
                                <div class="shop-w">
                                    <div class="shop-w__intro-wrap">
                                        <h1 class="shop-w__h">{{ __('BRAND') }}</h1>

                                        <span class="fas fa-minus shop-w__toggle" data-target="#s-category" data-toggle="collapse"></span>
                                    </div>
                                    <div class="shop-w__wrap collapse show" id="s-category">
                                        <ul class="shop-w__category-list gl-scroll brand_area">
                                           
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
                            </div>
                           
                           
                            <div class="u-s-m-b-30">
                                <div class="shop-w">
                                    <div class="shop-w__intro-wrap">
                                        <h1 class="shop-w__h">{{ __('PRICE') }}</h1>

                                        <span class="fas fa-minus shop-w__toggle" data-target="#s-price" data-toggle="collapse"></span>
                                    </div>
                                    <div class="shop-w__wrap collapse show" id="s-price">
                                     
                                            <div class="shop-w__form-p-wrap">
                                                <div>

                                                    <label for="price-min"></label>

                                                    <input class="input-text input-text--primary-style" type="text" id="price-min" placeholder="Min"></div>
                                                <div>

                                                    <label for="price-max"></label>

                                                    <input class="input-text input-text--primary-style" type="text" id="price-max" placeholder="Max"></div>
                                                <div>

                                                <button class="btn btn--icon fas fa-angle-right btn--e-transparent-platinum-b-2 filter_btn" type="button"></button></div>
                                            </div>
                                        
                                    </div>
                                </div>
                            </div>
                         
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-12">
                    <div class="shop-p">
                        <div class="shop-p__toolbar u-s-m-b-30">
                            
                            <div class="shop-p__tool-style">
                                <div class="u-s-m-b-8">
                                    <p>{{ __('Showing') }} <span id="from">0</span>–<span id="to">0</span> of <span id="total">0</span> {{ __('results') }}</p>                                 
                                </div>
                                <form>
                                    <div class="tool-style__form-wrap">
                                        <div class="u-s-m-b-8">
                                            <select class="select-box select-box--transparent-b-2" id="limit">
                                                <option value="9">{{ __('Show') }}: 9</option>
                                                <option value="12">{{ __('Show') }}: 12</option>
                                                <option value="16">{{ __('Show') }}: 16</option>
                                                <option value="16">{{ __('Show') }}: 28</option>
                                            </select></div>
                                        <div class="u-s-m-b-8"><select class="select-box select-box--transparent-b-2 order_by">
                                            <option value="DESC">{{ __('Short by new item') }}</option>
                                            <option value="ASC">{{ __('Short by old item') }}</option>
                                            <option value="bast_sell">{{ __('Short by best selling') }}</option>
                                            </select></div>
                                    </div>
                                </form>
                            </div>
                        </div>
                       
                        <div class="shop-p__collection">
                           
                            <div class="row product_area product_preload_area">                               
                            </div>
                        </div>
                        <div class="u-s-p-y-60">

                            <!--====== Pagination ======-->
                            <ul class="shop-p__pagination pagination">
                                
                            </ul>
                            <!--====== End - Pagination ======-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--====== End - Section 1 ======-->
</div>
<!--====== End - App Content ======-->

<input type="hidden" id="category" value="{{ $info->id ?? null }}">   
@endsection
@push('js')
<script src="{{ asset('frontend/bazar/js/shop.js') }}"></script>  
@endpush