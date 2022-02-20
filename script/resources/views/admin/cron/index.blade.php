@extends('layouts.app')
@section('head')
@include('layouts.partials.headersection',['title'=>'Cron Jobs'])
@endsection
@section('content')

<div class="row">
	<div class="col-12">			
		<div class="card">
			<div class="card-header">
				<h4><i class="fas fa-circle"></i> {{ __('Make Expired Membership') }} <code>{{ __('Once/day') }}</code></h4>
				
				
			</div>
			<div class="card-body">
				<div class="code"><p>curl -s {{ url('/cron/make-expire-order') }}</p></div>
			</div>
		</div>
	</div>

	<div class="col-12">			
		<div class="card">
			<div class="card-header">
				<h4><i class="fas fa-circle"></i> {{ __('Membership Will Expiration Alert') }} <code>{{ __('Once/day') }}</code></h4>
			</div>
			<div class="card-body">
				<div class="code"><p>curl -s {{ url('/cron/make-alert-before-expire-plan') }}</p></div>
			</div>
		</div>
	</div>
	<div class="col-12">			
		<div class="card">
			<div class="card-header">
				<h4><i class="fas fa-circle"></i> {{ __('Reset Offer Product Price') }} <code>{{ __('Once/day') }}</code></h4>
			</div>
			<div class="card-body">
				<div class="code"><p>curl -s {{ url('/cron/reset_product_price') }}</p></div>
			</div>
		</div>
	</div>
	<div class="col-12">			
		<div class="card">
			<div class="card-header">
				<h4><i class="fas fa-circle"></i> {{ __('Send Mail with Queue') }}</h4>
				
			</div>
			<div class="card-body">
				<span>{{ __('Note') }}: <span class="text-danger">{{ __('You Need Add This Command In Your Supervisor And Also Make QUEUE_MAIL On From System Settings To Mail Configuration.') }}</span></span><br>
				<span>{{ __('Command Path') }}: <span class="text-danger">{{ base_path() }}</span></span>
				<div class="code"><p>{{ __('php artisan queue:work') }}</p></div>

				
			</div>
		</div>
	</div>


	<div class="col-12">			
		<div class="card">
			<div class="card-header">
				<h4>{{ __('Customize Cron Jobs') }}</h4>
			</div>
			<form class="basicform" method="post" accept="{{ route('admin.cron.store') }}">
				@csrf
			
			<div class="card-body">
				<div class="row">
					
					

					<div class="col-sm-6">
						<div class="form-group">
							<label>{{ __('Make Alert To Customer The Subscription Will Ending Soon') }}</label><br>
							<span>{{ __('Note:') }} <span class="text-danger"><small>{{ __('It Will Send Notification Everyday Within The Selected Days') }}</small></span></span>
							<select class="form-control" name="send_mail_to_will_expire_within_days">
								<option value="7" @if($info->send_mail_to_will_expire_within_days==7)  selected=""  @endif>{{ __('7 Days') }}</option>
								<option value="6" @if($info->send_mail_to_will_expire_within_days==6)  selected=""  @endif>{{ __('6 Days') }}</option>
								<option value="5" @if($info->send_mail_to_will_expire_within_days==5)  selected=""  @endif>{{ __('5 Days') }}</option>
								<option value="4" @if($info->send_mail_to_will_expire_within_days==4)  selected=""  @endif>{{ __('4 Days') }}</option>
								<option value="3" @if($info->send_mail_to_will_expire_within_days==3)  selected=""  @endif>{{ __('3 Days') }}</option>
								<option value="2" @if($info->send_mail_to_will_expire_within_days==2)  selected=""  @endif>{{ __('2 Days') }}</option>
								<option value="1" @if($info->send_mail_to_will_expire_within_days==1)  selected=""  @endif>{{ __('1 Days') }}</option>
								
							</select>
						</div>
					</div>
				
					<div class="col-sm-6">
						<div class="form-group">
							<label>{{ __('Auto Approve To Plan After Successfull Payment') }}</label>

							<select class="form-control mt-4" name="auto_approve">
								<option value="yes" @if($info->auto_approve == 'yes') selected="" @endif>{{ __('Yes') }}</option>
								<option value="no" @if($info->auto_approve == 'no') selected="" @endif>{{ __('No') }}</option>
							</select>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label>{{ __('Alert Message Before Expire The Subscription') }} <small>(HTML supported)</small></label>

							<textarea name="alert_message" class="form-control">{{ $info->alert_message }}</textarea>

						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label>{{ __('Alert Message After Expire The Subscription') }} <small>(HTML supported)</small></label>

							<textarea name="expire_message" class="form-control">{{ $info->expire_message }}</textarea>

						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label>{{ __('Alert Message After Expire The Trial Subscription') }} <small>(HTML supported)</small></label>

							<textarea name="trial_expired_message" class="form-control">{{ $info->trial_expired_message }}</textarea>

						</div>
					</div>
					<div class="col-sm-12">
						<button class="btn btn-primary basicbtn" type="submit">{{ __('Save Changes') }}</button>
					</div>
					</form>	
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@push('js')

<script src="{{ asset('assets/js/form.js') }}"></script>
@endpush