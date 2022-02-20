@extends('layouts.app')

@section('content')
<div class="">
	<div class="row justify-content-center">
		<div class="col-12">
			
			<div class="card">
				<div class="card-body">
					

					<form method="post" action="{{ route('admin.galleries.destroys') }}" class="basicform_with_reload">
						@csrf
						<div class="float-left mb-1">
							@can('order.delete')
							<div class="input-group">
								<select class="form-control selectric" name="status">
									<option value="" >{{ __('Select Action') }}</option>
					
									<option value="delete" >{{ __('Delete Permanently') }}</option>
									
								</select>
								<div class="input-group-append">                                            
									<button class="btn btn-primary basicbtn" type="submit">{{ __('Submit') }}</button>
								</div>
							</div>
							@endcan
						</div>
						<div class="float-right mb-1">
							@can('gallery.create')
							<a href="#" class="btn btn-primary float-right" data-toggle="modal" data-target="#exampleModal">{{ __('Create Gallery') }}</a>
							@endcan
						</div>

						<div class="table-responsive">
							<table class="table table-hover table-nowrap card-table text-center">
								<thead>
									<tr>
										<th class="text-left" ><input type="checkbox" class="checkAll"></th>

										<th class="text-left"><i class="fa fa-image"></i></th>
										<th>{{ __('URl') }}</th>
										
									</tr>
								</thead>
								<tbody class="list font-size-base rowlink" data-link="row">
									@foreach($posts ?? [] as $key => $row)
									<tr>
										<td class="text-left"><input type="checkbox" name="ids[]" value="{{ $row->id }}"></td>
										<td><img class="float-left text-left" src="{{ asset($row->preview->content) }}" height="100"></td>
										<td>{{ $row->name }}</td>
									</tr>		
									@endforeach
								</tbody>
							</table>

						</div>
					</div>
				</form>
				<div class="card-footer d-flex justify-content-between">
					{{ $posts->links('vendor.pagination.bootstrap-4') }}
				</div>
			</div>
		</div>
	</div>   
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{ __('Create Gallery') }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form method="post" class="basicform_with_reload" action="{{ route('admin.gallery.store') }}" enctype="multipart/form-data">
      	<div class="form-group">
      		<label>{{ __('Url') }}</label>
      		<input type="text" required="" name="name" class="form-control">
      	</div>
      	<div class="form-group">
      		<label>{{ __('Image File') }}</label>
      		<input type="file" required="" accept="image/*" name="file" class="form-control">
      	</div>
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
        <button type="submit" class="btn btn-primary basicbtn">{{ __('Save') }}</button>
      </div>
      </form>
    </div>
  </div>
</div>
@endsection
@push('js')
<script src="{{ asset('assets/js/form.js') }}"></script>
@endpush