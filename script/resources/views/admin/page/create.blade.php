@extends('layouts.app')
@section('content')
<div class="row">
	<div class="col-lg-9">      
		<div class="card">
			<div class="card-body">
				<h4>{{ __('Add new Page') }}</h4>
				<form method="post" action="{{ route('admin.page.store') }}" >
					@csrf
					<div class="custom-form pt-20">
						@php
						$arr['title']= 'Page Title';
						$arr['id']= 'name';
						$arr['type']= 'text';
						$arr['placeholder']= 'Page Title';
						$arr['name']= 'title';
						$arr['is_required'] = true;

						echo  input($arr);

						

						$arrn['title']= 'Page Content';
						$arrn['name']= 'content';
						$arr['class']= 'content';
						echo  editor($arrn);


						$arr['title']= 'Meta Description';
						$arr['id']= 'excerpt';
						$arr['placeholder']= 'Meta description';
						$arr['name']= 'excerpt';
						$arr['is_required'] = true;
						
						echo  textarea($arr);
						@endphp
						
					</div>
				</div>
			</div>

		</div>
		<div class="col-lg-3">
			<div class="single-area">
				<div class="card">
					<div class="card-body">
						
						
						<div class="btn-publish">
							<button type="submit" class="btn btn-primary col-12"><i class="fa fa-save"></i> {{ __('Save') }}</button>
						</div>
					</div>
				</div>
			</div>
		<div class="single-area">
				<div class="card sub">
					<div class="card-body">
						<h5>{{ __('Status') }}</h5>
						<hr>
						<select class="custom-select mr-sm-2" id="inlineFormCustomSelect" name="status">
							<option value="1">{{ __('Published') }}</option>
							<option value="2">{{ __('Draft') }}</option>

						</select>
					</div>
				</div>
			</div>
		</div>



	<input type="hidden" name="type" value="1">
	<input type="hidden"  name="post_type" value="page">
</form>
@endsection
@push('js')
<script src="{{ asset('assets/js/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('assets/js/form.js?v=1.0') }}"></script>
@endpush