@extends('layouts.app')
@section('head')
@include('layouts.partials.headersection',['title'=>'Create Plan'])
@endsection
@section('content')
<div class="row">
	<div class="col-12 mt-2">
		<div class="card">
			<div class="card-body">
				<form method="post" action="{{ route('admin.plan.store') }}" class="basicform_with_reset">
					@csrf
					<div class="row">
						<div class="col-sm-8">
							<div class="form-group">
								<label>{{ __('Plan Name') }}</label>
								<input type="text" name="name" class="form-control" required> 
							</div>

							<div class="form-group">
								<label>{{ __('Plan description') }}</label>
								<input type="text" name="description" class="form-control" required> 
								
							</div> 


							<div class="form-group">
								<label>{{ __('Plan Price') }}</label>
								<input type="number" step="any" name="price" class="form-control" required> 
							</div>
							

							<div class="form-group">
								<label>{{ __('Product Limit') }}</label>
								<input type="number"  name="product_limit" class="form-control" required> 
							</div>
							<div class="form-group">
								<label>{{ __('Storage Limit') }} (MB)</label>
								<input type="number"  name="storage" class="form-control" required> 
							</div>
							<div class="form-group">
								<label>{{ __('Customer Limit') }}</label>
								<input type="number"  name="customer_limit" class="form-control" required> 
							</div>
							<div class="form-group">
								<label>{{ __('Category Limit') }}</label>
								<input type="number"  name="category_limit" class="form-control" required> 
							</div>
							<div class="form-group">
								<label>{{ __('Location Limit') }}</label>
								<input type="number"  name="location_limit" class="form-control" required> 
							</div>
							<div class="form-group">
								<label>{{ __('Brand Limit') }}</label>
								<input type="number"  name="brand_limit" class="form-control" required> 
							</div>
							<div class="form-group">
								<label>{{ __('Variation Limit') }}</label>
								<input type="number"  name="variation_limit" class="form-control" required> 
							</div>
							

							<div class="form-group">
								<button class="btn btn-primary basicbtn" type="submit" >{{ __('Save') }}</button>
							</div>
						</div>
						<div class="col-sm-4">
							
							<div class="form-group">
								<label>{{ __('Duration') }}</label>
								<select class="form-control" name="days">
									<option value="365">{{ __('Yearly') }}</option>
									<option value="30">{{ __('Monthly') }}</option>
									<option value="7">{{ __('Weekly') }}</option>
								</select>
							</div>
							<div class="form-group">
								<label>{{ __('Custom Domain') }}</label>
								<select class="form-control" name="custom_domain">
									<option value=true>{{ __('Enable') }}</option>
									<option value=false>{{ __('Disable') }}</option>
								</select>
							</div>
							<div class="form-group">
								<label>{{ __('Inventory') }}</label>
								<select class="form-control" name="inventory">
									<option value=true>{{ __('Enable') }}</option>
									<option value=false>{{ __('Disable') }}</option>
								</select>
							</div>
							<div class="form-group">
								<label>{{ __('POS') }}</label>
								<select class="form-control" name="pos">
									<option value=true>{{ __('Enable') }}</option>
									<option value=false>{{ __('Disable') }}</option>
								</select>
							</div>
							<div class="form-group">
								<label>{{ __('Customer Panel Access') }}</label>
								<select class="form-control" name="customer_panel">
									<option value=true>{{ __('Enable') }}</option>
									<option value=false>{{ __('Disable') }}</option>
								</select>
							</div>
							<div class="form-group">
								<label>{{ __('PWA') }}</label>
								<select class="form-control" name="pwa">
									<option value=true>{{ __('Enable') }}</option>
									<option value=false>{{ __('Disable') }}</option>
								</select>
							</div>
							<div class="form-group">
								<label>{{ __('Whatsapp modules') }}</label>
								<select class="form-control" name="whatsapp">
									<option value=true>{{ __('Enable') }}</option>
									<option value=false>{{ __('Disable') }}</option>
								</select>
							</div>
							<div class="form-group">
								<label>{{ __('Support') }}</label>
								<select class="form-control" name="live_support">
									<option value=true>{{ __('Enable') }}</option>
									<option value=false>{{ __('Disable') }}</option>
								</select>
							</div>
							<div class="form-group">
								<label>{{ __('QR code') }}</label>
								<select class="form-control" name="qr_code">
									<option value=true>{{ __('Enable') }}</option>
									<option value=false>{{ __('Disable') }}</option>
								</select>
							</div>
							<div class="form-group">
								<label>{{ __('Facebook Pixel') }}</label>
								<select class="form-control" name="facebook_pixel">
									<option value=true>{{ __('Enable') }}</option>
									<option value=false>{{ __('Disable') }}</option>
								</select>
							</div>
							<div class="form-group">
								<label>{{ __('Custom Css') }}</label>
								<select class="form-control" name="custom_css">
									<option value=true>{{ __('Enable') }}</option>
									<option value=false>{{ __('Disable') }}</option>
								</select>
							</div>
							<div class="form-group">
								<label>{{ __('Custom Js') }}</label>
								<select class="form-control" name="custom_js">
									<option value=true>{{ __('Enable') }}</option>
									<option value=false>{{ __('Disable') }}</option>
								</select>
							</div>
							<div class="form-group">
								<label>{{ __('GTM') }}</label>
								<select class="form-control" name="gtm">
									<option value=true>{{ __('Enable') }}</option>
									<option value=false>{{ __('Disable') }}</option>
								</select>
							</div>
							<div class="form-group">
								<label>{{ __('Google Analytics') }}</label>
								<select class="form-control" name="google_analytics">
									<option value=true>{{ __('Enable') }}</option>
									<option value=false>{{ __('Disable') }}</option>
								</select>
							</div>
							
							<div class="form-group">
								<label>{{ __('Is Featured ?') }}</label>
								<select class="form-control" name="featured">
									<option value="0">{{ __('No') }}</option>
									<option value="1">{{ __('Yes') }}</option>
								</select>
							</div>
							
							
							<div class="form-group">
								<label>{{ __('Status') }}</label>
								<select class="form-control" name="status">
									<option value="1">{{ __('Enable') }}</option>
									<option value="0">{{ __('Disable') }}</option>
								</select>
							</div>
						</div>
					</div>					
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
@push('js')
<script src="{{ asset('assets/js/form.js') }}"></script>
@endpush