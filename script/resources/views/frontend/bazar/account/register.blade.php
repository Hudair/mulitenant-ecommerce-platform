@extends('frontend.bazar.layouts.app')
@section('content')
  <!--====== App Content ======-->
  <div class="app-content">
    <!--====== Section 2 ======-->
    <div class="u-s-p-b-60">

        <!--====== Section Intro ======-->
        <div class="section__intro u-s-m-b-60">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section__text-wrap">
                            <h1 class="section__heading u-c-secondary"></h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--====== End - Section Intro ======-->


        <!--====== Section Content ======-->
        <div class="section__content">
            <div class="container">
                <div class="row row--center">
                    <div class="col-lg-6 col-md-8 u-s-m-b-30">
                        <div class="l-f-o">
                            <div class="l-f-o__pad-box">
                                <h1 class="gl-h1">{{ __('Create Account') }}</h1>
                                <form action="{{ url('/user/register-user') }}" method="POST" class="l-f-o__form basicform">
                                   @csrf
                                   
                                        @if ($errors->any())
                                        <div class="alert alert-danger">
                                          <ul>
                                            @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                            @endforeach
                                          </ul>
                                        </div>
                                        @endif
                                        @if(Session::has('user_limit'))
                                        <div class="alert alert-danger">
                                          <ul>
                                              
                                            <li>{{ Session::get('user_limit') }}</li>
                                            
                                        </ul>
                                    </div>
                                    @endif
                                    
                                    <div class="u-s-m-b-30">
                                        <label class="gl-label" for="reg-fname">{{ __('Name') }} *</label>
                                        <input class="input-text input-text--primary-style" type="text" id="reg-fname" value="{{ old('name') }}" name="name" placeholder="Name">
                                    </div>
                                   
                                    
                                    <div class="u-s-m-b-30">
                                        <label class="gl-label" for="reg-email">{{ __('E-Mail') }} *</label>
                                        <input class="input-text input-text--primary-style"value="{{ old('email') }}" name="email" id="reg-email" placeholder="Enter E-mail">
                                    </div>
                                    <div class="u-s-m-b-30">
                                        <label class="gl-label" for="reg-password">{{ __('Password') }} *</label>
                                        <input class="input-text input-text--primary-style"  type="password" name="password" id="reg-password" placeholder="Enter Password">
                                    </div>
                                    
                                    <div class="u-s-m-b-30">
                                        <label class="gl-label" for="reg-password">{{ __('Confirm Password') }} *</label>
                                        <input class="input-text input-text--primary-style"  type="password" name="password_confirmation" id="reg-password" placeholder="Enter Password">
                                    </div>

                                    <div class="u-s-m-b-15">

                                        <button class="btn btn--e-transparent-brand-b-2 basicbtn" type="submit">{{ __('Create') }}</button></div>

                                    <a class="gl-link" href="{{ url('/shop') }}">{{ __('Return to Store') }}</a>
                                </form>
                            </div>
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
@endsection
@push('js')
 <script src="{{ asset('frontend/bigbag/js/register.js')}}"></script>
@endpush