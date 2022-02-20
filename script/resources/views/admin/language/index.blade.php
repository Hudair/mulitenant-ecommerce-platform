@extends('layouts.app')
@section('head')
@include('layouts.partials.headersection',['title'=>'Language'])
@endsection
@section('content')
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<h4>{{ __('All Languages') }}</h4>
				<div class="card-header-action">
				</div>

			</div>
			<div class="card-body">
				
				<form class="basicform" action="{{ route('admin.languages.active') }}" method="post">
					@csrf
						<div class="table-responsive">
							<table class="table table-hover table-nowrap card-table text-center">
								<thead>
									<tr>
										<th class="text-left" ><input type="checkbox" class="checkAll"></th>

										<th>{{ __('Language Key') }}</th>
										<th>{{ __('Language Name') }}</th>
										<th class="text-right">{{ __('Action') }}</th>
									</tr>
								</thead>
								<tbody class="list font-size-base rowlink" data-link="row">
									@foreach($posts ?? [] as $key => $row)
									<tr>
										<td class="text-left"><input type="checkbox" @if(in_array($key, $actives)) checked="" @endif name="ids[{{ $key }}][{{ $row }}]" value="{{ $key }}"></td>
										<td>{{ $key }}</td>									
										<td>{{ $row }}</td>									
										<td class="text-right"><a href="{{ route('admin.language.show',$key) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
										<a href="{{ route('admin.languages.delete',$key) }}" class="btn btn-danger btn-sm cancel"><i class="fa fa-trash"></i></a></td>
									</tr>	
									@endforeach
								</tbody>
							</table>

						</div>


					<div class="form-group row mb-4">
						
						<div class="col-sm-12 col-md-12">
							<button class="btn btn-primary basicbtn" type="submit">{{ __('Save For Main Site') }}</button>
						</div>
					</div>
				</form>
				
			</div>
		</div>
	</div>
</div>
@endsection
@push('js')
<script src="{{ asset('assets/js/form.js') }}"></script>
@endpush