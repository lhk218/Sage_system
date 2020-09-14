<?php
require_once '../users/init.php';
require_once $abs_us_root.$us_url_root.'/users/includes/template/prep.php';
if (!securePage($_SERVER['PHP_SELF'])){die();}
require_once 'includes/staff_functions.php';
require_once '../includes/functions.php';
?>
<link rel="stylesheet" type="text/css" href="<?php echo $us_url_root ?>includes/custom_css.css" />
<body>
  <div id="page-wrapper">
    <div class="container">

      <!--Import Messages-->
      <?php require_once $abs_us_root.$us_url_root.'includes/messages.php'; ?>

      <h1>Shift Swaps</h1>
      <hr/>

      <!-- IMPORT MODAL -->
      <?php require_once $abs_us_root.$us_url_root.'staff/includes/modals/modal_new_swap.php'; ?>
      <button class="btn btn-success" data-toggle="modal" data-target="#createSwap">+ Create Swap</button></br></br>

      <?php if (count(getOpenUserSwaps())!=0) { ?>
        <table class="table table-bordered text-center">
          <tr>
            <th class='align-middle'>Start Date</th>
            <th class='align-middle'>End Date</th>
            <th class='align-middle'>Status</th>
            <th class='align-middle'></th>
          </tr>
          <?php foreach (getOpenUserSwaps() as $r) {?>
            <tr>
              <td>
                <?php echo getShiftDetails('start_date', $r->shift_id); ?>
              </td>
              <td>
                <?php echo getShiftDetails('end_date', $r->shift_id); ?>
              </td>
              <td>
                <?php echo getSwapStatus($r->id); ?>
              </td>
              <td class="text-center">
                <form method="post" action="<?php echo $us_url_root ?>staff/includes/staff_actions.php?action=cancelSwap">
                  <input type="text" name="request_id" id="request_id" value="<?php echo $r->id ?>" hidden/>
                  <input type="submit" class="btn btn-danger" value="Cancel" />
                </form>
              </td>
            </tr>
          <?php }} else {echo "No requests made";} ?>
        </table>
        <hr/>

        <?php if (count(getOpenSwaps())!=0) { ?>
          <table class="table table-bordered text-center">
            <tr>
              <th class='align-middle'>Start Date</th>
              <th class='align-middle'>End Date</th>
              <th class='align-middle'></th>
            </tr>
            <?php foreach (getOpenSwaps() as $r) {?>
              <tr>
                <td>
                  <?php echo getShiftDetails('start_date', $r->shift_id); ?>
                </td>
                <td>
                  <?php echo getShiftDetails('end_date', $r->shift_id); ?>
                </td>
                <td class="text-center">
                  <form method="post" action="<?php echo $us_url_root ?>staff/includes/staff_actions.php?action=acceptSwap">
                    <input type="text" name="request_id" id="request_id" value="<?php echo $r->id ?>" hidden/>
                    <input type="submit" class="btn btn-success" value="Accept" />
                  </td>
                </tr>
              <?php }} else {echo "No open requests";} ?>
            </table>
            <hr/>

            <?php if (count(getClosedUserSwaps())!=0) { ?>
              <table class="table table-bordered text-center">
                <tr>
                  <th class='align-middle'>Start Date</th>
                  <th class='align-middle'>End Date</th>
                </tr>
                <?php foreach (getClosedUserSwaps() as $r) {?>
                  <tr>
                    <td>
                      <?php echo getShiftDetails('start_date', $r->shift_id); ?>
                    </td>
                    <td>
                      <?php echo getShiftDetails('end_date', $r->shift_id); ?>
                    </td>
                  </tr>
                <?php }} else {echo "No completed requests";} ?>
              </table>
              <?php require_once $abs_us_root . $us_url_root . 'users/includes/html_footer.php'; ?>
            </div>
          </div>
