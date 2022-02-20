@extends('admin.frontend.app')
@section('append')
<form method="post" action="{{ route('admin.appearance.update','header') }}" class="basicform">
	@csrf
	@method('PUT')
	<div class="form-group">
		<label>{{ __('Header Small Title') }}</label>
		<input type="text" name="title"  class="form-control" required="" value="{{ $info->title ?? '' }}">
	</div>
	<div class="form-group">
		<label>{{ __('Header Highlight Title') }}</label>
		<input type="text" name="highlight_title"  class="form-control" required="" value="{{ $info->highlight_title ?? '' }}">
	</div>
	
	<div class="form-group">
		<label>{{ __('Header Description') }}</label>
		<textarea class="form-control" name="description">{{ $info->description ?? '' }}</textarea>
	</div>
	
	<div class="form-group">
		<label>{{ __('Header Image') }}</label>
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