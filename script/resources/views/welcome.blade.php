@extends('main.app')
@section('content')

<!-- Slider Start -->
<section class="banner" style="background-image: url('{{ asset($header->preview ?? '')}}');">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 col-md-12 col-xl-7">
        <div class="block">
          <div class="divider mb-3"></div>
          <span class="text-uppercase text-sm letter-spacing ">{{ $header->title ?? '' }}</span>
          <h1 class="mb-3 mt-3">{{ $header->highlight_title ?? '' }}</h1>
          
          <p class="mb-4 pr-5">{{ $header->description ?? '' }}</p>
          <div class="btn-container ">
            <a href="#priceing" class="btn btn-main-2 btn-icon btn-round-full">{{ __('Get Start Now') }} <i class="icofont-simple-right ml-2"></i></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<section class="features">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="feature-block d-lg-flex">
          <div class="feature-item mb-5 mb-lg-0">
            <div class="feature-icon mb-4">
              <i class="{{ $about_1->preview }}"></i>
            </div>
            
            <h4 class="mb-3">{{ $about_1->title }}</h4>
            <p class="mb-4">{{ $about_1->description }}</p>
            @if(!empty($about_1->btn_text) && !empty($about_1->btn_link))
            <a href="{{ url($about_1->btn_link) }}" class="btn btn-main btn-round-full">{{ $about_1->btn_text }}</a>
            @endif
          </div>
        
          <div class="feature-item mb-5 mb-lg-0">
            <div class="feature-icon mb-4">
              <i class="{{ $about_2->preview }}"></i>
            </div>
            
            <h4 class="mb-3">{{ $about_2->title }}</h4>
            <p class="mb-4">{{ $about_2->description }}</p>
            @if(!empty($about_2->btn_text) && !empty($about_2->btn_link))
            <a href="{{ url($about_2->btn_link) }}" class="btn btn-main btn-round-full">{{ $about_2->btn_text }}</a>
            @endif
          </div>
        
          <div class="feature-item mb-5 mb-lg-0">
            <div class="feature-icon mb-4">
              <i class="{{ $about_3->preview }}"></i>
            </div>
            
            <h4 class="mb-3">{{ $about_3->title }}</h4>
            <p class="mb-4">{{ $about_3->description }}</p>
            @if(!empty($about_3->btn_text) && !empty($about_3->btn_link))
            <a href="{{ url($about_3->btn_link) }}" class="btn btn-main btn-round-full">{{ $about_3->btn_text }}</a>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<section class="section about">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-4 col-sm-6">
        <div class="about-img">

          <img src="{{ $ecom_features->top_image }}" alt="" class="img-fluid">
          <img src="{{ $ecom_features->bottom_image }}" alt="" class="img-fluid mt-4">
        </div>
      </div>
      <div class="col-lg-4 col-sm-6">
        <div class="about-img mt-4 mt-lg-0">
          <img src="{{ $ecom_features->center_image }}" alt="" class="img-fluid">
        </div>
      </div>
      <div class="col-lg-4">
        <div class="about-content pl-4 mt-4 mt-lg-0">
          <h2 class="title-color">{{ $ecom_features->area_title }}</h2>
          <p class="mt-4 mb-5">{{ $ecom_features->description }}</p>
          @if(!empty($ecom_features->btn_link) && !empty($ecom_features->btn_text))
          <a href="{{ url($ecom_features->btn_link) }}" class="btn btn-main-2 btn-round-full btn-icon">{{ $ecom_features->btn_text }}<i class="icofont-simple-right ml-3"></i></a>
          @endif
        </div>
      </div>
    </div>
  </div>
</section>

<section class="cta-section ">
  <div class="container">
    <div class="cta position-relative">
      <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="counter-stat">
            <i class="icofont-users"></i>
            <span class="h3">{{ $counter_area->happy_customer ?? '' }}</span>
            <p>{{ __('Happy Customers') }}</p>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="counter-stat">
            <i class="icofont-star"></i>
            <span class="h3">{{ $counter_area->total_reviews ?? '' }}</span>+
            <p>{{ __('Total Reviews') }}</p>
          </div>
        </div>
        
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="counter-stat">
            <i class="icofont-world"></i>
            <span class="h3">{{ $counter_area->total_domain ?? '' }}</span>+
            <p>{{ __('Total Domains') }}</p>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="counter-stat">
            <i class="icofont-ui-user-group"></i>
            <span class="h3">{{ $counter_area->community_member ?? '' }}</span>+
            <p>{{ __('Community Members') }}</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="section service gray-bg" id="service">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-7 text-center">
        <div class="section-title">
          <h2>{{ __('features_title') }}</h2>
          <div class="divider mx-auto my-4"></div>
          <p>{{ __('features_description') }}</p>
        </div>
      </div>
    </div>
    <div class="row">
       @foreach($features as $row)
      <div class="col-lg-4 col-md-6 col-sm-6">
        <div class="service-item mb-4">
          <div class="icon d-flex align-items-center">
             <img  src="{{ asset($row->preview->content ?? '') }}" height="80">
            <h4 class="mt-3 mb-3">{{ $row->name }}</h4>
          </div>
          <div class="content">
            <p class="mb-4">{{ $row->excerpt->content ?? '' }}</p>
          </div>
        </div>
      </div>
      @endforeach 
    </div>
  </div>
</section>

<section class="section appoinment">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-12 ">
        <div class="section-title text-center">
          <h2>{{ __('gallery_title') }}</h2>
          <div class="divider mx-auto"></div>
          <p>{{ __('gallery_description') }}</p>
        </div>
        <section class="" id="gallery">
          <div class="container">
            <div class="row">
              <div class="col-lg-12">
                <div class="portfolio__slide gallery_part">
                   @foreach($latest_gallery as $key => $row)
                  <a href="{{ url($row->name) }}">
                    <div class="port__card">
                      <div class="portfolio__img">
                        <img src="{{ asset($row->preview->content ?? '') }}"   alt="">
                      </div>                                
                    </div>
                  </a>
                   @endforeach
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>      
      </div>
    </div>
  </div>
</section>

<section class="section gray-bg" id="priceing">
   <div class="container">
      <div class="container">
         <div class="row justify-content-center">
            <div class="col-lg-7">
               <div class="section-title text-center">
                  <h2>{{ __('Pricing') }}</h2>
                  <div class="divider mx-auto my-4"></div>
                  <p>{{ __('priceing_description') }}</p>
               </div>
            </div>
         </div>
      </div>
      <!-- END -->
      <div class="row text-center align-items-end plan_list">
         <!-- Pricing Table-->
@foreach($plans as $row)
@php
  $plan=json_decode($row->data);
@endphp
          <div class="col-lg-4 mb-5 mb-lg-0  @if($row->featured == 0) priceing @endif">
           <div class="bg-white p-5 rounded-lg  @if($row->featured == 1) shadow @endif ">
           <h1 class="h6 text-uppercase font-weight-bold mb-4">{{ $row->name }}</h1>
           <h2 class="h1 font-weight-bold">{{ amount_format($row->price) }}</h2>
              <span class="font-weight-bold">@if($row->days == 365) {{ __('Yearly') }} @elseif($row->days == 30) {{ __('Monthly') }} @else {{ $row->days }}  {{ __('Days') }} @endif</span>
          <ul class="list-unstyled my-5 text-small text-left font-weight-normal">
         <li class="mb-3">
            {{ __('Products Limit') }} <b>{{ $plan->product_limit }}</b>
         </li>
         <li class="mb-3">
             {{ __('Storage Limit') }} <b>{{ number_format($plan->storage) }}MB</b>
         </li>
          <li class="mb-3">
            {{ __('Use Subdomain') }}
         </li>
         <li class="mb-3">
            @if($plan->custom_domain == 'true')
            {{ __('Use your existing domain') }}
            @else
            <del>{{ __('Use your existing domain') }}</del>
            @endif
         </li>
        
         <li class="mb-3">
            @if($plan->inventory == 'true')
            {{ __('Inventory Management') }}
            @else
            <del> {{ __('Inventory Management') }}</del>
            @endif
         </li>
         <li class="mb-3">
           @if($plan->pos == 'true')
            {{ __('POS System') }}
           @else
           <del>{{ __('POS System') }}</del>
           @endif
         </li>
         <li class="mb-3">
          @if($plan->customer_panel == 'true')
            {{ __('Customer Panel') }}
          @else
            <del>{{ __('Customer Panel') }}</del>
          @endif  
         </li>
         <li class="mb-3">
           @if($plan->google_analytics == 'true')
            {{ __('Google Analytics') }}
           @else
           <del>{{ __('Google Analytics') }}</del>
           @endif 
         </li>
         <li class="mb-3">
           @if($plan->gtm == 'true')
           {{ __('Google Tag Manager (GTM)') }}
           @else
           <del>{{ __('Google Tag Manager (GTM)') }}</del>
           @endif 
            
         </li>
         <li class="mb-3">
          @if($plan->facebook_pixel == 'true')
           {{ __('Facebook Pixel') }}
          @else
          <del>{{ __('Facebook Pixel') }}</del>
          @endif 
         </li>

         <li class="mb-3">
          @if($plan->whatsapp == 'true')
            {{ __('Whatsapp Api') }}
          @else
         <del> {{ __('Whatsapp Api') }}</del>
          @endif   
         </li>
         
          <li class="mb-3">
          @if($plan->qr_code == 'true')
            {{ __('QR Code') }}
          @else
         <del> {{ __('QR Code') }}</del>
          @endif   
         </li>
          <li class="mb-3">
          @if($plan->live_support == 'true')
            {{ __('Technical Support') }}
          @else
         <del> {{ __('Technical Support') }}</del>
          @endif   
         </li>
         
         
         <li class="mb-3">
           {{ __('Multi Language') }}
         </li>
         <li class="mb-3">
           {{ __('Image Optimization') }}
         </li>
      </ul>
      @if($row->is_trial == 1)
      <a href="{{ route('merchant.form',$row->id) }}" class="btn site_color text-white btn-block p-2 shadow rounded-pill">{{ __('Register') }}</a>
      @endif
     </div>
    </div>
@endforeach
         <!-- END -->
      </div>
   </div>
</section>
<section class="section testimonial-2 ">
<div class="container">
   <div class="row justify-content-center">
      <div class="col-lg-7">
         <div class="section-title text-center">
            <h2>{{ __('review_title') }}  </h2>
            <div class="divider mx-auto my-4"></div>
            <p>{{ __('review_description') }}</p>
         </div>
      </div>
   </div>
</div>
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-12 testimonial-wrap-2">
         @foreach($testimonials as $row)
        <div class="testimonial-block style-2  gray-bg">
          <i class="icofont-quote-right"></i>

          <div class="testimonial-thumb">
            <img src="https://ui-avatars.com/api/?name={{ $row->name ?? '' }}&background=random&length=1&color=#fff" alt="" class="img-fluid">
          </div>

          <div class="client-info ">
            <h4>{{ $row->name ?? '' }}</h4>
            <span>{{ $row->slug ?? '' }}</span>
            <p>
              {{ $row->excerpt->content }}
            </p>
          </div>
        </div>
        @endforeach
        
      </div>
    </div>
  </div>
</section>


<section class="section clients gray-bg">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-7">
        <div class="section-title text-center">
          <h2>{{ __('brand_area_title') }}</h2>
          <div class="divider mx-auto my-4"></div>
          <p>{{ __('brand_area_description') }}</p>
        </div>
      </div>
    </div>
  </div>

  <div class="container">
    <div class="row clients-logo">
      @foreach($brands as $row)
      <div class="col-lg-2">
        <div class="client-thumb">
         <a href="{{ $row->name }}" target="_blank"> <img src="{{ asset($row->preview->content)}}" height="50" alt="" class="img-fluid"></a>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>
@endsection
