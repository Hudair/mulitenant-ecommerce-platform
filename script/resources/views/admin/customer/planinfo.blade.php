@extends('layouts.app')
@section('head')
@include('layouts.partials.headersection',['title'=>'Customer Plan Data'])
@endsection
@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4>{{ __('Edit Customer Plan Data') }}</h4>

      </div>
      <div class="card-body">

        <form class="basicform" action="{{ route('admin.customer.updateplaninfo',$domain->id) }}" method="post">
          @csrf
          @method('PUT')

          

          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" >{{ __('Product Limit') }}</label>
            <div class="col-sm-12 col-md-7">
              <input type="text" class="form-control" required="" name="product_limit"   value="{{ $planinfo->product_limit ?? '' }}">
            </div>
          </div>

          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" >{{ __('Storage Limit') }}</label>
            <div class="col-sm-12 col-md-7">
              <input type="text" class="form-control" required="" name="storage"   value="{{ $planinfo->storage ?? '' }}">
            </div>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" >{{ __('Customer Limit') }}</label>
            <div class="col-sm-12 col-md-7">
              <input type="text" class="form-control" required="" name="customer_limit"   value="{{ $planinfo->customer_limit }}">
            </div>
          </div>

          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" >{{ __('Category Limit') }}</label>
            <div class="col-sm-12 col-md-7">
              <input type="text" class="form-control" required="" name="category_limit"   value="{{ $planinfo->category_limit ?? '' }}">
            </div>
          </div>

          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" >{{ __('Location Limit') }}</label>
            <div class="col-sm-12 col-md-7">
              <input type="text" class="form-control" required="" name="location_limit"   value="{{ $planinfo->location_limit ?? '' }}">
            </div>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" >{{ __('Brand Limit') }}</label>
            <div class="col-sm-12 col-md-7">
              <input type="text" class="form-control" required="" name="brand_limit"   value="{{ $planinfo->brand_limit ?? '' }}">
            </div>
          </div>

          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" >{{ __('Variation Limit') }}</label>
            <div class="col-sm-12 col-md-7">
              <input type="text" class="form-control" required="" name="variation_limit"   value="{{ $planinfo->variation_limit ?? '' }}">
            </div>
          </div>

          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" >{{ __('Inventory') }}</label>
            <div class="col-sm-12 col-md-7">
              <select class="form-control" name="inventory">
                <option @if($planinfo->inventory  == true) selected @endif  value=true >{{ __('Enable') }}</option>
                <option  @if($planinfo->inventory  == false) selected @endif value=false >{{ __('Disable') }}</option>
              </select>
            </div>
          </div>

          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" >{{ __('Custom domain') }}</label>
            <div class="col-sm-12 col-md-7">
             <select class="form-control" name="custom_domain">
              <option @if($planinfo->custom_domain  == true) selected @endif  value=true >{{ __('Enable') }}</option>
              <option  @if($planinfo->custom_domain  == false) selected @endif value=false >{{ __('Disable') }}</option>
            </select>
          </div>
        </div>
        <div class="form-group row mb-4">
          <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" >{{ __('POS') }}</label>
          <div class="col-sm-12 col-md-7">
            <select class="form-control" name="pos">
              <option @if($planinfo->pos  == true) selected @endif  value=true >{{ __('Enable') }}</option>
              <option  @if($planinfo->pos  == false) selected @endif value=false >{{ __('Disable') }}</option>
            </select>
          </div>
        </div>
        <div class="form-group row mb-4">
          <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" >{{ __('Customer Panel Access') }}</label>
          <div class="col-sm-12 col-md-7">
            <select class="form-control" name="customer_panel">
              <option @if($planinfo->customer_panel  == true) selected @endif  value=true >{{ __('Enable') }}</option>
              <option  @if($planinfo->customer_panel  == false) selected @endif value=false >{{ __('Disable') }}</option>
            </select>
          </div>
        </div>
        <div class="form-group row mb-4">
          <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" >{{ __('PWA') }}</label>
          <div class="col-sm-12 col-md-7">
            <select class="form-control" name="pwa">
              <option @if($planinfo->pwa  == true) selected @endif  value=true >{{ __('Enable') }}</option>
              <option  @if($planinfo->pwa  == false) selected @endif value=false >{{ __('Disable') }}</option>
            </select>
          </div>
        </div>
        <div class="form-group row mb-4">
          <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" >{{ __('Whatsapp modules') }}</label>
          <div class="col-sm-12 col-md-7">
            <select class="form-control" name="whatsapp">
              <option @if($planinfo->whatsapp  == true) selected @endif  value=true >{{ __('Enable') }}</option>
              <option  @if($planinfo->whatsapp  == false) selected @endif value=false >{{ __('Disable') }}</option>
            </select>
          </div>
        </div>
        <div class="form-group row mb-4">
          <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" >{{ __('Support') }}</label>
          <div class="col-sm-12 col-md-7">
            <select class="form-control" name="live_support">
              <option @if($planinfo->live_support  == true) selected @endif  value=true >{{ __('Enable') }}</option>
              <option  @if($planinfo->live_support  == false) selected @endif value=false >{{ __('Disable') }}</option>
            </select>
          </div>
        </div>
        <div class="form-group row mb-4">
          <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" >{{ __('QR code') }}</label>
          <div class="col-sm-12 col-md-7">
           <select class="form-control" name="qr_code">
            <option @if($planinfo->qr_code  == true) selected @endif  value=true >{{ __('Enable') }}</option>
            <option  @if($planinfo->qr_code  == false) selected @endif value=false >{{ __('Disable') }}</option>
          </select>
        </div>
      </div>
      <div class="form-group row mb-4">
        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" >{{ __('Facebook Pixel') }}</label>
        <div class="col-sm-12 col-md-7">

          <select class="form-control" name="facebook_pixel">
            <option @if($planinfo->facebook_pixel  == true) selected @endif  value=true >{{ __('Enable') }}</option>
            <option  @if($planinfo->facebook_pixel  == false) selected @endif value=false >{{ __('Disable') }}</option>
          </select>
        </div>
      </div>
      <div class="form-group row mb-4">
        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" >{{ __('custom css') }}</label>
        <div class="col-sm-12 col-md-7">
          <select class="form-control" name="custom_css">
            <option @if($planinfo->custom_css  == true) selected @endif  value=true >{{ __('Enable') }}</option>
            <option  @if($planinfo->custom_css  == false) selected @endif value=false >{{ __('Disable') }}</option>
          </select>
        </div>
      </div>
      <div class="form-group row mb-4">
        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" >{{ __('custom js') }}</label>
        <div class="col-sm-12 col-md-7">
         <select class="form-control" name="custom_js">
          <option @if($planinfo->custom_js  == true) selected @endif  value=true >{{ __('Enable') }}</option>
          <option  @if($planinfo->custom_js  == false) selected @endif value=false >{{ __('Disable') }}</option>
        </select>
      </div>
    </div>
    <div class="form-group row mb-4">
      <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" >{{ __('GTM') }}</label>
      <div class="col-sm-12 col-md-7">
       <select class="form-control" name="gtm">
        <option @if($planinfo->gtm  == true) selected @endif  value=true >{{ __('Enable') }}</option>
        <option  @if($planinfo->gtm  == false) selected @endif value=false >{{ __('Disable') }}</option>
      </select>
    </div>
  </div>
  <div class="form-group row mb-4">
    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" >{{ __('google analytics') }}</label>
    <div class="col-sm-12 col-md-7">
     <select class="form-control" name="google_analytics">
      <option @if($planinfo->google_analytics  == true) selected @endif  value=true >{{ __('Enable') }}</option>
      <option  @if($planinfo->google_analytics  == false) selected @endif value=false >{{ __('Disable') }}</option>
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