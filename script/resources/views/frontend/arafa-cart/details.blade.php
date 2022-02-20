@extends('frontend.arafa-cart.layouts.app')
@push('css')
<link rel="stylesheet" href="{{ asset('frontend/arafa-cart/css/slick.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/arafa-cart/css/lightgallery.css') }}">
@endpush
@section('content')
  <div class="app-content">

            <!--====== Section 1 ======-->
            <div class="u-s-p-t-90">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-5">

                            <!--====== Product Breadcrumb ======-->
                            <div class="pd-breadcrumb u-s-m-b-30">
                                <ul class="pd-breadcrumb__list">
                                    <li class="has-separator">

                                        <a href="{{ url('/') }}">{{ __('Home') }}</a></li>
                                    <li class="has-separator">

                                       <a href="{{ url('/shop') }}">{{ __('Product') }}</a></li>
                                    
                                    <li class="is-marked">

                                        <a>{{ Str::limit($info->title,50) }}</a></li>
                                </ul>
                            </div>
                            <!--====== End - Product Breadcrumb ======-->


                            <!--====== Product Detail Zoom ======-->
                            <div class="pd u-s-m-b-30">
                                <div class="slider-fouc pd-wrap">
                                    <div id="pd-o-initiate">
                                    	 @foreach($info->medias as $row)
                                        <div class="pd-o-img-wrap" data-src="{{ asset($row->url) }}">
                                            <img class="u-img-fluid" src="{{ asset($row->url) }}" data-zoom-image="{{ asset($row->url) }}" alt="">
                                        </div>
                                        @endforeach
                                        @if(count($info->medias) == 0)
                                        <div class="pd-o-img-wrap" data-src="{{ asset('uploads/default.png') }}">
                                            <img class="u-img-fluid" src="{{ asset('uploads/default.png') }}" data-zoom-image="{{ asset('uploads/default.png') }}" alt="">
                                        </div>
                                        @endif
                                        
                                    </div>

                                    <span class="pd-text">{{ __('Click for larger zoom') }}</span>
                                </div>
                                <div class="u-s-m-t-15">
                                    <div class="slider-fouc">
                                        <div id="pd-o-thumbnail">
                                        	 @foreach($info->medias as $row)
                                            <div>
                                                <img class="u-img-fluid" src="{{ asset($row->url) }}" alt="">
                                            </div>
                                            @endforeach
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--====== End - Product Detail Zoom ======-->
                        </div>
                        <div class="col-lg-7">

                            <!--====== Product Right Side Details ======-->
                            <div class="pd-detail">
                                <div>

                                    <span class="pd-detail__name">{{ $info->title }}</span>
                                </div>
                                <div>
                                  <div class="pd-detail__inline">
                                    @if($info->price->starting_date != null)
                                    <span id="amount" class="pd-detail__price">{{ amount_format($info->price->price) }}</span>

                                    <del class="pd-detail__del">{{ amount_format($info->price->regular_price) }}</del></div>

                                    @else
                                    <span class="pd-detail__price" id="amount">{{ amount_format($info->price->price) }}</span>
                                    @endif
                                     <input type="hidden" id="main_amount" value="{{ $info->price->price }}">
                                  </div>
                                   <div class="u-s-m-b-15">
                                    <div class="pd-detail__rating gl-rating-style avg_review_area">
                                </div>
                                <div class="pd-detail__rating gl-rating-style">
                                      

                                        <span class="pd-detail__review u-s-m-l-4">

                                        <a data-click-scroll="#view-review"><span class="review_count"></span></a></span></div>
                                </div>
                                 @if($info->stock->stock_manage == 1 && $info->stock->stock_status == 1)
                                <div>
                                    <div class="pd-detail__inline">
                                    	<span class="pd-detail__stock"><b>{{ $info->stock->stock_qty }}</b> {{ __('in stock') }}</span>
                                     
                                    </div>
                                </div>
                                @endif
                               
                                
                                <div class="u-s-m-b-15">

                                    <span class="pd-detail__preview-desc">{{ Str::limit($content->excerpt ?? '',300) }}</span></div>
                                <div class="u-s-m-b-15">
                                    <div class="pd-detail__inline">

                                        <span class="pd-detail__click-wrap"><i class="far fa-heart u-s-m-r-6 heart"></i>

                                            <a href="javascript:void(0)" data-id="{{ $info->id }}" id="wishlist">{{ __('Add to Wishlist') }}</a>

                                           </span></div>
                                </div>
                               
                                <div class="u-s-m-b-15">
                                    <ul class="pd-social-list">
                                        <li>

                                            <a class="s-fb--color-hover" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ url()->full() }}"><i class="fab fa-facebook-f"></i></a>
                                        </li>
                                        <li>

                                            <a class="s-tw--color-hover" target="_blank" href="https://twitter.com/intent/tweet?url={{ url()->full() }}"><i class="fab fa-twitter"></i></a>
                                        </li>
                                        <li>

                                            <a class="s-insta--color-hover" target="_blank" href="https://www.linkedin.com/sharing/share-offsite/?url={{ url()->full() }}"><i class="fab fa-linkedin-in"></i></a>
                                        </li>
                                        <li>

                                            <a class="s-wa--color-hover" target="_blank" href="https://wa.me/?text={{ url()->full() }}"><i class="fab fa-whatsapp"></i></a>
                                        </li>
                                        <li>
                                            <a class="s-gplus--color-hover" target="_blank" href="http://pinterest.com/pin/create/link/?url={{ url()->full() }}"><i class="fab fa-pinterest-p"></i>
                                            </a>
                                        </li>
                                        
                                    </ul>
                                </div>
                                <div class="u-s-m-b-15">
                                 <form method="post" class="pd-detail__form cart-form" action="{{ url('/addtocart') }}">
                                   @csrf
                                   <input type="hidden" name="id" value="{{ $info->id }}">
                                        
                                     
                                   
                                        <div class="u-s-m-b-15">
                                         
                                           @foreach ($variations as $key => $item)
                                            <span class="pd-detail__label u-s-m-b-8">{{ $key }}:</span>
                                            <div class="pd-detail__color">

                                               @foreach ($item as $k => $row)
                                               <div class="radio-box">
                                                 <input type="radio" @if($k == 0) checked  @endif id="attr{{ $row->variation->id }}"    value="{{ $row->variation->id }}" name="variation[{{ $row->attribute->id }}]">
                                                 <div class="radio-box__state radio-box__state--primary">
                                                  <label class="radio-box__label  attr{{ $row->variation->id }}" for="attr{{ $row->variation->id }}">{{ $row->variation->name }}</label>&nbsp&nbsp
                                                </div>
                                              </div>
                                              
                                              @endforeach  
                                                
                                            </div>
                                            @endforeach


                                        </div>
                                        <div class="u-s-m-b-15">
                                          @foreach ($info->options as $key => $option)
                                            <span class="pd-detail__label u-s-m-b-8">{{ $option->name }} @if($option->is_required == 1) <span class="text-danger">*</span> @endif </span>
                                            <div class="pd-detail__size">
                                                 @foreach ($option->childrenCategories as $row)
                                                 <div class="@if($option->select_type == 1) size__checkbox @else size__radio @endif">
                                                    <input  data-amount="{{ $row->amount }}" data-amounttype="{{ $row->amount_type }}"  @if($option->select_type == 1) type="checkbox" name="option[]" @else name="option[{{ $key }}]" type="radio" @endif  value="{{ $row->id }}" class="selectgroup-input option options @if($option->is_required == 1) req @endif" id="option{{ $row->id }}">
                                                    <label class="size__radio-label option option{{ $row->id }}" for="option{{ $row->id }}">{{ $row->name }}</label>
                                                  </div>  
                                                  @endforeach                                             

                                            </div>
                                             @endforeach
                                        </div>
                                          <p class="text-danger none required_option">{{ __('Please Select A Option From Required Field') }}</p>
                                        <div class="pd-detail-inline-2">
                                          @if(empty($info->affiliate))
                                            <div class="u-s-m-b-15">

                                                <!--====== Input Counter ======-->
                                                <div class="input-counter">

                                                    <span class="input-counter__minus fas fa-minus"></span>

                                                    <input  name="qty" id="qty" class="input-counter__text input-counter--text-primary-style" type="text"   @if($info->stock->stock_manage == 1) @if($info->stock->stock_status == 0) disabled data-max="0" data-min="0" @else data-max="{{ $info->stock->stock_qty }}" data-min="1"  value="1" @endif @else data-min="1" data-max="999" value="1"  @endif>

                                                    <span class="input-counter__plus fas fa-plus"></span></div>
                                                <!--====== End - Input Counter ======-->
                                            </div>
                                            <div class="u-s-m-b-15">
                                                <button class="btn btn--e-brand-b-2 submit_btn"  @if($info->stock->stock_status == 0) disabled @endif type="submit">@if($info->stock->stock_status == 0) <del>{{ __('Out Of Stock') }}</del> @else {{ __('Add to Cart') }} @endif</button>
                                            </div>
                                            @else
                                            <div class="u-s-m-b-15">
                                                <a href="{{ url($info->affiliate->value ?? '') }}" target="_blank"  class="btn btn--e-brand-b-2"  @if($info->stock->stock_status == 0) disabled @endif type="submit">@if($info->stock->stock_status == 0) <del>{{ __('Out Of Stock') }}</del> @else {{ __('Purchase Now') }} @endif</a>
                                            </div>

                                            @endif
                                        </div>
                                    </form>
                                </div>
                                <div class="u-s-m-b-15">
                                	@if(count($info->categories) > 0)
                                    <span class="pd-detail__label u-s-m-b-8">{{ __('Categories') }}</span>
                                    <ul class="pd-detail__policy-list d-flex">
                                    	@foreach($info->categories as $row)
                                    	<li><a class="text-dark" href="{{ url('/category/'.$row->slug.'/'.$row->id) }}"><span>{{ $row->name }}</span></a>,</li>
                                    	<input type="hidden" class="cat_id" value="{{ $row->id}}">
                                    	@endforeach
                                                                              
                                    </ul>
                                    @endif
                                   @if(count($info->brands) > 0)
                                    <span class="pd-detail__label u-s-m-b-8">{{ __('Brand') }} :</span>
                                    <ul class="pd-detail__policy-list">
                                    	@foreach($info->brands as $row)
                                    	<li><a class="text-dark" href="{{ url('/brand/'.$row->slug.'/'.$row->id) }}"><span>{{ $row->name }}</span></a>,</li>
                                    	<input type="hidden" class="cat_id" value="{{ $row->id}}">
                                    	@endforeach
                                                                              
                                    </ul>
                                    @endif
                                </div>
                            </div>
                            <!--====== End - Product Right Side Details ======-->
                        </div>
                    </div>
                </div>
            </div>

<div class="u-s-p-y-90">
<div class="container">
<div class="row">
<div class="col-lg-12">
<div class="pd-tab">
<div class="u-s-m-b-30">
   <ul class="nav pd-tab__list">
      <li class="nav-item">
         <a class="nav-link active" data-toggle="tab" href="#pd-desc">{{ __('Description') }}</a>
      </li>
      <li class="nav-item">
         <a class="nav-link" data-toggle="tab" href="#pd-tag">{{ __('Product Information') }}</a>
      </li>
      <li class="nav-item">
         <a class="nav-link" id="view-review" data-toggle="tab" href="#pd-rev"><span class="review_count"></span></a>
      </li>
   </ul>
</div>
<div class="tab-content">

<!--====== Tab 1 ======-->
<div class="tab-pane show active" id="pd-desc">
     {{ content($content->content ?? '') }}
</div>
<!--====== End - Tab 1 ======-->


<!--====== Tab 2 ======-->
<div class="tab-pane" id="pd-tag">
    {{ $content->excerpt ?? '' }}
</div>
<!--====== End - Tab 2 ======-->


<!--====== Tab 3 ======-->
<div class="tab-pane fade" id="pd-rev">
   <div class="pd-tab__rev">
      <div class="u-s-m-b-30">
         <div class="pd-tab__rev-score">
            
            <div class="gl-rating-style-2 u-s-m-b-8 avg_review_area">
            	
            </div>
            <div class="u-s-m-b-8">
               <h4>{{ __('We want to hear from you!') }}</h4>
            </div>
            <span class="gl-text">{{ __('Tell us what you think about this item') }}</span>
         </div>
      </div>
      <div class="u-s-m-b-30">
         <div class="rev-f1__group">
            <div class="u-s-m-b-15">
               <h2><span class="review_count"></span> {{ __('Review(s) for') }} {{ $info->title }}</h2>
            </div>
            
         </div>
         <div class="rev-f1__review review-list">
         </div>
         <ul class="shop-p__pagination pagination"></ul>
      </div>
      <div class="u-s-m-b-30">
         
         	<form class="pd-tab__rev-f2 review-form" method="post" action="{{ url('/make-review',$info->id) }}">
            @csrf
            <h2 class="u-s-m-b-15">{{ __('Add a Review') }}</h2>
            <span class="gl-text u-s-m-b-15">{{ __('Your email address will not be published. Required fields are marked') }} *</span>
            <div class="u-s-m-b-30">
               <div class="rev-f2__table-wrap gl-scroll">
                  <table class="rev-f2__table">
                     <thead>
                        <tr>
                           <th>
                              <div class="gl-rating-style-2"><i class="fas fa-star"></i>
                                 <span>(1)</span>
                              </div>
                           </th>
                           <th>
                              <div class="gl-rating-style-2"><i class="fas fa-star"></i><i class="fas fa-star"></i>
                                 <span>(2)</span>
                              </div>
                           </th>
                           <th>
                              <div class="gl-rating-style-2"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                                 <span>(3)</span>
                              </div>
                           </th>
                           <th>
                              <div class="gl-rating-style-2"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                                 <span>(4)</span>
                              </div>
                           </th>
                           <th>
                              <div class="gl-rating-style-2"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                                 <span>(5)</span>
                              </div>
                           </th>
                        </tr>
                     </thead>
                     <tbody>
                        <tr>
                           <td>
                              <!--====== Radio Box ======-->
                              <div class="radio-box">
                                 <input type="radio" id="star-1" name="rating" value="1">
                                 <div class="radio-box__state radio-box__state--primary">
                                    <label class="radio-box__label" for="star-1"></label>
                                 </div>
                              </div>
                              <!--====== End - Radio Box ======-->
                           </td>
                           <td>
                              <!--====== Radio Box ======-->
                              <div class="radio-box">
                                 <input type="radio" id="star-2" name="rating" value="2">
                                 <div class="radio-box__state radio-box__state--primary">
                                    <label class="radio-box__label" for="star-2"></label>
                                 </div>
                              </div>
                              <!--====== End - Radio Box ======-->
                           </td>
                           <td>
                              <!--====== Radio Box ======-->
                              <div class="radio-box">
                                 <input type="radio" id="star-3" name="rating" value="3">
                                 <div class="radio-box__state radio-box__state--primary">
                                    <label class="radio-box__label" for="star-3"></label>
                                 </div>
                              </div>
                              <!--====== End - Radio Box ======-->
                           </td>
                           <td>
                              <!--====== Radio Box ======-->
                              <div class="radio-box">
                                 <input type="radio" id="star-4" name="rating" value="4">
                                 <div class="radio-box__state radio-box__state--primary">
                                    <label class="radio-box__label" for="star-4"></label>
                                 </div>
                              </div>
                              <!--====== End - Radio Box ======-->
                           </td>
                           <td>
                              <!--====== Radio Box ======-->
                              <div class="radio-box">
                                 <input type="radio" id="star-5" name="rating" value="5">
                                 <div class="radio-box__state radio-box__state--primary">
                                    <label class="radio-box__label" for="star-5"></label>
                                 </div>
                              </div>
                              <!--====== End - Radio Box ======-->
                           </td>
                        </tr>
                     </tbody>
                  </table>
               </div>
            </div>
            <div class="rev-f2__group">
               <div class="u-s-m-b-15">
                  <label class="gl-label" for="reviewer-text">{{ __('Your Review') }} *</label><textarea class="text-area text-area--primary-style" id="reviewer-text" required name="comment" maxlength="200"></textarea>
               </div>
               <div>
                  <p class="u-s-m-b-30">
                     <label class="gl-label" for="reviewer-name">{{ __('Name') }} *</label>
                     <input class="input-text input-text--primary-style" type="text" id="reviewer-name" value="{{ Auth::guard('customer')->user()->name ?? '' }}" name="name" placeholder="Your name" required readonly>
                  </p>
                  <p class="u-s-m-b-30">
                     <label class="gl-label" for="reviewer-email">{{ __('Email') }} *</label>
                     <input class="input-text input-text--primary-style" type="email" id="reviewer-email" name="email" placeholder="Your email" required readonly value="{{ Auth::guard('customer')->user()->email ?? '' }}">
                  </p>
               </div>
            </div>
            <div>
            	@if(Auth::guard('customer')->check())
               <button class="btn btn--e-brand-shadow review_btn" type="submit"><i class="fas fa-paper-plane"></i> {{ __('Send Review') }}</button>
               @else
               <a href="{{ url('/user/login') }}" class="btn btn--e-brand-shadow review_btn">
               	<i class="fas fa-sign-in-alt"></i>
               	{{ __('Please Login') }}
               </a>
               @endif
            </div>
         </form>
      </div>
   </div>
</div>
<!--====== End - Tab 3 ======-->
</div>
</div>
</div>
</div>
</div>
</div>
<!--====== End - Product Detail Tab ======-->
<div class="u-s-p-b-90 related_product_area">
   <!--====== Section Intro ======-->
   <div class="section__intro u-s-m-b-46">
      <div class="container">
         <div class="row">
            <div class="col-lg-12">
               <div class="section__text-wrap">
                  <h1 class="section__heading u-c-secondary u-s-m-b-12">{{ __('Related Products') }}</h1>
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
            <div class="owl-carousel product-slider related_product" data-item="4">
            </div>
         </div>
      </div>
   </div>
   <!--====== End - Section Content ======-->
</div>
<div class="u-s-p-b-90 new_product_area">
   <!--====== Section Intro ======-->
   <div class="section__intro u-s-m-b-46">
      <div class="container">
         <div class="row">
            <div class="col-lg-12">
               <div class="section__text-wrap">
                  <h1 class="section__heading u-c-secondary u-s-m-b-12">{{ __('NEW ARRIVALS') }}</h1>
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
            <div class="owl-carousel product-slider new_product" data-item="4">
            </div>
         </div>
      </div>
   </div>
   <!--====== End - Section Content ======-->
</div>
<!--====== End - Section 1 ======-->
</div>

<!--====== End - App Content ======-->
<input type="hidden" id="max_qty"  @if($info->stock->stock_manage == 1) value="{{ $info->stock->stock_qty }}" @else value="999" @endif>
<input type="hidden" id="term" value="{{ $info->id }}">        
@endsection
@push('js')
<script src="{{ asset('frontend/arafa-cart/js/elevateZoom.js') }}"></script>
<script src="{{ asset('frontend/arafa-cart/js/lightgallery.js') }}"></script>
<script src="{{ asset('frontend/arafa-cart/js/details.js') }}"></script>
@endpush