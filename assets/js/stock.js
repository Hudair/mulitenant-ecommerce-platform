(function ($) {
"use strict";
$('#stock_manage').on('change',function(){
    var status= $(this).val();
    if(status == 1){
        $('.stock_area').show();
    }
    else{
        $('.stock_area').hide();
    }
});
})(jQuery);