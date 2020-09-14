<?php
/**
* Redirects the user to the correct page after login depending on role.
*
* Framework used:
* UserSpice 5
* An Open Source PHP User Management System by the UserSpice Team at http://UserSpice.com
*
* @author UserSpice (Edited by James Bradford)
* @version 19/04/2020
*/
//Whatever you put here will happen after the username and password are verified and the user is "technically" logged in, but they have not yet been redirected to their starting page.  This gives you access to all the user's data through $user->data()

//Where do you want to redirect the user after login
//in this example, admins will go to the dashboard and others will go to the location you configured
//in the dashboard under settings->general->Redirect After Login

//Added manager and staff roles that redirect to index.php
if(hasPerm([2],$user->data()->id)){
  Redirect::to($us_url_root.'users/admin.php');
}else if (hasPerm([3],$user->data()->id)){
  Redirect::to($us_url_root.'index.php');
}else if (hasPerm([1],$user->data()->id)) {
  Redirect::to($us_url_root.'index.php');
}
?>
