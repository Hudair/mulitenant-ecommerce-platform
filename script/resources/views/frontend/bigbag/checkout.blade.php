@extends('frontend.bigbag.layouts.app')
@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/bigbag/css/checkout.css') }}">
@endpush
@section('content')   
<section class="single-banner">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="single-content">
					<h2>{{ __('Checkout') }}</h2>
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{ url('/') }}">{{ __('Home') }}</a></li>
						<li class="breadcrumb-item active" aria-current="page">{{ __('Checkout') }}</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
</section>
<form action="{{ url('/make_order') }}" class="checkout_form" method="post">
@csrf
<div class="section">
	<div class="container">

		
			<div class="row">
				<div class="col-xl-7">
					 @if(env('MULTILEVEL_CUSTOMER_REGISTER') == true)
					@if(!Auth::guard('customer')->check())
					<!-- Login -->
					<div class="bigbag_notice">
						<p>{{ __('Are you a returning customer?') }} <a href="{{ url('/user/login') }}">{{ __('Click here to login') }}</a> </p>
					</div>
					@endif
					@endif
					
					<!-- Coupon Code -->
					<div class="bigbag_notice">
						<p>{{ __('Do you have a coupon code?') }} <a href="{{ url('/cart') }}">{{ __('Click here to apply') }}</a> </p>
					</div>
					
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
					@if(Session::has('payment_fail'))
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
						{{ Session::get('payment_fail') }}
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					
					@endif
					<!-- Buyer Info Start -->
					<h4>{{ __('Billing Details') }}</h4>
					<div class="row">
						<div class="form-group col-xl-12">
							<label>{{ __('Name') }} <span class="text-danger">*</span></label>
							<input type="text" placeholder="Full Name" name="name" class="form-control" required="" value="{{ Auth::guard('customer')->user()->name  ?? '' }}">
						</div>
						<div class="form-group col-xl-6">
							<label>{{ __('Email Address') }} <span class="text-danger">*</span></label>
							<input type="email" placeholder="Email Address" name="email" class="form-control" required="" value="{{ Auth::guard('customer')->user()->email ?? '' }}">
						</div>
						<div class="form-group col-xl-6">
							<label>{{ __('Phone Number') }} <span class="text-danger">*</span></label>
							<input type="text" placeholder="Phone Number" name="phone" class="form-control" value="" required="">
						</div>
						@if(env('MULTILEVEL_CUSTOMER_REGISTER') == true)
						@if(!Auth::guard('customer')->check())
						<div class="form-group col-xl-12">
							<label><input type="checkbox"  name="create_account" value="1" class="create_account">{{ __('With Create Account') }}</label>
						</div>
						<div class="form-group col-xl-12 password_area none">

							<label>{{ __('Password') }} <span class="text-danger">*</span></label>
							<input type="password" placeholder="Enter Password" name="password" class="form-control" value="" minlength="8">
						</div>
						@endif
						@endif
						@if(domain_info('shop_type') == 1)
						@if(count($locations) > 0)
						<div class="form-group col-xl-12">
							<label>{{ __('Location') }} <span class="text-danger">*</span></label>
							<select class="form-control location" name="location">
								<option selected disabled value="">{{ __('Select Location') }}</option>
								@foreach($locations as $location)
								<option value="{{ $location->id }}" data-method="{{ $location->child_relation }}">{{ $location->name }}</option>
								@endforeach

							</select>
						</div>
						@endif
						
						<div class="form-group col-xl-6">
							<label>{{ __('Delivery Address') }}  <span class="text-danger">*</span></label>
							<input type="text" placeholder="Delivery Address" name="delivery_address" class="form-control" value="" required="">
						</div>
						
						<div class="form-group col-xl-6">
							<label>{{ __('Zip Code') }}<span class="text-danger">*</span></label>
							<input type="number" placeholder="Zip Code" name="zip_code" class="form-control" value="" required="">
						</div>
						
						@endif
						<div class="form-group col-xl-12 mb-0">
							<label>{{ __('Order Notes') }}</label>
							<textarea name="comment" rows="5" class="form-control" placeholder="Order Notes (Optional)"></textarea>
						</div>
					</div>
					<!-- Buyer Info End -->

				</div>
				<div class="col-xl-5 checkout-billing">
					<!-- Order Details Start -->
					<table class="bigbag_responsive-table">
						<thead>
							<tr>
								<th>{{ __('Product') }}</th>
								<th>{{ __('Qunantity') }}</th>
								<th>{{ __('Total') }}</th>
							</tr>
						</thead>
						<tbody>
							@foreach(Cart::content() as $row)
							<tr>
								<td data-title="Product">
									<div class="bigbag_cart-product-wrapper">
										<div class="bigbag_cart-product-body">
											<h6> <a href="{{ url('/product/'.$row->name.'/'.$row->id) }}">{{ $row->name }}</a> </h6>
											@foreach ($row->options->attribute as $attribute)
                                            <p><b>{{ $attribute->attribute->name }}</b> : {{ $attribute->variation->name }}</p>
                                            @endforeach
											@foreach ($row->options->options as $op)
											<p>{{ $op->name }}</p>
                                            @endforeach
											<p>{{ $row->qty }} {{ __('Piece') }}</p>
										</div>
									</div>
								</td>
								<td data-title="Quantity">x{{ $row->qty }}</td>
								<td data-title="Total"> <strong>{{ amount_format($row->price) }}</strong> </td>
							</tr>
							@endforeach
							<tr class="total none shipping_charge">
								<td>
									<h6 class="mb-0">{{ __('Shipping Charge') }}</h6>
								</td>
								<td></td>
								<td> <strong id="shipping_charge"></strong> </td>
							</tr>
							<tr class="total">
								<td>
									<h6 class="mb-0">{{ __('Tax') }}</h6>
								</td>
								<td></td>
								<td> <strong >{{ amount_format(Cart::tax()) }}</strong> </td>
							</tr>
							<tr class="total">
								<td>
									<h6 class="mb-0">{{ __('Grand Total') }}</h6>
								</td>
								<td></td>
								<td> <strong class="total_cost_amount">{{ amount_format(Cart::total()) }}</strong> </td>
							</tr>
						</tbody>
					</table>
					<div  class="bigbag-checkout-payment none">
						<h6>{{ __('Select Shipping Mode') }}</h6>
						<hr>

						<ul class="wc_payment_methods payment_methods shipping_methods">
							
						</ul>						
				    </div>
					<div id="payment" class="bigbag-checkout-payment mt-3">

						<h6>{{ __('Select Payment Mode') }}</h6>
						<hr>

						<ul class="wc_payment_methods payment_methods">
							@foreach($getways as $key => $row)
							@php
							$data=json_decode($row->content);
							@endphp
							<li class="wc_payment_method payment_method_bacs">
								<input id="payment_method_{{ $key }}" type="radio" class="input-radio" name="payment_method" value="{{ $row->category_id  }}" @if($key==0) checked="checked" @endif>
								<label for="payment_method_{{ $key }}">
								{{ $data->title }} </label>
								@if(isset($data->additional_details))
								<div class="payment_box payment_method_{{ $key }}">
									<p>{{ $data->additional_details }}</p>
								</div>
								@endif
							</li>
							@endforeach
						</ul>						
				    </div>

				@if(Cart::count() > 0)
				<button type="submit" class="bigbag_btn-custom primary btn-block mt-2 checkout_submit_btn">{{ __('Place Order') }}</button>
				@endif
				<!-- Order Details End -->				
			</div>
		</div>	
</div>
</div> 
</form>
<input type="hidden" value="{{ str_replace(',','',number_format(Cart::total(),2)) }}" id="total_amount"/>
@endsection
@push('js')
<script src="{{ asset('frontend/bigbag/js/checkout.js') }}"></script>
@endpush