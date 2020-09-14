<?php
/**
* This file displays a modal that allows a shift to be swapped.
*
* Framework used:
* UserSpice 5
* An Open Source PHP User Management System by the UserSpice Team at http://UserSpice.com
*
* @author James Bradford
* @version 19/04/2020
*/
?>

<!-- Beginning of new swap modal -->
<div class="modal" id="createSwap">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Swap a Shift</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form action="includes/manager_actions.php?action=createSwap" method="post" class="text-center">
          <div class="form-group">

            <!-- Select box, if a shift has already been swapped it will not appear -->
            <select class="form-control" name="shift_id" id="shift_id" required>
              <option value="">Select a shift</option>
              <?php foreach (getAllShifts() as $s) {
                if (!isSwapped($s->id)) {?>
                  <option value="<?php echo $s->id ?>"><?php echo $s->id." | ".$s->start_date." - ".$s->end_date; ?></option>
                <?php }} ?>
              </select>

            </div>
            <input type="submit" class="btn btn-success" value="+ Create Request" />
          </form>
        </div>

      </div>
    </div>
  </div>
