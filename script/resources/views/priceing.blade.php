@extends('main.app')
@section('content')
<section class="page-title bg-1">
	<div class="overlay"></div>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="block text-center">
					<h1 class="text-capitalize mb-5 text-lg">{{ __('Pricing') }}</h1>
					<span class="text-white">{{ __('priceing_description') }}</span>   
				</div>
			</div>
		</div>
	</div>
</section>

<section class="section gray-bg" id="priceing">
	<div class="container">
		
		<!-- END -->
		<div class="row text-center align-items-end plan_list">
			<!-- Pricing Table-->
			@foreach($plans as $row)
@php
  $plan=json_decode($row->data);
@endphp
          <div class="col-lg-4 mb-5 mb-lg-0  @if($row->featured == 0) priceing @endif">
           <div class="bg-white p-5 rounded-lg  @if($row->featured == 1) shadow @endif ">
           <h1 class="h6 text-uppercase font-weight-bold mb-4">{{ $row->name }}</h1>
           <h2 class="h1 font-weight-bold">{{ amount_format($row->price) }}</h2>
              <span class="font-weight-bold">@if($row->days == 365) {{ __('Yearly') }} @elseif($row->days == 30) {{ __('Monthly') }} @else {{ $row->days }}  {{ __('Days') }} @endif</span>
          <ul class="list-unstyled my-5 text-small text-left font-weight-normal">
         <li class="mb-3">
            {{ __('Products Limit') }} <b>{{ $plan->product_limit }}</b>
         </li>
         <li class="mb-3">
             {{ __('Storage Limit') }} <b>{{ number_format($plan->storage) }}MB</b>
         </li>
          <li class="mb-3">
            {{ __('Use Subdomain') }}
         </li>
         <li class="mb-3">
            @if($plan->custom_domain == 'true')
            {{ __('Use your existing domain') }}
            @else
            <del>{{ __('Use your existing domain') }}</del>
            @endif
         </li>
        
         <li class="mb-3">
            @if($plan->inventory == 'true')
            {{ __('Inventory Management') }}
            @else
            <del> {{ __('Inventory Management') }}</del>
            @endif
         </li>
         <li class="mb-3">
           @if($plan->pos == 'true')
            {{ __('POS System') }}
           @else
           <del>{{ __('POS System') }}</del>
           @endif
         </li>
         <li class="mb-3">
          @if($plan->customer_panel == 'true')
            {{ __('Customer Panel') }}
          @else
            <del>{{ __('Customer Panel') }}</del>
          @endif  
         </li>
         <li class="mb-3">
           @if($plan->google_analytics == 'true')
            {{ __('Google Analytics') }}
           @else
           <del>{{ __('Google Analytics') }}</del>
           @endif 
         </li>
         <li class="mb-3">
           @if($plan->gtm == 'true')
           {{ __('Google Tag Manager (GTM)') }}
           @else
           <del>{{ __('Google Tag Manager (GTM)') }}</del>
           @endif 
            
         </li>
         <li class="mb-3">
          @if($plan->facebook_pixel == 'true')
           {{ __('Facebook Pixel') }}
          @else
          <del>{{ __('Facebook Pixel') }}</del>
          @endif 
         </li>

         <li class="mb-3">
          @if($plan->whatsapp == 'true')
            {{ __('Whatsapp Api') }}
          @else
         <del> {{ __('Whatsapp Api') }}</del>
          @endif   
         </li>
         
          <li class="mb-3">
          @if($plan->qr_code == 'true')
            {{ __('QR Code') }}
          @else
         <del> {{ __('QR Code') }}</del>
          @endif   
         </li>
          <li class="mb-3">
          @if($plan->live_support == 'true')
            {{ __('Technical Support') }}
          @else
         <del> {{ __('Technical Support') }}</del>
          @endif   
         </li>
         
         
         <li class="mb-3">
           {{ __('Multi Language') }}
         </li>
         <li class="mb-3">
           {{ __('Image Optimization') }}
         </li>
      </ul>
      @if($row->is_trial == 1)
      <a href="{{ route('merchant.form',$row->id) }}" class="btn site_color text-white btn-block p-2 shadow rounded-pill">{{ __('Register') }}</a>
      @endif
     </div>
    </div>
@endforeach
			<!-- END -->
		</div>
	</div>
</section>

@endsection