<div class="modal fade" id="deleteLog">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Delete Shift Note</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form name="delete" method="POST">
                <!-- Modal body -->
                <div class="modal-body">
                    <p>Are you sure you want to delete this note?</p>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <input type="hidden" name="delete" value="" id="row-id-to-delete" />
                    <button type="submit" class="btn btn-danger">Confirm Deletion</button>
                    <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
  </div>
