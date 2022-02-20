"use strict";
payWithPaystack();

function payWithPaystack() {
    var rand=$('#rand').val();
    var f_amount=$('#amount').val();
    var final_amount=parseFloat(f_amount);
    var amont=final_amount*100;

    let handler = PaystackPop.setup({
        key: $('#public_key').val(), // Replace with your public key
        email: $('#email').val(),
        amount: amont,
        currency: $('#currency').val(),
        ref: 'ps_'+rand,
        onClose: function(){
            payWithPaystack();
        },
        callback: function(response){
            $('#ref_id').val(response.reference);
            $('.status').submit();

        }
    });
    handler.openIframe();
}