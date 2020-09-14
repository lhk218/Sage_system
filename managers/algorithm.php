<?php
/**
 * This file handles the creation and assignment of shifts equally between all members of staff.
 * The rota provides shifts 6 months in advance and takes into account shift preferences, while leaving at least
 * a month between shifts.  This will only work if there is a minimum of six staff members in the database.
 *
 * Framework used:
 * UserSpice 5
 * An Open Source PHP User Management System by the UserSpice Team at http://UserSpice.com
 *
 * @author Stephanie Gomes
 * @version 28/04/2020
 */

include 'algorithm_functions.php';

require_once '../users/init.php';
require_once $abs_us_root.$us_url_root.'users/includes/template/prep.php';
require_once $abs_us_root.$us_url_root.'includes/imports.php';
//if (!securePage($_SERVER['PHP_SELF'])){die();}

// Check what the last scheduled date is
$lastShift = getLastEndDate();

// Set the start and end date of the scheduling period
$dateFrom = date("Y-m-d", strtotime("$lastShift +1 day"));
$dateTo = '';

// Check when the last shift was in order to define the end of the scheduling period
if($lastShift == date('Y-m-d')) {
    // There are no shifts in the rota so we have to schedule for 6 months
    $dateTo = date("Y-m-d", strtotime("$dateFrom +6 months"));
} else {
    // There are shifts in the rota so we only have to schedule for 1 month
    $dateTo = date("Y-m-d", strtotime("$dateFrom +31 days"));
}

// Create all the unassigned shifts for this period in the database
createShifts($dateFrom, $dateTo);

// Iterate through the unassigned shifts
while(checkUnassigned()) {

    // Retrieve the details of the earliest unassigned shift
    $shift = getShift();
    $shift_id = $shift[0];
    $shift_start = $shift[1];
    $shift_end = $shift[2];

    // Get the list of staff sorted by amount of shifts worked/scheduled
    $staff_list = getSortedStaff();

    // Iterate through this list to find an employee suitable to work this shift
    foreach($staff_list as $key=>$value) {

        // Check if this employee has shift preferences that overlap with this shift
        if(!checkPreference($value["user_id"], $shift_start, $shift_end)) {

            // Check if this employee has at least a 30 day break after last scheduled shift
            if(!checkLastShift($value["user_id"], $shift_start)) {

                // Assign the shift
                assignShift($value["user_id"], $shift_id);
                // Go back to the while loop
                break 1;
            }
        }
    }
}

if (isset($_GET['redirect'])) {
  header("Location:".$us_url_root."index.php");
}

?>
