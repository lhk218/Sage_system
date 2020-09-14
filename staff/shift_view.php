<?php
/**
* This file allows the viewing of shift details.
*
* Framework used:
* UserSpice 5
* An Open Source PHP User Management System by the UserSpice Team at http://UserSpice.com
*
* @author James Bradford
* @version 19/04/2020
*/

require_once '../users/init.php';
require_once $abs_us_root.$us_url_root.'users/includes/template/prep.php';
require_once $abs_us_root.$us_url_root.'staff/includes/staff_functions.php';
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

<body>
</br>

<!--Page Containers-->
<div class="container">
  <?php require_once $abs_us_root.$us_url_root.'staff/includes/staff_messages.php'; ?>

  <h1>Shift Details</h1>
  <div class="row">
    <div class="col-sm-12">

      <!--Echo Shift Details-->
      <h2><?php echo getFullNameFromShiftID($shift_id) ?></h2>
      <form>
        <div class="form-group">
          <label for="start_date">Start Date</label>
          <input class="form-control" type="text" value="<?php echo $start_date ?>" name="start_date" id="start_date" readonly="readonly"/>
        </div>
        <div class="form-group">
          <label for="end_date">End Date</label>
          <input class="form-control" type="text" value="<?php echo $end_date ?>" name="end_date" id="end_date" readonly="readonly" />
        </div>
        <div class="form-group">
          <label for="notes">Notes</label>
          <textarea class="form-control" rows="6" name="notes" id="notes" readonly="readonly"><?php echo $notes ?></textarea>
        </div>
      </form>
      <a class="btn btn-light float-left" href="../index.php">Back</a>
    </div>

    <!--Import Footer-->
    <?php require_once $abs_us_root . $us_url_root . 'users/includes/html_footer.php'; ?>

    <!--Page Containers-->
  </div>
</body>
