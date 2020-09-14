<?php
/**
* This file handles all functions related to staff members.
*
* Framework used:
* UserSpice 5
* An Open Source PHP User Management System by the UserSpice Team at http://UserSpice.com
*
* @author James Bradford
* @version 19/04/2020
*/

//Assign Variables
$user_id = $user->data()->id;

/* SHIFTS */

/** Returns an array of shifts for the current user.
 *
 * @return array - Array of shifts for the current user.
 */
function getUserShifts() {
  $db = DB::getInstance();
  $user_id = $GLOBALS['user_id'];
  $query = $db->query("SELECT * FROM sage_shifts WHERE user_id = $user_id")->results();
  return $query;
}

/* SHIFT SWAPS */

/** Returns an array of open shift swaps for the current user.
 *
 * @return array - Array of shift swaps for the current user.
 */
function getOpenUserSwaps() {
  $db = DB::getInstance();
  $user_id = $GLOBALS['user_id'];
  $query = $db->query("SELECT * FROM sage_shift_swaps WHERE requester_id = $user_id AND respondent_id IS NULL")->results();
  return $query;
}

/** Returns an array of closed shift shifts for the current user.
 *
 * @return array - Array of shift swaps for the current user.
 */
function getClosedUserSwaps() {
  $db = DB::getInstance();
  $user_id = $GLOBALS['user_id'];
  $query = $db->query("SELECT * FROM sage_shift_swaps WHERE requester_id = $user_id AND respondent_id IS NOT NULL LIMIT 10")->results();
  return $query;
}

/** Returns an array of shift swaps not requested by the current user.
 *
 * @return array - Array of shift swaps.
 */
function getOpenSwaps() {
  $db = DB::getInstance();
  $user_id = $GLOBALS['user_id'];
  $query = $db->query("SELECT * FROM sage_shift_swaps WHERE requester_id != $user_id AND respondent_id IS NULL")->results();
  return $query;
}

/** Accepts a shift swap for a given user.
 *
 * @param $request_id - Given request ID.
 */
function acceptSwap($request_id) {
  $db = DB::getInstance();
  $respondent_id = $GLOBALS['user_id'];
  $requester_id = $db->query("SELECT * FROM sage_shift_swaps WHERE id = $request_id")->first()->requester_id;
  $query = $db->query("UPDATE sage_shift_swaps SET respondent_id = $respondent_id WHERE id = $request_id")->results();
  $shift_id = $db->query("SELECT * FROM sage_shift_swaps WHERE id = $request_id")->first()->shift_id;
  $query2 = $db->query("UPDATE sage_shifts SET user_id = $user_id WHERE id = $shift_id")->results();
}

/* SHIFT PREFERENCES */

/** Returns an array of shifts for the current user.
 *
 * @param $start_date - Start date of the preference.
 * @param $end_date - End date of the preference.
 */
function createPreference($start_date, $end_date) {
  $db = DB::getInstance();
  $user_id = $GLOBALS['user_id'];
  $query = $db->query("INSERT INTO sage_preferences (id, user_id, start_date, end_date) VALUES (NULL, $user_id, '$start_date', '$end_date')");
}

/** Cancels a preference of a given id.
 *
 * @param $preference_id - ID of the preference to be cancelled.
 */
function cancelPreference($preference_id) {
  $db = DB::getInstance();
  $query = $db->query("DELETE FROM sage_preferences WHERE id = $preference_id")->results();
}

/** Returns an array of requests for the current user.
 *
 * @return array - Array of requests for the current user.
 */
function getUserPreferences() {
  $db = DB::getInstance();
  $user_id = $GLOBALS['user_id'];
  $query = $db->query("SELECT * FROM sage_preferences WHERE user_id = $user_id")->results();
  return $query;
}
