<?php
/**
* This file allows a user to view and create shift preferences.
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
require_once $abs_us_root.$us_url_root.'staff/includes/staff_functions.php';
require_once $abs_us_root.$us_url_root.'includes/imports.php';
?>

<!--Import CSS-->
<link rel="stylesheet" type="text/css" href="<?php echo $us_url_root ?>includes/custom_css.css" />

<!--Page Containers-->
<div id="page-wrapper">
  <div class="container">

    <!--Import Messages-->
    <?php require_once $abs_us_root.$us_url_root.'includes/messages.php'; ?>

    <h1>Shift Preferences</h1>
    <hr/>

    <!-- IMPORT MODAL -->
    <?php require_once $abs_us_root.$us_url_root.'staff/includes/modals/modal_new_preference.php'; ?>
    <?php require_once $abs_us_root.$us_url_root.'staff/includes/modals/modal_delete_preference.php'; ?>

    <!--Opens Create Preference Modal-->
    <button class="btn btn-success" data-toggle="modal" data-target="#createPreference">+ Create Preference</button></br></br>

    <!--List Existing User Preferences-->
    <?php if (count(getUserPreferences())!=0) { ?>
      <table class="table table-bordered text-center">
        <tr>
          <th class='align-middle'>Start Date</th>
          <th class='align-middle'>End Date</th>
          <th></th>
        </tr>
        <?php foreach (getUserPreferences() as $p) { ?>

          <!--Import Delete Modal-->
          <?php require $abs_us_root.$us_url_root.'staff/includes/modals/modal_delete_preference.php'; ?>

          <tr>
            <td>
              <?php echo $p->start_date; ?>
            </td>
            <td>
              <?php echo $p->end_date; ?>
            </td>
            <td>
              <button class="btn btn-danger" data-toggle="modal" data-target="#deletePreference<?php echo $p->id ?>">Remove</button>
            </td>
          </tr>
        <?php }} else { echo 'No preference requests'; } ?>
      </table>

      <!--Import Footer-->
      <?php require_once $abs_us_root . $us_url_root . 'users/includes/html_footer.php'; ?>

      <!--Page Containers-->
    </div>
  </div>

  <!--Date Picker Script-->
  <script src="<?php echo $us_url_root ?>includes/date_picker.js" type="text/javascript"></script>
  <script src="<?php echo $us_url_root ?>includes/scripts.js" type="text/javascript"></script>
