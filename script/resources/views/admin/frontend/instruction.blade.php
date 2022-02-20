@extends('admin.frontend.app')
@section('append')
<form method="post"  action="{{ route('admin.appearance.update',$type) }}" class="basicform">
	@csrf
	@method('PUT')
	<div class="form-group">
		<label>{{ __('DNS Configure Instruction') }}</label>
		<textarea class="form-control" name="dns_configure_instruction" required="">{{ $info->dns_configure_instruction ?? '' }}</textarea>
	</div>
	<div class="form-group">
		<label>{{ __('Support Instruction') }}</label>
		<textarea class="form-control" name="support_instruction" required="">{{ $info->support_instruction ?? '' }}</textarea>
	</div>
	
	
	<div class="form-group">
		<button class="btn btn-primary basicbtn" type="submit">{{ __('Save Changes') }}</button>
	</div>
</form>
@endsection
@push('js')
<script src="{{ asset('assets/js/form.js') }}"></script>
@endpush