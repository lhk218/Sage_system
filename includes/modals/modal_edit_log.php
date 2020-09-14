<?php
// Retrieve all logs in the database
$results = getAllWorkLogs();
foreach ($results as $key=>$value) {
?>

    <div class="modal fade" id="edit-<?php echo $value["id"];?>" >
        <div class="modal-dialog" >
            <div class="modal-content">

                <!-- Modal header -->
                <div class="modal-header">
                    <h4 class="modal-title" id="titleEvent">Edit Shift Note</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form method="POST" id="edit_form" action="work_log.php?action=edit">
                        <label for="update_note">Update Note:</label>
                        <input type="hidden" id="id" name="id" value="<?php echo $value["id"];?>" />
                        <textarea id="update_note" name="update_note" rows="3" class="form-control" required><?php echo $value["note"];?></textarea>
                        <br>

                        <!-- Modal footer-->
                        <input type="submit" name="btnSave" id="btnSave" class="btn btn-primary" value="Save" />
                        <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php } ?>
