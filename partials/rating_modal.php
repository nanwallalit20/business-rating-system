<div class="modal fade" id="ratingModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Rate Business</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <form id="ratingForm">
                    <input type="hidden" name="business_id" id="rating_business_id">

                    <div class="mb-3">
                        <label class="form-label">Your Name</label>
                        <input type="text" name="name" id="rating_name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" id="rating_email" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Phone</label>
                        <input type="text" name="phone" id="rating_phone" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Rating</label>
                        <div id="ratingStars"></div>
                        <input type="hidden" name="rating" id="rating_value">
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button class="btn btn-primary" id="submitRatingBtn">Submit Rating</button>
            </div>

        </div>
    </div>
</div>
