@extends('frontend.arafa-cart.layouts.app')
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
                            <h1 class="section__heading u-c-secondary">{{ __('Already Registered') }}</h1>
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
                                <h1 class="gl-h1">{{ __('I am new customer') }}</h1>

                                
                                <div class="u-s-m-b-15">
                                    <a class="l-f-o__create-link btn--e-transparent-brand-b-2" href="{{ url('/user/register') }}">{{ __('CREATE AN ACCOUNT') }}</a></div>
                                <h1 class="gl-h1">{{ __('Login') }}</h1>

                                <span class="gl-text u-s-m-b-30">{{ __('If you have an account with us, please log in.') }}</span>
                                @error('email')
                                <div class="alert alert-danger">
                                  {{ $message }}
                                </div>
                                @enderror
                                <form action="{{ url('/customer/login') }}" method="POST" class="l-f-o__form basicform">
                                    @csrf
                                    <div class="u-s-m-b-30">
                                        <label class="gl-label" for="login-email">{{ __('E-mail') }} *</label>
                                        
                                        <input class="input-text input-text--primary-style @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email') }}" required="" id="login-email" placeholder="Enter E-mail"></div>
                                       
                                        <div class="u-s-m-b-30">

                                        <label class="gl-label" for="login-password">{{ __('Password') }} *</label>

                                        <input class="input-text input-text--primary-style" name="password"  type="password" id="login-password" placeholder="Enter Password"></div>
                                    <div class="gl-inline">
                                        <div class="u-s-m-b-30">

                                            <button class="btn btn--e-transparent-brand-b-2 basicbtn" type="submit">{{ __('Login') }}</button></div>
                                        <div class="u-s-m-b-30">

                                            <a class="gl-link" href="{{ url('/user/password/reset') }}">{{ __('Lost Your Password?') }}</a></div>
                                    </div>
                                    <div class="u-s-m-b-30">

                                        <!--====== Check Box ======-->
                                        <div class="check-box">

                                            <input type="checkbox" name="remember" id="remember-me">
                                            <div class="check-box__state check-box__state--primary">

                                                <label class="check-box__label" for="remember-me">{{ __('Remember Me') }}</label></div>
                                        </div>
                                        <!--====== End - Check Box ======-->
                                    </div>
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