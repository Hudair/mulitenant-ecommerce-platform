"use strict";	
//success response will assign this function
function success(res){
	$('#menuArea').load(' #menuArea');
	Sweet('success','Menu Creaed')
}

$(".checkAll").on('click',function(){
	$('input:checkbox').not(this).prop('checked', this.checked);
});