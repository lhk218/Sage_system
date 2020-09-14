<?php
/**
* This file is the modal to add a staff member.
*
* Framework used:
* UserSpice 5
* An Open Source PHP User Management System by the UserSpice Team at http://UserSpice.com
*
* @author Stephanie Gomes
* @version 19/04/2020
*/
?>

<div id="adduser" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add staff</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">

        <!--Add Staff Form-->
        <form class="form-signup" action="<?php echo $us_url_root ?>managers/staff_list.php?action=add"  method="POST">
          <div class="panel-body">
            <?php if($settings->auto_assign_un==0) {?>
              <label for="username">Username: </label>&nbsp;&nbsp;<span id="usernameCheck" class="small"></span>
              <input type="text" class="form-control" id="username" name="username" placeholder="Username" autocomplete="new-password" value="<?php if (!$form_valid && !empty($_POST)){ echo $username;} ?>" required>
            <?php } ?>
            <br />

            <label for="fname">First Name: </label>
            <input type="text" class="form-control" id="fname" name="fname" placeholder="First Name" value="<?php if (!$form_valid && !empty($_POST)){ echo $fname;} ?>" required autocomplete="new-password">
            <br />

            <label for="lname">Last Name: </label>
            <input type="text" class="form-control" id="lname" name="lname" placeholder="Last Name" value="<?php if (!$form_valid && !empty($_POST)){ echo $lname;} ?>" required autocomplete="new-password">
            <br />

            <label for="email">Email: </label>
            <input  class="form-control" type="text" name="email" id="email" placeholder="Email Address" value="<?php if (!$form_valid && !empty($_POST)){ echo $email;} ?>" required autocomplete="new-password">
            <br />

            <label for="password">Password: </label>
            <div class="input-group" data-container="body">
              <input  class="form-control" type="password" name="password" id="password" <?php if($settings->force_pr==1) { ?>value="<?=$random_password?>" readonly<?php } ?> placeholder="Password" required autocomplete="new-password" aria-describedby="passwordhelp">
              <?php if($settings->force_pr==1) { ?>
                <span class="input-group-addon" id="addon2">
                  <a class="nounderline pwpopover" data-container="body" data-toggle="popover" data-placement="top" data-content="The Administrator has manual creation password resets enabled. If you choose to send an email to this user, it will supply them with the password reset link and let them know they have an account. If you choose to not, you should manually supply them with this password (discouraged).">Why can't I edit this?</a>
                </span>
              <?php } ?>
            </div>
            <br />

            <label for="confirm">Confirm Password: </label>
            <div class="input-group" data-container="body">
              <input  type="password" id="confirm" name="confirm" <?php if($settings->force_pr==1) { ?>value="<?=$random_password?>" readonly<?php } ?> class="form-control" autocomplete="new-password" placeholder="Confirm Password" required >
              <?php if($settings->force_pr==1) { ?>
                <span class="input-group-addon" id="addon2">
                  <a class="nounderline pwpopover" data-container="body" data-toggle="popover" data-placement="top" data-content="The Administrator has manual creation password resets enabled. If you choose to send an email to this user, it will supply them with the password reset link and let them know they have an account. If you choose to not, you should manually supply them with this password (discouraged).">Why can't I edit this?</a>
                </span>
              <?php } ?>
            </div>
          </div>

          <!-- Modal footer -->
          <div class="modal-footer">
            <div class="btn-group">
              <input type="hidden" name="csrf" value="<?=Token::generate();?>" />
              <input class='btn btn-primary' type='submit' id="addUser" name="addUser" value='Add User' class='submit' />
            </div>
            <div class="btn-group">
              <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
            </div>
          </div>
        </form>
        <!--Add Staff Form-->

      </div>
    </div>
  </div>
</div>
