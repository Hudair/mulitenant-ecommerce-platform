<!DOCTYPE html>
<html lang="{{ App::getlocale() }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        {{-- generate seo info --}}
        {!! SEO::generate() !!}
        {!! JsonLdMulti::generate() !!}
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!--=====================================
                    CSS LINK PART START
        =======================================-->
        <!-- FOR PAGE ICON -->
        <link rel="icon" href="{{ asset('uploads/'.domain_info('user_id').'/favicon.ico') }}">
        @php
        Helper::autoload_site_data();
        
        @endphp
        <style type="text/css">
           :root {
              --main-theme-color: {{ Cache::get(domain_info('user_id').'theme_color','#ff4500') }};   
          }
        </style>
        <!--====== Google Font ======-->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800" rel="stylesheet">

        <link rel="stylesheet" href="{{ asset('frontend/saka-cart/css/normalize.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/saka-cart/css/fontawesome.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/saka-cart/css/bootstrap.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/saka-cart/css/animate.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/saka-cart/css/owlcarousel.css') }}">

        <!--====== Utility-Spacing ======-->
        <link rel="stylesheet" href="{{ asset('frontend/saka-cart/css/utility.css') }}">

        <!--====== App ======-->
        <link rel="stylesheet" href="{{ asset('frontend/saka-cart/css/app.css') }}">
      
         @stack('css')
        <!-- FOR STYLE -->
        {{ load_header() }}
    </head>
<body class="config">
    

    <!--====== Main App ======-->
<div id="app">

 


{{-- load partials views --}}      
@include('frontend/saka-cart/layouts/header')
@yield('content')
@include('frontend/saka-cart/layouts/footer')

{{-- end load --}}

{{-- load whatsapp api --}}
{{ load_whatsapp() }}
{{-- end whatsapp api loading --}}
</div>
<!--====== End - Main App ======-->

@php
$currency_info=currency_info();
@endphp
<input type="hidden" id="currency_position" value="{{ $currency_info['currency_position'] }}">
<input type="hidden" id="currency_name" value="{{ $currency_info['currency_name'] }}">
<input type="hidden" id="currency_icon" value="{{ $currency_info['currency_icon'] }}">
<input type="hidden" id="preloader" value="{{ asset('uploads/preload.webp') }}">
<input type="hidden" id="base_url" value="{{ url('/') }}">
<input type="hidden" id="theme_color" value="{{ Cache::get(domain_info('user_id').'theme_color','#dc3545') }}">


<!--====== Vendor Js ======-->
<script src="{{ asset('frontend/saka-cart/js/modernizr.js') }}"></script>
<script src="{{ asset('frontend/saka-cart/js/jquery.min.js') }}"></script>
<script src="{{ asset('frontend/saka-cart/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('frontend/saka-cart/js/owlcarousel.js') }}"></script>
<script src="{{ asset('frontend/saka-cart/js/slick.js') }}"></script>

<!--====== jQuery Shopnav plugin ======-->
<script src="{{ asset('frontend/saka-cart/js/jquery.shopnav.js') }}"></script>
<script src="{{ asset('assets/js/jquery.unveil.js') }}"></script>
<!--====== App ======-->

<script src="{{ asset('frontend/saka-cart/js/helper.js?v=1.1') }}"></script>
@stack('js')
<script src="{{ asset('frontend/saka-cart/js/app.js') }}"></script>
{{ load_footer() }}
 <!-- FOR INTERACTION -->
<!--=====================================
    JS LINK PART END
=======================================-->

<!--====== Noscript ======-->
    <noscript>
        <div class="app-setting">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="app-setting__wrap">
                            <h1 class="app-setting__h1">JavaScript is disabled in your browser.</h1>

                            <span class="app-setting__text">Please enable JavaScript in your browser or upgrade to a JavaScript-capable browser.</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </noscript>
</body>
</html>