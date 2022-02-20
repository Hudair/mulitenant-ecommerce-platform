@if(filter_var(domain_info('custom_css'),FILTER_VALIDATE_BOOLEAN) == true)
@if(file_exists('uploads/'.domain_info('user_id').'/additional.css'))
<link rel="stylesheet" href="{{ asset('uploads/'.domain_info('user_id').'/additional.css') }}" />
@endif
@endif

@if(filter_var(domain_info('gtm'),FILTER_VALIDATE_BOOLEAN) == true)
@if(Cache::has(domain_info('user_id').'tag_manager'))
@php
$tag_manager=Cache::get(domain_info('user_id').'tag_manager');
@endphp
{!! google_tag_manager_header($tag_manager ?? 1234) !!}
@endif
@endif

@if(filter_var(domain_info('facebook_pixel'),FILTER_VALIDATE_BOOLEAN) == true)
@if(Cache::has(domain_info('user_id').'fb_pixel'))
@php
$facebook_pixel=Cache::get(domain_info('user_id').'fb_pixel');
@endphp
{!! facebook_pixel($fb_pixel ?? 1234) !!}
@endif
@endif

@if(filter_var(domain_info('pwa'),FILTER_VALIDATE_BOOLEAN) == true)
@if(file_exists('uploads/'.domain_info('user_id').'/manifest.json'))
<link rel="manifest"  href="{{ asset('uploads/'.domain_info('user_id').'/manifest.json') }}">
@endif
@endif