@extends('layouts.app')
@section('head')
@include('layouts.partials.headersection',['title'=>'Marketing Tools'])
@endsection
@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4>{{ __('Google Analytics') }}</h4><br>
       
      </div>
      <div class="card-body">
        <form class="basicform" action="{{ route('admin.marketing.store') }}" method="post">
          @csrf
          <input type="hidden" name="type" value="google-analytics">
        <div class="form-group row mb-4">
         <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" > <a href="https://developers.google.com/analytics/devguides/collection/gtagjs" target="_blank">{{ __('GA_MEASUREMENT_ID') }}</a></label>
          <div class="col-sm-12 col-md-7">
            <input type="text" class="form-control" required="" name="ga_measurement_id" placeholder="UA-123456789" value="{{ $info->ga_measurement_id ?? '' }}">
          </div>
        </div>

        <div class="form-group row mb-4">
         <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3 text-primary" >{{ __('ANALYTICS VIEW ID') }}</label>
          <div class="col-sm-12 col-md-7">
            <input type="text" class="form-control" required="" name="analytics_view_id" placeholder="12345678" value="{{ $info->analytics_view_id ?? '' }}">
          </div>
        </div>
        <div class="form-group row mb-4">
         <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3 text-primary" >{{ __('service-account-credentials.json') }}</label>
          <div class="col-sm-12 col-md-7">
            <input type="file" name="file" class="form-control" accept=".json">
          </div>
        </div>

       
       
       
      
        <div class="form-group row mb-4">
          <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Status') }}</label>
          <div class="col-sm-12 col-md-7">
            <select class="form-control selectric" name="google_status">
              @if(!empty($info))
              <option value="on" @if($info->google_status  === 'on') selected="" @endif>{{ __('Enable') }}</option>
              <option value="off"  @if($info->google_status  === 'off') selected="" @endif>{{ __('Disable') }}</option>
              @else
              <option value="on">{{ __('Enable') }}</option>
              <option value="off" >{{ __('Disable') }}</option>
              @endif
            </select>
          </div>
        </div>
         
        <div class="form-group row mb-4">
          <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
          <div class="col-sm-12 col-md-7">
            <button class="btn btn-primary basicbtn" type="submit">{{ __('Save') }}</button><br>
            <small>{{ __('Note:') }} </small> <small class="text-danger mt-4">{{ __('After You Update Settings The Action Will Work After 5 Minutes') }}</small>
          </div>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>


 <div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4>{{ __('Facebook Pixel') }}</h4><br>
       
      </div>
      <div class="card-body">
        <form class="basicform" action="{{ route('admin.marketing.store') }}" method="post">
          @csrf
          <input type="hidden" name="type" value="fb_pixel">
        <div class="form-group row mb-4">
         <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" > <a href="https://developers.facebook.com/docs/facebook-pixel/implementation" target="_blank">{{ __('Your Pixel Id') }}</a></label>
          <div class="col-sm-12 col-md-7">
            <input type="text" class="form-control" required="" name="fb_pixel" placeholder="31064306894650" value="{{ $info->fb_pixel ?? '' }}">
          </div>
        </div>

       
       
       
      
        <div class="form-group row mb-4">
          <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Status') }}</label>
          <div class="col-sm-12 col-md-7">
            <select class="form-control selectric" name="fb_pixel_status">
              @if(!empty($info))
              <option value="on" @if($info->fb_pixel_status  === 'on') selected="" @endif>{{ __('Enable') }}</option>
              <option value="off"  @if($info->fb_pixel_status  === 'off') selected="" @endif>{{ __('Disable') }}</option>
              @else
              <option value="on">{{ __('Enable') }}</option>
              <option value="off" >{{ __('Disable') }}</option>
              @endif
            </select>
          </div>
        </div>
         
        <div class="form-group row mb-4">
          <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
          <div class="col-sm-12 col-md-7">
            <button class="btn btn-primary basicbtn" type="submit">{{ __('Save') }}</button><br>
            <small>{{ __('Note:') }} </small> <small class="text-danger mt-4">{{ __('After You Update Settings The Action Will Work After 5 Minutes') }}</small>
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