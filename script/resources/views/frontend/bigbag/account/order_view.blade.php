@extends('frontend.bigbag.account.layout.app')
@section('user_content')
<section class="section">
	<div class="section-body">
		<div class="invoice">
			<div class="invoice-print">
				<div class="row">
					<div class="col-lg-12">
						<div class="invoice-title d-flex justify-content-between align-items-center">
							<h2>{{ __('Order Information') }}</h2>
							<div class="invoice-number"><strong>{{ __('Order Id') }}:</strong> {{ $info->order_no }}</div>
						</div>
						<hr>
						<div class="row">
							@if($info->order_type == 1)
							<div class="col-md-6">
								
								<address>
									<strong>{{ __('Shipped To') }}:</strong><br>
									{{ $order_content->address ?? '' }}<br>
									{{ __('City') }}: {{ $info->shipping_info->city->name ?? '' }}
									<br>
									{{ __('Postal Code') }}: {{ $order_content->zip_code ?? '' }}
									<br>
									{{ __('Address') }}: {{ $order_content->address ?? '' }}
								</address>

							</div>
							@endif
							@if($info->order_type == 1)
							<div class="col-md-6 text-md-right">
							@else	
							<div class="col-md-12 text-md-right">
							@endif		
								<address>
									<strong>Order Status:</strong><br>
									@if($info->status=='pending')
									<span class="badge badge-warning ">{{ __('Awaiting processing') }}</span>

									@elseif($info->status=='processing')
									<span class="badge badge-primary ">{{ __('Processing') }}</span>

									@elseif($info->status=='ready-for-pickup')
									<span class="badge badge-info ">{{ __('Ready for pickup') }}</span>

									@elseif($info->status=='completed')
									<span class="badge badge-success ">{{ __('Completed') }}</span>

									@elseif($info->status=='archived')
									<span class="badge badge-danger ">{{ __('Archived') }}</span>
									@elseif($info->status=='canceled')
									<span class="badge badge-danger ">{{ __('Canceled') }}</span>

									@else
									<span class="badge badge-primary ">{{ $info->status }}</span>

									@endif
								</address><br>
								<address>
									<strong>{{ __('Payment Status') }}:</strong><br>
									
									
									@if($info->payment_status==2)
									<span class="badge badge-warning ">{{ __('Pending') }}</span>

									@elseif($info->payment_status==1)
									<span class="badge badge-success ">{{ __('Paid') }}</span>

									@elseif($info->payment_status==0)
									<span class="badge badge-danger ">{{ __('Cancel') }}</span> 
									@elseif($info->payment_status==3)
									<span class="badge badge-danger ">{{ __('Incomplete') }}</span> 

									@endif
								</address>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<address>
									<strong>{{ __('Payment Info') }}:</strong><br>
									
									<p>{{ __('Payment Method') }} : <b>{{ $info->getway->name ?? '' }}</b></p>
									<p>{{ __('Transaction Id') }} : <b>{{ $info->transaction_id }}</b></p>
									
								</address>
							</div>
							<div class="col-md-6 text-md-right">
								<address>

									<strong>{{ __('Order Date') }}:</strong><br>

									{{ $info->created_at->format('d-F-Y') }}<br><br>

								</address>
							</div>
						</div>
					</div>
				</div>

				<div class="row mt-4">
					<div class="col-md-12">
						<div class="section-title">{{ __('Order Summary') }}</div>

						<div class="table-responsive">
							<table class="table table-borderless table-hover table-md">
								<tbody><tr>
									
									<th>{{ __('Name') }}</th>
																	
									<th class="text-center">{{ __('Amount') }}</th>
									
									<th class="text-right">{{ __('Total') }}</th>
									
								</tr>
								@foreach($info->order_item as $row)
								<tr>
									<td><a href="{{ url('/product/'.$row->term->title.'/'.$row->term->id) }}">{{ Str::limit($row->term->title,50) ?? '' }}</a>
										<br>
										@php
										$variations=json_decode($row->info);
										@endphp
										@foreach ($variations->attribute ?? [] as $item)

										<span></span> <small>{{ $item->attribute->name ?? '' }} - {{ $item->variation->name ?? '' }}</small>,
										@endforeach

										@foreach ($variations->options ?? [] as $option)
										<span>{{ __('Option') }} :</span> <small>{{ $option->name ?? '' }}</small>,
										@endforeach
										@if($info->status == 'completed' && $info->payment_status == 1)
										<br>
										@foreach ($row->file ?? [] as $file)
										<a href="{{ url($file->url) }}" target="_blank">{{ __('Download') }}</a>
										@endforeach
										@endif
									</td>
									<td class="text-center">{{ amount_format($row->amount) }} × {{ $row->qty }}</td>
									
									<td class="text-right">{{  amount_format($row->amount*$row->qty) }}</td>
									
								</tr>
								@endforeach
							</tbody></table>
						</div>
						<div class="row mt-4">
							<div class="col-lg-8">
							</div>
							<div class="col-lg-4 text-right">
								<div class="invoice-detail-item">
									<div class="invoice-detail-name"><strong>{{ __('Subtotal') }}:</strong>{{ amount_format($order_content->sub_total + $order_content->coupon_discount) }}</div>
								</div>
								<div class="invoice-detail-item">
									<div class="invoice-detail-name"><strong>{{ __('Discount') }}:</strong>{{ amount_format($order_content->coupon_discount) }}</div>
								</div>
								
								<div class="invoice-detail-item">
									<div class="invoice-detail-name"><strong>{{ __('Tax') }}:</strong> {{ amount_format($info->tax) }}</div>
								</div>
								<div class="invoice-detail-item">
									<div class="invoice-detail-name"><strong>{{ __('Shipping') }}:</strong> {{ amount_format($info->shipping) }}</div>
								</div>
								<hr class="mt-2 mb-2">
								<div class="invoice-detail-item">
									<div class="invoice-detail-name">{{ __('Total') }}</div>
									<div class="invoice-detail-value invoice-detail-value-lg">{{ amount_format($info->total) }}</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>


		</div>
	</div>
</section>

@endsection