(function ($) {
	"use strict";
	$('.edit').on('click',function(){
		var oid= $(this).attr("data-oid");
		var td= $(this).attr("data-td");
		var mode= $(this).attr("data-mode");
		var transaction_id= $(this).attr("data-transaction");
		$('#o_id').val(oid);
		$('#t_id').val(td);
		$('#method').val(mode);
		$('#transection_id').val(transaction_id);

	});
})(jQuery);
//suuccess response will assign here
function success(argument) {
	location.reload();
}