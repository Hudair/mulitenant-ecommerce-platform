@extends('layouts.app')

@section('content')
<div class="card"  >
	<div class="card-body">
		<div class="row mb-30">
			<div class="col-lg-6">
				<h4>{{ __('Page List') }}</h4>
			</div>
			<div class="col-lg-6">
				
			</div>
		</div>
		<br>
		<div class="card-action-filter">
			<form method="post" class="basicform_with_reload" action="{{ route('admin.pages.destroys') }}">
				@csrf
				<div class="row">
					@can('page.delete')
					<div class="col-lg-6">
						<div class="d-flex">
							<div class="single-filter">
								<div class="form-group">
									<select class="form-control selectric" name="status">
										<option disabled="" selected="">Select Action</option>
										<option value="delete">{{ __('Delete Permanently') }}</option>

									</select>
								</div>
							</div>
							<div class="single-filter">
								<button type="submit" class="btn btn-primary btn-lg ml-2">{{ __('Apply') }}</button>
							</div>
						</div>
					</div>
					@endcan

					@can('page.create')
					<div class="col-lg-6">
						<div class="add-new-btn">
							<a href="{{ route('admin.page.create') }}" class="btn btn-primary float-right">{{ __('Add New Page') }}</a>
						</div>
					</div>
					@endcan
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
							<th class="am-title">{{ __('Title') }}</th>
							<th class="am-title">{{ __('Url') }}</th>
							
							<th class="am-date">{{ __('Last Update') }}</th>
						</tr>
					</thead>
					<tbody>
						@foreach($pages as $page)
						<tr>
							<th>
								<div class="custom-control custom-checkbox">
									<input type="checkbox" name="ids[]" class="custom-control-input" id="customCheck{{ $page->id }}" value="{{ $page->id }}">
									<label class="custom-control-label" for="customCheck{{ $page->id }}"></label>
								</div>
							</th>
							<td>
								{{ $page->title }}
								@can('page.edit')
								<div class="hover">
									<a href="{{ route('admin.page.edit',$page->id) }}">{{ __('Edit') }}</a>

									
								</div>
								@endcan
							</td>
							<input type="text" class="offscreen" id="myUrl{{ $page->id }}" value="{{ url('/page',$page->slug)  }}">
							<td style="cursor: pointer" onclick="copyUrl('{{ $page->id }}')">{{ url('/page',$page->slug)  }}</td>
							
							<td>{{ __('Last Modified') }}
								<div class="date">
									{{ $page->updated_at->diffForHumans() }}
								</div>
							</td>
						</tr>
						@endforeach
					</tbody>
				</form>
				<tfoot>
					<tr>
						<th class="am-select">
							<div class="custom-control custom-checkbox">
								<input type="checkbox" class="custom-control-input checkAll" id="selectAll">
								<label class="custom-control-label checkAll" for="selectAll"></label>
							</div>
						</th>
						<th class="am-title">{{ __('Title') }}</th>
						<th class="am-title">{{ __('Url') }}</th>
						
						<th class="am-date">{{ __('Last Update') }}</th>
					</tr>
				</tfoot>
			</table>
			{{ $pages->links('vendor.pagination.bootstrap-4') }}

		</div>
	</div>
</div>
@endsection
@push('js')
<script src="{{ asset('assets/js/form.js') }}"></script>
@endpush