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
                        <a >{{ __('Cart') }}</a>
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
                     <h1 class="section__heading u-c-secondary">{{ __('SHOPPING CART') }}</h1>
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
               <div class="col-lg-12 col-md-12 col-sm-12 u-s-m-b-30">
                  <div class="table-responsive">
                     <table class="table-p">
                        <tbody>
                           @foreach(Cart::content() as $row)   

                           <!--====== Row ======-->
                           <tr>
                              <td>
                                 <div class="table-p__box">
                                    <div class="table-p__img-wrap">
                                       <img class="u-img-fluid" src="{{ asset($row->options->preview) }}" alt="">
                                    </div>
                                    <div class="table-p__info">
                                       <span class="table-p__name">
                                       <a href="{{ url('/product/'.$row->name.'/'.$row->id) }}">{{ Str::limit($row->name,70) }}</a></span>
                                       <span class="table-p__category">
                                       <a href="{{ url('/product/'.$row->name.'/'.$row->id) }}"></a>
                                        @foreach ($row->options->attribute as $attribute)

                                       <p><b>{{ $attribute->attribute->name }}</b> : {{ $attribute->variation->name }}</p>
                                       @endforeach
                                       @foreach ($row->options->options as $op)
                                       <small>{{ $op->name }}</small>,
                                       @endforeach
                                    </span>
                                      
                                    </div>
                                 </div>
                              </td>
                              
                              <td>
                              <span class="table-p__price">{{ amount_format($row->price) }} x {{ $row->qty }} </span>                                     
                              </td>
                              <td>
                                 <span class="table-p__price">{{ amount_format($row->price*$row->qty) }}</span>
                              </td>
                              <td>
                                 <div class="table-p__del-wrap">
                                    <a class="far fa-trash-alt table-p__delete-link" href="{{ url('/cart_remove',$row->rowId) }}"></a>
                                 </div>
                              </td>
                           </tr>
                           <!--====== End - Row ======-->
                           @endforeach
                        </tbody>
                     </table>
                  </div>
               </div>
               <div class="col-lg-12">
                  <div class="route-box">
                     <div class="route-box__g1">
                        <a class="route-box__link" href="{{ url('/shop') }}"><i class="fas fa-long-arrow-alt-left"></i>
                        <span>{{ __('CONTINUE SHOPPING') }}</span></a>
                     </div>
                     <div class="route-box__g2">
                        <a class="route-box__link" href="{{ url('/cart-clear') }}"><i class="fas fa-trash"></i>
                        <span>{{ __('CLEAR CART') }}</span></a>
                        
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!--====== End - Section Content ======-->
   </div>
   <!--====== End - Section 2 ======-->
   <!--====== Section 3 ======-->
   <div class="u-s-p-b-60">
      <!--====== Section Content ======-->
      <div class="section__content">
         <div class="container">
            <div class="row">
               <div class="col-lg-12 col-md-12 col-sm-12 u-s-m-b-30">
                  <form class="f-cart basicform_with_reload" enctype="multipart/form-data" action="{{ url('/apply_coupon') }}" method="post">
                     @csrf
                     <div class="row">
                        <div class="col-lg-6 col-md-6 u-s-m-b-30">
                           <div class="f-cart__pad-box">
                              <h1 class="gl-h1">{{ __('Have a coupon ?') }}</h1>
                                                         
                              <div class="u-s-m-b-30">
                                 <label class="gl-label" for="coupon_code">{{ __('Coupon') }} *</label>
                                 <input class="input-text input-text--primary-style" name="code" type="text" id="coupon_code" placeholder="Coupon code" required="">
                              </div>
                              <div class="u-s-m-b-30">
                                 <button class="f-cart__ship-link btn--e-transparent-brand-b-2 btn basicbtn" >{{ __('Apply coupon') }}</button>
                              </div>
                           
                           </div>
                        </div>
                       </form>
                      
                        <div class="col-lg-6 col-md-6 u-s-m-b-30">
                           <div class="f-cart__pad-box">
                              <div class="u-s-m-b-30">
                                 
                                 <table class="f-cart__table">
                                    <tbody>
                                       <tr>
                                          <td>{{ __('Price Total') }}</td>
                                          <td>{{ amount_format(Cart::priceTotal()) }}</td>
                                       </tr>
                                       
                                       <tr>
                                          <td>{{ __('Subtotal') }}</td>
                                          <td>{{ amount_format(Cart::subtotal()) }}</td>
                                       </tr>
                                       <tr>
                                          <td>{{ __('Tax') }}</td>
                                          <td>{{ amount_format(Cart::tax()) }}</td>
                                       </tr>
                                       <tr>
                                          <td>{{ __('Discount') }}</td>
                                          <td>- {{ amount_format(Cart::discount()) }}</td>
                                       </tr>
                                       <tr>
                                          <td>{{ __('Grand Total') }}</td>
                                          <td>{{ amount_format(Cart::total()) }}</td>
                                       </tr>
                                    </tbody>
                                 </table>
                              </div>
                              <div>
                                 <a href="{{ url('/checkout') }}" class="btn btn--e-brand-b-2">{{ __('Proceed to checkout') }}</a>
                              </div>
                           </div>
                        </div>
                     </div>
                  
               </div>
            </div>
         </div>
      </div>
      <!--====== End - Section Content ======-->
   </div>
   <!--====== End - Section 3 ======-->
</div>
<!--====== End - App Content ======-->
@endsection
@push('js')
<script type="text/javascript" src="{{ asset('assets/js/sweetalert2.all.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/form.js') }}"></script>
@endpush