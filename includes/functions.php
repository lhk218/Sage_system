<?php
/**
* Provides the general functions used by both manager and staff sections.
*
* Framework used:
* UserSpice 5
* An Open Source PHP User Management System by the UserSpice Team at http://UserSpice.com
*
* @author James Bradford and Stephanie Gomes
* @version 19/04/2020
*/

/*Shifts*/
/**
* Get full name
*
* Get a user's full name from a given shift ID
*
*
* @param int $shiftid - The id of a shift
* @return string - The full namer of a user
*/
function getFullNameFromShiftID($shift_id) {
  $db = DB::getInstance();
  $query = $db->query(
    "SELECT users.fname AS fname, users.lname AS lname
    FROM users
    INNER JOIN sage_shifts ON sage_shifts.user_id = users.id
    WHERE sage_shifts.id = $shift_id
    ")->first();
    return $query->fname . " " . $query->lname;
  }

  /**
  * Get shift details
  *
  * Returns a given attribute of a given shift ID
  *
  *
  * @param string $attribute - The attribute to be returned
  * @param int $shift_id - The id of a shift
  * @return string - The attribute of a given shift id
  */
  function getShiftDetails($attribute, $shift_id) {
    $db = DB::getInstance();
    $query = $db->query("SELECT * FROM sage_shifts WHERE id = $shift_id")->first()->$attribute;
    return $query;
  }

  /* SHIFT SWAPS */

  /**
  * Is shift swapped?
  *
  * Returns true if a shift is already up for swap and false if not.
  *
  *
  * @param int $shift_id - The id of a shift
  * @return boolean - The attribute of a given shift id
  */
  function isSwapped($shift_id) {
    $db = DB::getInstance();
    $query = $db->query("SELECT * FROM sage_shift_swaps WHERE shift_id = $shift_id")->results();
    if (count($query)>0) {return true;} else {return false;}
  }

  /**
  * Create a shift swap.
  *
  * Creates a new shift swap request.
  *
  *
  * @param int $shift_id - The id of a shift
  */
  function createSwap($shift_id) {
    $db = DB::getInstance();
    $user_id = $GLOBALS['user_id'];
    $query = $db->query("INSERT INTO sage_shift_swaps (id, requester_id, shift_id) VALUES (NULL, $user_id, $shift_id)")->results();
  }

  /**
  * Cancel a Swap
  *
  * Cancels a shift swap request.
  *
  *
  * @param int $request_id - The id of a swap request
  */
  function cancelSwap($request_id) {
    $db = DB::getInstance();
    $query = $db->query("DELETE FROM sage_shift_swaps WHERE id = $request_id")->results();
  }

  /**
  * Get shift swap status.
  *
  * Returns Open if the request is not accepted and Accepted if it has
  *
  *
  * @param int $request_id - The id of a request
  * @return string - The status of the shift swap.
  */
  function getSwapStatus($request_id) {
    $db = DB::getInstance();
    $respondent_id = $db->query("SELECT * FROM sage_shift_swaps WHERE id = $request_id")->first()->respondent_id;
    if ($respondent_id == NULL) {return 'Open';} else {return 'Accepted';}
  }

  /* WORK LOG */

  /**
  * Add log
  *
  * Add a log in the database
  *
  * @param int $user_id - The id of the author of the note
  * @param string $note - The content of the note
  */
  function addLog($user_id, $note) {
    $db = DB::getInstance();
    $stmt=$db->query("INSERT INTO sage_work_log (last_update, note, user_id) VALUES (NOW(), '$note', '$user_id')");
  }

  /**
  * Edit log
  *
  * Update a log in the database
  *
  * @param int $id - The id of the note to be updated
  * @param string $note - The updated content of the note
  */
  function editLog($id, $note) {
    $db = DB::getInstance();
    $stmt=$db->query("UPDATE sage_work_log SET last_update=NOW(), note='$note' WHERE id='$id'");
  }

  /**
  * Get all logs
  *
  * Retrieve all the logs in the database
  *
  * @return array - The details of all work logs in the system
  */
  function getAllWorkLogs() {
    $db = DB::getInstance();
    $logs = $db->query(
      "SELECT s.id, s.last_update, s.note, u.fname, u.lname
      FROM sage_work_log s
      JOIN users u ON u.id = s.user_id")->results(true);
      return $logs;
    }

    /**
    * Get a user's logs
    *
    * Retrieve all the logs written by a given user
    *
    * @param int $userid - The id of a user
    * @return array - The details of logs written by this user
    */
    function getMyWorkLogs($userid) {
      $db = DB::getInstance();
      $logs = $db->query(
        "SELECT id, last_update, note
        FROM sage_work_log
        WHERE user_id = ".$userid)->results(true);
        return $logs;
      }

      /**
      * Delete log
      *
      * Delete a log from the database
      *
      * @param int $id - The id of the log to be deleted.
      */
      function deleteLog($id) {
        $db = DB::getInstance();
        $stmt = $db->query("DELETE FROM sage_work_log WHERE id = ".$id);
      }
