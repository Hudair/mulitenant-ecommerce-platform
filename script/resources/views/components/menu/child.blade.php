@if ($childrens)
  	<li>
  		@if(isset($childrens->children))
  		<a  data-toggle="collapse" data-target="#{{ $child_data_parent ?? 'childcollapse' }}" ><span>{{ $row->text }}</span><i class="fas fa-chevron-down"></i></a>	 
  		@else
  		<a href="{{ url($childrens->href) }}" @if(!empty($childrens->target)) target={{ $childrens->target }} @endif>{{ $childrens->text }}</a>	
  		@endif
  		
		@if (isset($childrens->children)) 
		<ul id="{{ $child_data_parent ?? 'childcollapse' }}" class="{{ $ul }}" data-parent="#{{ $child_data_parent ?? $data_parent }}">
			@foreach($childrens->children as $parent=> $row)
			 @include('components.menu.child', ['childrens' => $row,'child_data_parent'=>'child_parent'.$parent])
			@endforeach
		</ul>
		@endif
	</li>
@endif


