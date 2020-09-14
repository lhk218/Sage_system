<?php
/**
* This file displays shifts that need swapping and allows a shift to be swapped.
*
* Framework used:
* UserSpice 5
* An Open Source PHP User Management System by the UserSpice Team at http://UserSpice.com
*
* @author James Bradford
* @version 19/04/2020
*/

//Import UserSpice files
require_once '../users/init.php';
require_once $abs_us_root.$us_url_root.'/users/includes/template/prep.php';

//Import Sage functions
require_once $abs_us_root.$us_url_root.'managers/includes/manager_functions.php';
require_once $abs_us_root.$us_url_root.'includes/imports.php';

//Check if user is logged in and has correct permissions
if (!securePage($_SERVER['PHP_SELF'])){die();}
?>
<!-- Import custom CSS file -->
<link rel="stylesheet" type="text/css" href="<?php echo $us_url_root ?>includes/custom_css.css" />
<body>
  <!--Begin page container-->
  <div id="page-wrapper">
    <div class="container">
      <h1>Shift Swaps</h1><hr/>
      <button class="btn btn-success" data-toggle="modal" data-target="#createSwap">+ New Swap</button>
      <hr/>

      <!-- Beginning of all requests section -->
      <div class="card">
        <div class="card-header">All Requests</div>
        <div class="card-body">

          <!-- Import New Swap Modal -->
          <?php require_once $abs_us_root.$us_url_root.'managers/includes/modals/modal_new_swap.php'; ?>

          <!-- If there are any open shift swaps show table -->
          <?php if (count(getAllOpenSwaps())!=0) { ?>
            <table class="table table-bordered text-center">
              <tr>
                <th class='align-middle'>Start Date</th>
                <th class='align-middle'>End Date</th>
                <th class='align-middle'>Status</th>
                <th class='align-middle'></th>
              </tr>
              <!-- For each open shift swap, echo details to table -->
              <?php foreach (getAllOpenSwaps() as $r) {?>
                <tr>
                  <td><?php echo getShiftDetails('start_date', $r->shift_id); ?></td>
                  <td><?php echo getShiftDetails('end_date', $r->shift_id); ?></td>
                  <td><?php echo getSwapStatus($r->id); ?></td>
                  <td class="text-center">
                    <form method="post" action="<?php echo $us_url_root ?>managers/includes/manager_actions.php?action=cancelSwap">
                      <input type="text" name="request_id" id="request_id" value="<?php echo $r->id ?>" hidden/>
                      <input type="submit" class="btn btn-danger" value="Cancel" />
                    </form>
                  </td>
                </tr>

                <!-- If there are no open requests, don't show table -->
              <?php }} else {echo "No requests made";} ?>

            </table>
          </div>
        </div></br>
        <!-- End of all requests section -->

        <!-- Beginning of completed requests section -->
        <div class="card">
          <div class="card-header">Completed Requests</div>
          <div class="card-body">

            <!-- If there are any completed shift swaps show table -->
            <?php if (count(getAllClosedSwaps())!=0) { ?>
              <table class="table table-bordered text-center">
                <tr>
                  <th class='align-middle'>Start Date</th>
                  <th class='align-middle'>End Date</th>
                </tr>

                <!-- For each closed shift swap, echo details to table -->
                <?php foreach (getAllClosedSwaps() as $r) {?>
                  <tr>
                    <td><?php echo getShiftDetails('start_date', $r->shift_id); ?></td>
                    <td><?php echo getShiftDetails('end_date', $r->shift_id); ?></td>
                  </tr>

                  <!-- If there are no open requests, don't show table -->
                <?php }} else {echo "No completed requests";} ?>

              </table>
            </div>
          </div>
          <!-- End of completed requests section -->

          <!-- Import page footer -->
          <?php require_once $abs_us_root . $us_url_root . 'users/includes/html_footer.php'; ?>

          <!-- Closing container tags -->
        </div>
      </div>
