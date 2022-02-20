@extends('admin.frontend.app')
@section('append')
<div class="card-action-filter">
	<form method="post" class="basicform_with_reload" action="{{ route('admin.categorie.destroys') }}">
		@csrf
		<div class="row">
			
			<div class="col-lg-6">
				<div class="d-flex">
					<div class="single-filter">
						<div class="form-group">
							<select class="form-control selectric" name="type">
								<option disabled="" selected="">{{ __('Select Action') }}</option>
								<option value="delete">{{ __('Delete Permanently') }}</option>

							</select>
						</div>
					</div>
					<div class="single-filter">
						<button type="submit" class="btn btn-primary btn-lg ml-2">{{ __('Apply') }}</button>
					</div>
				</div>
			</div>
			

			
			<div class="col-lg-6">
				<div class="add-new-btn">
					<a href="#" class="btn btn-primary float-right" data-toggle="modal" data-target="#exampleModal">{{ __('Add New Testimonial') }}</a>
				</div>
			</div>

		</div>
	</div>
	<div class="table-responsive custom-table">
		<table class="table">
			<thead>
				<tr>
					<th class="am-select">
						<div class="custom-control custom-checkbox">
							<input type="checkbox" class="custom-control-input checkAll" id="selectAll">
							<label class="custom-control-label checkAll" for="selectAll"></label>
						</div>
					</th>
					<th class="am-title">{{ __('Name') }}</th>
					<th class="am-title">{{ __('position') }}</th>

					<th class="am-date">{{ __('Created At') }}</th>
				</tr>
			</thead>
			<tbody>
				@foreach($posts ?? [] as $row)
				<tr>
					<td>
						<div class="custom-control custom-checkbox">
							<input type="checkbox" name="ids[]" class="custom-control-input" id="customCheck{{ $row->id }}" value="{{ $row->id }}">
							<label class="custom-control-label" for="customCheck{{ $row->id }}"></label>
						</div>
					</td>
					<td>{{ $row->name }}</td>
					<td>{{ $row->slug }}</td>
					<td>
						<div class="date">
							{{ $row->updated_at->diffForHumans() }}
						</div>
					</td>
				</tr>
				@endforeach
			</tbody>
		</form>
	</table>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">{{ __('Create Testimonial') }}</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form class="basicform_with_reload" method="post" action="{{ route('admin.appearance.store') }}">
				@csrf
				<input type="hidden" name="type" value="testimonial">

				<div class="modal-body">

					<div class="fom-group">
						<label>{{ __('Name') }}</label>
						<input type="text" name="name" class="form-control" required="">
					</div>
					<div class="fom-group">
						<label>{{ __('Position') }}</label>
						<input type="text" name="position" class="form-control" required="">
					</div>

					<div class="fom-group">
						<label>{{ __('Feedback') }}</label>
						<textarea class="form-control h-200" name="feedback" required=""></textarea>
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