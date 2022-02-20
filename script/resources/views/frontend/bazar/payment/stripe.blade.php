@extends('frontend.arafa-cart.layouts.app')
@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/bigbag/css/stripe.css') }}">
@endpush
@section('content')  
<!--====== App Content ======-->
<div class="app-content">
   <!--====== Section 1 ======-->
   <div class="u-s-p-y-60">
      <!--====== Section Content ======-->
      <div class="section__content">
         <div class="container">
            <div class="breadcrumb">
               <div class="breadcrumb__wrap">
                  <ul class="breadcrumb__list">
                     <li class="has-separator">
                        <a href="{{ url('/') }}">{{ __('Home') }}</a>
                     </li>
                     <li class="is-marked">
                        <a>{{ __('Make Payment') }}</a>
                     </li>
                  </ul>
               </div>
            </div>
         </div>
      </div>
   </div>

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


