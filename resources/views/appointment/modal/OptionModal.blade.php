<div class="modal" id="OptionModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmation</h5>
                <button type="button" class="btn-close" aria-label="Close" onclick="closeOptionModal()"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to proceed with the appointment?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeOptionModal()">Cancel</button>
                <button type="button" class="btn btn-primary" id="confirmButton"
                    onclick="closeOptionModal()">Confirm</button>
            </div>
        </div>
    </div>
</div>
