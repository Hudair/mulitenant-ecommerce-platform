@extends('frontend.bigbag.layouts.app')
@section('content')   

<!--=====================================
         SINGLE BANNER PART START
=======================================-->
<section class="single-banner">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="single-content">
                            <h2>{{ $info->title }}</h2>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ __('Home') }}</a></li>
                                <li class="breadcrumb-item"><a href="{{ url('/shop') }}">{{ __('Product') }}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $info->title }}</li>
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
         SINGLE PRODUCT PART START
=======================================-->
<section class="single-product">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-lg-6">
                        <div class="single-product-slider">
                            @foreach($info->medias as $row)
                            <img src="{{ asset($row->url) }}" alt="">
                            @endforeach
                             @if(count($info->medias) == 0)
                            <img src="{{ asset('uploads/default.png') }}" alt="">
                            @endif
                        </div>
                        @if(count($info->medias) > 1)
                        <div class="single-thumb-slider">
                            @foreach($info->medias as $row)
                            <img src="{{ asset($row->url) }}" alt="">
                            @endforeach
                            @if(count($info->medias) == 0)
                            <img src="{{ asset('uploads/default.png') }}" alt="">
                            @endif
                        </div>
                        @endif
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <div class="single-product-info">
                            <div class="single-product-meta">
                                <div class="single-product-name">
                                    <h3>{{ $info->title }}</h3>
                                    @if($info->stock->stock_manage == 1)
                                    <p>{{ __('SKU') }}: <span id="sku_area">{{ $info->stock->sku }}</span></p>
                                    @endif
                                </div>
                                <ul class="single-page-slider round-icon">
                                   
                                    @if($previous)
                                    <li><a href="{{ url('/product/'.$previous->slug.'/'.$previous->id) }}"><i class="fas fa-long-arrow-alt-left"></i></a></li>
                                    @endif

                                     @if($next)
                                    <li><a href="{{ url('/product/'.$next->slug.'/'.$next->id) }}"><i class="fas fa-long-arrow-alt-right"></i></a></li>
                                    @endif
                                </ul>
                            </div>
                            <div class="single-product-meta">
                                <ul class="single-product-review">
                                    
                                </ul>
                                <div class="single-product-price">
                                    @if($info->price->starting_date != null)
                                   
                                    <h3><del>{{ amount_format($info->price->regular_price) }}</del> <span id="amount">{{ amount_format($info->price->price) }}</span></h3>
                                    @else
                                    <h3 id="amount">{{ amount_format($info->price->price) }}</h3>
                                    @endif
                                </div>
                                <input type="hidden" id="main_amount" value="{{ $info->price->price }}">
                            </div>
                            <div class="single-product-describe">
                               {{ content($content->excerpt ?? '') }}
                            </div>
                             <form method="post" class="cart-form" action="{{ url('/addtocart') }}">
                                 @csrf
                             <input type="hidden" name="id" value="{{ $info->id }}">
                            <div class="single-product-widget product-quantity">
                                @if(empty($info->affiliate))
                                <h5>{{ __('Product Quantity') }} :</h5>
                                @endif
                                <ul>
                                    @if(empty($info->affiliate))
                                    <li><input type="number" name="qty"  id="qty"  @if($info->stock->stock_manage == 1) @if($info->stock->stock_status == 0) disabled max="0" min="0" @else max="{{ $info->stock->stock_qty }}" min="1"  value="1" @endif @else min="1" max="999" value="1"  @endif></li>
                                    @endif
                                    
                                    <li>
                                        @if(empty($info->affiliate))
                                        <button type="submit"  class="btn btn-outline submit_btn"  @if($info->stock->stock_status == 0) disabled @endif>
                                            <i class="fas fa-shopping-basket"></i>
                                            <span class="submit_text"> @if($info->stock->stock_status == 0) {{ __('Out Of Stock') }} @else {{ __('Add to Cart') }} @endif</span>
                                        </button>
                                        @else
                                         <a href="{{ url($info->affiliate->value ?? '') }}" target="_blank"  class="btn btn-outline"  @if($info->stock->stock_status == 0) disabled @endif>
                                            <i class="fas fa-shopping-basket"></i>
                                            <span class="submit_text"> @if($info->stock->stock_status == 0) {{ __('Out Of Stock') }} @else {{ __('Purchase Now') }} @endif</span>
                                        </a>
                                        @endif
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)" data-id="{{ $info->id }}" class="wishlist-icon" id="wishlist">
                                            <i class="fas fa-heart heart"></i>
                                        </a>
                                    </li>
                                </ul>
                                <span class="available_qty @if($info->stock->stock_manage == 0 || $info->stock->stock_status == 0) none  @endif">{{ __('Available Quantity') }} : <span id="qty_area">@if($info->stock->stock_manage == 1) {{ $info->stock->stock_qty }} @endif</span></span>
                                <p class="text-danger none required_option">{{ __('Please Select A Option From Required Field') }}</p>
                            </div>
                           @foreach ($variations as $key => $item)
                           <div class="single-product-widget product-tags">
                            <h5>{{ $key }} :</h5>
                            <ul>
                                @foreach ($item as $row)
                                <li><label class="attribute attr{{ $row->variation->id }}">{{ $row->variation->name }} <input type="radio" class="variation" hidden value="{{ $row->variation->id }}" name="variation[{{ $row->attribute->id }}]"></label></li>
                                @endforeach                              
                            </ul>
                           </div>  
                           @endforeach
                            
                           @if(count($info->options) > 0)
                           <hr>
                           @endif
                           @foreach ($info->options as $key => $option)
                            
                            <div class="single-product-widget product-tags">
                                <h5>{{ $option->name }} @if($option->is_required == 1) <span class="text-danger">*</span> @endif </h5>
                                <ul>
                                    @foreach ($option->childrenCategories as $row)
                                  
                                    <li><label class="selectgroup-item option option{{ $row->id }}">
                                        <input hidden  data-amount="{{ $row->amount }}" data-amounttype="{{ $row->amount_type }}"  @if($option->select_type == 1) type="checkbox" name="option[]" @else type="radio" name="option[{{ $key }}]" @endif  value="{{ $row->id }}" class="selectgroup-input options @if($option->is_required == 1) req @endif" >
                                        <span class="selectgroup-button">{{ $row->name }}</span>
                                        </label></li>
                                    @endforeach
                                </ul>
                            </div>   
                            @endforeach
                            </form>
                           <hr>
                           @if(count($info->categories) > 0)
                            <div class="single-product-widget">
                                <h5>{{ __('Category') }} :</h5>
                                <ul>
                                    @foreach($info->categories as $row)
                                    <li><a class="text-dark" href="{{ url('/category/'.$row->slug.'/'.$row->id) }}">{{ $row->name }}</a>,</li>
                                    <input type="hidden" class="cat_id" value="{{ $row->id}}">
                                    @endforeach
                                
                                </ul>

                            </div>
                            @endif
                            @if(count($info->brands) > 0)
                            <div class="single-product-widget product-tags">
                                <h5>{{ __('Brand') }} :</h5>
                                <ul>
                                    @foreach($info->brands as $row)
                                    <li><a href="{{ url('/brand/'.$row->slug.'/'.$row->id) }}">{{ $row->name }}</a></li>
                                    <input type="hidden" class="cat_id" value="{{ $row->id}}">
                                    @endforeach
                                
                                </ul>

                            </div>
                             @endif
                            <div class="single-product-widget product-share">
                                <h5>{{ __('Share this product') }}</h5>
                                <ul class="round-icon footer-icon">
                                    <li><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ url()->full() }}"><i class="fab fa-facebook-f"></i></a></li>
                                    <li><a target="_blank" href="https://twitter.com/intent/tweet?url={{ url()->full() }}"><i class="fab fa-twitter"></i></a></li>
                                    <li><a target="_blank" href="https://www.linkedin.com/sharing/share-offsite/?url={{ url()->full() }}"><i class="fab fa-linkedin-in"></i></a></li>
                                    
                                    <li><a target="_blank" href="http://pinterest.com/pin/create/link/?url={{ url()->full() }}"><i class="fab fa-pinterest-p"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</section>
<!--=====================================
         SINGLE PRODUCT PART END
=======================================-->


<!--=====================================
          PRODUCT DETAILS START
=======================================-->
<section class="details-part">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="details-menu">
                            <ul class="nav nav-tabs">
                                <li><a href="#descrip" class="nav-link active" data-toggle="tab">{{ ('Description') }}</a></li>
                                <li><a href="#review" class="nav-link" data-toggle="tab">{{ __('Review') }} <span id="review_count"></span></a></li>
                               
                               
                            </ul>
                        </div>
                        <div class="tab-pane active" id="descrip">
                            <div class="details-descrip">
                               {{ content($content->content ?? '') }}
                            </div>
                        </div>
                       
                        <div class="tab-pane" id="review">
                            <div class="details-review">
                                <ul class="review-list">
                                   
                                </ul>
                                <ul class="pagination pagi-ghape">
                                    
                                </ul>
                                <form class="review-form" method="post" action="{{ url('/make-review',$info->id) }}">
                                    @csrf
                                    <h3>{{ __('Leave Your Review') }}</h3>
                                    <div class="grid-input">
                                        <input type="text" value="{{ Auth::guard('customer')->user()->name ?? '' }}" name="name" placeholder="Your name" required readonly>
                                        <input type="email" name="email" placeholder="Your email" required readonly value="{{ Auth::guard('customer')->user()->email ?? '' }}">
                                    </div>
                                    <div class="row-input">
                                        <textarea placeholder="Your quote" name="comment" maxlength="200"></textarea>
                                    </div>
                                    <div class="star-rating">
                                        <input type="checkbox" value="5" name="rating" id="star1"><label for="star1"></label>
                                        <input type="checkbox" value="4" name="rating" id="star2"><label for="star2"></label>
                                        <input type="checkbox" value="3" name="rating" id="star3"><label for="star3"></label>
                                        <input type="checkbox" value="2" name="rating" id="star4"><label for="star4"></label>
                                        <input type="checkbox" value="1" name="rating" id="star5"><label for="star5"></label>
                                    </div>
                                    @if(Auth::guard('customer')->check())
                                    <button type="submit" class="btn btn-outline review_btn">
                                        <i class="fas fa-paper-plane"></i>
                                       {{ __('Send Review') }}
                                    </button>
                                    @else
                                    <a href="{{ url('/user/login') }}" class="btn btn-outline review_btn">
                                       <i class="fas fa-sign-in-alt"></i>
                                       {{ __('Please Login') }}
                                    </a>
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</section>
<!--=====================================
          PRODUCT DETAILS END
=======================================-->


<!--=====================================
            RELATED PART START
=======================================-->
<section class="related-part">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-heading">
                            <h2>{{ __('Related products') }}</h2>
                            <a href="{{ url('/shop') }}" class="btn btn-outline"><i class="fas fa-eye"></i> {{ __('view all') }}</a>
                        </div>
                    </div>
                </div>
                <div class="row related_product_area">
                  
                    <div class="col-lg-12">
                        <div class="product-slider" id="related_product_area">
                           
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
<input type="hidden" id="max_qty"  @if($info->stock->stock_manage == 1) value="{{ $info->stock->stock_qty }}" @else value="999" @endif>
<input type="hidden" id="term" value="{{ $info->id }}">
@endsection   
@push('js')
<script src="{{ asset('frontend/bigbag/js/product/details.js')}}"></script>
@endpush   



       





