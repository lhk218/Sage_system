<?php
if(isset($_GET['action']) && $_GET['action'] == 'edit') {
    if(!empty($_POST)){
        $id = (int)$_POST["id"];
        $note = $_POST["update_note"];

        editLog($id, $note);

        $_SESSION['message'] = "This log was successfully updated.";
        $_SESSION['msg_type'] = "success";

        header("location: work_log.php");
    }
}
?>
