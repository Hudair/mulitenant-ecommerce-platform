@extends('frontend.bazar.account.layout.app')
@section('user_content')   
  <div class="dash__box dash__box--shadow dash__box--bg-white dash__box--radius u-s-m-b-30">
        <div class="dash__table-2-wrap gl-scroll">
            <table class="dash__table-2">
                <thead>
                    <tr>
                        <th>{{ __('Order Id') }}</th>
                        <th>{{ __('Amount') }}</th>
                        <th>{{ __('Payment Mode') }}</th>
                        <th>{{ __('Payment Status') }}</th>
                        <th>{{ __('Order Status') }}</th>
                        <th>{{ __('View') }}</th>
                    </tr>
                </thead>
                <tbody>
                    
                    @foreach($orders as $row)
                    <tr>
                        <td><a href="{{ url('/user/order/view',$row->id) }}">{{ $row->order_no }}</a></td>
                        <td>{{ amount_format($row->total) }}</td>
                        <td>{{ $row->getway->name ?? '' }}</td>
                        <td>
                            @if($row->payment_status==2)
                            <span class="badge badge-warning">{{ __('Pending') }}</span>
        
                            @elseif($row->payment_status==1)
                            <span class="badge badge-success">{{ __('Complete') }}</span>
        
                            @elseif($row->payment_status==0)
                            <span class="badge badge-danger">{{ __('Cancel') }}</span> 
                            @elseif($row->payment_status==3)
                            <span class="badge badge-danger">{{ __('Incomplete') }}</span> 
                            @endif
                        </td>
                        <td>
                            @if($row->status=='pending')
                            <span class="badge badge-warning">{{ __('Pending') }}</span>
        
                            @elseif($row->status=='processing')
                            <span class="badge badge-primary">{{ __('Processing') }}</span>
        
                            @elseif($row->status=='ready-for-pickup')
                            <span class="badge badge-info">{{ __('Ready for pickup') }}</span>
        
                            @elseif($row->status=='completed')
                            <span class="badge badge-success">{{ __('Completed') }}</span>
        
                            @elseif($row->status=='archived')
                            <span class="badge badge-warning">{{ __('Archived') }}</span>
                            @elseif($row->status=='canceled')
                            <span class="badge badge-danger">{{ __('Canceled') }}</span>
        
                            @else
                            <span class="badge badge-info">{{ $row->status }}</span>
        
                            @endif
        
                        </td>
                        <td ><a href="{{ url('/user/order/view',$row->id) }}" class="address-book-edit btn--e-transparent-platinum-b-2"><i class="fa fa-eye"></i></a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $orders->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>
    <div>
</div>
@endsection