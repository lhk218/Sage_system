<?php
/**
* This file displays a modal to add a new shift preference.
*
* Framework used:
* UserSpice 5
* An Open Source PHP User Management System by the UserSpice Team at http://UserSpice.com
*
* @author James Bradford
* @version 19/04/2020
*/
?>

<div class="modal" id="createPreference">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Preference</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">

        <!-- New Shift Error MSG -->
        <div class="alert alert-danger" id="newShiftError" style="display: none">
          <strong>Error</strong></br> Start date cannot be later than end date.
        </div>

        <p>Please let us know when you will be unavailable and we will try to accommdate the absence.</p>
        <form onsubmit="return validateNewShift()" action="<?php echo $us_url_root ?>staff/includes/staff_actions.php?action=createPreference" method="post">
          <div class="form-group">
            <label for="start_date">Start Date</label>
            <input class="form-control" type="text" placeholder="MM/DD/YYYY" id="start_date" name="start_date"required/>
          </div>
          <div class="form-group">
            <label for="end_date">End Date</label>
            <input class="form-control" type="text" placeholder="MM/DD/YYYY" id="end_date" name="end_date" required/>
          </div>
          <input type="submit" class="btn btn-success" value="+ Create Preference" />
        </form>
      </div>

    </div>
  </div>
</div>
