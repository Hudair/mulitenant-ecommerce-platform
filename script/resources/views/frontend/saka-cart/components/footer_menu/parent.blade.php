@if(!empty($menus))
@php
$mainMenus=$menus;

@endphp
@if(isset($mainMenus['name']))
@php
$name=$mainMenus['name'];
$menus=$mainMenus['data'];
@endphp
<div class="outer-footer__content u-s-m-b-40">
    <span class="outer-footer__content-title">{{ $name ?? '' }}</span>
    <div class="outer-footer__list-wrap">
        <ul>
           @foreach ($menus ?? [] as $row)
           <li>
            <a href="{{ url($row->href) }}" @if(!empty($row->target)) target="{{ $row->target }}" @endif>{{ $row->text }}</a>
           </li>
           @if (isset($row->children)) 
            @foreach($row->children as $childrens)
            @include('frontend.arafa-cart.components.footer_menu.child', ['childrens' => $childrens])
            @endforeach
           @endif
           @endforeach       
        </ul>
    </div>
 </div>
 @endif
@endif