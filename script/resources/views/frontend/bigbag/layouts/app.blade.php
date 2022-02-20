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
              --main-theme-color: {{ Cache::get(domain_info('user_id').'theme_color','#dc3545') }};   
          }
        </style>
        <!-- FOR FONT ICON -->
       <link rel="stylesheet" href="{{ asset('assets/css/fontawsome/all.min.css') }}">
       <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;700;800;900&display=swap">
        <!-- FOR SLICK SLIDER -->
        <link rel="stylesheet" href="{{ asset('frontend/bigbag/css/slick.css') }}">

        <!-- FOR BOOTSTRAP -->
        <link rel="stylesheet" href="{{ asset('frontend/bigbag/css/bootstrap.min.css') }}">
         @stack('css')
        <!-- FOR STYLE -->
        <link rel="stylesheet" href="{{ asset('frontend/bigbag/css/main.css') }}">
       
        <!--=====================================
                    CSS LINK PART END
        =======================================-->
        {{ load_header() }}
    </head>
<body>
 


{{-- load partials views --}}      
@include('frontend/bigbag/layouts/header')
@yield('content')
@include('frontend/bigbag/layouts/footer')

{{-- end load --}}





{{-- load whatsapp api --}}
{{ load_whatsapp() }}
{{-- end whatsapp api loading --}}

@php
$currency_info=currency_info();
@endphp
<input type="hidden" id="currency_position" value="{{ $currency_info['currency_position'] }}">
<input type="hidden" id="currency_name" value="{{ $currency_info['currency_name'] }}">
<input type="hidden" id="currency_icon" value="{{ $currency_info['currency_icon'] }}">
<input type="hidden" id="preloader" value="{{ asset('uploads/preload.webp') }}">
<input type="hidden" id="base_url" value="{{ url('/') }}">
<input type="hidden" id="theme_color" value="{{ Cache::get(domain_info('user_id').'theme_color','#dc3545') }}">

<!--=====================================
             JS LINK PART START
 =======================================-->
 <!-- FOR BOOTSTRAP -->
 <script src="{{ asset('frontend/bigbag/js/jquery-3.5.1.min.js')}}"></script>
 <script src="{{ asset('assets/js/jquery.unveil.js') }}"></script>
 <script src="{{ asset('frontend/bigbag/js/cart.js?v=1.1')}}"></script>
 <script src="{{ asset('frontend/bigbag/js/popper.min.js')}}"></script>
 <script src="{{ asset('frontend/bigbag/js/bootstrap.min.js')}}"></script>
 <!-- FOR SLICK SLIDER -->
 <script src="{{ asset('frontend/bigbag/js/slick.min.js')}}"></script>
 <script src="{{ asset('frontend/bigbag/js/slick.js')}}"></script>
 <!-- FOR NICESCROLL -->
 <script src="{{ asset('frontend/bigbag/js/nicescroll.min.js')}}"></script>

  @stack('js')
 <!-- FOR INTERACTION -->
 <script src="{{ asset('frontend/bigbag/js/main.js')}}"></script>
 {{ load_footer() }}
<!--=====================================
    JS LINK PART END
=======================================-->
    </body>
</html>