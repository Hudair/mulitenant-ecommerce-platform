@extends('layouts.app')
@section('head')
@include('layouts.partials.headersection',['title'=>'Payment Gateway'])
@endsection
@section('content')
<div class="row">
  <div class="col-12 mt-2">
    <div class="card">
      <div class="card-body">        
          <div class="table-responsive">
            <table class="table table-striped table-hover text-center table-borderless">
              <thead>
                <tr>
                 

                  <th><i class="fas fa-image"></i></th>
                  <th>{{ __('Name') }}</th>
                  <th>{{ __('Status') }}</th>
                 
                  <th>{{ __('Total Users') }}</th>
                  
                  <th>{{ __('Last Updated at') }}</th>
                  <th>{{ __('Edit') }}</th>
                </tr>
              </thead>
              <tbody>
                @foreach($posts as $row)
                <tr>
                  <td><img src="{{ asset($row->preview->content ?? '') }}" alt="" height="50" width="120"></td>
                	<td>{{ $row->name }}</td>
                	<td>@if($row->featured==1) <span class="badge badge-success">{{ __('Active') }}</span> @else <span class="badge badge-danger">{{ __('Deactive') }}</span> @endif</td>
                	<td>{{ $row->gateway_users_count }}</td>
                	<td>{{ $row->updated_at->diffForHumans() }}</td>
                	<td><a href="{{ route('admin.payment-geteway.show',$row->slug) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a></td>
                </tr>
                @endforeach
              </tbody>
             
           </table>
         </div>
       </form>
     </div>
   </div>
 </div>
</div>
@endsection
