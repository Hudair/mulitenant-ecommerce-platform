@extends('layouts.app')
@section('head')
@include('layouts.partials.headersection',['title'=>'Frontend Settings'])
@endsection
@section('content')
<div class="card">
	<div class="card-body">
		
		<div class="row">
			<div class="col-12 col-sm-12 col-md-4">
				<ul class="nav nav-pills flex-column" id="myTab4" role="tablist">
					<li class="nav-item">
						<a class="nav-link  @if(route('admin.appearance.show','header') == url()->current()) active @endif" href="{{ route('admin.appearance.show','header') }}" >{{ __('Header Section') }}</a>
					</li>
					<li class="nav-item">
						<a class="nav-link @if(route('admin.appearance.show','features') == url()->current()) active @endif" href="{{ route('admin.appearance.show','features') }}">{{ __('Features Section') }}</a>
					</li>
					<li class="nav-item">
						<a class="nav-link @if(route('admin.appearance.show','about_1') == url()->current()) active @endif" href="{{ route('admin.appearance.show','about_1') }}">{{ __('About Section 1') }}</a>
					</li>
					<li class="nav-item">
						<a class="nav-link @if(route('admin.appearance.show','about_2') == url()->current()) active @endif" href="{{ route('admin.appearance.show','about_2') }}">{{ __('About Section 2') }}</a>
					</li>
					<li class="nav-item">
						<a class="nav-link @if(route('admin.appearance.show','about_3') == url()->current()) active @endif" href="{{ route('admin.appearance.show','about_3') }}">{{ __('About Section 3') }}</a>
					</li>
					<li class="nav-item">
						<a class="nav-link @if(route('admin.appearance.show','ecom_features') == url()->current()) active @endif" href="{{ route('admin.appearance.show','ecom_features') }}">{{ __('Market Features') }}</a>
					</li>
					<li class="nav-item">
						<a class="nav-link @if(route('admin.appearance.show','counter_area') == url()->current()) active @endif" href="{{ route('admin.appearance.show','counter_area') }}">{{ __('Counter Area') }}</a>
					</li>
					
					<li class="nav-item">
						<a class="nav-link @if(route('admin.appearance.show','testimonials') == url()->current()) active @endif" href="{{ route('admin.appearance.show','testimonials') }}">{{ __('Testimonials Section') }}</a>
					</li>
					<li class="nav-item">
						<a class="nav-link @if(route('admin.appearance.show','instruction') == url()->current()) active @endif" href="{{ route('admin.appearance.show','instruction') }}">{{ __('Instruction For Custom Domain') }}</a>
					</li>
					<li class="nav-item">
						<a class="nav-link @if(route('admin.appearance.show','css-js') == url()->current()) active @endif" href="{{ route('admin.appearance.show','css-js') }}">{{ __('Custom Css And Js') }}</a>
					</li>

					<li class="nav-item">
						<a class="nav-link @if(route('admin.appearance.show','brands') == url()->current()) active @endif" href="{{ route('admin.appearance.show','brands') }}">{{ __('Brands Section') }}</a>
					</li>

					
				</ul>
			</div>
			<div class="col-12 col-sm-12 col-md-8">
				@yield('append')
			</div>
		</div>

	</div>
</div>
@endsection