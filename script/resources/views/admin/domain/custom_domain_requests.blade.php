@extends('layouts.app')
@section('head')
@include('layouts.partials.headersection',['title'=>'Domains'])
@endsection
@section('content')
<div class="row">
  <div class="col-12 mt-2">
    <div class="card">
      <div class="card-body">
       
        <div class="row mb-2">
          <div class="col-sm-8">

            <a href="{{ route('admin.customdomain.index') }}" class="mr-2 btn btn-outline-primary @if($type=="all") active @endif">{{ __('All') }} ({{ $all }})</a>

            <a href="{{ route('admin.customdomain.show',1) }}" class="mr-2 btn btn-outline-success @if($type==1) active @endif">{{ __('Active') }} ({{ $actives }})</a>

            

            <a href="{{ route('admin.customdomain.show',2) }}" class="mr-2 btn btn-outline-warning @if($type==3) active @endif">{{ __('Requested') }} ({{ $requested }})</a>


            <a href="{{ route('admin.customdomain.show',0) }}" class="mr-2 btn btn-outline-danger @if($type== 0 && $type != 'all') active @endif">{{ __('Trash') }} ({{ $trash }})</a>
          </div>

          <div class="col-sm-4 text-right">
           
          </div>
        </div>

        <div class="float-right">
            <form>
              <div class="input-group mb-2">

                <input type="text" id="src" class="form-control" placeholder="Search..." required="" name="src" autocomplete="off" value="{{ $request->src ?? '' }}">
                <select class="form-control selectric" name="type" id="type">
                  <option value="domain">{{ __('Search By Domain Name') }}</option>
                  <option value="email">{{ __('Search By User Mail') }}</option>

                </select>
                <div class="input-group-append">                                            
                  <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                </div>
              </div>
            </form>
          </div>

        <form method="post" action="{{ route('admin.customdomain.destroy') }}" class="basicform_with_reload">
          @csrf
          <div class="float-left mb-1">
            @can('domain.delete')
            <div class="input-group">
              <select class="form-control selectric" name="method">
                <option value="" >{{ __('Select Action') }}</option>
                
                @if($type != "0")
                <option value="0" >{{ __('Move To Trash') }}</option>
                @endif
                @if($type== 0 && $type != 'all')
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

                  <th>{{ __('Domain Name') }}</th>
                  <th>{{ __('Current Domain') }}</th>
                  <th>{{ __('User') }}</th>
                  <th>{{ __('Status') }}</th>

                  <th>{{ __('Created at') }}</th>
                  <th>{{ __('Action') }}</th>
                </tr>
              </thead>
              <tbody>
                @foreach($posts as $row)
                <tr id="row{{ $row->id }}">
                  <td><input type="checkbox" name="ids[]" value="{{ $row->id }}"></td>

                  <td>{{ $row->domain }}</td>
                  <td><a href="{{ url($row->parentdomain->full_domain ?? '') }}" target="_blank">{{ $row->parentdomain->domain ?? '' }}</a></td>
                  <td><a href="{{ route('admin.customer.show',$row->user->id) }}">{{ $row->user->name }}</a></td>
                  <td>
                    @if($row->status==1) <span class="badge badge-success">{{ __('Active') }}</span>
                    @elseif($row->status==0) <span class="badge badge-danger">{{ __('Trash') }}</span>
                  
                     @elseif($row->status==2) <span class="badge badge-warning">{{ __('Requested') }}</span>
                    @endif
                  </td>
                  <td>{{ $row->created_at->diffforHumans()  }}</td>
                  <td>
                    @can('domain.edit')
                    <a href="{{ route('admin.customdomain.edit',$row->id) }}" class="btn btn-primary btn-sm text-center"><i class="far fa-edit"></i></a>
                    @endcan

                  </td>
                </tr>
                @endforeach
              </tbody>
              <tfoot>
                <tr>
                 <th><input type="checkbox" class="checkAll"></th>

                 <th>{{ __('Domain Name') }}</th>
                 <th>{{ __('Current Domain') }}</th>
                 <th>{{ __('User') }}</th>
                 <th>{{ __('Status') }}</th>
                 
                 <th>{{ __('Created at') }}</th>
                 <th>{{ __('Action') }}</th>
               </tr>
             </tfoot>
           </table>
           {{ $posts->appends($request->all())->links('vendor.pagination.bootstrap-4') }}
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