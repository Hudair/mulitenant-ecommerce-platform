(function ($) {
	"use strict";
$('.add_new_row').on('click',function(){
    var id= $(this).data('id');
    $('#row_id').val(id);
 });

 $('.option_delete').on('click',function(){
    var id= $(this).data('id');
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
              $('#option_id').val(id);
          $('.option'+id).remove();
          $('.delete_from').submit();
          }
      })
 });

 $('.row_edit').on('click',function(){

    var name=$(this).data('name');
    var is_required=$(this).data('required');
    var id=$(this).data('id');
    var select_type=$(this).data('selecttype');
    $('#edit_name').val(name);
    $('#edit_id').val(id);
    if(is_required == 1){
       $('#edit_required').attr('checked','');
    }
    else{
       $('#edit_required').removeAttr('checked')
    }
    $('#edit_id').val(id);
    $('#edit_select').val(select_type);
 });
 $('.row_update_form').on('submit',function() {
    var name=$('#edit_name').val();
    var id=$('#edit_id').val();
    $('#option_name'+id).text(name);
 });

 
})(jQuery);