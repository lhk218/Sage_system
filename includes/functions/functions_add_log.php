<?php
if(isset($_GET['action']) && $_GET['action'] == 'add') {
    if(!empty($_POST)){
        $userid = (int)$_POST["userid"];
        $note = $_POST["note"];

        addLog($userid, $note);

        $_SESSION['message'] = "This log has been added.";
        $_SESSION['msg_type'] = "success";

        header("location: work_log.php");
    }
}
?>
