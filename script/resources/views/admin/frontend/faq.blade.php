@extends('admin.frontend.app')
@section('append')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form method="post" action="{{ route('admin.appearance.update','faqs') }}" class="basicform_with_reload" enctype="multipart/form-data">
	@csrf
	@method('PUT')
<div class="form-group">
	<label>{{ __('Preview Image') }}</label>
	<input type="file" accept="image/*" name="file" class="form-control">
</div>
<div class="form-group">
	<label>{{ __('Area Content') }}</label>
	<textarea class="form-control" name="content">{{ $info->description ?? '' }}</textarea>
</div>
<div class="form-group">
	<button class="btn btn-primary" type="submit">{{ __('Save Changes') }}</button>
</div>
</form>
@endsection
@push('js')

<script src="{{ asset('assets/js/ckeditor/ckeditor.js') }}"></script>s
@endpush