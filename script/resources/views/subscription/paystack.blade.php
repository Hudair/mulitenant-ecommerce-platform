<!DOCTYPE html>
<html>
<head>
    <title>Payment With Paystack</title>
</head>
<body>
@if(url('/') == env('APP_URL'))
<form action="{{ url('/merchant/paystack/status')}}" method="POST" hidden class="status">
@else
<form action="{{ url('/seller/paystack/status')}}" method="POST" hidden class="status">	
@endif	
    <input type="hidden" value="{{csrf_token()}}" name="_token" /> 
   <input type="hidden" name="ref_id" id="ref_id">
</form>
<input type="hidden" id="public_key" value="{{ $paystack_credentials['public_key'] }}">
<input type="hidden" id="amount" value="{{ $paystack_credentials['amount'] }}">
<input type="hidden" id="currency" value="{{ $paystack_credentials['currency'] }}">
<input type="hidden" id="email" value="{{ Auth::user()->email }}">
<input type="hidden" id="rand" value="{{ Str::random(15) }}">
<script src="{{ asset('frontend/bigbag/js/jquery-3.5.1.min.js')}}"></script>
<script src="https://js.paystack.co/v1/inline.js"></script> 
<script src="{{ asset('assets/js/paystack.js')}}"></script>

</body>
</html>