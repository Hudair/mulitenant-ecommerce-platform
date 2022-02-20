<!--=====================================
FOOTER PART START
=======================================-->
<footer class="footer-part">
   <div class="container">
       <div class="row">
           <div class="col-md-6 col-lg-4">
               <div class="footer-about">
                   <a href="#"><img src="{{ asset('uploads/'.domain_info('user_id').'/logo.png') }}" alt="logo"></a>
                   <p>{{ Cache::get(domain_info('user_id').'shop_description','') }}</p>
                   @if(Cache::has(domain_info('user_id').'socials'))
                   @php
                   $socials=json_decode(Cache::get(domain_info('user_id').'socials',[]));
                   @endphp
                   <ul class="round-icon footer-icon">
                    @foreach($socials as $key => $value)
                       <li><a href="{{ url($value->url) }}" target="_blank"><i class="{{ $value->icon }}"></i></a></li>
                     @endforeach 
                   </ul>
                   @endif
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
              {{ \Amcoders\Lpress\Lphelper::MenuCustomForUser('left') }}
                
            </div>
            <div class="col-md-12 col-lg-3">
                {{ \Amcoders\Lpress\Lphelper::MenuCustomForUser('center') }}
            </div>
             <div class="col-md-12 col-lg-2">
                 {{ \Amcoders\Lpress\Lphelper::MenuCustomForUser('right') }}
            </div>
        </div>
    </div>
    <div class="footer-bottom text-center">
        <div class="container ">
            <div class="row text-center">
            <p>{{ __('Copyright') }} &copy; {{ date('Y') }}. {{ __('All rights reserved by') }} <a href="{{ url('/') }}">{{ Cache::get(domain_info('user_id').'shop_name',env('APP_NAME')) }}</a></p>
            </div>
        </div>
    </div>
</footer>
<!--=====================================
              FOOTER PART END
=======================================-->