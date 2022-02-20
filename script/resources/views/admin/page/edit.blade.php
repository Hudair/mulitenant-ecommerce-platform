@extends('layouts.app')
@section('content')
<div class="row">
	<div class="col-lg-9">      
		<div class="card">
			<div class="card-body">
				<h4>{{ __('Edit Page') }}</h4>
				<form method="post" action="{{ route('admin.page.update',$info->id) }}">
					@csrf
					@method('PUT')

					<div class="custom-form pt-20">

						@php
						$arr['title']= 'Page Title';
						$arr['id']= 'name';
						$arr['type']= 'text';
						$arr['placeholder']= 'Page Title';
						$arr['name']= 'title';
						$arr['is_required'] = true;
						$arr['value'] = $info->title;

						echo  input($arr);

						
							
						
						$arr['title']= 'Page Content';
						$arr['name']= 'content';
						$arr['id']= 'content';
						$arr['value'] = $info->content->value;
						
						echo  editor($arr);


						$arr['title']= 'Meta Description';
						$arr['id']= 'excerpt';
						$arr['placeholder']= 'short description';
						$arr['name']= 'excerpt';
						$arr['is_required'] = false;
						$arr['value'] = $info->excerpt->value;

						echo  textarea($arr);
					
						@endphp


					</div>
				</div>
			</div>
			<div class="card">
				<div class="card-body">
					<h4>{{ __('Search Engine Optimization') }}</h4>
					<div class="search-engine">
						<h6 class="pt-15 page-title-seo" id="seotitle">{{ $info->title }}</h6>
						<a href="#" class="text-success" id="seourl">{{ url('/').'/page/'.$info->slug }}</a>
						<p id="seodescription">{{ $info->excerpt->content }}</p>
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
							<option value="1" @if($info->status==1) selected="" @endif>{{ __('Published') }}</option>
							<option value="2" @if($info->status==2) selected="" @endif>{{ __('Draft') }}</option>

						</select>
					</div>
				</div>
			</div>
	</div>		
		
</form>
@endsection

@push('js')
<script src="{{ asset('assets/js/form.js?v=1.0') }}"></script>
<script src="{{ asset('assets/js/ckeditor/ckeditor.js') }}"></script>
@endpush