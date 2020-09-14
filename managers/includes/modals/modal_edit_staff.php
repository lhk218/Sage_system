<?php
/**
* This file is the modal to edit a staff member.
*
* Framework used:
* UserSpice 5
* An Open Source PHP User Management System by the UserSpice Team at http://UserSpice.com
*
* @author Stephanie Gomes
* @version 19/04/2020
*/


// Pull list of staff from database
$results = getStaffList();
foreach ($results as $key=>$value) {
  ?>
  <div class="modal fade" id="edit-<?php echo $value["id"]; ?>">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal header -->
        <div class="modal-header">
          <h4 class="modal-title" id="titleEvent">Edit staff</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <form class="edit_form" id="edit_form" method="POST" action="<?php echo $us_url_root ?>managers/staff_list.php?action=edit">
            <div class="panel-body">
              <p>All fields are required.</p>
              <label for="fname">First Name: </label>
              <input type="text" class="form-control" id="fname" name="fname" placeholder="First Name"
              value="<?php echo $value["fname"]; ?>" required />
              <br/>

              <label for="lname">Last Name: </label>
              <input type="text" class="form-control" id="lname" name="lname" placeholder="Last Name"
              value="<?php echo $value["lname"]; ?>" required />
              <br/>

              <label for="email">Email: </label>
              <input class="form-control" type="text" name="email" id="email"
              value="<?php echo $value["email"]; ?>" required/>
              <br/>
              <input type="hidden" id="id" name="id" value="<?php echo $value["id"];?>" />
            </div>

            <!-- Modal footer -->
            <input type="submit" name="btnSave" id="btnSave" class="btn btn-primary" value="Save">
            <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
          </form>
        </div>

      </div>
    </div>
  </div>
  <?php
}
?>
