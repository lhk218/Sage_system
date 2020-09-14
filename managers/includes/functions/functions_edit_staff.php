<?php
/**
* This file handles all edit functions related to staff management.
*
* Framework used:
* UserSpice 5
* An Open Source PHP User Management System by the UserSpice Team at http://UserSpice.com
*
* @author Stephanie Gomes
* @version 19/04/2020
*/

if(isset($_GET['action']) && $_GET['action'] == 'edit') {
    if(!empty($_POST)){
        $id = (int)$_POST["id"];
        $fname = test_input($_POST["fname"]);
        $lname = test_input($_POST["lname"]);
        $email = test_input($_POST["email"]);

        // check if first name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z ]*$/", $fname)) {
            $_SESSION['message'] = "Only letters and white space are allowed in the first name.";
            $_SESSION['msg_type'] = "danger";
        } else {
            // check if last name only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z ]*$/", $lname)) {
                $_SESSION['message'] = "Only letters and white space are allowed in the last name.";
                $_SESSION['msg_type'] = "danger";
            } else {
                // check if email is valid
                if (!isEmail($email)) {
                    $_SESSION['message'] = "Invalid email format.";
                    $_SESSION['msg_type'] = "danger";
                } else {
                        // update the user details
                        editStaff($id, $fname, $lname, $email);

                        $_SESSION['message'] = "This employee was successfully updated.";
                        $_SESSION['msg_type'] = "success";

                }
            }
        }
        header("location: ".$us_url_root."managers/staff_list.php");
    }
}
?>
