@extends('layouts.app')
@section('head')
@include('layouts.partials.headersection',['title'=>'Templates'])
@endsection
@section('content')
<div class="row">
	<div class="col-12 mt-2">
		<div class="card">
			<div class="card-body">
				
					<div class="float-left mb-1">
					
					</div>
					<div class="float-right">
						@can('template.upload')
						<a href="#" data-toggle="modal" data-target="#exampleModal" class="btn btn-primary">{{ __('Upload Theme') }}</a>
						@endcan
					</div>

					<div class="table-responsive">
						<table class="table table-striped table-hover text-center table-borderless">
							<thead>
								<tr>
									<th><i class="fa fa-image"></i></th>
									<th>{{ __('Name') }}</th>
									<th>{{ __('Assets root') }}</th>
									<th>{{ __('View root') }}</th>
									<th>{{ __('Total Installed') }}</th>

									<th>{{ __('Uploaded at') }}</th>
									<th>{{ __('Action') }}</th>
								</tr>
							</thead>
							<tbody>
								@foreach($posts as $row)
								<tr id="row{{ $row->id }}" >
									<td><img src="{{ asset($row->asset_path.'/screenshot.png') }}" height="100"></td>
									<td>{{ $row->name }}</td>
									<td>{{ $row->asset_path }}</td>
									<td>{{ $row->src_path }}</td>
									<td>{{ $row->installed_count }}</td>
									<td>{{ $row->created_at->format('d-F-Y') }}</td>
									<td>@if( $row->installed_count == 0) <a href="{{ route('admin.templates.delete',$row->id) }}" class="btn btn-danger cancel"><i class="fa fa-trash"></i></a> @endif</td>
								</tr>
								@endforeach
							</tbody>
							<tfoot>
								<tr>
									<th><i class="fa fa-image"></i></th>
									<th>{{ __('Name') }}</th>
									<th>{{ __('Assets root') }}</th>
									<th>{{ __('View root') }}</th>
									<th>{{ __('Total Installed') }}</th>

									<th>{{ __('Uploaded at') }}</th>
									<th>{{ __('Action') }}</th>
								</tr>
							</tfoot>
						</table>
					</div>
				
			</div>
		</div>
	</div>
</div>

@can('template.upload')
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{ __('Upload New Theme') }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="{{ route('admin.template.store') }}" class="basicform_with_reload">
      	@csrf
      
      <div class="modal-body">
      	<div class="form-group">
      		<label>{{ __('Select File') }}</label>
      		<input type="file" class="form-control" accept=".zip" name="file" required="">
      	</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
        <button type="submit" class="btn btn-primary basicbtn">{{ __('Upload') }}</button>
      </div>
      </form>
    </div>
  </div>
</div>
@endcan
@endsection

@push('js')
<script src="{{ asset('assets/js/form.js') }}"></script>
@endpush