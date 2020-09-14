<?php
/**
* This file is the confirmation modal to delete a shift.
*
* Framework used:
* UserSpice 5
* An Open Source PHP User Management System by the UserSpice Team at http://UserSpice.com
*
* @author James Bradford
* @version 19/04/2020
*/
?>

<div class="modal" id="deleteShift">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Delete a Shift</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <p>Are you sure you want to delete this shift?</p>
        <a class="btn btn-danger" href="includes/manager_actions.php?shiftid=<?php echo $shift_id ?>&action=delete">Confirm Deletion</a>
        <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
      </div>

    </div>
  </div>
</div>
