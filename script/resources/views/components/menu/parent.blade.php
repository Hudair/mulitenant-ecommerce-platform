@if(!empty($menus))
	@foreach ($menus as $key=> $row) 
	<li>
		@if (isset($row->children)) 
		<a  href="#" data-toggle="collapse" data-target="#parent{{ $key }}" ><span>{{ $row->text }}</span><i class="fas fa-chevron-down"></i></a>
		<ul id="parent{{ $key }}" class="{{ $ul }}" data-parent="#accordionExample" >
			@foreach($row->children as $childrens)
			 @include('components.menu.child', ['childrens' => $childrens,'data_parent' => 'parent'.$key])
			@endforeach
		</ul>
		@else
		<a  href="{{ url($row->href) }}" @if(!empty($row->target)) target="{{ $row->target }}" @endif><span>{{ $row->text }}</span></a>
		@endif
	</li>		
	@endforeach
@endif