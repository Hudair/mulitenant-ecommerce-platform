@php
$cart_count=Cart::instance('default')->count();
$cart_content=Cart::instance('default')->content();
$cart_subtotal=Cart::instance('default')->subtotal();
$cart_total=Cart::instance('default')->total();
$wishlist=Cart::instance('wishlist')->count();
@endphp
<!--=====================================
                    HEADER PART START
        =======================================-->
        <header class="header-part">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-6">

                        <ul class="header-content">
                            @if(Cache::has(domain_info('user_id').'store_email'))
                            <li>
                                <i class="fas fa-envelope text-danger"></i>
                                <p>{{ Cache::get(domain_info('user_id').'store_email') }}</p>
                            </li>
                            @endif
                           
                        </ul>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <ul class="header-content header-widget">
                            
                            @if(Cache::has(domain_info('user_id').'languages'))
                            @php
                            $languages=Cache::get(domain_info('user_id').'languages');
                            $languages=json_decode($languages);
                            @endphp
                            <li class="dropdown">
                                <a href="#"><i class="fas fa-globe text-danger"></i>{{ __('language') }}</a>
                                <ul class="dropdown-menu header-dropdown">
                                    @foreach($languages as $lang_key=> $language)
                                    <li><a class="dropdown-item @if($language == Session::get('locale')) active_language text-white @endif" href="{{ url('/make_local?'.'lang='.$language.'&full='.$lang_key) }}"  >{{ $lang_key  }}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </header>
        <!--=====================================
                    HEADER PART END
        =======================================-->


        <!--=====================================
                    NAVBAR PART START
        =======================================-->
        <section class="navbar-part">
            <div class="container">
                <div class="navbar-content">
                    <ul class="round-icon left-widget">
                        <li><a href="#" class="left-bar"><i class="fas fa-align-left"></i></a></li>
                        <li><a href="#" class="left-src"><i class="fas fa-search"></i></a></li>
                    </ul>
                    <div class="navbar-logo">
                        <a href="{{ url('/') }}"><img src="{{ asset('uploads/'.domain_info('user_id').'/logo.png') }}" alt=""></a>
                    </div>
                    <div class="navbar-form">
                        <form action="{{ url('/shop') }}">
                            <input type="text" placeholder="Search anything..." name="src" class="src" value="{{ $src ?? null }}">
                            <button class="btn btn-inline"><i class="fas fa-search"></i>{{ __('search') }}</button>
                        </form>
                    </div>
                    <ul class="round-icon right-widget">
                         @if(env('MULTILEVEL_CUSTOMER_REGISTER') == true)
                        <li>
                            <a href="{{ url('/user/dashboard') }}">
                                <i class="fas fa-user"></i>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/wishlist') }}">
                                <i class="fas fa-heart"></i>
                                <sup class="wishlist_count">{{ $wishlist }}</sup>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="cart-icon">
                                <i class="fas fa-shopping-cart"></i>
                                <sup id="cart_count">{{ $cart_count }}</sup>
                            </a>
                        </li>
                        @else
                         <li>
                            <a href="{{ url('/wishlist') }}">
                                <i class="fas fa-heart"></i>
                                <sup class="wishlist_count">{{ $wishlist }}</sup>
                            </a>
                        </li>
                        <li>                           
                        </li>                       
                        <li>
                            <a href="#" class="cart-icon">
                                <i class="fas fa-shopping-cart"></i>
                                <sup id="cart_count">{{ $cart_count }}</sup>
                            </a>
                        </li>
                        @endif

                        
                        
                    </ul>
                </div>
            </div> 
        </section>
        <!--=====================================
                    NAVBAR PART END
        =======================================-->


        <!--=====================================
                 RIGHT SIDEBAR PART START
        =======================================-->
        <section class="right-sidebar">
            <div class="right-sidebar-cover sidebar-cover">
                <a class="cross-btn right-cross" href="#"><i class="fas fa-times"></i></a>
                <div class="container">
                    <div class="sidebar-logo">
                        <a href="{{ url('/') }}"><img src="{{ asset('uploads/'.domain_info('user_id').'/logo.png') }}" alt="logo"></a>
                    </div>
                    <div class="sidebar-heading">
                        <h4>{{ __('Shopping Cart') }}</h4>
                    </div>
                    <ul class="cart-list overflow-auto" >

                        @foreach($cart_content as $row)

                        <li class="cart-item cart-row{{ $row->rowId }}">
                            <div class="cart-img">
                                <a href="{{ url('/product/'.$row->name.'/'.$row->id) }}"><img src="{{ asset($row->options->preview) }}" alt="cart-1"></a>
                            </div>
                            <div class="cart-info">
                                <a href="{{ url('/product/'.$row->name.'/'.$row->id) }}">{{ $row->name }}</a>
                                <p>{{ $row->qty }} x <span>{{ amount_format($row->price) }}</span></p>
                            </div>
                            <div class="cart-remove">
                                <a href="javascript:void(0)" onclick="remove_cart({{ $row->id }})"><i class="fas fa-times"></i></a>
                            </div>
                            <input type="hidden" value="{{ $row->rowId }}" id="rowid{{ $row->id }}">
                        </li>
                        @endforeach
                        
                    </ul>
                    <ul class="cart-price">
                        <li>
                            <span>{{ __('Sub total') }}:</span>
                            <span id="cart_sub_total">{{ amount_format($cart_subtotal) }}</span>
                        </li>
                        <li>
                            <span>{{ __('Total') }}:</span>
                            <span id="cart_total">{{ amount_format($cart_total) }}</span>
                        </li>
                    </ul>
                    <ul class="cart-btn">
                        <li><a href="{{ url('/cart') }}" class="btn btn-light"><i class="fas fa-shopping-cart"></i> {{ __('view cart') }}</a></li>
                        <li><a href="{{ url('/checkout') }}" class="btn btn-light"><i class="fas fa-sign-out-alt"></i> {{ __('Checkout') }}</a></li>
                    </ul>
                </div>
            </div>
        </section>
        <!--=====================================
                    RIGHT SIDEBAR PART END
        =======================================-->


        <!--=====================================
                 LEFT SIDEBAR PART START
        =======================================-->
        <section class="left-sidebar">
            <div class="left-sidebar-cover sidebar-cover">
                <a class="cross-btn left-cross" href="#"><i class="fas fa-times"></i></a>
                <div class="container">
                    <div class="sidebar-logo">
                        <a href="{{ url('/') }}"><img src="{{ asset('uploads/'.domain_info('user_id').'/logo.png') }}" alt="logo"></a>
                    </div>
                    <div class="navbar-form sidebar-src">
                        <form action="{{ url('/shop') }}">
                            <input type="text" name="src" placeholder="Search anything..." class="src" value="{{ $src ?? null }}">
                            <button class="btn btn-inline"><i class="fas fa-search"></i>{{ __('search') }}</button>
                        </form>
                    </div>
                    <ul class="accordion accor-ghape" id="accordionExample">
                        {{ CollapseAbleMenu('header','collapse') }}
                    </ul>
                </div>
            </div>
        </section>
        <!--=====================================
                    LEFT SIDEBAR PART END
        =======================================-->


        <!--=====================================
                    BTMBAR PART START
        =======================================-->
        <div class="btmbar-part">
            <ul class="btmbar-widget">
                <li>
                    <a href="{{ url('/') }}" >
                        <i class="fas fa-home"></i>
                        <span>{{ __('Home') }}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/wishlist') }}">
                        <i class="fas fa-heart"></i>
                        <span>{{ __('Wishlist') }}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/cart') }}">
                        <i class="fas fa-shopping-basket"></i>
                        <span>{{ __('Cart') }}</span>
                    </a>
                </li>
                 @if(env('MULTILEVEL_CUSTOMER_REGISTER') == true)
                <li>
                    <a href="{{ url('/user/dashboard') }}">
                        <i class="fas fa-user"></i>
                        <span>{{ __('Account') }}</span>
                    </a>
                </li>
                @endif
            </ul>
        </div>
        <!--=====================================
                    BTMBAR PART END
        =======================================-->