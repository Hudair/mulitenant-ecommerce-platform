@extends('frontend.bigbag.layouts.app')
@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/bigbag/css/dashboard.css') }}" />

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
          <h2>{{ __('Dashboard') }}</h2>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('Dashboard') }}</li>
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
         LOGIN PART START
=======================================-->

 <main class="site-main  main-container no-sidebar mt-4">
    <div class="container">
        <div class="row">
            <div class="main-content col-md-12">
                <div class="page-main-content">
                    <div class="bigbag">
                        <div class="row">
                            <div class="col-lg-3">
                                <nav class="bigbag-MyAccount-navigation">
                                    <ul>
                                        <li class="bigbag-MyAccount-navigation-link bigbag-MyAccount-navigation-link--dashboard ">
                                            <a class="@if(url()->current() == url('/user/dashboard')) active @endif" href="{{ url('/user/dashboard') }}">{{ __('Dashboard') }}</a>
                                        </li>
                                        <li class="bigbag-MyAccount-navigation-link bigbag-MyAccount-navigation-link--orders">
                                            <a class="@if(url()->current() == url('/user/orders')) active @endif" href="{{ url('/user/orders') }}">{{ __('Orders') }}</a>
                                        </li>
                                       
                                        <li class="bigbag-MyAccount-navigation-link bigbag-MyAccount-navigation-link--edit-account">
                                            <a class="@if(url()->current() == url('/user/settings')) active @endif" href="{{ url('/user/settings') }}">{{ __('Account details') }}</a>
                                        </li>
                                        
                                        <li class="bigbag-MyAccount-navigation-link bigbag-MyAccount-navigation-link--customer-logout">
                                            <a href="{{ url('/logout') }}" onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                                        </li>
                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" class="d-none">
                                          @csrf
                                        </form>
                                    </ul>
                                </nav>
                            </div>
                            <div class="col-lg-9">
                             <div class="bigbag-MyAccount-content">
                                <div class="bigbag-notices-wrapper"></div>
                                 @yield('user_content')
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                 </div>
             </div>
         </div>
</main>

 <hr>
@endsection      




