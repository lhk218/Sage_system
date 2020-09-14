<?php
/**
* This file handles all create functions related to staff management.
*
* Framework used:
* UserSpice 5
* An Open Source PHP User Management System by the UserSpice Team at http://UserSpice.com
*
* @author Stephanie Gomes
* @version 19/04/2020
*/

$errors = $successes = [];
//$act = $results->email;
$form_valid=TRUE;
$hooks = getMyHooks(['page' =>'staff_list.php']);

$validation = new Validate();
if (!empty($_POST)) {
    includeHook($hooks,'post');

    //Manually Add User
    if(!empty($_POST['addUser'])) {
        $vericode_expiry=date("Y-m-d H:i:s",strtotime("+$settings->join_vericode_expiry hours",strtotime(date("Y-m-d H:i:s"))));
        $join_date = date("Y-m-d H:i:s");
        $fname = Input::get('fname');
        $lname = Input::get('lname');
        $email = Input::get('email');
        if($settings->auto_assign_un==1) {
            $username=username_helper($fname,$lname,$email);
            if(!$username) $username=NULL;
        } else {
            $username=Input::get('username');
        }
        $token = $_POST['csrf'];

        if(!Token::check($token)){
            include($abs_us_root.$us_url_root.'../usersc/scripts/token_error.php');
        }

        // Worst case
        $form_valid=FALSE;
        $validation->check($_POST,array(
                'username' => array(
                    'display' => 'Username',
                    'required' => true,
                    'min' => $settings->min_un,
                    'max' => $settings->max_un,
                    'unique' => 'users',
                ),
                'fname' => array(
                    'display' => 'First Name',
                    'required' => true,
                    'min' => 1,
                    'max' => 100,
                ),
                'lname' => array(
                    'display' => 'Last Name',
                    'required' => true,
                    'min' => 1,
                    'max' => 100,
                ),
                'email' => array(
                    'display' => 'Email',
                    'required' => true,
                    'valid_email' => true,
                    'unique' => 'users',
                    'min' => 5,
                    'max' => 100,
                ),

                'password' => array(
                    'display' => 'Password',
                    'required' => true,
                    'min' => $settings->min_pw,
                    'max' => $settings->max_pw,
                ),
                'confirm' => array(
                    'display' => 'Confirm Password',
                    'required' => true,
                    'matches' => 'password',
                ),
            ));

        // Form is valid
        if($validation->passed()) {
            $form_valid=TRUE;
            try {
                // echo "Trying to create user";
                $fields=array(
                    'username' => $username,
                    'fname' => ucfirst(Input::get('fname')),
                    'lname' => ucfirst(Input::get('lname')),
                    'email' => Input::get('email'),
                    'password' =>
                        password_hash(Input::get('password'), PASSWORD_BCRYPT, array('cost' => 12)),
                    'permissions' => 1,
                    'account_owner' => 1,
                    'join_date' => $join_date,
                    'email_verified' => 1,
                    'active' => 1,
                    'vericode' => randomstring(15),
                    'force_pr' => $settings->force_pr,
                    'vericode_expiry' => $vericode_expiry,
                    'oauth_tos_accepted' => true
                );
                $db->insert('users',$fields);
                $theNewId=$db->lastId();
                $perm = Input::get('perm');
                $addNewPermission = array('user_id' => $theNewId, 'permission_id' => 1);
                $db->insert('user_permission_matches',$addNewPermission);
                include($abs_us_root.$us_url_root.'../usersc/scripts/during_user_creation.php');

                $_SESSION['message'] = "This employee has been added.";
                $_SESSION['msg_type'] = "success";

                Redirect::to('staff_list.php');

            } catch (Exception $e) {
                die($e->getMessage());
            }
        }
    }
}
$random_password = random_password();

// Alerts generation
if(isset($_GET['action']) && $_GET['action'] == 'add') {
    if(!empty($_POST)){
        $username = test_input($_POST["username"]);
        $fname = test_input($_POST["fname"]);
        $lname = test_input($_POST["lname"]);
        $email = test_input($_POST["email"]);
        $password =$_POST["password"];
        $confirm = $_POST["confirm"];

        // check if username exists on the system
        if (checkUsernameExists($username)){
            $_SESSION['message'] = "This username is taken.";
            $_SESSION['msg_type'] = "danger";
        } else {
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
                        // check if email already exists on the system
                        if (checkEmailExists($email)) {
                            $_SESSION['message'] = "This email address is already used.";
                            $_SESSION['msg_type'] = "danger";
                        } else {
                            if ($password != $confirm) {
                                $_SESSION['message'] = "The passwords you entered did not match.";
                                $_SESSION['msg_type'] = "danger";
                            }
                        }
                    }
                }
            }
        }
        header("location: ".$us_url_root."managers/staff_list.php");
    }
}
?>
