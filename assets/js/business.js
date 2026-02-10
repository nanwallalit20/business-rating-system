$(document).ready(function () {

    const businessModal = new bootstrap.Modal(document.getElementById('businessModal'));

    function getAlertModal() {
        return bootstrap.Modal.getOrCreateInstance(document.getElementById('alertModal'));
    }

    /* =========================
       ALERT HELPERS
    ========================= */
    function showSuccess(message, type = 'Success') {
        $('#alertTitle').text(type);
        $('#alertMessage').html(message);

        $('#alertFooter').html(`
            <button class="btn btn-primary" data-bs-dismiss="modal">OK</button>
        `);

        getAlertModal().show();
    }

    function showConfirm(message, onConfirm) {
        $('#alertTitle').text('Confirm');
        $('#alertMessage').html(message);

        $('#alertFooter').html(`
            <button class="btn btn-danger" id="confirmYes">Yes</button>
            <button class="btn btn-secondary" data-bs-dismiss="modal">No</button>
        `);

        const modal = getAlertModal();
        modal.show();

        $(document)
            .off('click', '#confirmYes')
            .on('click', '#confirmYes', function () {
                modal.hide();
                onConfirm();
            });
    }

    /* =========================
       ADD BUSINESS
    ========================= */
    $('#btn-add-business').on('click', function () {
        $('#businessForm')[0].reset();
        $('#business_id').val('');
        $('#businessModalTitle').text('Add Business');
        businessModal.show();
    });

    /* =========================
       EDIT BUSINESS
    ========================= */
    $(document).on('click', '.btn-edit', function () {
        const id = $(this).data('id');

        $.post('ajax/business.php', { action: 'get', id }, function (res) {
            if (res.status) {
                $('#business_id').val(res.data.id);
                $('#business_name').val(res.data.name);
                $('#business_email').val(res.data.email);
                $('#business_phone').val(res.data.phone);
                $('#business_address').val(res.data.address);

                $('#businessModalTitle').text('Edit Business');
                businessModal.show();
            }
        }, 'json');
    });

    /* =========================
       SAVE BUSINESS
    ========================= */
    $('#saveBusinessBtn').on('click', function () {

        const formData = $('#businessForm').serializeArray();
        let data = { action: $('#business_id').val() ? 'update' : 'add' };

        formData.forEach(field => data[field.name] = field.value);

        $.post('ajax/business.php', data, function (res) {

            if (!res.status) {
                showSuccess(res.message, 'Error');
                return;
            }

            if (data.action === 'add') {
                const row = `
                    <tr id="row-${res.data.id}">
                        <td>${res.data.id}</td>
                        <td>${res.data.name}</td>
                        <td>${res.data.address}</td>
                        <td>${res.data.phone}</td>
                        <td>${res.data.email}</td>
                        <td>
                            <div class="raty-readonly"
                                 data-score="0"
                                 data-business-id="${res.data.id}">
                            </div>
                        </td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-warning btn-edit" data-id="${res.data.id}">
                                <i class="fa fa-edit"></i>
                            </button>
                            <button class="btn btn-sm btn-danger btn-delete" data-id="${res.data.id}">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                `;
                $('#business-table tbody').prepend(row);
                initReadonlyRaty();
            } else {
                const row = $(`#row-${data.id}`);
                row.find('td:eq(1)').text(data.name);
                row.find('td:eq(2)').text(data.address);
                row.find('td:eq(3)').text(data.phone);
                row.find('td:eq(4)').text(data.email);
            }

            businessModal.hide();
            showSuccess(res.message, 'Success');

        }, 'json');
    });

    /* =========================
       DELETE BUSINESS
    ========================= */
    let deleteId = null;

    $(document).on('click', '.btn-delete', function () {
        deleteId = $(this).data('id');

        showConfirm('Are you sure you want to delete this business?', function () {
            $.post('ajax/business.php', { action: 'delete', id: deleteId }, function (res) {
                if (res.status) {
                    $(`#row-${deleteId}`).fadeOut(300, function () {
                        $(this).remove();
                    });
                }
            }, 'json');
        });
    });

});
