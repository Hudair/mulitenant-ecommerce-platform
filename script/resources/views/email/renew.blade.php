@component('mail::message')

Dear {{ $data['name'] }},

{!! $data['message'] ?? '' !!}

@isset($data['references'])
@php
$references=json_decode($data['references'])
@endphp
<table style="width:100%; border: 1px solid black">
	@foreach($references ?? [] as $key => $row)
	<tr>
		<td>{{ $key }}</td>
		<td>{{ $row }}</td>
	</tr>
	@endforeach
	
</table>
@endisset


Thanks,<br>
{{ config('app.name') }}
@endcomponent