@extends('admin.frontend.app')
@section('append')
<form method="post" action="{{ route('admin.appearance.update',$type) }}" class="basicform" enctype="multipart/form-data">
	@csrf
	@method('PUT')

	<div class="form-group">
		<label>{{ __('Top Image') }}</label>
		<input type="file" accept="image/*" class="form-control" name="top_image">
	</div>
	<div class="form-group">
		<label>{{ __('Center Image') }}</label>
		<input type="file" accept="image/*" class="form-control" name="center_image">
	</div>
	<div class="form-group">
		<label>{{ __('Bottom Image') }}</label>
		<input type="file" accept="image/*" class="form-control" name="bottom_image">
	</div>
	
	<div class="form-group">
		<label>{{ __('Area Title') }}</label>
		<input type="text"  class="form-control" name="area_title" value="{{ $info->area_title ?? '' }}">
	</div>
	<div class="form-group">
		<label>{{ __('Area Content') }}</label>
		<textarea class="form-control" name="description">{{ $info->description ?? '' }}</textarea>
	</div>
	<div class="form-group">
		<label>{{ __('Button Link') }}</label>
		<input type="text"  class="form-control" name="btn_link" value="{{ $info->btn_link ?? '' }}">
	</div>
	<div class="form-group">
		<label>{{ __('Button Text') }}</label>
		<input type="text"  class="form-control" name="btn_text" value="{{ $info->btn_text ?? '' }}">
	</div>

	<div class="form-group">
		<button class="btn btn-primary basicbtn" type="submit">{{ __('Save Changes') }}</button>
	</div>
	@endsection
	@push('js')
</form>
<script src="{{ asset('assets/js/form.js') }}"></script>

@endpush