@extends('layouts.app')
@section('content')
<div class="row">
	<div class="col-lg-3 col-md-6 col-sm-6 col-12">
		<div class="card card-statistic-1">
			<div class="card-icon bg-primary">
				<i class="far fa-clipboard"></i>
			</div>
			<div class="card-wrap">
				<div class="card-header">
					<h4>{{ __('Total Orders') }}</h4>
				</div>
				<div class="card-body">
					{{ number_format($order_count) }}
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-3 col-md-6 col-sm-6 col-12">
		<div class="card card-statistic-1">
			<div class="card-icon bg-success">
				<i class="fas fa-wallet"></i>
			</div>
			<div class="card-wrap">
				<div class="card-header">
					<h4>{{ __('Total Earnings') }}</h4>
				</div>
				<div class="card-body">
					{{ amount_format($order_sum) }}

				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-3 col-md-6 col-sm-6 col-12">
		<div class="card card-statistic-1">
			<div class="card-icon bg-warning">
				<i class="fas fa-wallet"></i>
			</div>
			<div class="card-wrap">
				<div class="card-header">
					<h4>{{ __('Total Tax') }}</h4>
				</div>
				<div class="card-body">
					{{ amount_format($order_tax) }}
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-3 col-md-6 col-sm-6 col-12">
		<div class="card card-statistic-1">
			<div class="card-icon bg-danger">
				<i class="fas fa-history"></i>
			</div>
			<div class="card-wrap">
				<div class="card-header">
					<h4>{{ __('Total Expired Orders') }}</h4>
				</div>
				<div class="card-body">
					{{ number_format($order_expired) }}
				</div>
			</div>
		</div>
	</div>                  
</div>


<div class="card">
	<div class="card-header">
				
				<form class="card-header-form">
					<div class="d-flex">
						<input type="text" name="start" class="form-control datepicker" value="{{ $start ?? '' }}">
						
						<input type="text" name="end" class="form-control datepicker" value="{{ $end ?? '' }}">

						<button class="btn btn-primary btn-icon" type="submit"><i class="fas fa-search"></i></button>
					</div>					
				</form>
			</div>
	<div class="card-body">
			<div class="table-responsive">
				<table class="table table-hover table-nowrap card-table text-center">
					<thead>
						<tr>
							
							<th class="text-left" >{{ __('Order') }}</th>
							<th >{{ __('Date') }}</th>
							
							<th class="text-right">{{ __('Order total') }}</th>
							<th>{{ __('Payment Method') }}</th>
							<th>{{ __('Payment Status') }}</th>
							<th>{{ __('Status') }}</th>
							<th class="text-right">{{ __('Action') }}</th>
						</tr>
					</thead>
					<tbody class="list font-size-base rowlink" data-link="row">
						@foreach($posts ?? [] as $key => $row)
						<tr>

							<td class="text-left"><a href="{{ route('admin.order.invoice',$row->id) }}">{{ $row->order_no }}</a></td>
							<td>{{ $row->created_at->format('d-F-Y') }}</td>
							
							<td>{{ amount_format($row->amount) }}</td>
							<td>{{ $row->category->name ?? '' }}</td>
							<td>
								@if($row->payment_status==1)
								<span class="badge badge-success">{{ __('Paid') }}</span>
								
								@elseif($row->payment_status==2)
								<span class="badge badge-warning">{{ __('Pending') }}</span>
								@else
								<span class="badge badge-danger">{{ __('Fail') }}</span>
								@endif
								
							</td>

							<td>
								@if($row->status == 1) <span class="badge badge-success">Approved</span> @elseif($row->status == 2) <span class="badge badge-warning">{{ __('Pending') }}</span>@elseif($row->status == 3) <span class="badge badge-danger">{{ __('Expired') }}</span>@else <span class="badge badge-danger">{{ __('Cancelled') }}</span> @endif

							</td>
							<td> <div class="dropdown d-inline">
								<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									{{ __('Action') }}
								</button>
								<div class="dropdown-menu">
									<a class="dropdown-item has-icon" href="{{ route('admin.order.edit',$row->id) }}"><i class="far fa-edit"></i> {{ __('Edit') }}</a>
									<a class="dropdown-item has-icon" href="{{ route('admin.order.show',$row->id) }}"><i class="far fa-eye"></i> {{ __('View') }}</a>
									<a class="dropdown-item has-icon" href="{{ route('admin.order.invoice',$row->id) }}"><i class="fa fa-file-invoice"></i> {{ __('Download Invoice') }}</a>

								</div>
							</div></td>
						</tr>	
						@endforeach
					</tbody>
				</table>

			</div>
		</div>
	
	<div class="card-footer d-flex justify-content-between">
		{{ $posts->appends($request->all())->links('vendor.pagination.bootstrap-4') }}
	</div>
</div>

@endsection
@push('js')
<script src="{{ asset('assets/js/daterangepicker.js') }}"></script>
@endpush