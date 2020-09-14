<?php
if (isset($_POST['delete'])) {
    $id = $_POST['delete'];
    deleteLog($id);

    $_SESSION['message'] = "This log has been deleted.";
    $_SESSION['msg_type'] = "success";

    header("location: work_log.php");
}
?>
