@extends('frontend.bigbag.layouts.app')
@push('css')
 <link rel="stylesheet" href="{{ asset('frontend/bigbag/css/login.css') }}">

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
          <h2>{{ $info->name ?? __('Customer Login') }}</h2>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('Login') }}</li>
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
<section class="section-padding">
  <div class="form-box">
    <h2>{{ __('Login') }}</h2>
    <p>{{ __('Welcome back! please login to your account.') }}</p>
    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      {{session('error')}}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    @endif
    <form action="{{ url('/customer/login') }}" method="POST" class="mt-3 basicform">
      @csrf
      <fieldset class="form-group mb-3">
        <input type="email" placeholder="Email"  class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required="">
        @if($errors->has('email'))
        <div class="invalid-feedback">
          {{ $errors->first('email') }}
        </div>
        @endif
      </fieldset>
      <fieldset class="form-group mb-3">
        <input type="password" placeholder="Password" name="password" class="form-control" required="">
      </fieldset>
      <div class="row mt-3 mb-3">
        <div class="col-6">
          <div class="custom-control custom-checkbox">
            <input type="checkbox" name="remember" class="custom-control-input" id="rememberMe">
            <label class="custom-control-label" for="rememberMe">{{ __('Remember Me') }}</label>
          </div>
        </div>
        <div class="col-6">
          <p class="mb-0"><a href="{{ url('/user/password/reset') }}" class="base_color">{{ __('Forgot Password') }}</a></p>
        </div>
      </div>
      <div class="row mt-4">
        <div class="col-md-6 col-lg-6">
          <button type="submit" class="bigbag_btn-custom btn-block basicbtn">{{ __('Sign In') }}</button>
        </div>
        <div class="col-md-6 col-lg-6 text-center align-self-md-center pt-4 pt-md-0">
          <p class="mb-0">{{ __('Don\'t have an account?') }}<br><a href="{{ url('/user/register') }}" class="base_color">{{ __('Register here') }}</a></p>
        </div>
      </div>
    </form>
  </div>
</section>
 <hr>
@endsection      




