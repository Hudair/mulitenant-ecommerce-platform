@component('mail::message')

{{ $data['message'] }}

--------

This email was sent from {{ $data['name'] }} <<a href="mailto:{{ $data['email'] }}">{{ $data['email'] }}</a>> through your property contact form on {{ env('APP_NAME') }}.

You can reply directly to this email to respond to {{ $data['name'] }} <<a href="mailto:{{ $data['email'] }}">{{ $data['email'] }}</a>>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
