@php
$cart_count=Cart::instance('default')->count();
$cart_content=Cart::instance('default')->content();
$cart_subtotal=Cart::instance('default')->subtotal();
$cart_total=Cart::instance('default')->total();
$wishlist=Cart::instance('wishlist')->count();
@endphp
@if(url('/') == url()->current())
<!--====== Header Wrapper ======-->
<div class="header-wrapper">

   <!--====== Main Header ======-->
   <header class="header--style-3">

       <!--====== Nav 1 ======-->
       <nav class="primary-nav-wrapper">
           <div class="container">

               <!--====== Primary Nav ======-->
               <div class="primary-nav">

                   <!--====== Main Logo ======-->

                   <a class="main-logo" href="index-3.html">

                     <img src="{{ asset('uploads/'.domain_info('user_id').'/logo.png') }}" alt=""></a>
                   <!--====== End - Main Logo ======-->


                   <!--====== Search Form ======-->
                   <form class="main-form" action="{{ url('/shop') }}">

                       <label for="main-search"></label>

                       <input class="input-text input-text--border-radius input-text--only-white  src" value="{{ $src ?? '' }}" name="src" type="text" id="main-search" placeholder="Search">

                       <button class="btn btn--icon fas fa-search main-search-button" type="submit"></button></form>
                   <!--====== End - Search Form ======-->


                   <!--====== Dropdown Main plugin ======-->
                   <div class="menu-init" id="navigation">
                       @if(env('MULTILEVEL_CUSTOMER_REGISTER') == true)   
                       <button class="btn btn--icon toggle-button toggle-button--white fas fa-cogs" type="button"></button>
                       @endif
                       <!--====== Menu ======-->
                       <div class="ah-lg-mode">

                           <span class="ah-close">✕ Close</span>

                           <ul class="ah-list ah-list--design1 ah-list--link-color-secondary">
                             @if(env('MULTILEVEL_CUSTOMER_REGISTER') == true)   
                              <li class="has-dropdown" data-tooltip="tooltip" data-placement="left" title="Account">
                                 <a><i class="far fa-user-circle"></i></a>
                                 <!--====== Dropdown ======-->
                                 <span class="js-menu-toggle"></span>
                                 <ul class="w-120">
                                    @if(Auth::guard('customer')->check())
                                    <li>
                                       <a href="{{ url('/user/dashboard') }}"><i class="fas fa-user-circle u-s-m-r-6"></i>
                                       <span>{{ __('Account') }}</span></a>
                                    </li>
                                    <li>
                                       <a href="{{ url('/logout') }}" onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();"><i class="fas fa-lock-open u-s-m-r-6"></i>
                                       <span>{{ __('Signout') }}</span></a>
                                    </li>
                                    <form action="{{ url('/logout') }}" method="POST" class="d-none" id="logout-form">
                                       @csrf
                                     </form>
                                    @else
                                    <li>
                                       <a href="{{ url('/user/register') }}"><i class="fas fa-user-plus u-s-m-r-6"></i>
                                       <span>{{ __('Signup') }}</span></a>
                                    </li>
                                    <li>
                                       <a href="{{ url('/user/login') }}"><i class="fas fa-lock u-s-m-r-6"></i>
                                       <span>{{ __('Signin') }}</span></a>
                                    </li>
                                    @endif
                                    
                                    
                                 </ul>
                                 <!--====== End - Dropdown ======-->
                              </li>
                              @endif
                              @if(Cache::has(domain_info('user_id').'languages'))
                              @php
                              $languages=Cache::get(domain_info('user_id').'languages');
                              $languages=json_decode($languages);
                              @endphp 
                              <li class="has-dropdown" data-tooltip="tooltip" data-placement="left" title="Change Language">
                                 <a><i class="fas fa-globe"></i></a>
                                 <!--====== Dropdown ======-->
                                 <span class="js-menu-toggle"></span>
                                 <ul class="w-120">
                                    @foreach($languages as $lang_key=> $language)                       
                                    <li>
                                       <a class="@if($language == Session::get('locale')) u-c-brand @endif"  href="{{ url('/make_local?'.'lang='.$language.'&full='.$lang_key) }}">{{ $lang_key  }}</a>
                                    </li>
                                    @endforeach
         
                                    
                                 </ul>
                                 <!--====== End - Dropdown ======-->
                              </li>
                              @endif
                              
                              @if(Cache::has(domain_info('user_id').'store_email'))
                              <li data-tooltip="tooltip" data-placement="left" title="Mail">
                                 <a href="mailto:{{ Cache::get(domain_info('user_id').'store_email') }}"><i class="far fa-envelope"></i></a>
                              </li>
                              @endif
                           </ul>
                       </div>
                       <!--====== End - Menu ======-->
                   </div>
                   <!--====== End - Dropdown Main plugin ======-->
               </div>
               <!--====== End - Primary Nav ======-->
           </div>
       </nav>
       <!--====== End - Nav 1 ======-->


      <!--====== Nav 2 ======-->
   <nav class="secondary-nav-wrapper">
      <div class="container">
         <!--====== Secondary Nav ======-->
         <div class="secondary-nav">
            @if(url('/') == url()->full())
            <!--====== Dropdown Main plugin ======-->
            <div class="menu-init" id="navigation1">
               <button class="btn btn--icon toggle-mega-text toggle-button" type="button">C</button>
               <!--====== Menu ======-->
               <div class="ah-lg-mode">
                  <span class="ah-close">✕ {{ __('Close') }}</span>
                  <!--====== List ======-->
                  <ul class="ah-list">
                     <li class="has-dropdown">
                        <span class="mega-text">C</span>
                        <!--====== Mega Menu ======-->
                        <span class="js-menu-toggle"></span>
                        <div class="mega-menu">
                           <div class="mega-menu-wrap">
                              <div class="mega-menu-list">
                                 <ul id="menu_category">
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
                        <!--====== End - Mega Menu ======-->
                     </li>
                  </ul>
                  <!--====== End - List ======-->
               </div>
               <!--====== End - Menu ======-->
            </div>
            @endif
            <!--====== End - Dropdown Main plugin ======-->
            <!--====== Dropdown Main plugin ======-->
            <div class="menu-init" id="navigation2">
               <button class="btn btn--icon toggle-button toggle-button--secondary fas fa-bars" type="button"></button>
               <!--====== Menu ======-->
               <div class="ah-lg-mode">
                  <span class="ah-close">✕ {{ __('Close') }}</span>
                  <!--====== List ======-->
                  <ul class="ah-list ah-list--design2 ah-list--link-color-secondary">
                     {{ ThemeMenu('header','frontend.saka-cart.components.menu') }}
                  </ul>
                  <!--====== End - List ======-->
               </div>
               <!--====== End - Menu ======-->
            </div>
            <!--====== End - Dropdown Main plugin ======-->
            <!--====== Dropdown Main plugin ======-->
            <div class="menu-init" id="navigation3">
               <button class="btn btn--icon toggle-button toggle-button--secondary fas fa-shopping-bag toggle-button-shop" type="button"></button>
               <span class="total-item-round cart_count">{{ $cart_count }}</span>
               <!--====== Menu ======-->
               <div class="ah-lg-mode">
                  <span class="ah-close">✕ {{ __('Close') }}</span>
                  <!--====== List ======-->
                  <ul class="ah-list ah-list--design1 ah-list--link-color-secondary">
                     <li>
                        <a href="{{ url('/') }}"><i class="fas fa-home u-c-brand"></i></a>
                     </li>
                     <li>
                        <a class="mini-cart-shop-link" href="{{ url('/wishlist') }}"><i class="far fa-heart"></i><span class="total-item-round wishlist_count">{{ $wishlist }}</span></a>
                     </li>
                     <li class="has-dropdown">
                        <a class="mini-cart-shop-link"><i class="fas fa-shopping-bag"></i>
                        <span class="total-item-round cart_count">{{ $cart_count }}</span></a>
                        <!--====== Dropdown ======-->
                        <span class="js-menu-toggle"></span>
                        <div class="mini-cart">
                           <!--====== Mini Product Container ======-->
                           <div class="mini-product-container gl-scroll u-s-m-b-15 cart-list">
                               @foreach($cart_content as $row)
                              <!--====== Card for mini cart ======-->
                              <div class="card-mini-product cart-item cart-row{{ $row->rowId }}">
                                 <div class="mini-product">
                                    <div class="mini-product__image-wrapper">
                                       <a class="mini-product__link" href="{{ url('/product/'.$row->name.'/'.$row->id) }}">
                                       <img class="u-img-fluid" src="{{ asset($row->options->preview) }}" alt=""></a>
                                    </div>
                                    <div class="mini-product__info-wrapper">
                                       
                                       <span class="mini-product__name">
                                       <a href="{{ url('/product/'.$row->name.'/'.$row->id) }}">{{ $row->name }}</a></span>
                                       <span class="mini-product__quantity">{{ $row->qty }} x</span>
                                       <span class="mini-product__price">{{ amount_format($row->price) }}</span>
                                    </div>
                                 </div>
                                 <a class="mini-product__delete-link far fa-trash-alt" onclick="remove_cart({{ $row->id }})"></a>
                                 <input type="hidden" value="{{ $row->rowId }}" id="rowid{{ $row->id }}">
                              </div>
                              <!--====== End - Card for mini cart ======-->
                              @endforeach
                           </div>
                           <!--====== End - Mini Product Container ======-->
                           <!--====== Mini Product Statistics ======-->
                           <div class="mini-product-stat">
                              <div class="mini-total">
                                 <span class="subtotal-text">{{ __('SUBTOTAL') }}</span>
                                 <span class="subtotal-value" id="cart_sub_total">{{ amount_format($cart_subtotal) }}</span>
                              </div>
                              <div class="mini-action">
                                 <a class="mini-link btn--e-brand-b-2" href="{{ url('/checkout') }}">{{ __('PROCEED TO CHECKOUT') }}</a>
                                 <a class="mini-link btn--e-transparent-secondary-b-2" href="{{ url('/cart') }}">{{ __('VIEW CART') }}</a>
                              </div>
                           </div>
                           <!--====== End - Mini Product Statistics ======-->
                        </div>
                        <!--====== End - Dropdown ======-->
                     </li>
                  </ul>
                  <!--====== End - List ======-->
               </div>
               <!--====== End - Menu ======-->
            </div>
            <!--====== End - Dropdown Main plugin ======-->
         </div>
         <!--====== End - Secondary Nav ======-->
      </div>
   </nav>
   <!--====== End - Nav 2 ======-->
   </header>
   <!--====== End - Main Header ======-->
</div>
<!--====== End - Header Wrapper ======-->


@else
<!--====== Main Header ======-->
<header class="header--style-1">
   <!--====== Nav 1 ======-->
   <nav class="primary-nav primary-nav-wrapper--border">
      <div class="container">
         <!--====== Primary Nav ======-->
         <div class="primary-nav">
            <!--====== Main Logo ======-->
            <a class="main-logo" href="{{ url('/') }}">
            <img src="{{ asset('uploads/'.domain_info('user_id').'/logo.png') }}" alt=""></a>
            <!--====== End - Main Logo ======-->
            <!--====== Search Form ======-->
            <form class="main-form" action="{{ url('/shop') }}">
               <label for="main-search"></label>
               <input  class="input-text input-text--border-radius input-text--style-1 src" value="{{ $src ?? '' }}" name="src" type="text" id="main-search" placeholder="Search">
               <button class="btn btn--icon fas fa-search main-search-button" type="submit"></button>
            </form>
            <!--====== End - Search Form ======-->
            <!--====== Dropdown Main plugin ======-->
            <div class="menu-init" id="navigation">
               <button class="btn btn--icon toggle-button toggle-button--secondary fas fa-cogs" type="button"></button>
               <!--====== Menu ======-->
               <div class="ah-lg-mode">
                  <span class="ah-close">✕ {{ __('Close') }}</span>
                  <!--====== List ======-->
                  <ul class="ah-list ah-list--design1 ah-list--link-color-secondary">
                     @if(env('MULTILEVEL_CUSTOMER_REGISTER') == true)  
                     <li class="has-dropdown" data-tooltip="tooltip" data-placement="left" title="Account">
                        <a><i class="far fa-user-circle"></i></a>
                        <!--====== Dropdown ======-->
                        <span class="js-menu-toggle"></span>
                        <ul class="w-120">
                           @if(Auth::guard('customer')->check())
                           <li>
                              <a href="{{ url('/user/dashboard') }}"><i class="fas fa-user-circle u-s-m-r-6"></i>
                              <span>{{ __('Account') }}</span></a>
                           </li>
                           <li>
                              <a href="{{ url('/logout') }}" onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();"><i class="fas fa-lock-open u-s-m-r-6"></i>
                              <span>{{ __('Signout') }}</span></a>
                           </li>
                           <form action="{{ url('/logout') }}" method="POST" class="d-none" id="logout-form">
                              @csrf
                            </form>
                           @else
                           <li>
                              <a href="{{ url('/user/register') }}"><i class="fas fa-user-plus u-s-m-r-6"></i>
                              <span>{{ __('Signup') }}</span></a>
                           </li>
                           <li>
                              <a href="{{ url('/user/login') }}"><i class="fas fa-lock u-s-m-r-6"></i>
                              <span>{{ __('Signin') }}</span></a>
                           </li>
                           @endif
                           
                           
                        </ul>
                        <!--====== End - Dropdown ======-->
                     </li>
                     @endif
                     @if(Cache::has(domain_info('user_id').'languages'))
                     @php
                     $languages=Cache::get(domain_info('user_id').'languages');
                     $languages=json_decode($languages);
                     @endphp 
                     <li class="has-dropdown" data-tooltip="tooltip" data-placement="left" title="Change Language">
                        <a><i class="fas fa-globe"></i></a>
                        <!--====== Dropdown ======-->
                        <span class="js-menu-toggle"></span>
                        <ul class="w-120">
                           @foreach($languages as $lang_key=> $language)                       
                           <li>
                              <a class="@if($language == Session::get('locale')) u-c-brand @endif"  href="{{ url('/make_local?'.'lang='.$language.'&full='.$lang_key) }}">{{ $lang_key  }}</a>
                           </li>
                           @endforeach

                           
                        </ul>
                        <!--====== End - Dropdown ======-->
                     </li>
                     @endif
                     
                     @if(Cache::has(domain_info('user_id').'store_email'))
                     <li data-tooltip="tooltip" data-placement="left" title="Mail">
                        <a href="mailto:{{ Cache::get(domain_info('user_id').'store_email') }}"><i class="far fa-envelope"></i></a>
                     </li>
                     @endif
                  </ul>
                  <!--====== End - List ======-->
               </div>
               <!--====== End - Menu ======-->
            </div>
            <!--====== End - Dropdown Main plugin ======-->
         </div>
         <!--====== End - Primary Nav ======-->
      </div>
   </nav>
   <!--====== End - Nav 1 ======-->
   <!--====== Nav 2 ======-->
   <nav class="secondary-nav-wrapper">
      <div class="container">
         <!--====== Secondary Nav ======-->
         <div class="secondary-nav">
            @if(url('/') == url()->full())
            <!--====== Dropdown Main plugin ======-->
            <div class="menu-init" id="navigation1">
               <button class="btn btn--icon toggle-mega-text toggle-button" type="button">C</button>
               <!--====== Menu ======-->
               <div class="ah-lg-mode">
                  <span class="ah-close">✕ {{ __('Close') }}</span>
                  <!--====== List ======-->
                  <ul class="ah-list">
                     <li class="has-dropdown">
                        <span class="mega-text">C</span>
                        <!--====== Mega Menu ======-->
                        <span class="js-menu-toggle"></span>
                        <div class="mega-menu">
                           <div class="mega-menu-wrap">
                              <div class="mega-menu-list">
                                 <ul id="menu_category">
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
                        <!--====== End - Mega Menu ======-->
                     </li>
                  </ul>
                  <!--====== End - List ======-->
               </div>
               <!--====== End - Menu ======-->
            </div>
            @endif
            <!--====== End - Dropdown Main plugin ======-->
            <!--====== Dropdown Main plugin ======-->
            <div class="menu-init" id="navigation2">
               <button class="btn btn--icon toggle-button toggle-button--secondary fas fa-bars" type="button"></button>
               <!--====== Menu ======-->
               <div class="ah-lg-mode">
                  <span class="ah-close">✕ {{ __('Close') }}</span>
                  <!--====== List ======-->
                  <ul class="ah-list ah-list--design2 ah-list--link-color-secondary">
                     {{ ThemeMenu('header','frontend.saka-cart.components.menu') }}
                  </ul>
                  <!--====== End - List ======-->
               </div>
               <!--====== End - Menu ======-->
            </div>
            <!--====== End - Dropdown Main plugin ======-->
            <!--====== Dropdown Main plugin ======-->
            <div class="menu-init" id="navigation3">
               <button class="btn btn--icon toggle-button toggle-button--secondary fas fa-shopping-bag toggle-button-shop" type="button"></button>
               <span class="total-item-round cart_count">{{ $cart_count }}</span>
               <!--====== Menu ======-->
               <div class="ah-lg-mode">
                  <span class="ah-close">✕ {{ __('Close') }}</span>
                  <!--====== List ======-->
                  <ul class="ah-list ah-list--design1 ah-list--link-color-secondary">
                     <li>
                        <a href="{{ url('/') }}"><i class="fas fa-home u-c-brand"></i></a>
                     </li>
                     <li>
                        <a class="mini-cart-shop-link" href="{{ url('/wishlist') }}"><i class="far fa-heart"></i><span class="total-item-round wishlist_count">{{ $wishlist }}</span></a>
                     </li>
                     <li class="has-dropdown">
                        <a class="mini-cart-shop-link"><i class="fas fa-shopping-bag"></i>
                        <span class="total-item-round cart_count">{{ $cart_count }}</span></a>
                        <!--====== Dropdown ======-->
                        <span class="js-menu-toggle"></span>
                        <div class="mini-cart">
                           <!--====== Mini Product Container ======-->
                           <div class="mini-product-container gl-scroll u-s-m-b-15 cart-list">
                               @foreach($cart_content as $row)
                              <!--====== Card for mini cart ======-->
                              <div class="card-mini-product cart-item cart-row{{ $row->rowId }}">
                                 <div class="mini-product">
                                    <div class="mini-product__image-wrapper">
                                       <a class="mini-product__link" href="{{ url('/product/'.$row->name.'/'.$row->id) }}">
                                       <img class="u-img-fluid" src="{{ asset($row->options->preview) }}" alt=""></a>
                                    </div>
                                    <div class="mini-product__info-wrapper">
                                       
                                       <span class="mini-product__name">
                                       <a href="{{ url('/product/'.$row->name.'/'.$row->id) }}">{{ $row->name }}</a></span>
                                       <span class="mini-product__quantity">{{ $row->qty }} x</span>
                                       <span class="mini-product__price">{{ amount_format($row->price) }}</span>
                                    </div>
                                 </div>
                                 <a class="mini-product__delete-link far fa-trash-alt" onclick="remove_cart({{ $row->id }})"></a>
                                 <input type="hidden" value="{{ $row->rowId }}" id="rowid{{ $row->id }}">
                              </div>
                              <!--====== End - Card for mini cart ======-->
                              @endforeach
                           </div>
                           <!--====== End - Mini Product Container ======-->
                           <!--====== Mini Product Statistics ======-->
                           <div class="mini-product-stat">
                              <div class="mini-total">
                                 <span class="subtotal-text">{{ __('SUBTOTAL') }}</span>
                                 <span class="subtotal-value" id="cart_sub_total">{{ amount_format($cart_subtotal) }}</span>
                              </div>
                              <div class="mini-action">
                                 <a class="mini-link btn--e-brand-b-2" href="{{ url('/checkout') }}">{{ __('PROCEED TO CHECKOUT') }}</a>
                                 <a class="mini-link btn--e-transparent-secondary-b-2" href="{{ url('/cart') }}">{{ __('VIEW CART') }}</a>
                              </div>
                           </div>
                           <!--====== End - Mini Product Statistics ======-->
                        </div>
                        <!--====== End - Dropdown ======-->
                     </li>
                  </ul>
                  <!--====== End - List ======-->
               </div>
               <!--====== End - Menu ======-->
            </div>
            <!--====== End - Dropdown Main plugin ======-->
         </div>
         <!--====== End - Secondary Nav ======-->
      </div>
   </nav>
   <!--====== End - Nav 2 ======-->
</header>
<!--====== End - Main Header ======-->
@endif