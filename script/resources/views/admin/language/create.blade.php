@extends('layouts.app')
@push('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.min.css') }}">
@endpush
@section('head')
@include('layouts.partials.headersection',['title'=>'Language'])
@endsection
@section('content')
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<h4>{{ __('Create Language') }}</h4>
				<div class="card-header-action">

				</div>

			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-sm-3"></div>
				<div class="col-sm-7">
					@if ($errors->any())
					<div class="alert alert-danger">
						<ul>
							@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>
					@endif
				</div>
				</div>
				<form class="basicform" action="{{ route('admin.language.store') }}" method="post">
					@csrf
					<div class="form-group row mb-4">
						<label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" >{{ __('Select Language') }}</label>
						<div class="col-sm-12 col-md-7">
							<select class="form-control select2" name="language">
								@foreach($posts as $row)
								<option value="{{ $row->code }}">{{ $row->name }}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="form-group row mb-4">
						<label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" >{{ __('Language Name') }}</label>
						<div class="col-sm-12 col-md-7">
							<input type="text" name="language_name" class="form-control" required="" placeholder="English">
						</div>
					</div>             

					<div class="form-group row mb-4">
						<label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
						<div class="col-sm-12 col-md-7">
							<button class="btn btn-primary basicbtn" type="submit">{{ __('Save And Next') }}</button>
						</div>
					</div>
				</form>
				<span class="text-center">Note: <span class="text-danger">{{ __('If You Already Created Language In Before It Will Replace It From First') }}</span></span>
			</div>
		</div>
	</div>
</div>
@endsection
@push('js')
<script src="{{ asset('assets/js/select2.min.js') }}"></script>
@endpush