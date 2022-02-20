"use strict";

$('.basicform').on('submit',function(){
	var html=$('.basicbtn').html();
	$('.basicbtn').attr('disabled','disabled');
	$('.basicbtn').html('<div class="spinner-border text-light spinner-border-sm" role="status"><span class="sr-only">Loading...</span></div></div>&nbsp&nbsp Please Wait...</span>');
});