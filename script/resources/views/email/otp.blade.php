@component('mail::message')
# Dear {{ $data['name'] }},

You are receiving this email because we received a password reset request for your account.

Below is your one time passcode (OTP):

<center><h4><b>{{ $data['otp'] }}</b></h4></center>

--------

If you dont sent the request just ignore this mail.


Thanks,<br>
{{ config('app.name') }}
@endcomponent
