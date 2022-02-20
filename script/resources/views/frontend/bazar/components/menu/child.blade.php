@if ($childrens)
  	<li >  
        @if (isset($childrens->children)) 			
  	    
        <li class="has-dropdown has-dropdown--ul-left-100">
            <a  href="{{ url($childrens->href) }}" @if(!empty($childrens->target)) target={{ $childrens->target }} @endif>{{ $childrens->text }} <i class="fas fa-angle-down u-s-m-l-6"></i></a> 
            <span class="js-menu-toggle"></span>
        <ul class="w-170">            
			@foreach($childrens->children as $row)
			 @include('frontend.bazar.components.menu.child', ['childrens' => $row])
            @endforeach           
        </ul>	
        </li>
        @else
        <a  href="{{ url($childrens->href) }}" @if(!empty($childrens->target)) target={{ $childrens->target }} @endif>{{ $childrens->text }}</a> 
		@endif
	</li>
@endif


