<?php
/**
* This file is the modal to remove a staff member.
*
* Framework used:
* UserSpice 5
* An Open Source PHP User Management System by the UserSpice Team at http://UserSpice.com
*
* @author Stephanie Gomes
* @version 19/04/2020
*/
?>

<div class="modal fade" id="deleteStaff">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Delete an employee</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form method="POST">
        <!-- Modal body -->
        <div class="modal-body">
          <p>Are you sure you want to delete this employee?</p>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <input type="hidden" name="delete" value="" id="row-id-to-delete" />
          <button type="submit" class="btn btn-danger" >Confirm Deletion</button>
          <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>
