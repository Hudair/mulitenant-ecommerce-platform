@extends('layouts.app')
@section('head')
@include('layouts.partials.headersection',['title'=>'Language'])
@endsection
@section('content')
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<h4>{{ __('Edit Language') }}</h4>
				<div class="card-header-action">
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
						{{ __('Add New Key') }}
					</button>
				</div>

			</div>
			<div class="card-body">
				<div class="row mb-3">
						<div class="col-sm-5"><h6><b>{{ __('Key') }}</b></h6></div>
						<div class="col-sm-7"><h6><b>{{ __('Value') }}</b></h6></div>
				</div>
				<form class="basicform" action="{{ route('admin.language.update',$id) }}" method="post">
					@csrf
					@method('PUT')
					@foreach($posts as $key => $row)
					<div class="row mb-2">
						<div class="col-sm-5">{{ $key }}</div>
						<div class="col-sm-7"><input type="text" name="values[{{ $key }}]" class="form-control" value="{{ $row }}"></div>
					</div>
					@endforeach
						
					      

					<div class="form-group row mb-4">
						
						<div class="col-sm-12 col-md-12">
							<button class="btn btn-primary basicbtn" type="submit">{{ __('Save Changes') }}</button>
						</div>
					</div>
				</form>
				
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<form method="post" class="basicform_with_reset" action="{{ route('admin.language.add_key') }}">
		@csrf
	<input type="hidden" name="id" value="{{ $id }}">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{ __('Add Key For ') }} <b>{{ $id }}</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="form-group">
      	<label>{{ __('Key') }}</label>
      	 <input type="text" name="key" class="form-control" required>
      </div>
      <div class="form-group">
      	<label>{{ __('Value') }}</label>
      	 <input type="text" name="value" class="form-control" required>
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
        <button type="submit" class="btn btn-primary basicbtn">{{ __('Save changes') }}</button>
      </div>
      </form>
    </div>
  </div>
</div>
@endsection
@push('js')
<script src="{{ asset('assets/js/form.js') }}"></script>
@endpush