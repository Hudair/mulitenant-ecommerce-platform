@extends('frontend.bigbag.layouts.app') 
@section('content') 
<section class="single-banner">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="single-content">
					<h2>{{ __('Wishlist') }}</h2>
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{ url('/') }}">{{ __('Home') }}</a></li>
						<li class="breadcrumb-item active" aria-current="page">{{ __('Wishlist') }}</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="product-list bg-white">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="table-responseive">
					<table class="table table-hover">
						<thead>
							<tr>
								<th></th>
								<th>{{ __('Image') }}</th>
								<th>{{ __('Name') }}</th>
								<th>{{ __('Price') }}</th>
								<th>{{ __('View') }}</th>
							</tr>
						</thead>

						<tbody>
							@foreach(Cart::instance('wishlist')->content() as $row)	
                                <tr>
                                    <td>
                                        <a class="text-danger" href="{{ url('/wishlist/remove',$row->rowId) }}">×</a></td>
                                    <td >
                                        <a href="{{ url('/product/'.$row->name.'/'.$row->id) }}"><img src="{{ $row->options->preview }}" alt="" height="100"></a>
                                    </td>
                                    <td >
                                        <a href="{{ url('/product/'.$row->name.'/'.$row->id) }}" class="text-dark">{{ $row->name }} @foreach ($row->options->attribute as $attribute)

                                       <p><b>{{ $attribute->attribute->name }}</b> : {{ $attribute->variation->name }}</p>
                                       @endforeach
                                       @foreach ($row->options->options as $op)
                                       <small>{{ $op->name }}</small>,
                                       @endforeach</a>
                                    </td>
                                    <td>
                                        {{ amount_format($row->price) }}
                                    </td>
                                    <td><a href="{{ url('/product/'.$row->name.'/'.$row->id) }}" class="text-dark">{{ __('View') }}</a></td>
                                </tr>
                               	@endforeach
						</tbody>

					</table>
				</div>
			</div>
		</div>
	</div>
</section>

@endsection   