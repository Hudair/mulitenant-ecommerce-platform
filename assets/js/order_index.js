 "use strict"
 var payment_status=$('#payment').val();
 var order_status=$('#order_status').val();

 $('#payment_status').val(payment_status);
 $('#status').val(order_status);    


 function success(arg){
 	location.reload();
 }