/*
* This file ensures the shift start date is not later than the end date.
*
* Framework used:
* UserSpice 5
* An Open Source PHP User Management System by the UserSpice Team at http://UserSpice.com
*
* @author James Bradford
* @version 19/04/2020
*/

function validateNewShift() {
  var start_date = new Date(document.getElementById('start_date').value);
  var end_date = new Date (document.getElementById('end_date').value);

  if (start_date.getTime() > end_date.getTime()) {
    document.getElementById("newShiftError").style.display = "";
    return false;
  } else {return true;}

}
