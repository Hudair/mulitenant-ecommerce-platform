@extends('layouts.app')
@section('head')
@include('layouts.partials.headersection',['title'=>'Customers'])
@endsection
@section('content')
<div class="row">
  <div class="col-12 mt-2">
    <div class="card">
      <div class="card-body">
        <div class="row mb-2">
          <div class="col-sm-8">
            <a href="{{ route('admin.customer.index') }}" class="mr-2 btn btn-outline-primary @if($type==="all") active @endif">{{ __('All') }} ({{ $all }})</a>

            <a href="{{ route('admin.customer.index','type=1') }}" class="mr-2 btn btn-outline-success @if($type==1) active @endif">{{ __('Active') }} ({{ $actives }})</a>

            <a href="{{ route('admin.customer.index','type=2') }}" class="mr-2 btn btn-outline-warning @if($type==2) active @endif">{{ __('Suspened') }} ({{ $suspened }})</a>

             <a href="{{ route('admin.customer.index','type=3') }}" class="mr-2 btn btn-outline-warning @if($type==3) active @endif">{{ __('Pending') }} ({{ $pendings }})</a>


            <a href="{{ route('admin.customer.index','type=trash') }}" class="mr-2 btn btn-outline-danger @if($type === 0) active @endif">{{ __('Trash') }} ({{ $trash }})</a>
          </div>

          <div class="col-sm-4 text-right">
            @can('customer.create')
            <a href="{{ route('admin.customer.create') }}" class="btn btn-primary">{{ __('Create Customer') }}</a>
            @endcan
          </div>
        </div>

        <div class="float-right">
          <form>
            <input type="hidden" name="type" value="@if($type === 0) trash @else {{ $type }} @endif">
            <div class="input-group mb-2">

              <input type="text" id="src" class="form-control" placeholder="Search..." required="" name="src" autocomplete="off" value="{{ $request->src ?? '' }}">
              <select class="form-control selectric" name="term" id="term">
                <option value="domain">{{ __('Search By Domain Name') }}</option>
                <option value="id">{{ __('Search By Customer Id') }}</option>
                <option value="email">{{ __('Search By User Mail') }}</option>

              </select>
              <div class="input-group-append">                                            
                <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
              </div>
            </div>
          </form>
        </div>

        <form method="post" action="{{ route('admin.customers.destroys') }}" class="basicform_with_reload">
          @csrf
          <div class="float-left mb-1">
            @can('customer.delete')
            <div class="input-group">
              <select class="form-control selectric" name="method">
                <option value="" >{{ __('Select Action') }}</option>
                <option value="1" >{{ __('Publish') }}</option>
                <option value="2" >{{ __('Suspend') }}</option>
                <option value="3" >{{ __('Move To Pending') }}</option>
                 @if($type !== "trash")
                <option value="trash" >{{ __('Move To Trash') }}</option>
                @endif
                @if($type=="trash")
                <option value="delete" >{{ __('Delete Permanently') }}</option>
                @endif
              </select>
              <div class="input-group-append">                                            
                <button class="btn btn-primary basicbtn" type="submit">{{ __('Submit') }}</button>
              </div>
            </div>
            @endcan
          </div>
          

          <div class="table-responsive">
            <table class="table table-striped table-hover text-center table-borderless">
              <thead>
                <tr>
                  <th><input type="checkbox" class="checkAll"></th>

                  <th>{{ __('Name') }}</th>
                  <th>{{ __('Email') }}</th>
                  <th>{{ __('Domain') }}</th>
                  <th>{{ __('Storage Used') }}</th>
                  <th>{{ __('Plan') }}</th>
                  <th>{{ __('Status') }}</th>
                  <th>{{ __('Join at') }}</th>
                  <th>{{ __('Action') }}</th>
                </tr>
              </thead>
              <tbody>
                @foreach($posts as $row)
                <tr id="row{{ $row->id }}">
                  <td><input type="checkbox" name="ids[]" value="{{ $row->id }}"></td>
                  <td>{{ $row->name }}</td>
                  <td><a href="mailto:{{ $row->email }}">{{ $row->email }}</a></td>
                  <td><a href="{{ $row->user_domain->full_domain ?? '' }}" target="_blank">{{ $row->user_domain->domain ?? '' }}</a></td>
                  <td>{{ folderSize('uploads/'.$row->id) }}MB / {{ $row->user_plan->plan_info->storage ?? 0 }} MB</td>
                  <td>{{ $row->user_plan->plan_info->name ?? '' }}</td>
                  <td>
                    @if($row->status==1) <span class="badge badge-success">{{ __('Active') }}</span>
                    @elseif($row->status==0) <span class="badge badge-danger">{{ __('Trash') }}</span>
                    @elseif($row->status==2) <span class="badge badge-warning">{{ __('Suspended') }}</span>
                    @elseif($row->status==3) <span class="badge badge-warning">{{ __('Pending') }}</span>
                    @endif
                  </td>
                  <td>{{ $row->created_at->format('d-F-Y')  }}</td>
                  <td>
                    <div class="dropdown d-inline">
                      <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ __('Action') }}
                      </button>
                      <div class="dropdown-menu">
                       
                         @can('customer.edit')
                        <a class="dropdown-item has-icon" href="{{ route('admin.customer.edit',$row->id) }}"><i class="fas fa-user-edit"></i> {{ __('Edit') }}</a>

                        <a class="dropdown-item has-icon" href="{{ route('admin.customer.planedit',$row->id) }}"><i class="far fa-edit"></i> {{ __('Edit Plan Info') }}</a>
                         @endcan
                          @can('customer.view')
                        <a class="dropdown-item has-icon" href="{{ route('admin.customer.show',$row->id) }}"><i class="far fa-eye"></i>{{ __('View') }}</a>
                         @endcan

                         <a class="dropdown-item has-icon" href="{{ route('admin.order.create','email='.$row->email) }}"><i class="fas fa-cart-arrow-down"></i>{{ __('Make Order') }}</a>

                         <a class="dropdown-item has-icon" href="{{ route('admin.customer.show',$row->id) }}"><i class="far fa-envelope"></i>{{ __('Send Email') }}</a>
                      </div>
                    </div>
                   

                  </td>
                </tr>
                @endforeach
              </tbody>
              <tfoot>
                <tr>
                 <th><input type="checkbox" class="checkAll"></th>

                 <th>{{ __('Name') }}</th>
                 <th>{{ __('Email') }}</th>
                 <th>{{ __('Domain') }}</th>
                 <th>{{ __('Storage Used') }}</th>
                 <th>{{ __('Plan') }}</th>
                 <th>{{ __('Status') }}</th>
                 <th>{{ __('Join at') }}</th>
                 <th>{{ __('Action') }}</th>
               </tr>
             </tfoot>
           </table>
           
         </div>
       </form>
        {{ $posts->appends($request->all())->links('vendor.pagination.bootstrap-4') }}
     </div>
   </div>
 </div>
</div>
@endsection

@push('js')
<script src="{{ asset('assets/js/form.js') }}"></script>
@endpush