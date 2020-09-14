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

<div class="modal" id="deletePreference<?php echo $p->id ?>">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Delete a Preference</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <p>Are you sure you want to delete this preference?</p>
      </div>

      <div class="modal-footer">
        <form method="post" action="<?php echo $us_url_root ?>staff/includes/staff_actions.php?action=cancelPreference">
          <input type="text" value="<?php echo $p->id; ?>" name="preference_id" id="preference_id" hidden />
          <input type="submit" class="btn btn-danger float-left" value="Confirm Deletion" />
        </form>
        <button type="button" class="btn btn-light float-right" data-dismiss="modal">Cancel</button>
      </div>

    </div>
  </div>
</div>
