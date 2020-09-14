<?php
/**
 * This file handles all functions used by the manager pages.
 *
 * Framework used:
 * UserSpice 5
 * An Open Source PHP User Management System by the UserSpice Team at http://UserSpice.com
 *
 * @author Stephanie Gomes, James Bradford
 * @version 18/04/2020
 */

$user_id = $user->data()->id;

/* SHIFTS */

/**
* Get all shifts
*
* Returns an array of all shifts in the database.
*
*
* @return array - Array of all shifts in the database.
*/
function getAllShifts() {
  $db = DB::getInstance();
  $query = $db->query("SELECT id, start_date, end_date FROM sage_shifts")->results();
  return $query;
}

/**
* Delete a shift
*
* Deletes a shift of a given id.
*
*
* @param int $shiftid - The id of a shift
*/
function deleteShiftByID($shift_id) {
  $db = DB::getInstance();
  $query = $db->query("DELETE FROM sage_shifts WHERE id = $shift_id")->results();
  $user_id = $db->query("SELECT * FROM sage_shifts WHERE id = $shift_id")->first()->user_id;
}

/**
* Create a shift.
*
* Creates a new shift for a given user.
*
*
* @param int $user_id - The id of a shift
* @param string $start_date - The start date of a shift
* @param string $end_date - The end date of a shift
* @param int $notes - The notes of a shift
*/
function addShift($user_id, $start_date, $end_date, $notes) {
  $db = DB::getInstance();
  $query = $db->query("INSERT INTO sage_shifts (id, user_id, start_date, end_date, notes) VALUES (NULL, $user_id, '$start_date', '$end_date', '$notes')")->results();
}

/**
* Edit a shift.
*
* Edits a given shift id.
*
*
* @param int $shift_id - The id of a shift
* @param string $start_date - The start date of a shift
* @param string $end_date - The end date of a shift
* @param int $notes - The notes of a shift
*/
function editShiftDates($shift_id, $start_date, $end_date, $notes) {
  $db = DB::getInstance();
  $query = $db->query("UPDATE sage_shifts SET start_date = '$start_date', end_date = '$end_date', notes = '$notes' WHERE id = $shift_id")->results();
  $user_id = $GLOBALS['user_id'];
  $log = $db->query("INSERT INTO sage_work_log (id, note, user_id) VALUES (NULL, 'Shift $shift_id updated', $user_id)")->results();
}

/**
* Reassign a shift.
*
* Reassigns a shift to a given user.
*
*
* @param int $shift_id - The id of a shift.
* @param int $user_id - The id of a user.
*/
function reassignShift($shift_id, $user_id) {
  $db = DB::getInstance();
  $query = $db->query("UPDATE sage_shifts SET user_id = '$user_id' WHERE id = $shift_id")->results();
  $user_id = $GLOBALS['user_id'];
  $log = $db->query("INSERT INTO sage_work_log (id, note, user_id) VALUES (NULL, 'Shift $shift_id reassigned', $user_id)")->results();
}

/* USERS */

/**
* Get users by role.
*
* Returns an array of users with a given role id.
*
*
* @param int $role_id - The id of a role.
* @return array - Array of users with a given role id.
*/
function getAllUsersByRole($role_id) {
  $db = DB::getInstance();
  $query = $db->query(
    "SELECT
            users.id as user_id,
            users.fname as firstname,
            users.lname as lastname
     FROM users
     INNER JOIN user_permission_matches ON user_permission_matches.user_id = users.id
     WHERE user_permission_matches.permission_id = $role_id
    ")->results();
    return $query;
}


// SHIFT SWAPS

/**
 * Gets a list of all swaps that have not been accepted
 *
 *
 * @return array - List of all open swaps
 */
function getAllOpenSwaps() {
  $db = DB::getInstance();
  $query = $db->query("SELECT * FROM sage_shift_swaps WHERE respondent_id IS NULL")->results();
  return $query;
}

/**
 * Gets a list of all swaps that have been accepted
 *
 *
 * @return array - List of all closed swaps
 */
function getAllClosedSwaps() {
  $db = DB::getInstance();
  $query = $db->query("SELECT * FROM sage_shift_swaps WHERE respondent_id IS NOT NULL LIMIT 10")->results();
  return $query;
}


/* STAFF */

/**
 * Get the list of staff
 *
 * Pull the list of details for users that are staff
 *
 * @return array - The details of all staff in the database
 */
function getStaffList() {
    $db = DB::getInstance();
    $staff = $db->query(
        "SELECT u.id, u.username, u.fname, u.lname, u.email AS email, u.join_date, u.last_login
            FROM users u
            JOIN user_permission_matches p ON p.user_id = u.id
            WHERE p.permission_id = 1")->results(true);
    return $staff;
}

/**
 * Edit staff
 *
 * Update the first name, last name and email of a user.
 *
 * @param int $id - The id of the user we are editing
 * @param string $fname - The first name submitted
 * @param string $lname - The last name submitted
 * @param string $email - The email submitted
 */
function editStaff($id, $fname, $lname, $email) {
    $db = DB::getInstance();
    $stmt=$db->query("UPDATE users SET fname = '$fname', lname = '$lname', email = '$email' WHERE id = '$id'");
}
/**
 * Test input
 *
 * Make sure the data input is safe to use
 *
 * @param string $data - The data submitted
 * @return string - A safe version of the data submitted
 */
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
/**
 * Check email
 *
 * Check if the submitted value is a valid email address
 *
 * @param string $email - The email address provided
 * @return boolean - Show if the format is valid
 */
function isEmail($email) {
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Email is valid
        return true;
    } else {
        // Email is invalid
        return false;
    }
}
/**
 * Check if email exists
 *
 * Check if the submitted email is already used by another user
 *
 * @param string $email - The email address provided
 * @return boolean - Show if the email already exists
 */
function checkEmailExists($email) {
    $db = DB::getInstance();
    $query = "SELECT id FROM users WHERE email = '$email'";
    $exist = $db->query($query)->results(true);
    if(!empty($exist)) {
        // Email address is already used on the system
        return true;
    } else {
        // Email address does not exist on the system - can be used
        return false;
    }
}
/**
 * Check username exists
 *
 * Check if the submitted username is already used by another user
 *
 * @param string $username - The username provided
 * @return boolean - Show if the username already exists
 */
function checkUsernameExists($username) {
    $db = DB::getInstance();
    $query = "SELECT id FROM users WHERE username = '$username'";
    $exist = $db->query($query)->results(true);
    if(!empty($exist)) {
        // Username is already used on the system
        return true;
    } else {
        //Username does not exist on the system - can be used
        return false;
    }
}
/**
 * Delete user
 *
 * Deletes a user from the database
 *
 * @param int $userid - The id of the user to be deleted
 */
function deleteUser($userid) {
    $db = DB::getInstance();
    $query1 = $db->query("DELETE FROM users WHERE id = ".$userid);
    $query2 = $db->query("DELETE FROM user_permission_matches WHERE user_id = ".$userid);
}
