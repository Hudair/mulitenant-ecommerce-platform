@extends('layouts.app')
@section('head')
@include('layouts.partials.headersection',['title'=>'Customer'])
@endsection
@section('content')
 <div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4>{{ __('Edit Customer') }}</h4>
                
      </div>
      <div class="card-body">

        <form class="basicform" action="{{ route('admin.customer.update',$info->id) }}" method="post">
          @csrf
          @method('PUT')

          <div class="form-group row mb-4">
          <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" >{{ __('Customer Name') }}</label>
          <div class="col-sm-12 col-md-7">
            <input type="text" class="form-control" required="" name="name" value="{{ $info->name }}">
          </div>
        </div>

        <div class="form-group row mb-4">
          <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" >{{ __('Customer Email') }}</label>
          <div class="col-sm-12 col-md-7">
            <input type="email" class="form-control" required="" name="email" value="{{ $info->email }}">
          </div>
        </div>

         <div class="form-group row mb-4">
          <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" >{{ __('Password') }}</label>
          <div class="col-sm-12 col-md-7">
            <input type="text" class="form-control" name="password">
          </div>
        </div>

         <div class="form-group row mb-4">
          <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" >{{ __('Status') }}</label>
          <div class="col-sm-12 col-md-7">
           <select class="form-control" name="status">
             <option value="1" @if($info->status==1) selected=""  @endif>{{ __('Active') }}</option>
             <option value="0" @if($info->status==0) selected=""  @endif>{{ __('Trash') }}</option>
             <option value="2" @if($info->status==2) selected=""  @endif>{{ __('Suspended') }}</option>
             <option value="3" @if($info->status==3) selected=""  @endif>{{ __('Request') }}</option>
           </select>
          </div>
        </div>      
        <div class="form-group row mb-4">
          <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
          <div class="col-sm-12 col-md-7">
            <button class="btn btn-primary basicbtn" type="submit">{{ __('Save') }}</button>
          </div>
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