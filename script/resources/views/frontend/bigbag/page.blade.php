@extends('frontend.bigbag.layouts.app') 

@section('content') 
<section class="single-banner">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="single-content">
					<h2>{{ $info->title }}</h2>
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{ url('/') }}">{{ __('Home') }}</a></li>
						<li class="breadcrumb-item active" aria-current="page">{{ $info->slug }}</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="product-list">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				{{ content($info->content->value ?? '') }}
			</div>
		</div>
	</div>
</section>    	

@endsection	