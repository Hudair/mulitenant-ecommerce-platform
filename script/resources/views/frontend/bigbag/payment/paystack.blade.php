<!DOCTYPE html>
<html>
<head>
    <title>Payment With Paystack</title>
</head>
<body>
<form action="{{ url('/payement/paystack')}}" method="POST" hidden class="status">	
    <input type="hidden" value="{{csrf_token()}}" name="_token" /> 
   <input type="hidden" name="ref_id" id="ref_id">
</form>
<input type="hidden" id="public_key" value="{{ $credentials['public_key'] }}">
<input type="hidden" id="amount" value="{{ $credentials['amount'] }}">
<input type="hidden" id="currency" value="{{ $credentials['currency'] }}">
<input type="hidden" id="email" value="{{ $credentials['email'] }}">
<input type="hidden" id="rand" value="{{ Str::random(15) }}">
<script src="{{ asset('frontend/bigbag/js/jquery-3.5.1.min.js')}}"></script>
<script src="https://js.paystack.co/v1/inline.js"></script> 
<script src="{{ asset('assets/js/paystack.js')}}"></script>
</body>
</html>