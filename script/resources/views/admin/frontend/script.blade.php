@extends('admin.frontend.app')
@section('append')
<form method="post"  action="{{ route('admin.appearance.update',$type) }}" class="basicform">
	@csrf
	@method('PUT')
	<div class="form-group">
		<label>{{ __('Additional CSS') }}</label>
		<textarea class="form-control" name="additional_css" required="">{{ $additional_css ?? '' }}</textarea>
	</div>
	<div class="form-group">
		<label>{{ __('Additional JS') }}</label>
		<textarea class="form-control" name="additional_js" required="">{{ $additional_js ?? '' }}</textarea>
	</div>
	<div class="form-group">
		<label>{{ __('Add Livechat js for support') }}</label>
		<textarea class="form-control" name="support_js" required="">{{ $support ?? '' }}</textarea>
	</div>
	
	
	
	<div class="form-group">
		<button class="btn btn-primary basicbtn" type="submit">{{ __('Save Changes') }}</button>
	</div>
</form>
@endsection
@push('js')
<script src="{{ asset('assets/js/form.js') }}"></script>
@endpush