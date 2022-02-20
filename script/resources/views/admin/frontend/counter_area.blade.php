@extends('admin.frontend.app')
@section('append')
<form method="post"  action="{{ route('admin.appearance.update',$type) }}" class="basicform">
	@csrf
	@method('PUT')
	<div class="form-group">
		<label>{{ __('Happy Customers') }}</label>
		<input type="number" name="happy_customer" value="{{ $info->happy_customer ?? '' }}" class="form-control">
	</div>
	<div class="form-group">
		<label>{{ __('Total Reviews') }}</label>
		<input type="number" name="total_reviews" value="{{ $info->total_reviews ?? '' }}" class="form-control">
	</div>
	<div class="form-group">
		<label>{{ __('Total Domains') }}</label>
		<input type="number" name="total_domain" value="{{ $info->total_domain ?? '' }}" class="form-control">
	</div>
	<div class="form-group">
		<label>{{ __('Community Members') }}</label>
		<input type="number" name="community_member" value="{{ $info->community_member ?? '' }}" class="form-control">
	</div>
	
	<div class="form-group">
		<button class="btn btn-primary basicbtn" type="submit">{{ __('Save Changes') }}</button>
	</div>
</form>
@endsection
@push('js')
<script src="{{ asset('assets/js/form.js') }}"></script>
@endpush