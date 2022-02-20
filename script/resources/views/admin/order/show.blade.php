@extends('layouts.app')
@section('head')
@include('layouts.partials.headersection',['title'=>'Order No: '. $info->order_no])
@endsection
@section('content')
<div class="row">
	<div class="col-sm-6">
		<div class="card">
			<div class="card-header">
				<h4>{{ __('Order Information') }}</h4>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-hover">
						<tr>
							<td>{{ __('Order No') }}</td>
							<td><b>{{ $info->order_no }}</b></td>
						</tr>
						<tr>
							<td>{{ __('Order Status') }}</td>
							<td>@if($info->status == 1) <span class="badge badge-success">{{ __('Approved') }}</span> @elseif($info->status == 2) <span class="badge badge-warning">{{ __('Pending') }}</span>@elseif($info->status == 3) <span class="badge badge-danger">{{ __('Expired') }}</span>@else <span class="badge badge-danger">{{ __('Cancelled') }}</span> @endif</td>
						</tr>
						<tr>
							<td>{{ __('Order Created Date') }}</td>
							<td><b>{{ $info->created_at->format('Y-m-d') }}</b></td>
						</tr>
						<tr>
							<td>{{ __('Order Created At') }}</td>
							<td><b>{{ $info->created_at->diffForHumans() }}</b></td>
						</tr>
						<tr>
							<td>{{ __('Order Will Be Expired') }}</td>
							<td><b>{{ $info->will_expire }}</b></td>
						</tr>
						<tr>
							<td>{{ __('Order Amount') }}</td>
							<td><b>{{ amount_format($info->amount) }}</b></td>
						</tr>
						<tr>
							<td>{{ __('Order Tax Amount') }}</td>
							<td><b>{{ amount_format($info->tax) }}</b></td>
						</tr>
						<tr>
							<td>{{ __('Order Total Amount') }}</td>
							<td><b>{{ amount_format($info->tax+$info->amount) }}</b></td>
						</tr>
						<tr>
							<td>{{ __('Plan Name') }}</td>
							<td><b>{{ $info->plan_info->name ?? '' }}</b></td>
						</tr>
						<tr>
							<td>{{ __('Payment Mode') }}</td>
							<td><b>{{ $info->category->name ?? '' }}</b></td>
						</tr>
						<tr>
							<td>{{ __('Transaction Id') }}</td>
							<td><b>{{ $info->trx }}</b></td>
						</tr>
						<tr>
							<td>{{ __('Transaction Status') }}</td>
							<td>
								@if($info->payment_status==1)
								<span class="badge badge-success">{{ __('Paid') }}</span>
								@elseif($row->payment_status == 2)
								<span class="badge badge-warning">{{ __('Pending') }}</span>
								@else
								<span class="badge badge-danger">{{ __('Fail') }}</span>
								@endif
							</td>
						</tr>
						
						
					</table>
				</div>
			</div>
		</div>
	</div>
	<div class="col-sm-6">
		<div class="card">
			<div class="card-header">
				<h4>{{ __('User Information') }}</h4>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-hover">
						<tr>
							<td>{{ __('User Name') }}</td>
							<td><b><a href="{{ route('admin.customer.show',$info->user->id) }}">{{ $info->user->name ?? '' }}</a></b></td>
						</tr>
						<tr>
							<td>{{ __('User Email') }}</td>
							<td><a href="mailto:{{ $info->user->email ?? '' }}"><b>{{ $info->user->email ?? '' }}</b></a></td>
						</tr>

						<tr>
							<td>{{ __('User Domain') }}</td>
							<td><b><a href="{{ url('/admin/domain/'.$user->user_domain->id.'/edit') }}">{{ $user->user_domain->domain ?? '' }}</a></b></td>
						</tr>
						<tr>
							<td>{{ __('Domain Status') }}</td>
							<td>@if(!empty($user->user_domain))<b>
								
								@if($user->user_domain->status==1) <span class="badge badge-success">{{ __('Active') }}</span>
								@elseif($user->user_domain->status==0) <span class="badge badge-danger">{{ __('Trash') }}</span>
								@elseif($user->user_domain->status==2) <span class="badge badge-warning">{{ __('Draft') }}</span>
								@elseif($user->user_domain->status==3) <span class="badge badge-warning">{{ __('Requested') }}</span>
								@endif
							</b>@endif</td>
						</tr>
						
					</table>
				</div>   		
			</div>
		</div>
	</div>
</div>
@endsection