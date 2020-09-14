/*
* This file is the script for removing staff.
*
*
* @author Stephanie Gomes
* @version 19/04/2020
*/

$(document).on('click', '.delete-user-btn', function(){
  $("#row-id-to-delete").val($(this).data('id'));
});
