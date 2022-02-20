@extends('layouts.app')
@section('head')
@include('layouts.partials.headersection',['title'=>'Domain'])
@endsection
@section('content')
 <div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4>{{ __('Edit Domain') }}</h4>
        <div class="card-header-action">
          <small class="text-right">{{ __('Note') }}: <span class="text-danger">{{ __('It Will Replace Current User Domain') }}</span></small>
        </div>
        
      </div>
      <div class="card-body">

        <form class="basicform" action="{{ route('admin.customdomain.update',$info->id) }}" method="post">
          @csrf
          @method('PUT')
        <div class="form-group row mb-4">
          <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" >{{ __('Domain Name Without Protocol') }} <br><small class="text-danger">example.com</small></label>
          <div class="col-sm-12 col-md-7">
            <input type="text" class="form-control" required="" name="domain" value="{{ $info->domain }}">
          </div>
        </div>

        <div class="form-group row mb-4">
          <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" >{{ __('Reflect With Main Domain') }}</label>

         
          <div class="col-sm-12 col-md-7">
            <select class="form-control selectric" name="reflect">
              <option value="1" >{{ __('Yes') }}</option>
              <option value="0">{{ __('No') }}</option>
             
            </select>
          </div>
        </div>
     
       
        <div class="form-group row mb-4">
          <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Status') }}</label>
          <div class="col-sm-12 col-md-7">
            <select class="form-control selectric" name="status">
              <option value="1" @if($info->status===1) selected="" @endif>{{ __('Active') }}</option>
              <option value="3" @if($info->status===2) selected="" @endif>{{ __('Requested') }}</option>
              <option value="0" @if($info->status===0) selected="" @endif>{{ __('Trash') }}</option>
            </select>
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
        <span>{{ __('Note') }}: <b><span class="text-danger">{{ __('Before Add Or Edit Domain Please Create Or Edit Domain Manually On Your Server The Domain Root Path Is Same With Your Project Directory') }}</span></b></span>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@push('js')
<script src="{{ asset('assets/js/form.js') }}"></script>
@endpush