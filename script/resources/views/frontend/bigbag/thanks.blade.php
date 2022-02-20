@extends('frontend.bigbag.layouts.app') 
@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/bigbag/css/thanks.css') }}" />
@endpush
@section('content') 
<section class="single-banner">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="single-content">
					<h2>{{ __('Order Confirmation') }}</h2>
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{ url('/') }}">{{ __('Home') }}</a></li>
						<li class="breadcrumb-item active" aria-current="page">{{ __('Thank you') }}</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
</section>

<div class="container padding-bottom-3x mb-2 mt-5">
	<div class="card text-center">
		<div class="card-body padding-top-2x">
			<h3 class="card-title">{{ __('Thank you for your order!') }}</h3>
			<p class="card-text">{{ __('Your order has been placed and will be processed as soon as possible.') }}</p>
			<p class="card-text">{{ __('Make sure you make note of your order number, which is') }} <span class="text-medium">{{ Session::get('order_no') }}</p>
			<p class="card-text">{{ __('You will be receiving an email shortly with confirmation of your order.') }}</p>
			<div class="padding-top-1x padding-bottom-1x"><a class="btn btn-inline" href="{{ url('/shop') }}">{{ __('Go Back Shopping') }}</a></div>
		</div>
	</div>
</div>
<hr>
@endsection	