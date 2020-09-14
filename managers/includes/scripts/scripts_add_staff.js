/*
* This file is the script for adding staff.
*
*
* @author Stephanie Gomes
* @version 19/04/2020
*/

$(document).ready(function() {
  jwerty.key('esc', function(){
    $('.modal').modal('hide');
  });
  $('#paginate').DataTable({"pageLength": 25,"stateSave": true,"aLengthMenu": [[25, 50, 100, -1], [25, 50, 100, "All"]], "aaSorting": []});
});

$('[data-toggle="popover"], .pwpopover').popover();
$('.pwpopover').on('click', function (e) {
  $('.pwpopover').not(this).popover('hide');
});
$('.modal').on('hidden.bs.modal', function () {
  $('.pwpopover').popover('hide');
});
