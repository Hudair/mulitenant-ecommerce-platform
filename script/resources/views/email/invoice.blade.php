<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice</title>
    
    <style>
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, .15);
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }

        .invoice-box table.item {
            text-align: center;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            font-weight: bold;
            padding: 10px 0;
        }

        

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td{
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        /* RTL */
        .rtl {
            direction: rtl;
            font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }

        .rtl table {
            text-align: right;
        }

        .rtl table tr td:nth-child(2) {
            text-align: left;
        }
        .text-left{
            text-align: left;
        }
        .text-right{
            text-align: right;
        }
    </style>
</head>

<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                <img height="80" width="160" src="{{ asset('uploads/'.$order->user_id.'/logo.png') }}">
                                
                            </td>
                            
                            <td>
                                <strong>Invoice No: </strong>{{ $order->order_no }}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
           
            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>

                            <td>
                               @if($order->order_type==1)
                               Shipped To<br>
                               Shipping Method: {{ $order->shipping_info->shipping_method->name ?? '' }}<br>
                               Name: {{ $order_content->name ?? '' }}<br>
                               Email: {{ $order_content->email ?? '' }}<br>
                               Phone: {{ $order_content->phone ?? '' }}<br>
                              
                               City: {{ $order->shipping_info->city->name ?? '' }}<br>
                               Postal Code: {{ $order_content->zip_code  ?? ''}}
                               <br>
                               Address: {{ $order_content->address ?? '' }}
                                

                               <br>
                               @endif
                              @if($order->order_type==0)
                               Name: {{ $order_content->name ?? '' }}<br>
                               Email: {{ $order_content->email ?? '' }}<br>
                                
                               @endif
                           </td>
                           

                           
                           
                           <td>
                            @if(!empty($location))
                            <strong>{{ $location->company_name }}</strong><br>
                            {{ $location->zip_code }}, {{ $location->address }}, {{ $location->city }}, {{ $location->state }}<br>
                            
                            Email: {{ $location->email }}<br>
                            Phone: {{ $location->phone }}<br>
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <td>
                            Payment Status: <br>


                            @if($order->payment_status==2)
                            <div class="badge">Pending</div>
                            @elseif($order->payment_status==1)
                            <div class="badge">Paid</div>
                            @elseif($order->payment_status==0)
                            <div class="badge">Cancel</div>
                            @elseif($order->payment_status==3)
                            <div class="badge">Incomplete</div>
                            @endif

                        </td>

                        <td>
                            Order Date: <br>
                            {{ $order->created_at->format('d-F-Y') }} 
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <table class="item">
            <tbody>
                <tr class="heading">
                    <td class="text-left">Product</td>
                                 
                    <td class="text-center">Product Price</td>
                    <td class="text-right">Totals</td>
                </tr>
                @foreach($order->order_item as $key=>$orderitem)
                <tr>
                    <td class="text-left">{{ $orderitem->term->title }}
                        @php
						$variations=json_decode($orderitem->info);	 
						@endphp
                         @if(count($variations->attribute) > 0 || count($variations->options) > 0) - @endif
						@foreach ($variations->attribute ?? [] as $item)
                        		
						<span>{{ __('Variation') }} :</span> <small>{{ $item->attribute->name ?? '' }} - {{ $item->variation->name ?? '' }}</small>
						@endforeach
						@foreach ($variations->options ?? [] as $option)
						<span>{{ __('Options') }} :</span> <small>{{ $option->name ?? '' }}</small>
						@endforeach
                    </td>
                    <td class="text-center">{{ amount_format($orderitem->amount)  }} x {{ $orderitem->qty }}</td>
                    <td class="text-right">{{ amount_format($orderitem->amount*$orderitem->qty) }}</td>
                </tr>
                @endforeach
                <tr class="subtotal">
                    
                    <td></td>
                    <td></td>
                    <td><hr></td>
                </tr>
               
               
                <tr class="subtotal">
                    
                    <td></td>
                    <td class="text-right"><strong>Discount:</strong></td>
                    <td class="text-right">- {{ amount_format($order_content->coupon_discount) }}</td>
                </tr>
                
                <tr>
                   
                    <td></td>
                    <td class="text-right"><strong>Tax:</strong></td>
                    <td class="text-right">{{ $order->tax }}</td>
                </tr>
                @if($order->order_type == 1)
                <tr>
                   
                    <td></td>
                    <td class="text-right"><strong>Shippping:</strong></td>
                    <td class="text-right">{{ amount_format($order->shipping) }}</td>
                </tr>
                @endif
                 <tr class="subtotal">
                   
                    <td></td>
                    <td class="text-right"><strong>Subtotal:</strong></td>
                    <td class="text-right">{{ amount_format($order_content->sub_total) }}</td>
                </tr>
                <tr>
                   
                    <td></td>
                    
                    <td class="text-right"><strong>Total:</strong></td>
                    <td class="text-right">{{ amount_format($order->total) }}</td>
                </tr>
            </tbody>
        </table>
    </table>
</div>
</body>
</html>