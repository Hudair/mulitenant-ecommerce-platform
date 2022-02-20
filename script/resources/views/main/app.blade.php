<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
   <head>
      <meta charset="UTF-8">
       <meta http-equiv="X-UA-Compatible" content="IE=edge">
       <meta name="description" content="Health Care Medical Html5 Template">
       <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
       {{-- generate seo info --}}
       {!! SEO::generate() !!}
       {!! JsonLdMulti::generate() !!}
       <meta name="csrf-token" content="{{ csrf_token() }}">
       <!-- Favicon -->
       <link rel="shortcut icon" type="image/x-icon" href="{{ asset('uploads/favicon.ico') }}" />

      <!-- 
       Essential stylesheets
       =====================================-->
      <link rel="stylesheet" href="{{ asset('assets/frontend/plugins/bootstrap/bootstrap.min.css') }}">
      <link rel="stylesheet" href="{{ asset('assets/frontend/plugins/icofont/icofont.min.css') }}">
      <link rel="stylesheet" href="{{ asset('assets/frontend/plugins/slick-carousel/slick/slick.css') }}">
      <link rel="stylesheet" href="{{ asset('assets/frontend/plugins/slick-carousel/slick/slick-theme.css') }}">

     

      <!--=====================================
         CSS LINK PART START
         =======================================-->
      {{ Helper::autoload_main_site_data() }}  
       
        @if(Cache::has('site_info'))
        @php
        $site_info=Cache::get('site_info');
        $main_color=$site_info->site_color;
        @endphp
        @else
        $main_color='#223a66';
        @endif
        <style type="text/css">
           :root {
              --main-theme-color: {{ $main_color }};   
          }
        </style>

         <!-- Main Stylesheet -->
      <link rel="stylesheet" href="{{ asset('assets/frontend/css/style.css') }}">
      <link rel="stylesheet" href="{{ asset('uploads/additional.css') }}">
      @stack('style')
      <!--=====================================
         CSS LINK PART END
         =======================================-->

         
   </head>
   <body id="top">

  <!--=====================================
         NAVBAR PART START
         =======================================-->
     
         @if(Cache::has('marketing_tool'))
         @php
         $tools=Cache::get('marketing_tool');
         $tools=json_encode($tools);
         $tools=json_decode($tools ?? '');
         @endphp
         @isset($tools->fb_pixel_status)
         @if($tools->fb_pixel_status == 'on')
         {!! facebook_pixel($tools->fb_pixel) !!}
         @endif
         @endisset

         @endif
      <header>
@if(Cache::has('site_info'))
@php
$site_info=Cache::get('site_info');
@endphp
   <div class="header-top-bar">
      <div class="container">
         <div class="row align-items-center">
            <div class="col-lg-6">
               <ul class="top-bar-info list-inline-item pl-0 mb-0">
                  <li class="list-inline-item"><a href="mailto:{{ $site_info->email1 }}"><i class="icofont-support-faq mr-2"></i>{{ $site_info->email1 }}</a></li>
                  <li class="list-inline-item"><i class="icofont-location-pin mr-2"></i>{{ $site_info->address }} </li>
               </ul>
            </div>
            <div class="col-lg-6">
               <div class="text-lg-right top-right-bar mt-2 mt-lg-0">
                 @if(Cache::has('active_languages'))
                 @php
                 $langs=Cache::get('active_languages');
                 @endphp
                  <form class="translate_form" action="{{ route('translate') }}">
                   <select class="translate_option" name="local">
                     @foreach($langs as $key=>$row)
                     <option value="{{ $key }}"  @if(Session::get('locale') == $key) selected @endif>{{ $row }}</option>
                     @endforeach
                  </select>
                 </form>
                 @endif
                  
               </div>
            </div>
         </div>
      </div>
   </div>
@endif   
   <nav class="navbar navbar-expand-lg navigation" id="navbar">
      <div class="container">
         <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('uploads/logo.png') }}" alt="" class="img-fluid">
         </a>

         <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarmain"
            aria-controls="navbarmain" aria-expanded="false" aria-label="Toggle navigation">
            <span class="icofont-navigation-menu"></span>
         </button>

         <div class="collapse navbar-collapse" id="navbarmain">
            <ul class="navbar-nav ml-auto">
               {{ Menu('header','nav-item dropdown','navbar-item','navbar-link','',true) }}             
            </ul>
         </div>
      </div>
   </nav>
</header>

<!--=====================================
NAVBAR PART END
=======================================-->

   @yield('content')



<!--=====================================
FOOTER PART START
=======================================-->

<footer class="footer section ">
   <div class="container">
      <div class="row">
         <div class="col-lg-4 mr-auto col-sm-6">
            <div class="widget mb-5 mb-lg-0">
               <div class="logo mb-4">
                
                   <a href="{{ url('/') }}"><img  class="img-fluid" src="{{ asset('uploads/logo.png') }}" alt="{{ env('APP_NAME') }}" ></a>
               </div>
               @if(Cache::has('site_info'))
               @php
               $site_info=Cache::get('site_info');
               @endphp
               <p>{{ $site_info->site_description }}</p>

               <ul class="list-inline footer-socials mt-4">
                  @if(!empty($site_info->facebook))
                  <li class="list-inline-item"><a href="{{ $site_info->facebook }}"><i class="icofont-facebook"></i></a></li>
                  @endif
                   @if(!empty($site_info->twitter))
                  <li class="list-inline-item"><a href="{{ $site_info->twitter }}"><i class="icofont-twitter"></i></a></li>
                  @endif
                  @if(!empty($site_info->linkedin))
                  <li class="list-inline-item"><a href="{{ $site_info->linkedin }}"><i class="icofont-linkedin"></i></a></li>
                  @endif
                   @if(!empty($site_info->instagram))
                  <li class="list-inline-item"><a href="{{ $site_info->instagram }}"><i class="icofont-instagram"></i></a></li>
                  @endif
                  @if(!empty($site_info->youtube))
                  <li class="list-inline-item"><a href="{{ $site_info->youtube }}"><i class="icofont-youtube"></i></a></li>
                  @endif
               </ul>
               @endif
            </div>
         </div>

         <div class="col-lg-2 col-md-6 col-sm-6">
           
            {{ main_footer_menu('footer_left','','','','top',true) }}
         </div>

         <div class="col-lg-2 col-md-6 col-sm-6">
             {{ main_footer_menu('footer_center','','','','top',true) }}
         </div>
         <div class="col-lg-3 col-md-6 col-sm-6">
             {{ main_footer_menu('footer_right','','','','top',true) }}
         </div>

         
      </div>
      
      <div class="footer-btm py-4 mt-5">
         <div class="row align-items-center justify-content-between">
            <div class="col-lg-12 text-center">
               <div class="copyright">
                  &copy; Copyright Reserved  by <a href="{{ url('/') }}" >{{ env('APP_NAME') }}</a>
               </div>
            </div>
            
         </div>

         <div class="row">
            <div class="col-lg-4">
               <a class="backtop js-scroll-trigger" href="#top">
                  <i class="icofont-long-arrow-up"></i>
               </a>
            </div>
         </div>
      </div>
   </div>
</footer>



<!--=====================================
FOOTER PART END
=======================================-->
<!--=====================================
JS LINK PART START
=======================================-->
<script src="{{ asset('assets/frontend/plugins/jquery/jquery.js') }}"></script>
<script src="{{ asset('assets/frontend/plugins/bootstrap/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/frontend/plugins/slick-carousel/slick/slick.min.js') }}"></script>
<script src="{{ asset('assets/frontend/js/script.js') }}"></script>
<script src="{{ asset('uploads/additional.js') }}"></script>
@stack('js')

@if(Cache::has('marketing_tool'))
       @php
       $tools=Cache::get('marketing_tool');
       $tools=json_encode($tools);
       $tools=json_decode($tools ?? '');
       @endphp
       @isset($tools->google_status)
       @if($tools->google_status == 'on')
       {!! google_analytics($tools->ga_measurement_id) !!}
       @endif
       @endisset

       @endif
   </body>
</html>