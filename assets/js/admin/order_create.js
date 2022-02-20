"use strict";
function openModal(id) {
	$('#plan').val(id);
}
$('#notification_status').on('change',()=>{
	var val=$('#notification_status').val();
	if (val=="yes") {
		$('#email_content').show()
	}
	else{
		$('#email_content').hide()
	}
});