@extends('frontend.bazar.account.layout.app')
@section('user_content')
<div class="dash__box dash__box--shadow dash__box--radius dash__box--bg-white u-s-m-b-30">
    <div class="dash__pad-2">
        <h1 class="dash__h1 u-s-m-b-14">{{ __('Hi, Welcome to your dashboard') }}</h1>

        <span class="dash__text u-s-m-b-30"><p>{{ __('From your account dashboard you can view your') }} <a href="{{ url('/user/orders') }}">{{ __('recent orders') }}</a> and <a href="{{ url('/user/settings') }}">{{ __('edit your password and account details') }} </a>.</span>
        
    </div>
</div>

@endsection