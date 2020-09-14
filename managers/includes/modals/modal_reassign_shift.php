<?php
/**
* This file is the modal to reassign a shift.
*
* Framework used:
* UserSpice 5
* An Open Source PHP User Management System by the UserSpice Team at http://UserSpice.com
*
* @author James Bradford
* @version 19/04/2020
*/
?>

<!-- Reassign Shift Modal -->
<div class="modal" id="reassignShift">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Reassign</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">

        <form action="includes/manager_actions.php?shiftid=<?php echo $shift_id ?>&action=reassign" method="post">
<div class="form-group">
          <label for="staff">Assigned Staff: </label>
          <select class="form-control" id="staff" name="staff">
            <?php foreach (getAllUsersByRole(1) as $u) { ?>
              <option value="<?php echo $u->user_id ?>"><?php echo $u->user_id." - ".$u->firstname." ".$u->lastname ?></option>
            <?php } ?>
          </select>
        </div>
        <input type="text" value="<?php echo $shift_id ?>" name="shift_id" id="shift_id" hidden />

      <!-- Modal footer -->
      <div class="modal-footer">
        <input type="submit" class="btn btn-success" value="Confirm" />
      </form>
        <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
