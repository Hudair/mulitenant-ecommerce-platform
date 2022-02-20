@extends('layouts.app')
@section('head')
@include('layouts.partials.headersection',['title'=>'Edit '.$info->name])
@endsection
@section('content')
<div class="row">
  <div class="col-12 mt-2">
    <div class="card">
      <div class="card-body">
        <form method="post" action="{{ route('admin.payment-geteway.update',$info->id) }}" class="basicform" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class="row">
            <div class="col-sm-8">
              <div class="form-group">
               <label>Gateway Name</label>
               <input type="text" name="title" class="form-control" required value="{{ $info->name }}"> 
             </div>

              <div class="form-group">
               <label>Desctiption</label>
               <textarea class="form-control" name="description" required="">{{ $info->description->content ?? '' }}</textarea>
             </div>
             @if($info->slug != 'cod')
             <div class="form-group">
               <label>Status</label>
               <select class="form-control" name="status">
                 <option value="1" @if($info->featured === 1) selected="" @endif>Enable</option>
                 <option value="0" @if($info->featured === 0) selected="" @endif>Disable</option>
               </select>
             </div>
             @endif
             @if($info->slug=='instamojo')
             <div class="form-group">
               <label>X-Api-Key</label>
               <input type="text" name="x_api_Key" class="form-control" required value="{{ $credentials->x_api_Key ?? '' }}"> 
             </div>

             <div class="form-group">
               <label>X-Auth-Token</label>
               <input type="text" name="x_api_token" class="form-control" required value="{{ $credentials->x_api_token ?? '' }}"> 
             </div>

             @endif

              @if($info->slug=='razorpay')
             <div class="form-group">
               <label>Key Id</label>
               <input type="text" name="key_id" class="form-control" required value="{{ $credentials->key_id ?? '' }}"> 
             </div>

             <div class="form-group">
               <label>Key Secret</label>
               <input type="text" name="key_secret" class="form-control" required value="{{ $credentials->key_secret ?? '' }}"> 
             </div>

            <div class="form-group">
              <label>Currency</label>
              <input class="form-control" required="" value="{{ $credentials->currency ?? '' }}" name="currency" required="" type="text">
            </div>

             @endif

             @if($info->slug=='paypal')
             <div class="form-group">
               <label>Client ID</label>
               <input type="text" name="client_id" class="form-control" required value="{{ $credentials->client_id ?? '' }}"> 
             </div>

             <div class="form-group">
               <label>Secret</label>
               <input type="text" name="client_secret" class="form-control" required value="{{ $credentials->client_secret ?? '' }}"> 
             </div>

             <div class="form-group">
              <label>Currency</label>
              <input class="form-control" required="" value="{{ $credentials->currency ?? '' }}" name="currency" required="" type="text">
            </div>

             @endif

             @if($info->slug=='stripe')
             <div class="form-group">
               <label>Publishable key</label>
               <input type="text" name="publishable_key" class="form-control" required value="{{ $credentials->publishable_key ?? '' }}"> 
             </div>

             <div class="form-group">
               <label>Secret key</label>
               <input type="text" name="secret_key" class="form-control" required value="{{ $credentials->secret_key ?? '' }}"> 
             </div>

             <div class="form-group">
              <label>Currency</label>
              <input class="form-control" required="" value="{{ $credentials->currency ?? '' }}" name="currency" required="" type="text">
            </div>

             @endif
             @if($info->slug=='toyyibpay')
             <div class="form-group">
               <label>User Secret Key</label>
               <input type="text" name="userSecretKey" class="form-control" required value="{{ $credentials->userSecretKey ?? '' }}"> 
             </div>

             <div class="form-group">
              <label>Category Code</label>
               <input type="text" name="categoryCode" class="form-control" required value="{{ $credentials->categoryCode ?? '' }}"> 
             </div>

             @endif
             @if($info->slug=='mollie')
             <div class="form-group">
              <label>API Key</label>
              <input class="form-control" required="" value="{{ $credentials->api_key ?? '' }}" name="api_key" required="" type="text">
            </div>

            <div class="form-group">
              <label>Currency</label>
              <input class="form-control" required="" value="{{ $credentials->currency ?? '' }}" name="currency" required="" type="text">
            </div>

            @endif

            @if($info->slug=='paystack')
            <div class="form-group">
              <label>Public Key</label>
              <input class="form-control" required="" value="{{ $credentials->public_key ?? '' }}" name="public_key" required="" type="text">
            </div>
            <div class="form-group">
              <label>Secret Key</label>
              <input class="form-control" required="" value="{{ $credentials->secret_key ?? '' }}" name="secret_key" required="" type="text">
            </div>

            <div class="form-group">
              <label>Currency</label>
              <input class="form-control" required="" value="{{ $credentials->currency ?? '' }}" name="currency" required="" type="text">
            </div>

            @endif

            @if($info->slug=='mercado')
            <div class="form-group">
              <label>Public Key</label>
              <input class="form-control" required="" value="{{ $credentials->public_key ?? '' }}" name="public_key" required="" type="text">
            </div>
            <div class="form-group">
              <label>Access Token</label>
              <input class="form-control" required="" value="{{ $credentials->access_token ?? '' }}" name="access_token" required="" type="text">
            </div>

            

            @endif



            <div class="form-group">
             <button class="btn btn-primary basicbtn" type="submit" >Update</button>
             </div>
           </div>
            <div class="col-sm-4">
              <div class="form-group col-12">
                <label>Thumbnail</label>
                <div  class="image-preview">
                  <label for="image-upload" id="image-label">Choose Thumbnail</label>
                  <input type="file" name="file" class="img_up" accept="image/*" />
                </div>

              </div>
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