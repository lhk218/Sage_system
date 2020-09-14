<div class="modal fade" id="addlog" >
    <div class="modal-dialog" >
        <div class="modal-content">

            <!-- Modal header -->
            <div class="modal-header">
                <h4 class="modal-title" id="titleEvent">New Shift Note</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body-->
            <div class="modal-body">
                <form method="POST" id="add_form" action="work_log.php?action=add">
                    <label for="note">Note:</label>
                    <textarea id="note" name="note" rows="3" class="form-control" placeholder="New..." required></textarea>
                    <br>
                    <input type="hidden" name="userid" id="userid" value="<?php echo $userid; ?>">

                    <!-- Modal footer-->
                    <input type="submit" name="btnSave" id="btnSave" class="btn btn-primary" value="Save">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                </form>
            </div>

        </div>
    </div>
</div>
