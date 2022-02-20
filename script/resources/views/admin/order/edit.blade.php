@extends('layouts.app')
@section('head')
@include('layouts.partials.headersection',['title'=>'Edit Order'])
@endsection
@section('content')
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<h4>{{ __('Edit Order') }}</h4>

			</div>
			<div class="card-body">

				<form class="basicform" action="{{ route('admin.order.update',$info->id) }}" method="post">
					@csrf
					@method('PUT')

					<div class="form-group row mb-4">
						<label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" >{{ __('Order Id') }}</label>
						<div class="col-sm-12 col-md-7">
							<input type="text" class="form-control" name="order_no" value="{{ $info->order_no }}">
						</div>
					</div>



					<div class="form-group row mb-4">
						<label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" >{{ __('Transaction Method') }}</label>
						<div class="col-sm-12 col-md-7">
							<select class="form-control" name="category_id">
								
								@foreach($payment_getway as $row)
								<option value="{{ $row->id }}" @if($info->category_id == $row->id) selected="" @endif>{{ $row->name }}</option>
								@endforeach
							</select>
						</div>
					</div>

					<div class="form-group row mb-4">
						<label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" >{{ __('Transaction Id') }}</label>
						<div class="col-sm-12 col-md-7">
							<input type="text" class="form-control" name="trx" value="{{ $info->trx }}">
						</div>
					</div>
					<div class="form-group row mb-4">
						<label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" >{{ __('Amount') }}</label>
						<div class="col-sm-12 col-md-7">
							<input type="text" class="form-control" name="amount" value="{{ $info->amount }}">
						</div>
					</div>
					<div class="form-group row mb-4">
						<label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" >{{ __('Tax') }}</label>
						<div class="col-sm-12 col-md-7">
							<input type="text" class="form-control" name="tax" value="{{ $info->tax }}">
						</div>
					</div>

					<div class="form-group row mb-4">
						<label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" >{{ __('Payment Status') }}</label>
						<div class="col-sm-12 col-md-7">
							@php
							$payment_status=$info->payment_status ?? null;
							@endphp
							<select class="form-control" name="payment_status">
								<option value="1" @if($payment_status==1) selected="" @endif>{{ __('Complete') }}</option>
								
								<option value="2" @if($payment_status==2) selected="" @endif>{{ __('Pending') }}</option>

								<option value="0" @if($payment_status==0) selected="" @endif>{{ __('Decline') }}</option>
							</select>
						</div>
					</div>

					<div class="form-group row mb-4">
						<label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" >{{ __('Plan') }}</label>
						<div class="col-sm-12 col-md-7">
							<select class="form-control" name="plan">
								@foreach($posts as $row)
								<option value="{{ $row->id }}" @if($info->plan_info->id==$row->id) selected="" @endif>{{ $row->name }}</option>
								@endforeach
							</select>
						</div>
					</div>

					<div class="form-group row mb-4">
						<label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" >{{ __('Order Status') }}</label>
						<div class="col-sm-12 col-md-7">

							<select class="form-control" name="order_status">
								<option value="1" @if($info->status===1) selected="" @endif>{{ __('Approved') }}</option>
								<option value="2" @if($info->status===2) selected="" @endif>{{ __('Pending') }}</option>
								<option value="3" @if($info->status===3) selected="" @endif>{{ __('Expired') }}</option>
								<option value="0" @if($info->status===0) selected="" @endif>{{ __('Decline') }}</option>

							</select>
						</div>
					</div>
					@if($info->status==2)
					<div class="form-group row mb-4">
						<label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" >{{ __('Apply The Subscription ?') }}</label>
						<div class="col-sm-12 col-md-7">

							<select class="form-control" name="subscription_status" id="notification_status">
							<option value="yes">{{ __('Yes') }}</option>
							<option value="no" selected="">{{ __('No') }}</option>
						</select>
						</div>
					</div>
					@endif
					<div class="form-group row mb-4">
						<label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" >{{ __('Send Email To Customer ?') }}</label>
						<div class="col-sm-12 col-md-7">

							<select class="form-control" name="notification_status" id="notification_status">
							<option value="yes">{{ __('Yes') }}</option>
							<option value="no" selected="">{{ __('No') }}</option>
						</select>
						</div>
					</div>

					<div class="form-group row mb-4 " id="email_content">
						<label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" >{{ __('Email Comment') }}</label>
						<div class="col-sm-12 col-md-7">
							<textarea class="form-control" name="content"></textarea>
						</div>
					</div>
					

					

					<div class="form-group row mb-4">
						<label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
						<div class="col-sm-12 col-md-7">
							<button class="btn btn-primary basicbtn" type="submit">{{ __('Save') }}</button>
						</div>
					</div>

					<small class="text-center">Note: <span class="text-danger">{{ __('If This Order Does Not Used Have Any Payment Getway The Payment Status Will Not Update') }}</span></small>
				</form>
			</div>
		</div>
	</div>
</div>

@endsection
@push('js')
<script src="{{ asset('assets/js/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('assets/js/form.js?v=1.0') }}"></script>
<script src="{{ asset('assets/js/admin/order_create.js') }}"></script>
@endpush