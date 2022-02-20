@extends('admin.frontend.app')
@section('append')
<form method="post"  action="{{ route('admin.appearance.update','contact') }}" class="basicform">
	@csrf
	@method('PUT')
	<div class="form-group">
		<label>{{ __('Area Image') }}</label>
		<input type="file" name="file" value="" class="form-control" accept="image/*">
	</div>
	<div class="form-group">
		<button class="btn btn-primary basicbtn" type="submit">{{ __('Save Changes') }}</button>
	</div>
</form>
@endsection
@push('js')
<script src="{{ asset('assets/js/form.js') }}"></script>
@endpush