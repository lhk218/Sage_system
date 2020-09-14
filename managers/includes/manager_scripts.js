/*
* This file is the script for displaying success messages.
*
*
* @author James Bradford
* @version 19/04/2020
*/

/*
* Shows success message.
*
* Shows a success message based on the parameter in the url.
*
*/
function successMsg() {
  var urlParams = new URLSearchParams(window.location.search);
  if(urlParams.has('delete')) {
    $("#deleteShiftSuccess").fadeIn(0);
    setTimeout(function() {$("#deleteShiftSuccess").fadeOut(1000);}, 3000);
  } else if(urlParams.has('edit')) {
    $("#editShiftSuccess").fadeIn(0);
    setTimeout(function() {$("#editShiftSuccess").fadeOut(1000);}, 3000);
} else if(urlParams.has('new')) {
  $("#newShiftSuccess").fadeIn(0);
  setTimeout(function() {$("#newShiftSuccess").fadeOut(1000);}, 3000);
}
}

/*
* Shows success message.
*
* Shows a success message based on the parameter in the url.
*
*/
function reassignMsg() {
  var urlParams = new URLSearchParams(window.location.search);
  if (urlParams.has('reassign')) {
    $("#reassignShiftSuccess").fadeIn(0);
    setTimeout(function() {$("#reassignShiftSuccess").fadeOut(1000);}, 3000);
  }
}
