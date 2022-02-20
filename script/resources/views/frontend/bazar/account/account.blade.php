@extends('frontend.bazar.account.layout.app')
@section('user_content')
<div class="dash__box dash__box--shadow dash__box--radius dash__box--bg-white u-s-m-b-30">
    <div class="dash__pad-2">
        <h1 class="dash__h1 u-s-m-b-14">{{ __('Edit Profile') }}</h1>

   
        <div class="dash__link dash__link--secondary u-s-m-b-30">

           
        <div class="row">
            <div class="col-lg-12">
                <form class="dash-edit-p basicform" action="{{ url('/user/settings/update') }}">
                    <div class="gl-inline">
                        <div class="u-s-m-b-30">

                            <label class="gl-label" for="reg-fname">{{ __('Name') }} *</label>
                            
                            <input class="input-text input-text--primary-style" type="text" id="reg-fname" name="name" required="" value="{{ Auth::guard('customer')->user()->name }}">
                        </div>
                        <div class="u-s-m-b-30">

                            <label class="gl-label" for="reg-lname">{{ __('Email') }} *</label>

                            <input class="input-text input-text--primary-style" type="email" id="reg-lname" name="email" required="" value="{{ Auth::guard('customer')->user()->email }}"></div>
                    </div>
                    
                   
                        <div class="u-s-m-b-30">
                            <label for="password_current">{{ __('Current password (leave blank to leave unchanged)') }}</label>
                            <input type="password" class="input-text input-text--primary-style" name="password_current" id="password_current" autocomplete="off">
                        </div>
                        <div class="gl-inline">
                            <div class="u-s-m-b-30">
    
                                <label class="gl-label" for="password_1">{{ __('New password (leave blank to leave unchanged)') }}</label>
                                
                                <input class="input-text input-text--primary-style"  type="password"  name="password" id="password_1" autocomplete="off">
                            </div>
                            <div class="u-s-m-b-30">
    
                                <label class="gl-label" for="password_2">{{ __('Confirm new password') }} </label>
    
                                <input class="input-text input-text--primary-style" type="password" name="password_confirmation" id="password_2" autocomplete="off"></div>
                        </div>
                   
                    <button class="btn btn--e-brand-b-2 basicbtn" type="submit">{{ __('Save') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
@push('js')
<script src="{{ asset('assets/js/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('assets/js/form.js') }}"></script>
@endpush