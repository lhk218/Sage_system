<?php
/**
* This file is the modal to add a shift.
*
* Framework used:
* UserSpice 5
* An Open Source PHP User Management System by the UserSpice Team at http://UserSpice.com
*
* @author James Bradford
* @version 19/04/2020
*/
?>
<!-- Add Shift Modal -->
<div class="modal" id="addShift">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add a Shift</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">

        <!-- New Shift Error MSG -->
        <div class="alert alert-danger" id="newShiftError" style="display: none">
          <strong>Error</strong></br> Start date cannot be later than end date.
        </div>

        <!--Add shift form-->
        <form onsubmit="return validateNewShift()" action="managers/includes/manager_actions.php?action=addshift" method="post">
          <div class="form-group">
            <label for="staff">Assigned Staff: </label>
            <select class="form-control" id="staff" name="staff">
              <?php foreach (getAllUsersByRole(1) as $u) { ?>
                <option value="<?php echo $u->user_id ?>"><?php echo $u->user_id." - ".$u->firstname." ".$u->lastname ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <label for="start_date">Start Date</label>
            <input class="form-control" type="text" id="start_date" name="start_date" placeholder="MM/DD/YYYY" required/>
          </div>
          <div class="form-group">
            <label for="end_date">End Date</label>
            <input class="form-control" type="text" id="end_date"  name="end_date" placeholder="MM/DD/YYYY" required/>
          </div>
          <div class="form-group">
            <label for="notes">Notes</label>
            <textarea class="form-control" rows="6" name="notes" id="notes"></textarea>
          </div>


        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <input type="submit" class="btn btn-success" value="Create Shift" />
        </form>
        <!--Add Shift Form-->

        <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
