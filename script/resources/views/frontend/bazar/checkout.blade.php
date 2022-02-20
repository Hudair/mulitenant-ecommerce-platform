@extends('frontend.bazar.layouts.app')
@section('content')
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
                        <a >{{ __('Checkout') }}</a>
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
                 
                  <div id="checkout-msg-group">
                     @if(env('MULTILEVEL_CUSTOMER_REGISTER') == true)  
                     @if(!Auth::guard('customer')->check())
                     <div class="msg u-s-m-b-30">
                        <span class="msg__text">{{ __('Returning customer?') }}
                        <a class="gl-link" href="#return-customer" data-toggle="collapse">{{ __('Click here to login') }}</a></span>
                        @error('email')
                        <div class="invalid-feedback gl-link">
                          {{ $message }}
                        </div>
                        @enderror
                        @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                           {{session('error')}}
                          
                      </div>
                      @endif
                        <div class="collapse" id="return-customer" data-parent="#checkout-msg-group">
                           <div class="l-f u-s-m-b-16">
                              <span class="gl-text u-s-m-b-16">{{ __('If you have an account with us, please log in.') }}</span>
                              <form class="l-f__form" action="{{ url('/customer/login') }}" method="post">
                                 @csrf
                                 <div class="gl-inline">
                                    <div class="u-s-m-b-15">
                                       <label class="gl-label" for="login-email">{{ __('E-mail') }} *</label>
                                       <input class="input-text input-text--primary-style" name="email" type="text" id="login-email" placeholder="Enter E-mail">
                                       
                                    </div>
                                    <div class="u-s-m-b-15">
                                       <label class="gl-label" for="login-password">{{ __('Password') }} *</label>
                                       <input class="input-text input-text--primary-style" name="password" type="password" id="login-password" placeholder="Enter Password">
                                    </div>
                                 </div>
                                 <div class="gl-inline">
                                    <div class="u-s-m-b-15">
                                       <button class="btn btn--e-transparent-brand-b-2" type="submit">{{ __('Login') }}</button>
                                    </div>
                                    <div class="u-s-m-b-15">
                                       <a class="gl-link" href="{{ url('/user/password/reset') }}">{{ __('Lost Your Password?') }}</a>
                                    </div>
                                 </div>
                                 <!--====== Check Box ======-->
                                 <div class="check-box">
                                    <input type="checkbox" name="remember" id="remember-me">
                                    <div class="check-box__state check-box__state--primary">
                                       <label class="check-box__label" for="remember-me">{{ __('Remember Me') }}</label>
                                    </div>
                                 </div>
                                 <!--====== End - Check Box ======-->
                              </form>
                           </div>
                        </div>
                     </div>
                     @endif
                     @endif
                     <div class="msg">
                        <span class="msg__text">{{ __('Have a coupon?') }}
                        <a class="gl-link" href="{{ url('/cart') }}" >{{ __('Click Here to enter your code') }}</a></span>
                        
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!--====== End - Section Content ======-->
   </div>
  
   <div class="u-s-p-b-60">
      <form action="{{ url('/make_order') }}" class="checkout_form" method="post">
         @csrf
      <!--====== Section Content ======-->
      <div class="section__content">
         <div class="container">
            <div class="checkout-f">
               <div class="row">
                  <div class="col-lg-6">
                     @if ($errors->any())
               <div class="alert alert-danger">
                  <ul>
                     @foreach ($errors->all() as $error)
                     <li>{{ $error }}</li>
                     @endforeach
                  </ul>
               </div>
               @endif
               @if(Session::has('payment_fail'))
               <div class="alert alert-danger fade show" role="alert">
                  {{ Session::get('payment_fail') }}
                  
               </div>
               
               @endif
               @if(Session::has('user_limit'))
               <div class="alert alert-danger">
                  <ul>
                     <li>{{ Session::get('user_limit') }}</li>
                  </ul>
               </div>
               @endif
                     <h1 class="checkout-f__h1">{{ __('Delivery Information') }}</h1>
                    
                       
                        <div class="u-s-m-b-30">
                           
                           <!--====== First Name, Last Name ======-->
                          
                              <div class="u-s-m-b-15">
                                 <label class="gl-label" for="billing-fname">{{ __('Full Name') }}*</label>
                                 
                                 <input type="text" placeholder="Full Name" name="name" class="input-text input-text--primary-style" required="" value="{{ Auth::guard('customer')->user()->name  ?? '' }}">
                  
                              </div>
                             
                          
                           <!--====== End - First Name, Last Name ======-->
                           <!--====== E-MAIL ======-->
                           <div class="u-s-m-b-15">
                              <label class="gl-label" for="billing-email">{{ __('E-mail') }} *</label>
                              
                              <input type="email" placeholder="Email Address" name="email" class="input-text input-text--primary-style" required="" value="{{ Auth::guard('customer')->user()->email ?? '' }}">
                  
                           </div>
                           <!--====== End - E-MAIL ======-->
                           <!--====== PHONE ======-->
                           <div class="u-s-m-b-15">
                              <label class="gl-label" for="billing-phone">{{ __('Phone') }} *</label>
                              <input class="input-text input-text--primary-style" name="phone" required id="billing-phone" data-bill="">
                           </div>
                           <!--====== End - PHONE ======-->
                           @if(domain_info('shop_type') == 1)
                           <!--====== End - Street Address ======-->
                           @if(count($locations) > 0)
                           <!--====== Country ======-->
                           <div class="u-s-m-b-15">
                              <!--====== Select Box ======-->
                              <label class="gl-label" for="billing-country">{{ __('Location') }} *</label>
                              <select class="select-box select-box--primary-style location" name="location" id="billing-country" data-bill="">                                 
                                 <option selected disabled value="">{{ __('Select Location') }}</option>
                                 @foreach($locations as $location)
                                 <option value="{{ $location->id }}" data-method="{{ $location->child_relation }}">{{ $location->name }}</option>
                                 @endforeach
                              </select>
                              <!--====== End - Select Box ======-->
                           </div>
                           @endif
                            <!--====== Town / City ======-->
                            <div class="u-s-m-b-15">
                              <label class="gl-label" for="billing-town-city">{{ __('Delivery Address') }} *</label>
                              <input class="input-text input-text--primary-style" placeholder="Delivery Address" name="delivery_address" required type="text" id="billing-town-city" data-bill="">
                           </div>
                           <!--====== End - Town / City ======-->
                           <div class="u-s-m-b-15">
                              <label class="gl-label" for="billing-town-zip">{{ __('Zip Code') }} *</label>
                              <input class="input-text input-text--primary-style" type="number" placeholder="Zip Code" name="zip_code" required  id="billing-town-zip" data-bill="">
                           </div>
                           @endif

                           <!--====== End - Country ======-->
                          
                          @if(env('MULTILEVEL_CUSTOMER_REGISTER') == true && !Auth::guard('customer')->check())  
                                                  
                           <div class="u-s-m-b-10">
                              <div class="check-box">
                                 <input type="checkbox" id="make-default-address" name="create_account" value="1" class="create_account" data-bill="">
                                 <div class="check-box__state check-box__state--primary">
                                     <label class="check-box__label create_account" for="make-default-address">{{ __('Want to create a new account?') }}
                                    </a>
                                  </div>
                              </div>                            
                           </div>
                           <div class="u-s-m-b-15 none password_area" id="create-account">
                              <span class="gl-text u-s-m-b-15">{{ __('Create an account by entering the information below. If you are a returning customer please login at the top of the page.') }}</span>
                              <div>
                                 <label class="gl-label" for="reg-password">{{ __('Account Password') }} *</label>
                                 <input class="input-text input-text--primary-style" type="password" name="password" data-bill id="reg-password">
                              </div>
                           </div>
                          
                           @endif
                           <div class="u-s-m-b-10">
                              <label class="gl-label" for="order-note">{{ __('Order Note :') }}</label><textarea class="text-area text-area--primary-style" name="comment" id="order-note"></textarea>
                           </div>
                           
                        </div>
                    
                  </div>
                  <div class="col-lg-6">
                     <h1 class="checkout-f__h1">{{ __('Order Summqry') }}</h1>
                     <!--====== Order Summary ======-->
                     <div class="o-summary">
                        <div class="o-summary__section u-s-m-b-30">
                           <div class="o-summary__item-wrap gl-scroll">
                              @foreach(Cart::content() as $row)
                              <div class="o-card">
                                 <div class="o-card__flex">
                                    <div class="o-card__img-wrap">
                                       <img class="u-img-fluid" src="{{ asset($row->options->preview) }}" alt="">
                                    </div>
                                    <div class="o-card__info-wrap">
                                       <span class="o-card__name">
                                       <a  href="{{ url('/product/'.$row->name.'/'.$row->id) }}">{{ $row->name }} x {{ $row->qty }} </a>
                                       @foreach ($row->options->attribute as $attribute)

                                       <p><b>{{ $attribute->attribute->name }}</b> : {{ $attribute->variation->name }}</p>
                                       @endforeach
                                       @foreach ($row->options->options as $op)
                                       <small>{{ $op->name }}</small>,
                                       @endforeach

                                      
                                       </span>
                                       
                                       <span class="o-card__price">{{ amount_format($row->price) }}</span>
                                    </div>
                                 </div>
                                 <a href="{{ url('/cart_remove',$row->rowId) }}" class="o-card__del far fa-trash-alt"></a>
                              </div>
                              @endforeach
                            
                             
                            
                           </div>
                        </div>
                       
                        <div class="o-summary__section u-s-m-b-30">
                           <div class="o-summary__box">
                              <table class="o-summary__table">
                                 <tbody>
                                    <tr class="none shipping_charge">
                                       <td>{{ __('Shipping Charge') }}</td>
                                       <td><strong id="shipping_charge"></strong> </td>
                                    </tr>
                                    <tr>
                                       <td>{{ __('Tax') }}</td>
                                       <td>{{ amount_format(Cart::tax()) }}</td>
                                    </tr>
                                    
                                    <tr>
                                       <td>{{ __('Grand Total') }}</td>
                                       <td><strong class="total_cost_amount">{{ amount_format(Cart::total()) }}</strong></td>
                                    </tr>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                        <div class="o-summary__section u-s-m-b-30 shipping_area none">
                           <div class="o-summary__box">
                              <h1 class="checkout-f__h1">{{ __('Select Shipping Method') }}</h1>
                              <div class="ship-b shipping_methods">
                                                               
                              </div>
                           </div>
                        </div>
                        <div class="o-summary__section u-s-m-b-30">
                           <div class="o-summary__box">
                              <h1 class="checkout-f__h1">{{ __('Payment Method') }}</h1>
                              
                                 
                                 @foreach($getways as $key => $row)
                                 @php
                                 $data=json_decode($row->content);
                                 @endphp
                                 <div class="u-s-m-b-10">
                                    <!--====== Radio Box ======-->
                                    <div class="radio-box">
                                       <input type="radio"  id="payment_method_{{ $key }}"  name="payment_method" value="{{ $row->category_id  }}" @if($key==0) checked="checked" @endif>
                                       <div class="radio-box__state radio-box__state--primary">
                                          <label class="radio-box__label" for="payment_method_{{ $key }}">{{ $data->title }}</label>
                                       </div>
                                    </div>
                                    @if(isset($data->additional_details))
                                    <!--====== End - Radio Box ======-->
                                    <span class="gl-text u-s-m-t-6 payment_method_{{ $key }}">{{ $data->additional_details }}</span>
                                    @endif
                                 </div>
                                 @endforeach
                                 @if(Cart::count() > 0)
                                 <div>
                                    <button class="btn btn--e-brand-b-2 checkout_submit_btn" type="submit">{{ __('Place Order') }}</button>
                                 </div>
                                 @endif
                              
                           </div>
                        </div>
                     </div>
                  
                     <!--====== End - Order Summary ======-->
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!--====== End - Section Content ======-->
   </form>
   </div>

</div>
<input type="hidden" value="{{ str_replace(',','',number_format(Cart::total(),2)) }}" id="total_amount"/>
@endsection
@push('js')
<script src="{{ asset('frontend/bazar/js/checkout.js') }}"></script>
@endpush