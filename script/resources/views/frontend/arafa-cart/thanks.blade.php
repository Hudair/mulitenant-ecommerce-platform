@extends('frontend.arafa-cart.layouts.app')
@section('content')
 <!--====== App Content ======-->
 <div class="app-content">

	<!--====== Section 1 ======-->
	<div class="u-s-p-y-60">

		<!--====== Section Content ======-->
		<div class="section__content">
			<div class="container">
				<div class="breadcrumb">
					<div class="breadcrumb__wrap">
						<ul class="breadcrumb__list">
							<li class="has-separator">

								<a href="{{ url('/') }}">Home</a></li>
							<li class="is-marked">

								<a>Thanks</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--====== End - Section 1 ======-->


	<!--====== Section 2 ======-->
	<div class="u-s-p-b-60">

		<!--====== Section Content ======-->
		<div class="section__content">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="about">
							<div class="about__container">
								<div class="about__info">
									<h2 class="about__h2">{{ __('Thank you for your order!') }}</h2>
									<h2 class="about__h2">{{ Session::get('order_no') }}</h2>
									<div class="about__p-wrap">
										<p class="about__p">{{ __('Your order has been placed and will be processed as soon as possible.') }}</p>
										<p class="about__p">{{ __('Make sure you make note of your order number, which is') }} <span class="text-medium">{{ Session::get('order_no') }}</p>
										<p class="about__p">{{ __('You will be receiving an email shortly with confirmation of your order.') }}</p>
									</div>

									<a class="about__link btn--e-secondary" href="{{ url('/shop') }}">{{ __('Go Back Shopping') }}</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--====== End - Section Content ======-->
	</div>
	<!--====== End - Section 2 ======-->
</div>
<!--====== End - App Content ======-->
@endsection

