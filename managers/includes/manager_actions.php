<?php
/**
* Provides the general functionality to the manager section.
*
* Framework used:
* UserSpice 5
* An Open Source PHP User Management System by the UserSpice Team at http://UserSpice.com
*
* @author James Bradford and Stephanie Gomes
* @version 19/04/2020
*/

require_once '../../users/init.php';
require_once $abs_us_root.$us_url_root.'/users/includes/template/prep.php';
require_once $abs_us_root.$us_url_root.'managers/includes/manager_functions.php';
require_once $abs_us_root.$us_url_root.'includes/imports.php';

if (isset($_GET['action'])) {
  $action = $_GET['action'];

  //Get the action
  switch($action) {
    
    case 'addshift':
      $start_date = date_format(date_create($_POST['start_date']),"Y/m/d");
      $end_date = date_format(date_create($_POST['end_date']),"Y/m/d");
      addShift($_POST['staff'], $start_date, $end_date, $_POST['notes']);
      header('Location: '.$us_url_root.'index.php?new=success');
      break;

      case 'delete':
      deleteShiftByID($_GET['shiftid']);
      header('Location: '.$us_url_root.'index.php?delete=success');
      break;

      case 'editdate':
      $formatted_start_date = date_format(date_create($_POST['start_date']), 'Y/m/d');
      $formatted_end_date = date_format(date_create($_POST['end_date']), 'Y/m/d');
      editShiftDates($_POST['shift_id'], $formatted_start_date, $formatted_end_date, $_POST['notes']);
      header('Location: '.$us_url_root.'index.php?edit=success');
      break;

      case 'reassign':
      reassignShift($_POST['shift_id'], $_POST['staff']);
      header('Location: '.$us_url_root.'managers/shift_view.php?shiftid='.$_POST['shift_id'].'&reassign=success');
      break;

      case 'createSwap':
      createSwap($_POST['shift_id']);
      header('Location: '.$us_url_root.'managers/shift_swaps.php');
      break;

      case 'cancelSwap':
      cancelSwap($_POST['request_id']);
      header('Location: '.$us_url_root.'managers/shift_swaps.php');
      break;
    }
  }
