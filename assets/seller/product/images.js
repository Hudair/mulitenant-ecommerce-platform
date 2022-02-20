"use strict";
var m_id='';
function remove_image(param,key) {
	m_id=key;
	
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
			$('.basicform').submit();
		}
	})
	
}
function success(argument) {
	$('#m_area'+m_id).remove()
}
