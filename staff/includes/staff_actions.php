<?php
/**
* This file handles all the actions that staff members can take.
*
* Framework used:
* UserSpice 5
* An Open Source PHP User Management System by the UserSpice Team at http://UserSpice.com
*
* @author James Bradford
* @version 19/04/2020
*/

require_once '../../users/init.php';
require_once $abs_us_root.$us_url_root.'/users/includes/template/prep.php';
require_once $abs_us_root.$us_url_root.'staff/includes/staff_functions.php';
require_once $abs_us_root.$us_url_root.'includes/imports.php';

if (isset($_GET['action'])) {
  switch ($_GET['action']) {
    case 'cancelSwap':
    cancelSwap($_POST['request_id']);
    $_SESSION['msg_type'] = "success";
    $_SESSION['message'] = "Swap successfully cancelled";
    header('Location: '.$us_url_root.'staff/shift_swaps.php');
    break;

    case 'acceptSwap':
    acceptSwap($_POST['request_id']);
    $_SESSION['msg_type'] = "success";
    $_SESSION['message'] = "Swap successfully accepted";
    header('Location: '.$us_url_root.'staff/shift_swaps.php');
    break;

    case 'createSwap':
    createSwap($_POST['shift_id']);
    $_SESSION['msg_type'] = "success";
    $_SESSION['message'] = "Swap successfully created";
    header('Location: '.$us_url_root.'staff/shift_swaps.php');
    break;

    case 'createPreference':
    $start_date = date_format(date_create($_POST['start_date']),"Y/m/d");
    $end_date = date_format(date_create($_POST['end_date']),"Y/m/d");
    createPreference($start_date, $end_date);
    $_SESSION['msg_type'] = "success";
    $_SESSION['message'] = "Preference successfully created";
    header('Location: '.$us_url_root.'staff/shift_preferences.php');
    break;

    case 'cancelPreference':
    cancelPreference($_POST['preference_id']);
    $_SESSION['msg_type'] = "success";
    $_SESSION['message'] = "Preference successfully cancelled";
    header('Location: '.$us_url_root.'staff/shift_preferences.php');
    break;

    case 'createShift':
    $start_date = date_format(date_create($_POST['start_date']),"Y/m/d");
    $end_date = date_format(date_create($_POST['end_date']),"Y/m/d");
    addShift($_POST['staff'], $start_date, $end_date, $_POST['notes']);
    $_SESSION['msg_type'] = "success";
    $_SESSION['message'] = "Shift successfully created";
    header('Location: ../index.php?new=success');
    break;


  }
}
