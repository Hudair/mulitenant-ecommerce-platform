@extends('main.app')
@section('content')
<section class="page-title bg-1">
  <div class="overlay"></div>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="block text-center">
          <h1 class="text-capitalize mb-5 text-lg">{{ __('features_title') }}</h1>
           <span class="text-white">{{ __('features_description') }}</span>   
        </div>
      </div>
    </div>
  </div>
</section>

<section class="section service gray-bg" id="service">
  <div class="container">
    <div class="row">
       @foreach($features as $row)
      <div class="col-lg-4 col-md-6 col-sm-6">
        <div class="service-item mb-4">
          <div class="icon d-flex align-items-center">
             <img  src="{{ asset($row->preview->content ?? '') }}" height="80">
            <h4 class="mt-3 mb-3">{{ $row->name }}</h4>
          </div>
          <div class="content">
            <p class="mb-4">{{ $row->excerpt->content ?? '' }}</p>
          </div>
        </div>
      </div>
      @endforeach 
    </div>
  </div>
</section>	
@endsection