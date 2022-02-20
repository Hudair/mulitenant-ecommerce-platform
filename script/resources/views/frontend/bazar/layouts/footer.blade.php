<!--====== Main Footer ======-->
<footer>
   <div class="outer-footer">
      <div class="container">
         <div class="row">
            <div class="col-lg-4 col-md-6">
               <div class="outer-footer__content u-s-m-b-40">
                  @if(Cache::has(domain_info('user_id').'location'))
                  @php
                    $contact=json_decode(Cache::get(domain_info('user_id').'location'));
                  @endphp
                  <span class="outer-footer__content-title">Contact Us</span>
                  <div class="outer-footer__text-wrap"><i class="fas fa-home"></i>
                     <span>{{ $contact->address }}, {{ $contact->city }}, {{ $contact->state }}, {{ $contact->zip_code }}</span>
                  </div>
                  <div class="outer-footer__text-wrap"><i class="fas fa-phone-volume"></i>
                     <span>{{ $contact->phone }}</span>
                  </div>
                  <div class="outer-footer__text-wrap"><i class="far fa-envelope"></i>
                     <span>{{ $contact->email }}</span>
                  </div>
                  @endif
                  @if(Cache::has(domain_info('user_id').'socials'))
                  @php
                  $socials=json_decode(Cache::get(domain_info('user_id').'socials',[]));
                  @endphp
                  <div class="outer-footer__social">
                     <ul>
                        @foreach($socials as $key => $value)
                        <li><a href="{{ url($value->url) }}" target="_blank"><i class="{{ $value->icon }}"></i></a></li>
                        @endforeach
                                               
                     </ul>
                  </div>
                  @endif
               </div>
            </div>
            <div class="col-lg-8 col-md-6">
               <div class="row">
                  <div class="col-lg-4 col-md-4">
                     {{ ThemeFooterMenu('left','frontend.bazar.components.footer_menu') }}
                  </div>
                  <div class="col-lg-4 col-md-4">
                     {{ ThemeFooterMenu('center','frontend.bazar.components.footer_menu') }}
                  </div>
                  <div class="col-lg-4 col-md-4">
                     {{ ThemeFooterMenu('right','frontend.bazar.components.footer_menu') }}
                  </div>
               </div>
            </div>
            
         </div>
      </div>
   </div>
   <div class="lower-footer">
      <div class="container">
         <div class="row">
            <div class="col-lg-12">
               <div class="lower-footer__content">
                  <div class="lower-footer__copyright">                    
                  <span>{{ __('Copyright') }} &copy; {{ date('Y') }}. {{ __('All rights reserved by') }}</span> <a class="text-white" href="{{ url('/') }}">{{ Cache::get(domain_info('user_id').'shop_name',env('APP_NAME')) }}</a>
               </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</footer>