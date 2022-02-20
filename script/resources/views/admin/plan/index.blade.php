@extends('layouts.app')
@section('head')
@include('layouts.partials.headersection',['title'=>'Plans'])
@endsection
@section('content')
<div class="row">
  <div class="col-12 mt-2">
    <div class="card">
      <div class="card-body">
          <form method="post" action="{{ route('admin.plans.destroys') }}" class="basicform_with_reload">
            @csrf
            <div class="float-left mb-1">
              @can('plan.delete')
              <div class="input-group">
                <select class="form-control" name="type">
                  <option value="" >{{ __('Select Action') }}</option>
                  <option value="delete" >{{ __('Delete Permanently') }}</option>

                </select>
                <div class="input-group-append">                                            
                  <button class="btn btn-primary" type="submit">{{ __('Submit') }}</button>
                </div>
              </div>
              @endcan
            </div>
            <div class="float-right">
              @can('plan.create')
              <a href="{{ route('admin.plan.create') }}" class="btn btn-primary">{{ __('Create Plan') }}</a>
              @endcan
            </div>
        
          <div class="table-responsive">
            <table class="table table-striped table-hover text-center table-borderless">
              <thead>
                <tr>
                  <th><input type="checkbox" class="checkAll"></th>

                  <th>{{ __('Name') }}</th>
                  <th>{{ __('Price') }}</th>
                  <th>{{ __('Duration') }}</th>
                  <th>{{ __('Users') }}</th>
                  <th>{{ __('Featured') }}</th>
                  <th>{{ __('Is Trial') }}</th>
                  <th>{{ __('Created at') }}</th>
                  <th>{{ __('Action') }}</th>
                </tr>
              </thead>
              <tbody>
                @foreach($posts as $row)
                <tr id="row{{ $row->id }}">

                  <td>@if($row->id !== 1 && $row->active_users_count == 0) <input type="checkbox" name="ids[]" value="{{ $row->id }}"> @endif</td>

                  <td>{{ $row->name  }}</td>
                  <td>{{ $row->price  }}</td>
                  <td>@if($row->days == 365) Yearly @elseif($row->days == 30) Monthly @else {{ $row->days }}  Days @endif</td>
                  <td>{{ $row->active_users_count  }}</td>
                  <td>@if($row->featured==1) <span class="badge badge-success  badge-sm">Yes</span> @else <span class="badge badge-danger  badge-sm">No</span> @endif</td>
                  <td>@if($row->is_trial==1) <span class="badge badge-success  badge-sm">Yes</span> @else <span class="badge badge-danger  badge-sm">No</span> @endif</td>
                  <td>{{ $row->created_at->diffforHumans()  }}</td>
                  <td>
                    @can('plan.edit')
                    <a href="{{ route('admin.plan.edit',$row->id) }}" class="btn btn-primary btn-sm text-center"><i class="far fa-edit"></i></a>
                    @endcan
                    @can('plan.show')
                    <a href="{{ route('admin.plan.show',$row->id) }}" class="btn btn-success btn-sm text-center"><i class="far fa-eye"></i></a>
                    @endcan
                  </td>
                </tr>
                @endforeach
              </tbody>
              <tfoot>
                <tr>
                 <th><input type="checkbox" class="checkAll"></th>

                 <th>{{ __('Name') }}</th>
                 <th>{{ __('Price') }}</th>

                 <th>{{ __('Duration') }}</th>
                 <th>{{ __('Users') }}</th>
                 <th>{{ __('Featured') }}</th>
                 <th>{{ __('Is Deafult') }}</th>

                 <th>{{ __('Created at') }}</th>
                 <th>{{ __('Action') }}</th>
               </tr>
             </tfoot>
           </table>
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