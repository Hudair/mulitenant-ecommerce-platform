@extends('frontend.bigbag.layouts.app')
@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/bigbag/css/stripe.css') }}">
@endpush
@section('content')  
<section class="single-banner">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="single-content">
					<h2>{{ __('Payment With Stripe') }}</h2>
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{ url('/') }}">{{ __('Home') }}</a></li>

						<li class="breadcrumb-item active" aria-current="page">{{ __('stripe') }}</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="single-product">
	<div class="container">
		<div class="row">
			<div class="col-sm-3"></div>
			<div class="col-sm-6">
			
			<form action="{{ url('/payement/stripe') }}" method="post" id="payment-form">
				@csrf
				
				<div class="form-group">


					<label for="card-element">
						{{ __('Credit or debit card') }}
					</label>
					<div id="card-element">
						<!-- A Stripe Element will be inserted here. -->
					</div>

					<!-- Used to display form errors. -->
					<div id="card-errors" role="alert"></div>
					<button type="submit" class="btn btn-inline btn-block shadow-sm mt-2 checkout_submit_btn"> {{ __('Make Payment With Stripe') }} ({{ amount_format($amount) }}) </button>
				</div>
			</form>
			<p>{{ $description }}</p>
			</div>
			<div class="col-sm-3"></div>
		</div>
	</div>
</section>                	

<input type="hidden" id="publishable_key" value="{{ $publishable_key }}">
@endsection
@push('js')
<script src="https://js.stripe.com/v3/"></script>
<script src="{{ asset('frontend/bigbag/js/stripe.js') }}"></script>
@endpush


