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
                            
                                @php
                                $segments=request()->segments();   
                                $segment_count=count($segments);
                                @endphp
                                @foreach($segments as $key => $segment)
                                @if($segment_count == $key+1)
                                <li class="is-marked">
                                @else
                                <li class="has-separator">
                                @endif
                                    <a >{{ $segment }}</a>
                                </li>
                                @endforeach
                               
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
            <div class="dash">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 col-md-12">

                            <!--====== Dashboard Features ======-->
                            <div class="dash__box dash__box--bg-white dash__box--shadow u-s-m-b-30">
                                <div class="dash__pad-1">

                                    <span class="dash__text u-s-m-b-16">Hello, <b>{{ Auth::guard('customer')->user()->name }}</b></span>
                                    <ul class="dash__f-list">
                                        <li class="bigbag-MyAccount-navigation-link bigbag-MyAccount-navigation-link--dashboard ">
                                            <a class="@if(url()->current() == url('/user/dashboard')) dash-active @endif" href="{{ url('/user/dashboard') }}">{{ __('Dashboard') }}</a>
                                        </li>
                                        <li class="bigbag-MyAccount-navigation-link bigbag-MyAccount-navigation-link--orders">
                                            <a class="@if(url()->current() == url('/user/orders')) dash-active @endif" href="{{ url('/user/orders') }}">{{ __('Orders') }}</a>
                                        </li>
                                       
                                        <li class="bigbag-MyAccount-navigation-link bigbag-MyAccount-navigation-link--edit-account">
                                            <a class="@if(url()->current() == url('/user/settings')) dash-active @endif" href="{{ url('/user/settings') }}">{{ __('Account details') }}</a>
                                        </li>
                                        
                                        <li class="bigbag-MyAccount-navigation-link bigbag-MyAccount-navigation-link--customer-logout">
                                            <a href="{{ url('/logout') }}" onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                                        </li>
                                        
                                    </ul>
                                </div>
                            </div>
                          
                            <!--====== End - Dashboard Features ======-->
                        </div>
                        <div class="col-lg-9 col-md-12">
                            @yield('user_content')
                            
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--====== End - Section Content ======-->
    </div>
    <!--====== End - Section 2 ======-->
</div>
<!--====== End - App Content ======-->
<form id="logout-form" action="{{ url('/logout') }}" method="POST" class="d-none">
  @csrf
</form>
@endsection