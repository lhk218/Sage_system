<?php
/**
* This file handles all create, read, update and delete functions related to the work logs.
*
* Framework used:
* UserSpice 5
* An Open Source PHP User Management System by the UserSpice Team at http://UserSpice.com
*
* @author Stephanie Gomes and Tengxi Liu
* @version 17/04/2020
*/

require_once 'users/init.php';
require_once $abs_us_root.$us_url_root.'users/includes/template/prep.php';
require_once $abs_us_root.$us_url_root.'includes/imports.php';
if (!securePage($_SERVER['PHP_SELF'])){die();}

// Retrieve the user currently logged in
$logged_in = $user->data();
$userid = $logged_in->id;
?>
<link rel="stylesheet" type="text/css" href="<?php echo $us_url_root ?>includes/custom_css.css" />
<body>
  <div class="container">
    <div class="content mt-3" style="padding:10px">
      <h1>Shift Notes</h1>
      <hr />

      <!-- Button to add a work log -->
      <div>
        <button id="add-log-btn" class="btn btn-success pull-left add-log-btn" data-toggle="modal" data-target="#addlog">+ Add Note</button></br></br>
      </div>
      <hr />

      <!-- Table of work logs -->
      <table id="paginate" class='table table-bordered table-list-search text-center'>
        <?php
        if (hasPerm([2,3],$userid)){
          // User is an admin or a manager
          ?>
          <thead>
            <tr>
              <th class='align-middle'>ID</th>
              <th class='align-middle'>Last Updated</th>
              <th class='align-middle'>Note</th>
              <th class='align-middle'>Staff First Name</th>
              <th class='align-middle'>Staff Surname</th>
              <th class='align-middle'>Edit</th>
              <th class='align-middle'>Delete</th>
            </tr>
          </thead>
          <?php
          // Retrieve list of all logs in the database
          $results = getAllWorkLogs();
          foreach ($results as $key=>$value) {
            ?>
            <tbody>
              <tr>
                <td><?php echo $value["id"];?></td>
                <td><?php echo $value["last_update"];?></td>
                <td><?php echo $value["note"];?></td>
                <td><?php echo $value["fname"];?></td>
                <td><?php echo $value["lname"];?></td>
                <td>
                  <!-- Button to edit a work log -->
                  <button class="btn btn-primary edit-log-btn" data-target="#edit-<?php echo $value["id"];?>" data-toggle="modal">
                    <span class="glyphicon glyphicon-edit"></span>
                  </button>
                </td>
                <td>
                  <!-- Button to delete a work log -->
                  <button class="btn btn-danger delete-log-btn" data-target="#deleteLog" data-toggle="modal" data-id="<?php echo $value["id"]; ?>" >
                    <span class="glyphicon glyphicon-trash"></span>
                  </button>
                </td>
              </tr>
            </tbody>

            <?php
          }
        } else {
          // User is a staff
          ?>
          <thead>
            <tr>
              <th class='align-middle'>ID</th>
              <th class='align-middle'>Last Updated</th>
              <th class='align-middle'>Note</th>
              <th class='align-middle'>Edit</th>
            </tr>
          </thead>
          <?php
          // Retrieve all logs written by this user
          $results = getMyWorkLogs($userid);
          foreach ($results as $key=>$value) {
            ?>
            <tbody>
              <tr>
                <td><?php echo $value["id"];?></td>
                <td><?php echo $value["last_update"];?></td>
                <td><?php echo $value["note"];?></td>
                <td>
                  <!-- Button to edit a work log -->
                  <button class="btn btn-success edit-log-btn" data-target="#edit-<?php echo $value["id"];?>" data-toggle="modal">
                    <span class="glyphicon glyphicon-edit"></span>
                  </button>
                </td>
              </tr>
            </tbody>
            <?php
          }
        }
        ?>
      </table>
      <?php require_once 'users/includes/html_footer.php'; ?>
    </div>
  </div>
</body>

<!-- IMPORT MODALS -->
<?php  require_once $abs_us_root.$us_url_root.'includes/modals/modal_add_log.php'; ?>
<?php  require_once $abs_us_root.$us_url_root.'includes/modals/modal_edit_log.php'; ?>
<?php  require_once $abs_us_root.$us_url_root.'includes/modals/modal_delete_log.php'; ?>

<!-- IMPORT FUNCTIONS -->
<?php  require_once $abs_us_root.$us_url_root.'includes/functions/functions_add_log.php'; ?>
<?php  require_once $abs_us_root.$us_url_root.'includes/functions/functions_edit_log.php'; ?>
<?php  require_once $abs_us_root.$us_url_root.'includes/functions/functions_delete_log.php'; ?>

<!-- IMPORT OTHER SCRIPTS -->
<script src="<?php echo $us_url_root ?>includes/scripts/scripts_delete_log.js" type="text/javascript"></script>
