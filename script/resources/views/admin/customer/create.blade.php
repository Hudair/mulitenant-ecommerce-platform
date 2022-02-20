@extends('layouts.app')
@section('head')
@include('layouts.partials.headersection',['title'=>'Customer'])
@endsection
@section('content')
 <div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4>{{ __('Create Customer') }}</h4>
                
      </div>
      <div class="card-body">

        <form class="basicform_with_reload" action="{{ route('admin.customer.store') }}" method="post">
          @csrf

          <div class="form-group row mb-4">
          <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" >{{ __('Customer Name') }}</label>
          <div class="col-sm-12 col-md-7">
            <input type="text" class="form-control" required="" name="name">
          </div>
        </div>

        <div class="form-group row mb-4">
          <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" >{{ __('Customer Email') }}</label>
          <div class="col-sm-12 col-md-7">
            <input type="email" class="form-control" required="" name="email">
          </div>
        </div>

         <div class="form-group row mb-4">
          <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" >{{ __('Password') }}</label>
          <div class="col-sm-12 col-md-7">
            <input type="text" class="form-control" required="" name="password">
          </div>
        </div>

        

         <div class="form-group row mb-4">
          <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" >{{ __('Transaction Method') }}</label>
          <div class="col-sm-12 col-md-7">
            <select class="form-control" name="trasection_method">
              @foreach(App\Category::where('type','payment_getway')->get() as $row)
              <option value="{{ $row->id }}">{{ $row->name }}</option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="form-group row mb-4">
          <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" >{{ __('Transaction Id') }}</label>
          <div class="col-sm-12 col-md-7">
            <input type="text" class="form-control" required="" name="trasection_id">
          </div>
        </div>

        <div class="form-group row mb-4">
          <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" >{{ __('Plan') }}</label>
          <div class="col-sm-12 col-md-7">
            <select class="form-control" name="plan">
               @foreach(App\Plan::where('status',1)->get() as $row)
              <option value="{{ $row->id }}">{{ $row->name }}</option>
              @endforeach
            </select>
          </div>
        </div>


        <div class="form-group row mb-4">
          <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" >{{ __('Domain Name Without Protocol') }} <br><small class="text-danger">example.com</small></label>
          <div class="col-sm-12 col-md-7">
            <input type="text" class="form-control" required="" name="domain_name">
          </div>
        </div>

        <div class="form-group row mb-4">
          <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" >{{ __('Full Domain With Protocol') }}  <small class="text-danger">https://example.com</small></label>

         
          <div class="col-sm-12 col-md-7">
            <input type="text" class="form-control" required="" name="full_domain">
          </div>
        </div>

        

    
        <div class="form-group row mb-4">
          <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
          <div class="col-sm-12 col-md-7">
            <button class="btn btn-primary basicbtn" type="submit">{{ __('Save') }}</button>
          </div>
        </div>

        <span>{{ __('Subdomain Example') }}: <b><span class="text-danger">sub1.</span>{{ env('APP_PROTOCOLESS_URL') }}</b></span><br>
        @php
        $ext='\.';
        $ext=str_replace('.', "", $ext);
        $paths=explode($ext, base_path());
        $count=count($paths);
        @endphp
        <span>Your Root Path: <b><span class="text-danger">@foreach($paths as $key => $row) 
          @php
          $key=$key+1;
          @endphp 
         @if($key != $count){{ $row }}\@endif 
         @endforeach</span></span>
          <br>
        <span>{{ __('Note') }}: <b><span class="text-danger">{{ __('Before Add New Domain Please Create Domain Manually On Your Server The Domain Root Path Is Same With Your Project Directory') }}</span></b></span>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@push('js')
<script src="{{ asset('assets/js/form.js') }}"></script>
@endpush