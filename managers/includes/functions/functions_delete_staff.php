<?php
/**
* This file handles all delete functions related to staff management.
*
* Framework used:
* UserSpice 5
* An Open Source PHP User Management System by the UserSpice Team at http://UserSpice.com
*
* @author Stephanie Gomes
* @version 19/04/2020
*/

if (isset($_POST['delete'])) {
    $id = $_POST['delete'];

    deleteUser($id);

    $_SESSION['message'] = "This employee has been deleted.";
    $_SESSION['msg_type'] = "success";

    header("location: ".$us_url_root."managers/staff_list.php");
}
?>
