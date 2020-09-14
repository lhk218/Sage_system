<?php
/**
 * This file provides the functions used by the scheduling algorithm.
 *
 * Framework used:
 * UserSpice 5
 * An Open Source PHP User Management System by the UserSpice Team at http://UserSpice.com
 *
 * @author Stephanie Gomes
 * @version 28/04/2020
 */

// Set the timezone
date_default_timezone_set("Europe/London");

/** Add a shift to database for given start and end dates
 *
 * @param string $start The start date of the shift
 * @param string $end The end date of the shift
 */
function addShift($start, $end) {
    $db = DB::getInstance();
    $query = $db->query("INSERT INTO sage_shifts (start_date, end_date) VALUES ('$start', '$end')");
}

/** Create Monday to Sunday shifts & add them to the database based on a scheduling period
 *
 * @param string $dateFrom The start date of the scheduling period
 * @param string $dateTo The end date of the scheduling period
 */
function createShifts($dateFrom, $dateTo)
{
    $from_date = strtotime($dateFrom);
    $to_date = strtotime($dateTo);
    for($i = strtotime('Monday', $from_date); $i <= $to_date; $i = strtotime('+1 week', $i)) {
        $start_shift = date('Y-m-d', $i);
        $end_shift = date("Y-m-d", strtotime("$start_shift +6 days"));
        addShift($start_shift, $end_shift);
    }
}

/** Get the end date of the last shift scheduled
 *
 * @return string The end date of the last shift scheduled or today's date
 */
function getLastEndDate() {
    $db = DB::getInstance();
    $query = "SELECT MAX(end_date) FROM sage_shifts";
    $results = $db->query($query)->results(true);
    foreach ($results as $key=>$value) {
        if ($value["MAX(end_date)"] != null) {
            return $value["MAX(end_date)"];
        } else {
            //if schedule is empty take today's date
            $today = date("Y-m-d");
            return $today;
        }
    }
}

/** Check if there are unassigned shifts on the database
 *
 * @return boolean Representing if there are unassigned shifts
 */
function checkUnassigned() {
    $db = DB::getInstance();
    $query = "SELECT id FROM sage_shifts WHERE user_id IS NULL";
    $unassigned = $db->query($query)->results(true);
    if(!empty($unassigned)) {
        //there are still shifts to be assigned
        return true;
    } else {
        //all shifts have been assigned
        return false;
    }
}

/** Retrieve the details of the earliest unassigned shift
 *
 *@return array Contains details of the earliest unassigned shift
 */
function getShift() {
    $db = DB::getInstance();
    $query = "SELECT id, start_date, end_date 
            FROM sage_shifts 
            WHERE start_date IN (
                SELECT MIN(start_date)
                FROM sage_shifts
                WHERE user_id IS NULL)";
    $shift=$db->query($query)->results(true);
    $shift_id="";
    $shift_start="";
    $shift_end="";
    foreach($shift as $key=>$value) {
        $shift_id = $value['id'];
        $shift_start = $value['start_date'];
        $shift_end = $value['end_date'];
    }
    $shift_details = array ($shift_id, $shift_start, $shift_end);
    return $shift_details;
}

/** Get the list of staff ordered by the amount of shifts they have worked/scheduled
 *
 * @return array Contains list of staff sorted by amount of shifts worked or scheduled
 */
function getSortedStaff()
{
    $db = DB::getInstance();
    $query = "SELECT user_id, SUM(count) AS count
            FROM (
                SELECT user_id, 0 AS count
                FROM user_permission_matches
                WHERE permission_id = 1
            UNION
                SELECT user_id, COUNT(*)
                FROM sage_shifts
                WHERE user_id IS NOT NULL
                GROUP BY user_id) a
            GROUP BY user_id
            ORDER BY 2";
    $users = $db->query($query)->results(true);
    return $users;
}

/** Check user shift preferences over a given period
 *
 * @param string $userid The user whose preferences to check
 * @param string $start The start date of the potential shift
 * @param string $end The end date of the potential shift
 *
 * @return boolean Representing if there are preferences for that period
 */
function checkPreference($userid, $start, $end) {
    $db = DB::getInstance();
    $query = "SELECT start_date, end_date 
            FROM sage_preferences 
            WHERE user_id = '$userid'
            AND start_date <= '$end'
            AND end_date >= '$start'";
    $pref = $db->query($query)->results(true);
    if(!empty($pref)) {
        //this employee has preferences not to work over this period
        return true;
    } else {
        //this employee has no preferences & can be scheduled
        return false;
    }
}

/** Check gap between two shifts is at least a month
 *
 * @param string $userid The user to check
 * @param string $start_date The start date of the potential shift
 *
 * @return boolean Representing if there is less than 30 days between shift
 * @throws Exception Null if the user has never worked
 */
function checkLastShift($userid, $start_date) {
    $db = DB::getInstance();
    $query = "SELECT MAX(end_date) FROM sage_shifts WHERE user_id='$userid'";
    $last_result = $db->query($query)->results(true);
    $last_shift="";
    foreach ($last_result as $key=>$value) {
        $last_shift = $value["MAX(end_date)"];
    }
    if($last_shift==null) {
        //this employee has never worked
        return false;
    } else if((new DateTime($last_shift))->diff(new DateTime($start_date))->days < 30) {
        //this employee has a shift less than 30 days before the unassigned shift
        return true;
    } else {
        //this employee has at least 30 days between shifts
        return false;
    }
}

/** Assign shift to a user
 *
 * @param string $userid The user to get the shift
 * @param string $shiftid The shift to be assigned
 *
 */
function assignShift($userid, $shiftid)
{
    $db = DB::getInstance();
    //assign the shift
    $query1 = $db->query("UPDATE sage_shifts SET user_id = '$userid' WHERE id = '$shiftid'");
}
?>