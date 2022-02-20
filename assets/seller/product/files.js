"use strict";

function success(argument) {
	location.reload()
}

function make_trash(param) {
	Swal.fire({
		title: 'Are you sure?',
		text: "You won't be able to revert this!",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Yes, Do It!'
	}).then((result) => {
		if (result.value == true) {
			$('#m_id').val(param);
			$('#basicform').submit();
		}
	})
}

$('.edit').on('click',function(){
	var url= $(this).attr("data-url");
	var id= $(this).attr("data-id");
	var attribute= $(this).attr("data-attribute");
	var name= $(this).attr("data-name");
	
	$('#varient').val(attribute)	
	$('#url').val(url)	
	$('#name').val(name)	
	$('#id').val(id)	

});