<div class="modal fade" id="businessModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="businessModalTitle">Add Business</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <form id="businessForm">
                    <input type="hidden" name="id" id="business_id">

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Business Name</label>
                            <input type="text" name="name" id="business_name" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" id="business_email" class="form-control" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Phone</label>
                            <input type="text" name="phone" id="business_phone" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Address</label>
                            <textarea name="address" id="business_address" class="form-control" required></textarea>
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Cancel
                </button>
                <button type="submit" class="btn btn-primary" id="saveBusinessBtn">
                    Save
                </button>
            </div>

        </div>
    </div>
</div>
