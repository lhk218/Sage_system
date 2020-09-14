<?php
/**
* This file displays the correct message when a change is made.
*
* Framework used:
* UserSpice 5
* An Open Source PHP User Management System by the UserSpice Team at http://UserSpice.com
*
* @author Stephanie Gomes
* @version 19/04/2020
*/
?>

<!--Modification alerts-->
<?php if (isset($_SESSION['message'])){ ?>
<div class="alert alert-<?=$_SESSION['msg_type']?>">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <?php
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    ?>
</div>
<?php } ?>
