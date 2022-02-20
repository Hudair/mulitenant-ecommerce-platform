@extends('main.app')
@section('content')
<section class="page-title bg-1">
  <div class="overlay"></div>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="block text-center">
          <span class="text-white">{{ __('Contact Us') }}</span>
          <h1 class="text-capitalize mb-5 text-lg">{{ __('Get in Touch') }}</h1>
        </div>
      </div>
    </div>
  </div>
</section>


@if(Cache::has('site_info'))
@php
$info=Cache::get('site_info','');
@endphp
<section class="section contact-info pb-0">
  <div class="container">
    <div class="row">
      <div class="col-lg-4 col-md-6">
        <div class="contact-block mb-4 mb-lg-0">
          <i class="icofont-live-support"></i>
          <h5>Call Us</h5>
           {{ $info->phone1 ?? '' }}
        </div>
      </div>
      <div class="col-lg-4 col-md-6">
        <div class="contact-block mb-4 mb-lg-0">
          <i class="icofont-support-faq"></i>
          <h5>Email Us</h5>
          {{ $info->email1 ?? '' }}
        </div>
      </div>
      <div class="col-lg-4 col-md-12">
        <div class="contact-block mb-4 mb-lg-0">
          <i class="icofont-location-pin"></i>
          <h5>Location</h5>
         {{ $info->address ?? '' }} 
        </div>
      </div>
    </div>
  </div>
</section>
@endif

<section class="contact-form-wrap section">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12">
        
          <form action="{{ route('send_mail') }}" method="post" class="basicform_with_reset contact__form">
              @csrf
          <!-- form message -->
          

          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <input name="name" id="name"   required type="text" class="form-control" placeholder="Your Full Name">
              </div>
            </div>

            <div class="col-lg-6">
              <div class="form-group">
                <input name="email" id="email"  type="email" class="form-control" placeholder="Your Email Address" required>
              </div>
            </div>
           
          </div>

          <div class="form-group-2 mb-4">
            <textarea name="message" id="message" class="form-control" rows="8" placeholder="Your Message" required></textarea>
          </div>
          @if(env('NOCAPTCHA_SITEKEY') != null)
          <div class="form-group">
            {!! NoCaptcha::renderJs() !!}
            {!! NoCaptcha::display() !!}
          </div>
          @endif 
          <div>
            <input class="btn btn-main btn-round-full basicbtn" name="submit" type="submit" value="Send Messege"></input>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>



@endsection
@push('js')
<script src="{{ asset('assets/js/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('assets/js/form.js') }}"></script>
@endpush