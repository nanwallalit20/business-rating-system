$(document).ready(function () {

    const ratingModal = new bootstrap.Modal(document.getElementById('ratingModal'));

    function getAlertModal() {
        return bootstrap.Modal.getOrCreateInstance(document.getElementById('alertModal'));
    }

    function showAlert(title, message) {
        $('#alertTitle').text(title);
        $('#alertMessage').html(message);
        $('#alertFooter').html(`
            <button class="btn btn-primary" data-bs-dismiss="modal">OK</button>
        `);
        getAlertModal().show();
    }

    /* =========================
       Init Readonly Raty
    ========================= */
    window.initReadonlyRaty = function () {
        $('.raty-readonly').each(function () {
            const score = $(this).data('score');

            $(this).raty({
                readOnly: true,
                half: true,
                starType: 'i',
                starOn: 'fa fa-star text-warning',
                starOff: 'fa fa-star text-secondary',
                starHalf: 'fa fa-star-half-stroke text-warning',
                score: score
            });
        });
    };

    initReadonlyRaty();

    /* =========================
       Click Rating Column
    ========================= */
    $(document).on('click', '.raty-readonly', function () {
        const businessId = $(this).data('business-id');

        $('#ratingForm')[0].reset();
        $('#rating_business_id').val(businessId);
        $('#rating_value').val('');

        $('#ratingStars').empty().raty({
            half: true,
            starType: 'i',
            starOn: 'fa fa-star text-warning',
            starOff: 'fa fa-star text-secondary',
            starHalf: 'fa fa-star-half-stroke text-warning',
            click: function (score) {
                $('#rating_value').val(score);
            }
        });

        ratingModal.show();
    });

    /* =========================
       Submit Rating
    ========================= */
    $('#submitRatingBtn').on('click', function () {

        const data = $('#ratingForm').serialize();

        $.post('ajax/rating.php', data, function (res) {

            if (!res.status) {
                showAlert('Error', res.message);
                return;
            }

            const businessId = $('#rating_business_id').val();
            const ratyDiv = $(`.raty-readonly[data-business-id="${businessId}"]`);

            // 🔥 CORRECT WAY: destroy & re-init
            ratyDiv.raty('destroy');
            ratyDiv.empty();
            ratyDiv.data('score', res.avg_rating);

            ratyDiv.raty({
                readOnly: true,
                half: true,
                starType: 'i',
                starOn: 'fa fa-star text-warning',
                starOff: 'fa fa-star text-secondary',
                starHalf: 'fa fa-star-half-stroke text-warning',
                score: res.avg_rating
            });

            ratingModal.hide();
            showAlert('Success', res.message);

        }, 'json');
    });

});
