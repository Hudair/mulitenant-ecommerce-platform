    "use strict";

    var logo = document.getElementById('logo');
    var options = {
    "key": $('#razorpayId').val(), // Enter the Key ID generated from the Dashboard
    "amount": $('#amount').val(), // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
    "currency": $('#currency').val(),
    "name": $('#name').val(),
    "description": $('#description').val(),
    "image": logo, // You can give your logo url
    "order_id": $('#orderId').val(), //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
    "handler": function (response){
        // After payment successfully made response will come here
        // send this response to Controller for update the payment response
        // Create a form for send this data
        // Set the data in form
        document.getElementById('rzp_paymentid').value = response.razorpay_payment_id;
        document.getElementById('rzp_orderid').value = response.razorpay_order_id;
        document.getElementById('rzp_signature').value = response.razorpay_signature;

        // // Let's submit the form automatically
        document.getElementById('rzp-paymentresponse').click();
    },
    "prefill": {
        "name": $('#name').val(),
        "email": $('#email').val(),
        "contact": $('#contactNumber').val()
    },
    "notes": {
        "address": $('#address').val()
    },
    "theme": {
        "color": "#F37254"
    }
};
var rzp1 = new Razorpay(options);
window.onload = function(){
    document.getElementById('rzp-button1').click();
};

document.getElementById('rzp-button1').onclick = function(e){
    rzp1.open();
    e.preventDefault();
}