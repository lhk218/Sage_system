<?php
/**
* This file handles all create, read, update and delete functions related to staff management.
*
* Framework used:
* UserSpice 5
* An Open Source PHP User Management System by the UserSpice Team at http://UserSpice.com
*
* @author Stephanie Gomes
* @version 19/04/2020
*/

require_once '../users/init.php';
require_once $abs_us_root.$us_url_root.'users/includes/template/prep.php';
require_once $abs_us_root.$us_url_root.'managers/includes/manager_messages.php';
require_once $abs_us_root.$us_url_root.'managers/includes/manager_functions.php';
require_once $abs_us_root.$us_url_root.'includes/imports.php';
if (!securePage($_SERVER['PHP_SELF'])){die();}
?>

<!--Import CSS-->
<link rel="stylesheet" type="text/css" href="<?php echo $us_url_root ?>includes/custom_css.css" />

<body>

  <!--Page Containers-->
  <div class="container">
    <div class="content mt-3">
      <h1>User Management</h1>
      <hr />

      <!-- Button to add staff -->
      <div>
        <button class="btn btn-success pull-left" href="#" data-toggle="modal" data-target="#adduser">+ Add Staff</button></br></br>
      </div>
      <hr />
      <div class="alluinfo">&nbsp;</div>
      <div class="allutable">

        <!--Staff table -->
        <table id="paginate" class='table table-bordered table-list-search text-center'>
          <thead>
            <tr>
              <th class='align-middle'>User ID</th>
              <th class='align-middle'>Username</th>
              <th class='align-middle'>First name</th>
              <th class='align-middle'>Last name</th>
              <th class='align-middle'>Email address</th>
              <th class='align-middle'>Creation date</th>
              <th class='align-middle'>Last logged in</th>
              <th class='align-middle'>Edit</th>
              <th class='align-middle'>Delete</th>
            </tr>
          </thead>
          <?php
          // Pull list of staff from database
          $results = getStaffList();
          foreach ($results as $key=>$value)  {
            ?>
            <tbody>
              <tr>
                <td><?php echo $value["id"]; ?></td>
                <td><?php echo $value["username"]; ?></td>
                <td><?php echo $value["fname"]; ?></td>
                <td><?php echo $value["lname"]; ?></td>
                <td><?php echo $value["email"]; ?></td>
                <td><?php echo date("Y-m-d", strtotime($value["join_date"])); ?></td>
                <td><?php if ($value["last_login"] != 0) {echo $value["last_login"];} else {echo "Never";} ?></td>
                <td>
                  <!-- Edit staff button -->
                  <button class="btn btn-primary pull-right edit-staff-btn" data-target="#edit-<?php echo $value["id"];?>" data-toggle="modal">
                    <span class="glyphicon glyphicon-edit"></span>
                  </button>
                </td>
                <td>
                  <!-- Delete staff button -->
                  <button class="btn btn-danger delete-user-btn" data-toggle="modal" data-target="#deleteStaff" data-id="<?php echo $value["id"]; ?>" >
                    <span class="glyphicon glyphicon-trash"></span>
                  </button>
                </td>
              </tr>
            </tbody>
            <?php
          }
          ?>
        </table>
      </div></br></br>
      <?php require_once '../users/includes/html_footer.php'; ?>
    </div>
  </div>
</body>

<!-- IMPORT FUNCTIONS -->
<?php require_once $abs_us_root.$us_url_root.'managers/includes/functions/functions_delete_staff.php'; ?>
<?php require_once $abs_us_root.$us_url_root.'managers/includes/functions/functions_add_staff.php'; ?>
<?php require_once $abs_us_root.$us_url_root.'managers/includes/functions/functions_edit_staff.php'; ?>

<!-- IMPORT MODALS -->
<?php require_once $abs_us_root.$us_url_root.'managers/includes/modals/modal_edit_staff.php'; ?>
<?php require_once $abs_us_root.$us_url_root.'managers/includes/modals/modal_add_staff.php'; ?>
<?php require_once $abs_us_root.$us_url_root.'managers/includes/modals/modal_delete_staff.php'; ?>

<!-- Add Staff JavaScript Script -->
<script type="text/javascript" src="js/pagination/datatables.min.js"></script>
<script src="js/jwerty.js"></script>

<!-- IMPORT OTHER SCRIPTS -->
<script src="<?php echo $us_url_root ?>managers/includes/scripts/scripts_add_staff.js" type="text/javascript"></script>
<script src="<?php echo $us_url_root ?>managers/includes/scripts/scripts_delete_staff.js" type="text/javascript"></script>
</html>
