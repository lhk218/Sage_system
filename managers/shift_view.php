<?php
/**
* This file displays the attributes of a shift and allows a shift to be edited.
*
* Framework used:
* UserSpice 5
* An Open Source PHP User Management System by the UserSpice Team at http://UserSpice.com
*
* @author James Bradford
* @version 19/04/2020
*/

require_once '../users/init.php';
require_once $abs_us_root.$us_url_root.'/users/includes/template/prep.php';
require_once $abs_us_root.$us_url_root.'managers/includes/manager_functions.php';
require_once $abs_us_root.$us_url_root.'includes/imports.php';
if (!securePage($_SERVER['PHP_SELF'])){die();}

//Assign Variables
$shift_id = $_GET['shiftid'];
$start_date = date_format(date_create(getShiftDetails('start_date', $shift_id)), 'm/d/Y');
$end_date = date_format(date_create(getShiftDetails('end_date', $shift_id)), 'm/d/Y');
$notes = getShiftDetails('notes', $shift_id);
?>

<!--Import CSS-->
<link rel="stylesheet" type="text/css" href="<?php echo $us_url_root ?>includes/custom_css.css" />
<body onload="reassignMsg()">
  <div class="container">

<!--Import Messages-->
<?php require_once $abs_us_root.$us_url_root.'managers/includes/manager_messages.php';?>

  <h1>Shift Details</h1><hr/>
  <button class="btn btn-primary" data-toggle="modal" data-target="#reassignShift">Reassign Shift</button>
  <button class="btn btn-danger" data-toggle="modal" data-target="#deleteShift">Delete Shift</button><hr/>
  <div class="row">
    <div class="col-sm-12">

<!--Echo shift details-->
          <h3><?php echo getFullNameFromShiftID($shift_id) ?></h3>
          <form onsubmit="return validateEditedShift()" action="<?php echo $us_url_root ?>managers/includes/manager_actions.php?shiftid=<?php echo $shift_id ?>&action=editdate" method="post">
            <div class="form-group">
              <label for="start_date">Start Date</label>
              <input class="form-control" type="text" value="<?php echo $start_date ?>" name="start_date" id="start_date" placeholder="MM-DD-YYYY"/>
            </div>
            <div class="form-group">
              <label for="end_date">End Date</label>
              <input class="form-control" type="text" value="<?php echo $end_date ?>" name="end_date" id="end_date" placeholder="MM-DD-YYYY"/>
            </div>
            <div class="form-group">
              <label for="notes">Notes</label>
              <textarea class="form-control" rows="6" name="notes" id="notes"><?php echo $notes ?></textarea>
            </div>
            <input type="text" value="<?php echo $shift_id ?>" name="shift_id" id="shift_id" hidden />
            <a class="btn btn-light float-left" href="../index.php">Back</a>
            <input type="submit" class="btn btn-success float-right" value="Confirm">
          </form>

</div>
</div>
</body>

<!-- Delete Shift Modal -->
<?php require_once $abs_us_root.$us_url_root.'managers/includes/modals/modal_delete_shift.php'; ?>

<!-- Reassign Shift Modal -->
<?php require_once $abs_us_root.$us_url_root.'managers/includes/modals/modal_reassign_shift.php'; ?>

<!-- Import Scripts -->
<script src="<?php echo $us_url_root ?>includes/date_picker.js" type="text/javascript"></script>
<script src="<?php echo $us_url_root ?>includes/scripts.js" type="text/javascript"></script>
<script src="<?php echo $us_url_root ?>managers/includes/manager_scripts.js" type="text/javascript"></script>
