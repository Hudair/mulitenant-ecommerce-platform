@extends('frontend.bigbag.layouts.app')
@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/bigbag/css/cart.css') }}">

@endpush  
@section('content')   
<section class="single-banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="single-content">
                    <h2>{{ __('Cart') }}</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ __('Home') }}</a></li>

                        <li class="breadcrumb-item active" aria-current="page">{{ __('Cart') }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>



  <main class="site-main main-container no-sidebar">
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                 <div class="main-content">
                <div class="page-main-content">
                    <div class="bigbag">
                        <div class="bigbag-notices-wrapper"></div>
                        <div class="bigbag-cart-form">
                            <div class="table-responsive">
                                <table class="shop_table shop_table_responsive cart bigbag-cart-form__contents" cellspacing="0">
                                <thead>
                                <tr>
                                    <th class="product-remove"></th>
                                    <th class="product-thumbnail text-left"><i class="fa fa-image"></i></th>
                                    <th class="product-name">{{ __('Product') }}</th>
                                    <th class="product-name">{{ __('variation') }}</th>
                                    <th class="product-name">{{ __('Option') }}</th>
                                    <th class="product-price">{{ __('Price') }}</th>
                                    <th class="product-quantity">{{ __('Quantity') }}</th>
                                    <th class="product-subtotal">{{ __('Total') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach(Cart::content() as $row)   
                                   
                                <tr class="bigbag-cart-form__cart-item cart_item">
                                    <td class="product-remove">
                                        <a href="{{ url('/cart_remove',$row->rowId) }}" class="remove" >×</a></td>
                                    <td class="product-thumbnail">
                                        <a href="{{ url('/product/'.$row->name.'/'.$row->id) }}"><img src="{{ $row->options->preview }}" alt="" height="100"></a></td>
                                    <td class="product-name" data-title="Product">
                                        <a href="{{ url('/product/'.$row->name.'/'.$row->id) }}">{{ $row->name }}</a>
                                    </td>
                                    <td >
                                        @foreach ($row->options->attribute as $attribute)
                                            <p><b>{{ $attribute->attribute->name }}</b> : {{ $attribute->variation->name }}</p>
                                        @endforeach
                                      
                                    </td>
                                    <td >
                                       
                                       @foreach ($row->options->options as $op)
                                       
                                        <p>{{ $op->name }}</p>
                                       @endforeach
                                    </td>
                                    <td><b>{{ amount_format($row->price) }}</b></td>
                                    <td class="text-center">{{ $row->qty }}</td>
                                    <td class="product-subtotal" data-title="Total">
                                        <span class="bigbag-Price-amount amount">{{ amount_format($row->price*$row->qty) }}</span></td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td colspan="12" class="actions">
                                        
                                        
                                            <div class="coupon float-right">
                                                <form class="basicform_with_reload" enctype="multipart/form-data" action="{{ url('/apply_coupon') }}" method="post">
                                                    @csrf
                                                <label for="coupon_code">{{ __('Coupon') }}:</label> <input type="text" name="code" class="input-text" id="coupon_code" value="" placeholder="Coupon code" required="">
                                                <button type="submit" class="button basicbtn">{{ __('Apply coupon') }}
                                                </button>
                                                </form>
                                            </div>
                                        
                                       
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            </div>
           

            <div class="col-sm-4">
                <div class="cart-collaterals">
                    <div class="cart_totals ">
                        <h2 class="text-center">{{ __('Cart totals') }}</h2>
                        <table class="shop_table shop_table_responsive" cellspacing="0">
                            <tbody>
                                <tr class="cart-subtotal">
                                    <th>{{ __('Price Total') }}</th>
                                    <td data-title="Subtotal"><span class="bigbag-Price-amount amount">{{ amount_format(Cart::priceTotal()) }}</span></td>
                                </tr>
                                
                                
                                <tr class="cart-subtotal">
                                    <th>{{ __('Discount') }}</th>
                                    <td data-title="Subtotal"><span class="bigbag-Price-amount amount">- {{ amount_format(Cart::discount()) }}</span></td>
                                </tr>

                                <tr class="cart-subtotal">
                                    <th>{{ __('Tax') }}</th>
                                    <td data-title="Subtotal"><span class="bigbag-Price-amount amount">{{ amount_format(Cart::tax()) }}</span></td>
                                </tr>
                                 <tr class="cart-subtotal">
                                    <th>{{ __('Subtotal') }}</th>
                                    <td data-title="Subtotal"><span class="bigbag-Price-amount amount">{{ amount_format(Cart::subtotal()) }}</span></td>
                                </tr>
                                <tr class="order-total">
                                    <th>{{ __('Total') }}</th>
                                    <td data-title="Total"><strong><span class="bigbag-Price-amount amount text-dark">{{ amount_format(Cart::total()) }}</span></strong>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="bigbag-proceed-to-checkout">
                            <a href="{{ url('/checkout') }}" class="checkout-button button alt bigbag-forward">
                           {{ __('Proceed to checkout') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection 
@push('js')
<script type="text/javascript" src="{{ asset('assets/js/sweetalert2.all.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/form.js') }}"></script>
@endpush